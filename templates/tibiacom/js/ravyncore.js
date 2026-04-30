(function () {
    var navToggle = document.getElementById('rcNavToggle');
    var nav = document.getElementById('rcNav');

    if (navToggle && nav) {
        navToggle.addEventListener('click', function () {
            nav.classList.toggle('is-open');
        });
    }

    var countdownNode = document.getElementById('rcServerSaveCountdown');
    if (!countdownNode) {
        return;
    }

    function pad(value) {
        return value < 10 ? '0' + value : String(value);
    }

    function formatLeft(ms) {
        var hours = Math.floor(ms / (1000 * 60 * 60));
        var minutes = Math.floor((ms % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((ms % (1000 * 60)) / 1000);

        return pad(hours) + ':' + pad(minutes) + ':' + pad(seconds);
    }

    var targetIso = countdownNode.getAttribute('data-target');
    if (!targetIso) {
        return;
    }

    var target = new Date(targetIso).getTime();

    function updateCountdown() {
        var now = Date.now();
        var diff = target - now;

        if (diff <= 0) {
            target += 24 * 60 * 60 * 1000;
            diff = target - now;
        }

        countdownNode.textContent = formatLeft(diff);
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
})();
