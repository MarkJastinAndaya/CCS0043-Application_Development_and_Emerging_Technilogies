<?php
$fullname      = "";
$birthdate_str = "";
$age           = "";
$zodiac        = "";
$country       = "";
$address_full  = "";
$is_submitted  = false;

function calculateAge($year, $month, $day) {
    if (empty($year) || empty($month) || empty($day)) return "Unknown";
    $birthDate = date_create("$year-$month-$day");
    if (!$birthDate) return "Invalid Date";
    $today = date_create('today');
    $diff = date_diff($birthDate, $today);
    return $diff->y;
}

function getZodiacSign($month, $day) {
    $day = (int)$day;
    $month = strtolower(trim($month));
    
    $month_map = [
        'january' => 1, 'february' => 2, 'march' => 3, 'april' => 4, 'may' => 5, 'june' => 6,
        'july' => 7, 'august' => 8, 'september' => 9, 'october' => 10, 'november' => 11, 'december' => 12,
        'jan' => 1, 'feb' => 2, 'mar' => 3, 'apr' => 4, 'jun' => 6, 'jul' => 7, 'aug' => 8, 'sep' => 9, 'oct' => 10, 'nov' => 11, 'dec' => 12
    ];
    
    $m = isset($month_map[$month]) ? $month_map[$month] : (int)$month;
    if ($m == 0 || $day == 0) return "Unknown";

    if (($m == 3  && $day >= 21) || ($m == 4  && $day <= 19)) return "Aries";
    if (($m == 4  && $day >= 20) || ($m == 5  && $day <= 20)) return "Taurus";
    if (($m == 5  && $day >= 21) || ($m == 6  && $day <= 20)) return "Gemini";
    if (($m == 6  && $day >= 21) || ($m == 7  && $day <= 22)) return "Cancer";
    if (($m == 7  && $day >= 23) || ($m == 8  && $day <= 22)) return "Leo";
    if (($m == 8  && $day >= 23) || ($m == 9  && $day <= 22)) return "Virgo";
    if (($m == 9  && $day >= 23) || ($m == 10 && $day <= 22)) return "Libra";
    if (($m == 10 && $day >= 23) || ($m == 11 && $day <= 21)) return "Scorpio";
    if (($m == 11 && $day >= 22) || ($m == 12 && $day <= 21)) return "Sagittarius";
    if (($m == 12 && $day >= 22) || ($m == 1  && $day <= 19)) return "Capricorn";
    if (($m == 1  && $day >= 20) || ($m == 2  && $day <= 18)) return "Aquarius";
    if (($m == 2  && $day >= 19) || ($m == 3  && $day <= 20)) return "Pisces";
    
    return "Unknown";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_btn'])) {
    $fname   = htmlspecialchars($_POST['firstname']     ?? '');
    $mname   = htmlspecialchars($_POST['middlename']    ?? '');
    $lname   = htmlspecialchars($_POST['lastname']      ?? '');
    $b_year  = htmlspecialchars($_POST['birth_year']    ?? '');
    $b_month = htmlspecialchars($_POST['birth_month']   ?? '');
    $b_day   = htmlspecialchars($_POST['birth_day']     ?? '');
    $city    = htmlspecialchars($_POST['city']          ?? '');
    $country = htmlspecialchars($_POST['country']       ?? '');
    $local   = htmlspecialchars($_POST['local_address'] ?? '');

    $fullname = trim("$fname $mname $lname");
    $birthdate_str = ucwords(trim("$b_month $b_day, $b_year"));
    
    $age = calculateAge($b_year, $b_month, $b_day);
    $zodiac = getZodiacSign($b_month, $b_day);

    $address_full = trim("$city, $country");
    if (!empty($local)) {
        $address_full = htmlspecialchars($local) . ", " . $address_full;
    }
    
    $is_submitted = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Information Form (POST)</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

<div class="card">
    <h2>Personal Information Form</h2>
    <hr class="divider">

    <?php if (!$is_submitted): ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" placeholder="Mark Jastin" required>
            </div>
            
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" name="middlename" placeholder="Morales" required>
            </div>
            
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" placeholder="Andaya" required>
            </div>
            
            <div class="form-group">
                <label>Birth Date</label>
                <div class="row-three">
                    <input type="text" name="birth_year" placeholder="YYYY" maxlength="4" required>
                    <input type="text" name="birth_month" placeholder="MONTH" required>
                    <input type="text" name="birth_day" placeholder="00" maxlength="2" required>
                </div>
            </div>
            
            <div class="form-group">
                <label>Address</label>
                <div class="row-two">
                    <input type="text" name="city" placeholder="City" required>
                    <input type="text" name="country" placeholder="Country" required>
                </div>
                <input type="text" name="local_address" placeholder="Local Address (Optional)">
            </div>
            
            <button type="submit" name="submit_btn" class="submit-btn">Submit</button>
        </form>

    <?php else: ?>
        <div class="badge-info">
            Congratulations!<br>
            You just used PHP Superglobal - $_POST.
        </div>
        
        <div class="result-border">
            <p class="result-name"><?php echo $fullname; ?></p>
            
            <div class="result-item">
                <span class="result-label">Birth date</span>
                <span class="result-val-box"><?php echo $birthdate_str; ?></span>
            </div>
            
            <div class="result-item">
                <span class="result-label">Age</span>
                <span class="result-val-box"><?php echo $age; ?></span>
            </div>
            
            <div class="result-item">
                <span class="result-label">Zodiac</span>
                <span class="result-val-box"><?php echo $zodiac; ?></span>
            </div>
            
            <div class="result-item">
                <span class="result-label">Country</span>
                <span class="result-val-box">
                    <?php if (strtolower($country) === 'philippines' || strtolower($country) === 'ph'): ?>
                        <svg class="ph-flag" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1800 900">
                            <rect width="1800" height="900" fill="#fcd116"/>
                            <path d="M0 0h1800v450H0z" fill="#0038a8"/>
                            <path d="M0 450h1800v450H0z" fill="#ce1126"/>
                            <path d="M0 0l779.4 450L0 900z" fill="#fff"/>
                            <circle cx="260" cy="450" r="90" fill="#fcd116"/>
                        </svg>
                    <?php endif; ?>
                    <?php echo ucwords($country); ?>
                </span>
            </div>
            
            <div class="result-item">
                <span class="result-label">Address</span>
                <span class="result-val-box"><?php echo $address_full; ?></span>
            </div>
        </div>
        
        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="back-btn">Back</a>
    <?php endif; ?>
</div>

</body>
</html>
