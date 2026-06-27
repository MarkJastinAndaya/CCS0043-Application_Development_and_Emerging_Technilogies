<?php
include 'database.php';

// --- SEED DATA ENGINE (For quick testing) ---
if (isset($_POST['seed_data'])) {
    $dummy_dogs = [
        ['PRINCE', 'Chow Chow', 'Bulacan', '4 years old', 'Brown', '2 feet', '4 kilos'],
        ['BROWNY', 'Pug', 'Quezon City', '2yrs old', 'White', '2 ft', '2.5 kilos'],
        ['WHITEY', 'Siberian Husky', 'Malabon City', '3yrs old', 'Brown', '3 ft', '5.5 kilos'],
        ['MAX', 'Golden Retriever', 'Makati City', '1 year old', 'Golden', '2.2 ft', '30 kilos']
    ];
    foreach ($dummy_dogs as $dog) {
        $sql = "INSERT INTO dog_info (d_name, d_breed, d_add, d_age, d_color, d_height, d_weight) 
                VALUES ('{$dog[0]}', '{$dog[1]}', '{$dog[2]}', '{$dog[3]}', '{$dog[4]}', '{$dog[5]}', '{$dog[6]}')";
        mysqli_query($conn, $sql);
    }
    header("Location: dog_view.php");
    exit();
}

// --- UPDATE/EDIT RECORD ENGINE ---
if (isset($_POST['update_dog'])) {
    $id = intval($_POST['id']);
    $d_name = mysqli_real_escape_string($conn, $_POST['d_name']);
    $d_breed = mysqli_real_escape_string($conn, $_POST['d_breed']);
    $d_add = mysqli_real_escape_string($conn, $_POST['d_add']);
    $d_age = mysqli_real_escape_string($conn, $_POST['d_age']);
    $d_color = mysqli_real_escape_string($conn, $_POST['d_color']);
    $d_height = mysqli_real_escape_string($conn, $_POST['d_height']);
    $d_weight = mysqli_real_escape_string($conn, $_POST['d_weight']);

    if (isset($_FILES['d_image']) && $_FILES['d_image']['error'] === 0) {
        $file_name = $_FILES['d_image']['name'];
        $file_tmp = $_FILES['d_image']['tmp_name'];
        $unique_name = time() . '_' . basename($file_name);
        $target_directory = "uploads/" . $unique_name;
        
        if (move_uploaded_file($file_tmp, $target_directory)) {
            $sql = "UPDATE dog_info SET d_name='$d_name', d_breed='$d_breed', d_add='$d_add', d_age='$d_age', d_color='$d_color', d_height='$d_height', d_weight='$d_weight', d_image='$target_directory' WHERE id=$id";
        }
    } else {
        $sql = "UPDATE dog_info SET d_name='$d_name', d_breed='$d_breed', d_add='$d_add', d_age='$d_age', d_color='$d_color', d_height='$d_height', d_weight='$d_weight' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('✨ Profile updated successfully!'); window.location='dog_view.php';</script>";
        exit();
    }
}

// --- CRITICAL NEW ACCIDENT-PROOF DELETION ENGINE ---
if (isset($_POST['delete_dog'])) {
    $id = intval($_POST['id']);
    
    // Optional clean-up helper: Retrieve target file location first to wipe the physical image path off XAMPP storage
    $find_img_query = "SELECT d_image FROM dog_info WHERE id=$id";
    $img_result = mysqli_query($conn, $find_img_query);
    if ($img_row = mysqli_fetch_assoc($img_result)) {
        if (!empty($img_row['d_image']) && file_exists($img_row['d_image'])) {
            unlink($img_row['d_image']); // Erases file from uploads directory
        }
    }

    $sql = "DELETE FROM dog_info WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('🗑️ Record deleted successfully!'); window.location='dog_view.php';</script>";
        exit();
    }
}

