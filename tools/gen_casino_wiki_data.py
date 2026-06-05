import re
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
SERVER = Path(r"c:\Users\PICHAU\Desktop\DURVAL\RavynCore")
xml = (SERVER / "data/items/items.xml").read_text(encoding="utf-8", errors="ignore")
items = {}
for m in re.finditer(r'<item id="(\d+)"[^>]*name="([^"]+)"', xml):
    items[int(m.group(1))] = m.group(2)
for m in re.finditer(r'<item id="(\d+)"[^>]*article="[^"]*" name="([^"]+)"', xml):
    items[int(m.group(1))] = m.group(2)

NAME_OVERRIDES = {
    61621: "purified genesis longbow",
    61622: "purified genesis crossbow",
    61869: "RavynCore Token",
    61862: "magic spark",
    61865: "green spark",
    61866: "yellow spark",
    61867: "red spark",
    64087: "Roulette Token",
    64040: "addon casket outfit 1",
    64041: "addon casket outfit 2",
    64042: "addon casket outfit 3",
    64043: "addon casket outfit 4",
    64085: "mount casket",
    64101: "surprise casket",
    64114: "ultra rare scroll",
    43898: "bag you covet",
    63787: "boss points",
}
for iid, name in NAME_OVERRIDES.items():
    items[iid] = name

BOXES = [
    (63743, "Ratmiral Box", [35523, 35517, 50270, 35516, 35518, 35514, 35524, 35521, 50186, 35522, 35520, 35519]),
    (63744, "Brainstealer Box", [36664, 36667, 36657, 36670, 36835, 36663, 36672, 36661, 36671, 36666, 36674, 36656, 36673, 36668, 36659, 50169, 36665, 36658, 36662, 36675, 36669, 36660, 50170]),
    (63745, "Timira Box", [39233, 39166, 39164, 39161, 39158, 39167, 39165, 39156, 39157, 39159, 50160, 39160, 39163, 39155, 39162, 50262]),
    (63746, "Drume Box", [34158, 34253, 50162, 34254, 34150, 34155, 34157, 34151, 34154, 34156, 34153, 34152]),
    (63747, "Scarlett Box", [31631, 30396, 30395, 30393, 30397, 30400, 30398, 30399, 50167]),
    (63748, "Oberon Box", [28714, 28715, 28716, 28717, 28718, 28719, 28720, 28721, 28722, 28723, 28724, 28725, 50161]),
    (63749, "Plunder Patriarch Box", [39149, 39150, 39182, 39153, 39188, 39154, 39152, 39151, 39185, 50188, 39147, 39148, 39179]),
    (63750, "Nightmare Beast Box", [50190, 29427, 30342]),
    (63751, "Arbaziloth Box", [49522, 49523, 49527, 49520, 50250, 49525, 49524, 49529, 49530, 49528, 49526, 49531, 49532, 49533, 49534, 50189]),
    (63752, "Soulwar Box", [34088, 34089, 34099, 34083, 34090, 34091, 34087, 34086, 34084, 34092, 34093, 34098, 34097, 34094]),
    (63753, "Sanguine Box", [43864, 43877, 43866, 43868, 43876, 43870, 43885, 43881, 43882, 43879, 43884]),
    (63754, "Gaz'haragoth Box", [20071, 20065, 20083, 20074, 20086, 20080, 20077, 20068, 20089, 50164, 20072, 20084, 20075, 20087, 20081, 20078, 20069, 20090, 20066, 50165]),
    (63755, "Zelos Box", [50260, 31581, 31582, 31737, 31583]),
    (63756, "Mitmah Box", [44648, 44636, 44620, 44642, 44643, 44637, 44649, 44619, 50291, 50255]),
    (63757, "Amber Box", [47371, 47377, 47376, 47370, 47375, 47369, 47368, 47374, 47373, 47372, 50239]),
    (63758, "Sugar Box", []),
    (63759, "Monster Box", [40588, 40592, 40594, 40593, 40595, 40591, 40590, 40589, 50184]),
    (63193, "Warzone Box", [27647, 27648, 27649, 27650, 27651]),
    (61713, "Destruction Box", [27451, 27449, 27454, 27452, 27453, 27455, 27450, 27458, 27456, 27457]),
    (61703, "Pale Box", [32617, 50185, 32628, 32619, 32616, 32636, 32618]),
]

