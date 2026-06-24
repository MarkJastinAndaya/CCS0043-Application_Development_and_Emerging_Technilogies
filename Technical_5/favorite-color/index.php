<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_colors'])) {
    for ($i = 1; $i <= 5; $i++) {
        $_SESSION["fav_color_hex_$i"] = htmlspecialchars($_POST["color_hex_$i"] ?? '#A6824A');
        $_SESSION["fav_color_txt_$i"] = htmlspecialchars($_POST["color_txt_$i"] ?? 'Color ' . $i);
    }
    header("Location: ResultColors.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Favorite Colors Setup</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #101111; /* Charcoal Black */
            margin: 0;
            padding: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .card {
            background-color: #154230; /* Emerald Green */
            border-radius: 24px;
            width: 100%;
            max-width: 800px; /* Expanded width for split view */
            padding: 30px;
            box-shadow: 0 4px 20px #A6824A;
            box-sizing: border-box;
        }
        h2 {
            color: #E6E2DA; /* Soft Cream */
            font-size: 24px;
            margin: 0 0 5px 0;
            text-align: center;
        }
        .subtitle {
            color: #A6824A;
            font-size: 13px;
            margin-bottom: 20px;
            text-align: center;
            letter-spacing: 0.5px;
        }
        .divider {
            height: 2px;
            background-color: #A6824A; /* Antique Gold */
            border: none;
            margin-bottom: 20px;
        }
        /* Dual column layout to maximize workspace use */
        .split-workspace {
            display: flex;
            gap: 25px;
            align-items: stretch;
        }
        .form-side {
            flex: 1.2;
        }
        .preview-side {
            flex: 0.8;
            background: rgba(0, 0, 0, 0.2);
            border: 2px dashed #A6824A;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .color-row-item {
            display: grid;
            grid-template-columns: 75px 50px 1fr;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
            background: rgba(0, 0, 0, 0.15);
            padding: 8px 12px;
            border-radius: 12px;
            border: 1px solid rgba(166, 130, 74, 0.2);
        }
        .label-text {
            color: #E6E2DA;
            font-size: 14px;
            font-weight: 600;
        }
        input[type="color"] {
            -webkit-appearance: none;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            background: none;
            padding: 0;
        }
        input[type="color"]::-webkit-color-swatch-wrapper { padding: 0; }
        input[type="color"]::-webkit-color-swatch {
            border: 2px solid #E6E2DA;
            border-radius: 50%;
        }
        input[type="text"] {
            width: 100%;
            background-color: #A6824A;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            color: #5D1E21;
            font-size: 14px;
            font-weight: bold;
            box-sizing: border-box;
        }
        input[type="text"]:focus { outline: 2px solid #E6E2DA; }
        
        /* Live Palette Preview Layout */
        .mini-palette-title {
            color: #E6E2DA;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .mini-grid {
            display: flex;
            flex-direction: column;
            gap: 8px;
            width: 100%;
        }
        .mini-strip {
            height: 30px;
            width: 100%;
            border-radius: 6px;
            border: 1px solid #E6E2DA;
            transition: background-color 0.2s;
        }
        
        .action-container {
            text-align: center;
            margin-top: 15px;
        }
        .send-btn {
            background-color: #5D1E21;
            color: #E6E2DA;
            border: none;
            border-radius: 12px;
            padding: 12px 35px;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            cursor: pointer;
            letter-spacing: 1px;
            transition: background 0.2s, transform 0.1s;
        }
        .send-btn:hover { background-color: #7b292c; }
        .send-btn:active { transform: scale(0.98); }
    </style>
</head>
<body>

<div class="card">
    <h2>Enter your favorite colors</h2>
    <div class="subtitle">Select colors and name them. Watch your live canvas update on the right!</div>
    <hr class="divider">

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="split-workspace">
            <div class="form-side">
                <div class="color-row-item">
                    <span class="label-text">Color 1:</span>
                    <input type="color" name="color_hex_1" id="hex1" value="#CE1126" oninput="updatePreview(1)">
                    <input type="text" name="color_txt_1" value="Imperial Red" required>
                </div>
                <div class="color-row-item">
                    <span class="label-text">Color 2:</span>
                    <input type="color" name="color_hex_2" id="hex2" value="#FCD116" oninput="updatePreview(2)">
                    <input type="text" name="color_txt_2" value="Sun Yellow" required>
                </div>
                <div class="color-row-item">
                    <span class="label-text">Color 3:</span>
                    <input type="color" name="color_hex_3" id="hex3" value="#0038A8" oninput="updatePreview(3)">
                    <input type="text" name="color_txt_3" value="Royal Blue" required>
                </div>
                <div class="color-row-item">
                    <span class="label-text">Color 4:</span>
                    <input type="color" name="color_hex_4" id="hex4" value="#A6824A" oninput="updatePreview(4)">
                    <input type="text" name="color_txt_4" value="Antique Gold" required>
                </div>
                <div class="color-row-item">
                    <span class="label-text">Color 5:</span>
                    <input type="color" name="color_hex_5" id="hex5" value="#154230" oninput="updatePreview(5)">
                    <input type="text" name="color_txt_5" value="Emerald Green" required>
                </div>
            </div>

            <div class="preview-side">
                <div class="mini-palette-title">Live Composition Preview</div>
                <div class="mini-grid">
                    <div class="mini-strip" id="strip1" style="background-color: #CE1126;"></div>
                    <div class="mini-strip" id="strip2" style="background-color: #FCD116;"></div>
                    <div class="mini-strip" id="strip3" style="background-color: #0038A8;"></div>
                    <div class="mini-strip" id="strip4" style="background-color: #A6824A;"></div>
                    <div class="mini-strip" id="strip5" style="background-color: #154230;"></div>
                </div>
            </div>
        </div>
        
        <div class="action-container">
            <button type="submit" name="send_colors" class="send-btn">Send Colors</button>
        </div>
    </form>
</div>

<script>
function updatePreview(id) {
    const hexValue = document.getElementById('hex' + id).value;
    document.getElementById('strip' + id).style.backgroundColor = hexValue;
}
</script>

</body>
</html>
