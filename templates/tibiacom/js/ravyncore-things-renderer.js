(function () {
  var outfitColors = [
    0xffffff, 0xffd4bf, 0xffe9bf, 0xffffbf, 0xe9ffbf, 0xd4ffbf,
    0xbfffbf, 0xbfffd4, 0xbfffe9, 0xbfffff, 0xbfe9ff, 0xbfd4ff,
    0xbfbfff, 0xd4bfff, 0xe9bfff, 0xffbfff, 0xffbfe9, 0xffbfd4,
    0xffbfbf, 0xdadada, 0xbf9f8f, 0xbfaf8f, 0xbfbf8f, 0xafbf8f,
    0x9fbf8f, 0x8fbf8f, 0x8fbf9f, 0x8fbfaf, 0x8fbfbf, 0x8fafbf,
    0x8f9fbf, 0x8f8fbf, 0x9f8fbf, 0xaf8fbf, 0xbf8fbf, 0xbf8faf,
    0xbf8f9f, 0xbf8f8f, 0xb6b6b6, 0xbf7f5f, 0xbfaf8f, 0xbfbf5f,
    0x9fbf5f, 0x7fbf5f, 0x5fbf5f, 0x5fbf7f, 0x5fbf9f, 0x5fbfbf,
    0x5f9fbf, 0x5f7fbf, 0x5f5fbf, 0x7f5fbf, 0x9f5fbf, 0xbf5fbf,
    0xbf5f9f, 0xbf5f7f, 0xbf5f5f, 0x919191, 0xbf6a3f, 0xbf943f,
    0xbfbf3f, 0x94bf3f, 0x6abf3f, 0x3fbf3f, 0x3fbf6a, 0x3fbf94,
    0x3fbfbf, 0x3f94bf, 0x3f6abf, 0x3f3fbf, 0x6a3fbf, 0x943fbf,
    0xbf3fbf, 0xbf3f94, 0xbf3f6a, 0xbf3f3f, 0x6d6d6d, 0xff5500,
    0xffaa00, 0xffff00, 0xaaff00, 0x54ff00, 0x00ff00, 0x00ff54,
    0x00ffaa, 0x00ffff, 0x00a9ff, 0x0055ff, 0x0000ff, 0x5500ff,
    0xa900ff, 0xfe00ff, 0xff00aa, 0xff0055, 0xff0000, 0x484848,
    0xbf3f00, 0xbf7f00, 0xbfbf00, 0x7fbf00, 0x3fbf00, 0x00bf00,
    0x00bf3f, 0x00bf7f, 0x00bfbf, 0x007fbf, 0x003fbf, 0x0000bf,
    0x3f00bf, 0x7f00bf, 0xbf00bf, 0xbf007f, 0xbf003f, 0xbf0000,
    0x242424, 0x7f2a00, 0x7f5500, 0x7f7f00, 0x557f00, 0x2a7f00,
    0x007f00, 0x007f2a, 0x007f55, 0x007f7f, 0x00547f, 0x002a7f,
    0x00007f, 0x2a007f, 0x54007f, 0x7f007f, 0x7f0055, 0x7f002a,
    0x7f0000
  ];

  var manifestCache = {};
  var imageCache = {};

  function colorMultiplier(id) {
    var value = outfitColors[id] || 0;
    return [(value >> 16) & 255, (value >> 8) & 255, value & 255];
  }

  function loadManifest(url) {
    if (!manifestCache[url]) {
      manifestCache[url] = fetch(url, { cache: "force-cache" }).then(function (response) {
        if (!response.ok) {
          throw new Error("Unable to load things manifest");
        }
        return response.json();
      });
    }
    return manifestCache[url];
  }

  function loadImage(url) {
    if (!imageCache[url]) {
      imageCache[url] = new Promise(function (resolve, reject) {
        var image = new Image();
        image.onload = function () { resolve(image); };
        image.onerror = reject;
        image.src = url;
      });
    }
    return imageCache[url];
  }

  function buildSheetList(manifest) {
    if (!manifest._sheetList) {
      manifest._sheetList = Object.keys(manifest.sheets || {}).map(function (key) {
        var sheet = manifest.sheets[key];
        sheet.file = key;
        return sheet;
      }).sort(function (a, b) {
        return a.first - b.first;
      });
    }
    return manifest._sheetList;
  }

  function findSheet(manifest, spriteId) {
    var sheets = buildSheetList(manifest);
    var low = 0;
    var high = sheets.length - 1;
    while (low <= high) {
      var mid = Math.floor((low + high) / 2);
      var sheet = sheets[mid];
      if (spriteId < sheet.first) {
        high = mid - 1;
      } else if (spriteId > sheet.last) {
        low = mid + 1;
      } else {
        return sheet;
      }
    }
    return null;
  }

  function spriteIndex(appearance, layer, x, y, z, phase) {
    return (((phase % appearance.phases) * appearance.patternDepth + z) * appearance.patternHeight + y) *
      appearance.patternWidth * appearance.layers + x * appearance.layers + layer;
  }

  function addonPatterns(addons, maxPatterns) {
    var patterns = [0];
    if (addons === 1 || addons === 3) {
      patterns.push(1);
    }
    if (addons === 2 || addons === 3) {
      patterns.push(2);
    }
    return patterns.filter(function (pattern) {
      return pattern < maxPatterns;
    });
  }

  function colorize(baseCanvas, templateCanvas, colors) {
    var context = baseCanvas.getContext("2d");
    var templateContext = templateCanvas.getContext("2d");
    var base = context.getImageData(0, 0, baseCanvas.width, baseCanvas.height);
    var template = templateContext.getImageData(0, 0, templateCanvas.width, templateCanvas.height);
    var multipliers = {
      head: colorMultiplier(colors.head),
      body: colorMultiplier(colors.body),
      legs: colorMultiplier(colors.legs),
      feet: colorMultiplier(colors.feet)
    };

    for (var i = 0; i < base.data.length; i += 4) {
      if (!base.data[i + 3] || !template.data[i + 3]) {
        continue;
      }

      var tr = template.data[i];
      var tg = template.data[i + 1];
      var tb = template.data[i + 2];
      var target = null;

      if (tr && tg && !tb) {
        target = multipliers.head;
      } else if (tr && !tg && !tb) {
        target = multipliers.body;
      } else if (!tr && tg && !tb) {
        target = multipliers.legs;
      } else if (!tr && !tg && tb) {
        target = multipliers.feet;
      }

      if (!target) {
        continue;
      }

      base.data[i] = Math.floor(base.data[i] * (target[0] / 255));
      base.data[i + 1] = Math.floor(base.data[i + 1] * (target[1] / 255));
      base.data[i + 2] = Math.floor(base.data[i + 2] * (target[2] / 255));
    }

    context.putImageData(base, 0, 0);
  }

  function firstVisibleBounds(canvas) {
    var data = canvas.getContext("2d").getImageData(0, 0, canvas.width, canvas.height).data;
    var bounds = { left: canvas.width, top: canvas.height, right: -1, bottom: -1 };
    for (var y = 0; y < canvas.height; y++) {
      for (var x = 0; x < canvas.width; x++) {
        if (data[(y * canvas.width + x) * 4 + 3]) {
          bounds.left = Math.min(bounds.left, x);
          bounds.top = Math.min(bounds.top, y);
          bounds.right = Math.max(bounds.right, x);
          bounds.bottom = Math.max(bounds.bottom, y);
        }
      }
    }
    return bounds.right >= 0 ? bounds : null;
  }

  async function renderCanvas(canvas) {
    var manifestUrl = canvas.getAttribute("data-manifest");
    var lookType = canvas.getAttribute("data-looktype");
    var manifest = await loadManifest(manifestUrl);
    var appearance = manifest.appearances && manifest.appearances[lookType];
    if (!appearance) {
      throw new Error("Missing appearance " + lookType);
    }

    var direction = Math.min(Math.max(parseInt(canvas.getAttribute("data-direction") || "2", 10), 0), appearance.patternWidth - 1);
    var addons = parseInt(canvas.getAttribute("data-addons") || "3", 10);
    var z = 0;
    var phase = 0;
    var patterns = addonPatterns(addons, appearance.patternHeight);
    var firstSpriteId = appearance.spriteIds[0];
    var firstSheet = findSheet(manifest, firstSpriteId);
    var width = firstSheet ? firstSheet.spriteWidth : 64;
    var height = firstSheet ? firstSheet.spriteHeight : 64;
    var baseCanvas = document.createElement("canvas");
    var templateCanvas = document.createElement("canvas");
    baseCanvas.width = templateCanvas.width = width;
    baseCanvas.height = templateCanvas.height = height;
    var baseContext = baseCanvas.getContext("2d");
    var templateContext = templateCanvas.getContext("2d");
    baseContext.imageSmoothingEnabled = false;
    templateContext.imageSmoothingEnabled = false;

    for (var p = 0; p < patterns.length; p++) {
      for (var layer = 0; layer < appearance.layers; layer++) {
        var index = spriteIndex(appearance, layer, direction, patterns[p], z, phase);
        var spriteId = appearance.spriteIds[index];
        var sheet = findSheet(manifest, spriteId);
        if (!sheet) {
          continue;
        }

        var image = await loadImage(new URL(sheet.src, manifestUrl).href);
        var offset = spriteId - sheet.first;
        var sheetSize = manifest.spriteSheetSize || 384;
        var columns = Math.max(1, Math.floor(sheetSize / sheet.spriteWidth));
        var sx = (offset % columns) * sheet.spriteWidth;
        var sy = Math.floor(offset / columns) * sheet.spriteHeight;
        var targetContext = layer === 0 ? baseContext : templateContext;
        targetContext.drawImage(image, sx, sy, sheet.spriteWidth, sheet.spriteHeight, 0, 0, sheet.spriteWidth, sheet.spriteHeight);
      }
    }

    colorize(baseCanvas, templateCanvas, {
      head: parseInt(canvas.getAttribute("data-head") || "95", 10),
      body: parseInt(canvas.getAttribute("data-body") || "114", 10),
      legs: parseInt(canvas.getAttribute("data-legs") || "39", 10),
      feet: parseInt(canvas.getAttribute("data-feet") || "115", 10)
    });

    var context = canvas.getContext("2d");
    var bounds = firstVisibleBounds(baseCanvas);
    canvas.width = parseInt(canvas.getAttribute("width") || "96", 10);
    canvas.height = parseInt(canvas.getAttribute("height") || "96", 10);
    context.imageSmoothingEnabled = false;
    context.clearRect(0, 0, canvas.width, canvas.height);

    if (!bounds) {
      return;
    }

    var sourceWidth = bounds.right - bounds.left + 1;
    var sourceHeight = bounds.bottom - bounds.top + 1;
    var scale = Math.min(canvas.width / sourceWidth, canvas.height / sourceHeight, 2);
    var drawWidth = Math.max(1, Math.floor(sourceWidth * scale));
    var drawHeight = Math.max(1, Math.floor(sourceHeight * scale));
    var dx = Math.floor((canvas.width - drawWidth) / 2);
    var dy = Math.floor((canvas.height - drawHeight) / 2);
    context.drawImage(baseCanvas, bounds.left, bounds.top, sourceWidth, sourceHeight, dx, dy, drawWidth, drawHeight);
    canvas.classList.add("is-rendered");
  }

  function init(root) {
    var scope = root || document;
    var canvases = [].slice.call(scope.querySelectorAll("canvas[data-rc-thing='outfit']"));
    var startRender = function (canvas) {
      if (canvas.getAttribute("data-render-started") === "1") {
        return;
      }
      canvas.setAttribute("data-render-started", "1");
      renderCanvas(canvas).catch(function (error) {
        if (window.console && console.warn) {
          console.warn("RavynCore things renderer failed for looktype " + canvas.getAttribute("data-looktype"), error);
        }
        canvas.classList.add("is-missing");
        var fallback = canvas.parentNode && canvas.parentNode.querySelector(".rc-thing-fallback");
        if (fallback) {
          fallback.hidden = false;
        }
      });
    };

    if ("IntersectionObserver" in window) {
      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) {
            return;
          }
          observer.unobserve(entry.target);
          startRender(entry.target);
        });
      }, { rootMargin: "360px 0px" });

      canvases.forEach(function (canvas) {
        observer.observe(canvas);
      });
      return;
    }

    canvases.forEach(startRender);
  }

  window.RavynCoreThingsRenderer = { init: init };

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", function () { init(document); });
  } else {
    init(document);
  }
})();