SUGAR_NAMES = ["candy crown", "candy boots", "candy armor", "candy legs", "candy bow", "candy wand", "candy rod"]
rev = {v.lower(): k for k, v in items.items()}
for n in SUGAR_NAMES:
    for k, v in items.items():
        if v.lower() == n:
            BOXES[15][2].append(k)
            break

COMMON = [61621, 61622, 64086, 61869, 37110, 61862, 60581, 16129, 35563, 61865, 61866, 61867,
    36723, 36724, 36725, 36726, 36727, 36728, 36729, 36730, 36731, 36732, 36733, 36734, 36735,
    36736, 36737, 36738, 36739, 36740, 36741, 36742, 28485, 28484,
    61560, 61556, 61558, 61554, 61559, 61555, 61561, 61557]
RARE = [64040, 64041, 64042, 64043, 64101, 64087, 64085, 43946, 43947, 43948, 43949, 63100, 63101, 63099,
    39546, 43898, 34109, 63787, 63743, 63744, 63745, 63748, 63746, 63747, 63749, 63750, 63751, 63752,
    63753, 63754, 63755, 63756, 63757, 63758, 63759, 63193, 61713, 61703]
ULTRA = [64114]

def php_array_boxes():
    lines = ["<?php", "defined('MYAAC') or die('Direct access not allowed!');", "", "return ["]
    for bid, bname, loot in BOXES:
        lines.append(f"    {bid} => [")
        lines.append(f"        'name' => {bname!r},")
        lines.append("        'loot' => [")
        for iid in loot:
            name = items.get(iid, f"item {iid}")
            lines.append(f"            ['id' => {iid}, 'name' => {name!r}],")
        lines.append("        ],")
        lines.append("    ],")
    lines.append("];")
    return "\n".join(lines) + "\n"

def php_prize_line(iid, tier):
    name = items.get(iid, f"item {iid}")
    return f"    ['id' => {iid}, 'name' => {name!r}, 'tier' => {tier!r}],"

out_boxes = ROOT / "system/libs/casino_boxes_data.php"
out_boxes.write_text(php_array_boxes(), encoding="utf-8")

lines = ["<?php", "defined('MYAAC') or die('Direct access not allowed!');", "", "return ["]
lines.append("    'tokenId' => 64087,")
lines.append("    'tokenName' => 'Roulette Token',")
lines.append("    'spinOptions' => [1, 5, 10, 25, 50, 100],")
lines.append("    'spinningBonus' => [")
lines.append("        ['spins' => 25, 'reward' => '2x Roulette Tokens', 'itemId' => 64087, 'count' => 2],")
lines.append("        ['spins' => 50, 'reward' => '1x Addon Casket', 'itemId' => 64040, 'count' => 1],")
lines.append("        ['spins' => 75, 'reward' => '1x Mount Casket', 'itemId' => 64085, 'count' => 1],")
lines.append("        ['spins' => 100, 'reward' => '1x Surprise Casket', 'itemId' => 64101, 'count' => 1],")
lines.append("    ],")
lines.append("    'roulettes' => [")
for rid, rname in [('norte', 'Roleta do Norte'), ('esquerda', 'Roleta da Esquerda'), ('sul', 'Roleta do Sul')]:
    lines.append(f"        ['id' => {rid!r}, 'name' => {rname!r}],")
lines.append("    ],")
lines.append("    'commons' => [")
for iid in COMMON:
    lines.append(php_prize_line(iid, 'common'))
lines.append("    ],")
lines.append("    'rares' => [")
for iid in RARE:
    lines.append(php_prize_line(iid, 'rare'))
lines.append("    ],")
lines.append("    'ultraRares' => [")
for iid in ULTRA:
    lines.append(php_prize_line(iid, 'ultra'))
lines.append("    ],")
lines.append("];")
(ROOT / "system/libs/casino_roulette_data.php").write_text("\n".join(lines) + "\n", encoding="utf-8")
print("Generated casino_boxes_data.php and casino_roulette_data.php")