$sql = "SELECT id, d_name, d_breed, d_add, d_age, d_color, d_height, d_weight, d_image FROM dog_info";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawsome Registry | Records</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #b89264;
            --primary-hover: #a37f53;
            --bg-glass: rgba(30, 41, 59, 0.85);
            --font-head: 'Poppins', sans-serif;
            --font-body: 'Inter', sans-serif;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: var(--font-body);
            background: url('https://images.unsplash.com/photo-1548199973-03cce0bbc87b?q=80&w=2069&auto=format&fit=crop') center center/cover fixed no-repeat;
            color: #fff;
            min-height: 100vh;
            padding: 90px 20px 40px 20px;
        }

        header {
            position: fixed; top: 10px; left: 50%; transform: translateX(-50%); width: 70%; max-width: 1200px; z-index: 1000;
            background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px);
            border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }
        .navbar { display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; }
        .logo { font-family: var(--font-head); font-size: 20px; font-weight: 700; color: #fff; text-decoration: none; }
        .logo span { color: var(--primary); }
        .nav-links { display: flex; list-style: none; gap: 24px; }
        .nav-links a { text-decoration: none; color: rgba(255, 255, 255, 0.8); font-weight: 500; font-size: 14px; transition: color 0.3s; }
        .nav-links a:hover, .nav-links a.active { color: var(--primary); }

        .view-title { text-align: center; font-family: var(--font-head); font-size: 32px; margin-bottom: 5px; text-shadow: 0 2px 10px rgba(0,0,0,0.5); }
        .subtitle { text-align: center; color: rgba(255,255,255,0.6); font-size: 14px; margin-bottom: 30px; }

        .records-grid { max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }

        .dog-card {
            background: var(--bg-glass); 
            backdrop-filter: blur(10px); 
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15); 
            border-radius: 20px; 
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
            
            /* Smooth transition for all properties (Lift, Shadow, and Border) */
            transition: transform 0.35s cubic-bezier(0.25, 1, 0.5, 1), 
                        box-shadow 0.35s cubic-bezier(0.25, 1, 0.5, 1), 
                        border-color 0.35s ease;
            cursor: pointer; 
            display: flex; 
            flex-direction: column; 
            height: 100%;
        }

        /* --- THE NEW INTERACTIVE HOVER EFFECT --- */
        .dog-card:hover { 
            transform: translateY(-8px); /* Lifts the card up by 8px */
            border-color: rgba(184, 146, 100, 0.6); /* Tints the border gold */
            box-shadow: 0 12px 30px rgba(184, 146, 100, 0.25); /* Gives it a warm soft glow */
        }

        /* Keeps the expanded card stable when active so it doesn't wobble on hover */
        .dog-card.expanded { 
            grid-column: 1 / -1; 
            flex-direction: row; 
            height: auto; 
            background: rgba(23, 32, 48, 0.95); 
            border-color: var(--primary); 
            transform: none !important; /* Disables the pop-up shift when expanded */
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5) !important;
            cursor: default;
        }

        .dog-card.expanded { grid-column: 1 / -1; flex-direction: row; height: auto; background: rgba(23, 32, 48, 0.95); border-color: var(--primary); }

        .card-photo-wrapper { width: 100%; height: 200px; background: rgba(15, 23, 42, 0.5); display: flex; justify-content: center; align-items: center; overflow: hidden; transition: all 0.4s ease; }
        .dog-card.expanded .card-photo-wrapper { width: 35%; height: inherit; min-height: 320px; }
        .card-photo { width: 100%; height: 100%; object-fit: cover; }
        .placeholder-svg { width: 54px; height: 54px; fill: var(--primary); opacity: 0.4; }

        .card-details { padding: 22px; flex-grow: 1; transition: all 0.4s ease; }
        .dog-card.expanded .card-details { width: 65%; padding: 35px; }
        
        .dog-name { font-family: var(--font-head); font-size: 22px; color: var(--primary); font-weight: 700; }
        .dog-breed { font-size: 13px; text-transform: uppercase; letter-spacing: 1.5px; color: rgba(255,255,255,0.5); margin-bottom: 15px; }

        .expanded-info { display: none; margin-top: 15px; animation: fadeIn 0.4s ease; }
        .dog-card.expanded .expanded-info { display: block; }

        .info-row { display: flex; justify-content: space-between; padding: 7px 0; border-bottom: 1px solid rgba(255,255,255,0.06); font-size: 14px; }
        .info-row:last-child { border: none; }
        .info-label { color: rgba(255,255,255,0.45); }
        .info-value { font-weight: 500; color: rgba(255,255,255,0.9); }

        /* Premium Buttons layout design updates */
        .action-container { margin-top: 25px; display: flex; gap: 15px; }
        .edit-btn {
            background-color: var(--primary); color: #fff; border: none; padding: 10px 24px;
            border-radius: 8px; font-weight: 600; font-family: var(--font-head); cursor: pointer; transition: background 0.2s;
        }
        .edit-btn:hover { background-color: var(--primary-hover); }

        /* New sleek red Delete Button style */
        .delete-btn {
            background-color: #7f1d1d; color: #fca5a5; border: 1px solid #991b1b; padding: 10px 24px;
            border-radius: 8px; font-weight: 600; font-family: var(--font-head); cursor: pointer; transition: all 0.2s;
        }
        .delete-btn:hover { background-color: #991b1b; color: #fff; }

        /* Beautiful Overlay Modal Window for Editing */
        .modal {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 2000;
            background: rgba(15, 23, 42, 0.75); backdrop-filter: blur(8px);
            display: flex; justify-content: center; align-items: center;
            opacity: 0; pointer-events: none; transition: opacity 0.3s ease;
        }
        .modal.active { opacity: 1; pointer-events: auto; }
        .modal-content {
            background: rgba(30, 41, 59, 0.95); width: 90%; max-width: 500px;
            border: 1px solid rgba(255,255,255,0.2); border-radius: 20px; padding: 30px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5); transform: scale(0.9); transition: transform 0.3s ease;
        }
        .modal.active .modal-content { transform: scale(1); }
        .modal-header { font-family: var(--font-head); font-size: 22px; color: var(--primary); margin-bottom: 20px; text-align: center; }
        .modal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .modal-group { display: flex; flex-direction: column; margin-bottom: 12px; }
        .modal-group.full-width { grid-column: span 2; }
        .modal-group label { font-size: 13px; margin-bottom: 4px; color: rgba(255,255,255,0.6); }
        .modal-input { background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); border-radius: 8px; padding: 10px; color: #fff; outline: none; }
        .modal-input:focus { border-color: var(--primary); }
        .modal-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px; }
        .save-changes-btn { background: #5c1d24; color: white; border: none; padding: 10px 20px; border-radius: 6px; cursor: pointer; font-weight: 600; }
        .cancel-btn { background: #475569; color: white; border: none; padding: 10px 15px; border-radius: 6px; cursor: pointer; }

        .empty-state-box { grid-column: 1/-1; text-align: center; background: var(--bg-glass); padding: 40px; border-radius: 20px; max-width: 500px; margin: 40px auto; }
        .seed-btn { background-color: var(--primary); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>

    <header>
        <nav class="navbar">
            <a href="index.php" class="logo">Pawsome<span>Registry</span></a>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="dog_register.php">Register Dog</a></li>
                <li><a href="dog_view.php" class="active">View Records</a></li>
            </ul>
        </nav>
    </header>

    <h2 class="view-title">Registered Canine Profiles</h2>
    <div class="subtitle">💡 Click on any card to expand details, edit entries inline, or delete records securely.</div>

    <div class="records-grid">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $uppercase_name = strtoupper($row['d_name']);
                $titlecase_breed = ucwords(strtolower($row['d_breed']));
                $titlecase_location = ucwords(strtolower($row['d_add']));
                $titlecase_color = ucwords(strtolower($row['d_color']));

                echo "<div class='dog-card' onclick='toggleCardExpand(this, event)'>";
                
                echo "<div class='card-photo-wrapper'>";
                if (!empty($row['d_image']) && file_exists($row['d_image'])) {
                    echo "<img src='" . htmlspecialchars($row['d_image']) . "' class='card-photo' alt='Dog profile picture'>";
                } else {
                    echo '<svg class="placeholder-svg" viewBox="0 0 24 24"><path d="M12 14c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm-4.5-3c.83 0 1.5-.67 1.5-1.5S8.33 8 7.5 8 6 8.67 6 9.5s.67 1.5 1.5 1.5zm9 0c.83 0 1.5-.67 1.5-1.5S17.33 8 16.5 8s-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm-4.5 7.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/></svg>';
                }
                echo "</div>";
                
                echo "<div class='card-details'>";
                echo "<div class='dog-name'>" . htmlspecialchars($uppercase_name) . "</div>";
                echo "<div class='dog-breed'>" . htmlspecialchars($titlecase_breed) . "</div>";
                
                echo "<div class='info-row'><span class='info-label'>Breed Group</span><span class='info-value'>" . htmlspecialchars($titlecase_breed) . "</span></div>";
                echo "<div class='info-row'><span class='info-label'>Primary Color</span><span class='info-value'>" . htmlspecialchars($titlecase_color) . "</span></div>";
                
                echo "<div class='expanded-info'>";
                echo "<div class='info-row'><span class='info-label'>Location Location</span><span class='info-value'>" . htmlspecialchars($titlecase_location) . "</span></div>";
                echo "<div class='info-row'><span class='info-label'>Age Index</span><span class='info-value'>" . htmlspecialchars($row['d_age']) . "</span></div>";
                echo "<div class='info-row'><span class='info-label'>Height Parameter</span><span class='info-value'>" . htmlspecialchars($row['d_height']) . "</span></div>";
                echo "<div class='info-row'><span class='info-label'>Weight Value</span><span class='info-value'>" . htmlspecialchars($row['d_weight']) . "</span></div>";
                
                // Action Layout containing Edit & Delete triggers
                echo "<div class='action-container'>";
                echo "<button class='edit-btn' onclick='openEditModal(event, " . json_encode($row) . ")'>📝 Edit Profile</button>";
                
                // Form wrapper that handles submission directly to the backend deletion engine
                echo "<form action='dog_view.php' method='POST' style='display:inline;' onsubmit='return verifyDogNameBeforeDelete(event, \"" . htmlspecialchars($row['d_name'], ENT_QUOTES) . "\");'>";
                echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                echo "<button type='submit' name='delete_dog' class='delete-btn'>🗑️ Delete</button>";
                echo "</form>";
                echo "</div>";
                
                echo "</div>"; // End expanded-info
                echo "</div>"; // End card-details
                echo "</div>"; // End dog-card
            }
        } else {
            echo "<div class='empty-state-box'>";
            echo "<p style='color: rgba(255,255,255,0.7);'>No pet profiles loaded into system schema tables yet.</p>";
            echo "<form action='dog_view.php' method='POST'>";
            echo "<button type='submit' name='seed_data' class='seed-btn'>⚡ Seed Test Records</button>";
            echo "</form>";
            echo "</div>";
        }
        ?>
    </div>

    <div class="modal" id="editModal">
        <div class="modal-content">
            <div class="modal-header">Update Dog Profile</div>
            <form action="dog_view.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="edit_id">
                <div class="modal-group full-width"><label>Dog Name</label><input type="text" name="d_name" id="edit_name" class="modal-input" required></div>
                <div class="modal-group full-width"><label>Breed Line</label><input type="text" name="d_breed" id="edit_breed" class="modal-input" required></div>
                <div class="modal-group full-width"><label>Registered Location Address</label><input type="text" name="d_add" id="edit_add" class="modal-input" required></div>
                <div class="modal-grid">
                    <div class="modal-group"><label>Age Metric</label><input type="text" name="d_age" id="edit_age" class="modal-input" required></div>
                    <div class="modal-group"><label>Color Shading</label><input type="text" name="d_color" id="edit_color" class="modal-input" required></div>
                    <div class="modal-group"><label>Height Dimension</label><input type="text" name="d_height" id="edit_height" class="modal-input" required></div>
                    <div class="modal-group"><label>Weight Category</label><input type="text" name="d_weight" id="edit_weight" class="modal-input" required></div>
                </div>
                <div class="modal-group full-width" style="margin-top: 10px;"><label>Replace Image File <i>(Optional)</i></label><input type="file" name="d_image" class="modal-input" accept="image/*"></div>
                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" name="update_dog" class="save-changes-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleCardExpand(card, event) {
            // Prevent expanding if clicking any elements inside the button actions container
            if (event.target.tagName === 'BUTTON' || event.target.closest('.action-container') || event.target.closest('form')) {
                return;
            }

            const wasExpanded = card.classList.contains('expanded');
            document.querySelectorAll('.dog-card').forEach(c => c.classList.remove('expanded'));
            
            if (!wasExpanded) {
                card.classList.add('expanded');
                setTimeout(() => {
                    const yOffset = -90;
                    const yPosition = card.getBoundingClientRect().top + window.pageYOffset + yOffset;
                    window.scrollTo({ top: yPosition, behavior: 'smooth' });
                }, 50);
            }
        }

        // --- NEW: AUTHENTICATION CHECK BEFORE DELETING ---
        function verifyDogNameBeforeDelete(event, correctName) {
            event.stopPropagation(); // Stops card from collapsing when delete is clicked
            
            // Native authentication prompt modal window
            const userInput = prompt(`⚠️ WARNING: This action cannot be undone.\nTo delete this record, please type the dog's name exactly ("${correctName.toUpperCase()}"):`);
            
            // Check if user input matches database entry (case-insensitive check for reliability)
            if (userInput !== null && userInput.trim().toLowerCase() === correctName.toLowerCase()) {
                return true; // Match found! Let form submit cleanly to backend
            } else if (userInput !== null) {
                alert("❌ Authentication failed. Incorrect name entered.");
            }
            return false; // Stop form submission
        }

        function openEditModal(event, data) {
            event.stopPropagation();
            document.getElementById('edit_id').value = data.id;
            document.getElementById('edit_name').value = data.d_name;
            document.getElementById('edit_breed').value = data.d_breed;
            document.getElementById('edit_add').value = data.d_add;
            document.getElementById('edit_age').value = data.d_age;
            document.getElementById('edit_color').value = data.d_color;
            document.getElementById('edit_height').value = data.d_height;
            document.getElementById('edit_weight').value = data.d_weight;
            document.getElementById('editModal').classList.add('active');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.remove('active');
        }
    </script>
</body>
</html>
