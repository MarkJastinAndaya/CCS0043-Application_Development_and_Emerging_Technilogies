<?php
$cookie_status_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['set_cookies'])) {
    $fname = htmlspecialchars($_POST['firstname']  ?? 'Mark Jastin');
    $mname = htmlspecialchars($_POST['middlename'] ?? 'Morales');
    $lname = htmlspecialchars($_POST['lastname']   ?? 'Andaya');

    setcookie("firstname_cookie", $fname, time()  + 10, "/");
    setcookie("middlename_cookie", $mname, time() + 20, "/");
    setcookie("lastname_cookie", $lname, time()   + 30, "/");

    header("Location: " . $_SERVER['PHP_SELF'] . "?status=set");
    exit();
}

if (isset($_GET['status']) && $_GET['status'] == 'set') {
    $cookie_status_message = "Cookies have been initialized!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5">
    <title>Cookie Lifespan Monitor</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="card">
    <h2>Cookie Timing Monitor</h2>
    <hr class="divider">

    <?php if (!empty($cookie_status_message)): ?>
        <div class="badge-info">
            <?php echo $cookie_status_message; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label>First Name (Expires in 10s)</label>
            <input type="text" name="firstname" value="Mark Jastin" required>
        </div>
        <div class="form-group">
            <label>Middle Name (Expires in 20s)</label>
            <input type="text" name="middlename" value="Morales" required>
        </div>
        <div class="form-group">
            <label>Last Name (Expires in 30s)</label>
            <input type="text" name="lastname" value="Andaya" required>
        </div>
        <button type="submit" name="set_cookies" class="submit-btn">Initialize Cookies</button>
    </form>

    <div class="cookie-display-box">
        <h3 style="color: #E6E2DA; margin-top: 0; text-align: center; font-size: 16px;">Active Cookies Buffer</h3>
        
        <div class="cookie-item">
            <span class="cookie-label">First Name:</span>
            <span class="cookie-val <?php echo !isset($_COOKIE['firstname_cookie']) ? 'cookie-expired' : ''; ?>">
                <?php echo isset($_COOKIE['firstname_cookie']) ? htmlspecialchars($_COOKIE['firstname_cookie']) : '[ Expired / Not Set ]'; ?>
            </span>
        </div>

        <div class="cookie-item">
            <span class="cookie-label">Middle Name:</span>
            <span class="cookie-val <?php echo !isset($_COOKIE['middlename_cookie']) ? 'cookie-expired' : ''; ?>">
                <?php echo isset($_COOKIE['middlename_cookie']) ? htmlspecialchars($_COOKIE['middlename_cookie']) : '[ Expired / Not Set ]'; ?>
            </span>
        </div>

        <div class="cookie-item">
            <span class="cookie-label">Last Name:</span>
            <span class="cookie-val <?php echo !isset($_COOKIE['lastname_cookie']) ? 'cookie-expired' : ''; ?>">
                <?php echo isset($_COOKIE['lastname_cookie']) ? htmlspecialchars($_COOKIE['lastname_cookie']) : '[ Expired / Not Set ]'; ?>
            </span>
        </div>
    </div>

    <p class="refresh-notice">🔄 This monitor page automatically refreshes every 5 seconds to poll the server status.</p>
    <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="action-btn">Manual Check</a>
</div>

</body>
</html>
