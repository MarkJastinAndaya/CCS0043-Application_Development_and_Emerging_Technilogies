<?php
include 'database.php';

$message = "";

if (isset($_POST['save'])) {
    $d_name = mysqli_real_escape_string($conn, $_POST['d_name']);
    $d_breed = mysqli_real_escape_string($conn, $_POST['d_breed']);
    $d_add = mysqli_real_escape_string($conn, $_POST['d_add']);
    $d_age = mysqli_real_escape_string($conn, $_POST['d_age']);
    $d_color = mysqli_real_escape_string($conn, $_POST['d_color']);
    $d_height = mysqli_real_escape_string($conn, $_POST['d_height']);
    $d_weight = mysqli_real_escape_string($conn, $_POST['d_weight']);
    
    $image_destination = NULL;
    if (isset($_FILES['d_image']) && $_FILES['d_image']['error'] === 0) {
        $file_name = $_FILES['d_image']['name'];
        $file_tmp = $_FILES['d_image']['tmp_name'];
        
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }
        
        $unique_name = time() . '_' . basename($file_name);
        $target_directory = "uploads/" . $unique_name;
        
        if (move_uploaded_file($file_tmp, $target_directory)) {
            $image_destination = $target_directory;
        }
    }

    $sql = "INSERT INTO dog_info (d_name, d_breed, d_add, d_age, d_color, d_height, d_weight, d_image) 
            VALUES ('$d_name', '$d_breed', '$d_add', '$d_age', '$d_color', '$d_height', '$d_weight', " . 
            ($image_destination ? "'$image_destination'" : "NULL") . ")";

    if (mysqli_query($conn, $sql)) {
        $message = "<div class='success-banner'>✨ Pet profile registered cleanly into system backend!</div>";
    } else {
        $message = "<div class='error-banner'>Error: " . mysqli_error($conn) . "</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsome Registry | Register Pet</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #b89264;
            --bg-glass: rgba(30, 41, 59, 0.75);
            --font-head: 'Poppins', sans-serif;
            --font-body: 'Inter', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            background: url('https://images.unsplash.com/photo-1548199973-03cce0bbc87b?q=80&w=2069&auto=format&fit=crop') center center/cover fixed no-repeat;
            color: #fff;
            min-height: 100vh;
            padding-top: 100px;
            padding-bottom: 0px;
        }

        header {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 70%;
            max-width: 1200px;
            z-index: 1000;
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }

        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; }
        .logo { font-family: var(--font-head); font-size: 20px; font-weight: 700; color: #fff; text-decoration: none; }
        .logo span { color: var(--primary); }
        .nav-links { display: flex; list-style: none; gap: 24px; }
        .nav-links a { text-decoration: none; color: rgba(255, 255, 255, 0.8); font-weight: 500; font-size: 14px; transition: color 0.3s; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }

        .form-container {
            max-width: 650px;
            margin: 0px auto 30px;
            background: var(--bg-glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 24px;
            padding: 10px 40px 20px 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        }

        h2 { font-family: var(--font-head); text-align: center; font-size: 28px; }
        .divider { width: 80%; height: 1px; background: rgba(184, 146, 100, 0.4); margin: 12px auto 15px auto; }

        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; align-items: center; width: 100%; }
        .form-group label { font-weight: 500; margin-bottom: 6px; font-size: 15px; }

        .input-field {
            width: 100%; background-color: var(--primary); color: #2e1f0c; border: none; border-radius: 10px;
            padding: 12px 16px; font-size: 15px; font-weight: 500; text-align: center; outline: none;
        }

        .grid-layout { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; width: 100%; }

        /* Enhanced Interactive Image Placeholder Frame */
        .upload-box {
            grid-row: span 2;
            border: 2px dashed rgba(184, 146, 100, 0.6);
            border-radius: 14px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 15px;
            cursor: pointer;
            position: relative;
            background: rgba(0, 0, 0, 0.25);
            transition: all 0.3s ease;
            overflow: hidden;
            min-height: 170px;
        }
        .upload-box:hover { border-color: var(--primary); background: rgba(0, 0, 0, 0.35); }
        
        /* Upload success structural feedback modifier */
        .upload-box.has-file { border-color: #22c55e; border-style: solid; }

        .upload-box span { font-size: 13px; text-align: center; margin-bottom: 8px; z-index: 5; text-shadow: 0 1px 4px rgba(0,0,0,0.8); }
        .upload-box .plus-icon {
            font-size: 24px; background: var(--primary); color: #fff; width: 40px; height: 40px;
            display: flex; align-items: center; justify-content: center; border-radius: 10px; z-index: 5;
            transition: all 0.3s ease;
        }

        /* Live Preview Image styling layout override */
        .upload-preview-img {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 1; opacity: 0.5;
        }
        .upload-box:hover .upload-preview-img { opacity: 0.8; }

        .upload-box input[type="file"] { position: absolute; width: 100%; height: 100%; top: 0; left: 0; opacity: 0; cursor: pointer; z-index: 10; }

        .submit-btn {
            width: 100%; background-color: #5c1d24; color: #fff; border: none; border-radius: 12px;
            padding: 14px; font-family: var(--font-head); font-size: 16px; font-weight: 600; text-transform: uppercase;
            cursor: pointer; margin-top: 25px; transition: background-color 0.3s;
        }
        .submit-btn:hover { background-color: #4a151b; }

        .success-banner { background: rgba(34, 197, 94, 0.25); border: 1px solid #22c55e; padding: 12px; border-radius: 10px; text-align: center; margin-bottom: 20px; color: #a7f3d0;}
        .error-banner { background: rgba(239, 68, 68, 0.25); border: 1px solid #ef4444; padding: 12px; border-radius: 10px; text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="index.php" class="logo">Pawsome<span>Registry</span></a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="dog_register.php" class="active">Register Dog</a></li>
                <li><a href="dog_view.php">View Records</a></li>
            </ul>
        </nav>
    </header>

    <div class="form-container">
        <h2>Dog Information</h2>
        <div class="divider"></div>

        <?php echo $message; ?>

        <form action="dog_register.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="d_name" class="input-field" required placeholder="Enter dog name">
            </div>
            
            <div class="form-group">
                <label>Breed</label>
                <input type="text" name="d_breed" class="input-field" required placeholder="Enter breed line">
            </div>

            <div class="form-group">
                <label>Address</label>
                <input type="text" name="d_add" class="input-field" required placeholder="Enter primary location">
            </div>

            <div class="grid-layout">
                <div class="form-group">
                    <label>Height</label>
                    <input type="text" name="d_height" class="input-field" required placeholder="e.g., 2 feet">
                </div>

                <div class="form-group">
                    <label>Age</label>
                    <input type="text" name="d_age" class="input-field" required placeholder="e.g., 4 yo">
                </div>

                <div class="upload-box" id="dropBox">
                    <span id="uploadText">Dog Picture<br><i>(Optional)</i></span>
                    <div class="plus-icon" id="uploadIcon">+</div>
                    <input type="file" name="d_image" id="fileInput" accept="image/*">
                </div>

                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="d_color" class="input-field" required placeholder="e.g., Brown">
                </div>

                <div class="form-group">
                    <label>Weight</label>
                    <input type="text" name="d_weight" class="input-field" required placeholder="e.g., 4 kilo">
                </div>
            </div>

            <button type="submit" name="save" class="submit-btn">Submit</button>
        </form>
    </div>

    <script>
        const fileInput = document.getElementById('fileInput');
        const dropBox = document.getElementById('dropBox');
        const uploadText = document.getElementById('uploadText');
        const uploadIcon = document.getElementById('uploadIcon');

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function() {
                    // Check if an image container already exists from a previous pick
                    let existingImg = dropBox.querySelector('.upload-preview-img');
                    if (!existingImg) {
                        existingImg = document.createElement('img');
                        existingImg.className = 'upload-preview-img';
                        dropBox.appendChild(existingImg);
                    }
                    // Update layout preview sources dynamically
                    existingImg.setAttribute('src', this.result);
                    
                    // Modify UI indicators to signal state tracking change
                    dropBox.classList.add('has-file');
                    uploadText.innerHTML = "✓ Change Photo";
                    uploadIcon.innerHTML = "↺";
                    uploadIcon.style.backgroundColor = "#22c55e";
                });
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
