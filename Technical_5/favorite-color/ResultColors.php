<?php
session_start();

$colors = [];
for ($i = 1; $i <= 5; $i++) {
    $colors[$i] = [
        'hex' => $_SESSION["fav_color_hex_$i"] ?? '#A6824A',
        'txt' => $_SESSION["fav_color_txt_$i"] ?? 'Color ' . $i
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Interactive Palette Showcase</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #101111;
            margin: 0;
            padding: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background-color: #154230;
            border-radius: 28px;
            width: 100%;
            max-width: 520px;
            padding: 35px 30px;
            box-shadow: 0 4px 20px #A6824A;
            box-sizing: border-box;
            text-align: center;
            transition: background-color 0.4s ease;
        }
        h2 { color: #E6E2DA; font-size: 24px; margin: 0 0 5px 0; }
        .subtitle { color: #E6E2DA; opacity: 0.8; font-size: 13px; margin-bottom: 20px; }
        .divider { height: 2px; background-color: #A6824A; width: 100%; margin-bottom: 20px; border: none; }
        
        .palette-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }
        .swatch-chip {
            border: 3px solid #E6E2DA;
            height: 65px;
            border-radius: 14px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            transition: transform 0.2s, border-color 0.2s;
        }
        .swatch-chip:hover { transform: scale(1.08); border-color: #A6824A; }
        
        .results-box { 
            border: 2px solid #A6824A; 
            border-radius: 15px; 
            padding: 10px; 
            background: rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }
        
        /* Fixed-width layout row for flawless alignment */
        .color-row { 
            display: flex; 
            align-items: center;
            padding: 8px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .color-row:hover { background: rgba(230, 226, 218, 0.1); }
        
        .label-col {
            color: #E6E2DA;
            font-size: 14px;
            font-weight: 600;
            flex-basis: 140px; /* Forces exact matching alignment positions */
            text-align: left;
            flex-shrink: 0;
        }
        .badge-col {
            flex-grow: 1;
            text-align: right;
        }
        .color-badge { 
            color: #101111; 
            padding: 6px 14px; 
            border-radius: 8px; 
            font-size: 13px; 
            font-weight: bold; 
            display: inline-block;
            width: 190px; /* Explicit width prevents word alignment shifting */
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .back-btn { 
            background-color: #5D1E21; 
            color: #E6E2DA; 
            border: none; 
            border-radius: 12px; 
            padding: 12px; 
            width: 45%; 
            font-size: 15px; 
            font-weight: bold; 
            text-transform: uppercase; 
            text-decoration: none; 
            display: inline-block; 
            letter-spacing: 1px; 
        }
    </style>
</head>
<body>

<div class="card" id="displayCard">
    <h2>Your Favorite Palette</h2>
    <div class="subtitle">Click any item to test the interactive background workspace!</div>
    <hr class="divider">

    <div class="palette-container">
        <?php foreach ($colors as $colorData): ?>
            <div class="swatch-chip" 
                 style="background-color: <?php echo $colorData['hex']; ?>;" 
                 onclick="changeWorkspaceBackground('<?php echo $colorData['hex']; ?>')">
            </div>
        <?php endforeach; ?>
    </div>

    <div class="results-box">
        <?php foreach ($colors as $index => $colorData): ?>
            <div class="color-row" onclick="changeWorkspaceBackground('<?php echo $colorData['hex']; ?>')">
                <div class="label-col">Favorite Color <?php echo $index; ?>:</div>
                <div class="badge-col">
                    <span class="color-badge" style="background-color: <?php echo $colorData['hex']; ?>;">
                        <?php echo $colorData['txt'] . " (" . strtoupper($colorData['hex']) . ")"; ?>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <a href="index.php" class="back-btn">Back</a>
</div>

<script>
function changeWorkspaceBackground(hexColor) {
    document.getElementById('displayCard').style.backgroundColor = hexColor;
}
</script>

</body>
</html>
