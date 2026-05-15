<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration Form</title>
    <link rel="stylesheet" href="style-student-regis-form-1.css">
</head>
<body>

    <header class="header">
        <div class="header-logo">
            <div class="header-logo-icon">🎓</div>
            <div class="header-logo-text">
                <strong>Academic Registrar</strong>
                Student Enrollment System
            </div>
        </div>
        <div class="header-title">
            <span>New Student</span>
            Registration Form
        </div>
    </header>

    <div class="app">

        <div class="form-meta">
            <span class="form-meta-label">Complete all required fields</span>
            <div class="form-steps">
                <div class="form-step-dot active"></div>
                <div class="form-step-dot active"></div>
                <div class="form-step-dot active"></div>
                <div class="form-step-dot active"></div>
                <div class="form-step-dot"></div>
            </div>
        </div>

        <form method="POST" action="">

            <!-- ── Student Information ── -->
            <div class="section_container" id="student_info">
                <div class="section-head">Student Information</div>
                <div class="section-body">

                    <div class="row">
                        <span class="row-label">Full Legal Name</span>
                        <div class="input-group">
                            <input type="text" name="last_name" placeholder="e.g. Dela Cruz" required>
                            <label>Last Name</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="first_name" placeholder="e.g. Juan" required>
                            <label>First Name</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="middle_name" placeholder="e.g. Santos">
                            <label>Middle Name</label>
                        </div>
                    </div>

                    <hr class="section-divider">

                    <div class="row">
                        <span class="row-label">Preferred Name</span>
                        <div class="input-group">
                            <input type="text" name="pref_last_name" placeholder="Last Name">
                            <label>Last Name</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="pref_first_name" placeholder="First Name">
                            <label>First Name</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="pref_middle_name" placeholder="Middle Name">
                            <label>Middle Name</label>
                        </div>
                    </div>

                    <hr class="section-divider">

                    <div class="row">
                        <div class="input-group">
                            <label>Gender</label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="gender" value="Male"> Male
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="gender" value="Female"> Female
                                </label>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" name="birth_date" placeholder="YYYY-MM-DD">
                            <label>Date of Birth</label>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ── Previous School Information ── -->
            <div class="section_container" id="prev_school_info">
                <div class="section-head">Previous School Information</div>
                <div class="section-body">

                    <div class="row">
                        <div class="input-group">
                            <input type="text" name="prev_school_board_name" placeholder="School Board / Municipality">
                            <label>Name of Previous School Board / Municipality</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="last_date_attended" placeholder="YYYY-MM-DD">
                            <label>Last Date Attended</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group">
                            <input type="text" name="prev_school_name" placeholder="School Name">
                            <label>Name of Previous School</label>
                        </div>
                        <div class="input-group">
                            <input type="number" name="grade_prev_school" placeholder="e.g. 10">
                            <label>Grade at Previous School</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-group">
                            <label>Language of Instruction</label>
                            <div class="checkbox-group">
                                <label class="checkbox-option">
                                    <input type="checkbox" name="lang_instruction[]" value="English"> English
                                </label>
                                <label class="checkbox-option">
                                    <input type="checkbox" name="lang_instruction[]" value="French"> French
                                </label>
                                <label class="checkbox-option">
                                    <input type="checkbox" name="lang_instruction[]" value="Others"> Others
                                </label>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="text" name="reason_transfer" placeholder="Reason for transfer">
                            <label>Reason for Transfer</label>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ── Health Information ── -->
            <div class="section_container" id="health_info">
                <div class="section-head">Health Information</div>
                <div class="section-body">
                    <div class="row">
                        <div class="input-group">
                            <input type="text" name="medical_conditions" placeholder="Leave blank if none">
                            <label>Medical Conditions (if any)</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── Citizenship Information ── -->
            <div class="section_container" id="citizenship_info">
                <div class="section-head">Citizenship Information</div>
                <div class="section-body">
                    <div class="row">
                        <div class="input-group">
                            <input type="text" name="birth_country" placeholder="e.g. Philippines">
                            <label>Birth Country</label>
                        </div>
                        <div class="input-group">
                            <input type="text" name="citizenship" placeholder="e.g. Filipino">
                            <label>Country of Citizenship</label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="register" class="btn-submit">
                ✦ &nbsp; Process Registration
            </button>

        </form>

        <?php
        if (isset($_POST['register'])) {
            $lName   = $_POST['last_name']   ?? '';
            $fName   = $_POST['first_name']  ?? '';
            $mName   = $_POST['middle_name'] ?? '';
            $gender  = $_POST['gender']      ?? 'Not Specified';
            $bDate   = $_POST['birth_date']  ?? '';
            $pSchool = $_POST['prev_school_name'] ?? '';
            $lDate   = $_POST['last_date_attended'] ?? '';
            $medCond = $_POST['medical_conditions'] ?? '';
            $bCountry = $_POST['birth_country'] ?? '';
            $citizen  = $_POST['citizenship']   ?? '';

            echo "<div class='output-box'>";
            echo "<h3>Registration Summary</h3>";
            echo "<strong>Student Name:</strong>&nbsp; " . strtoupper(htmlspecialchars($lName)) . ", " . strtoupper(htmlspecialchars($fName)) . " " . strtoupper(htmlspecialchars($mName)) . "<br><br>";
            echo "<strong>Gender:</strong>&nbsp; " . htmlspecialchars($gender) . "<br><br>";
            echo "<strong>Date of Birth:</strong>&nbsp; " . htmlspecialchars($bDate) . "<br>";
            echo "<hr>";
            echo "<strong>Previous School:</strong>&nbsp; " . htmlspecialchars($pSchool) . " &nbsp;(Attended until: " . htmlspecialchars($lDate) . ")<br><br>";
            echo "<strong>Medical Remarks:</strong>&nbsp; " . ($medCond ? htmlspecialchars($medCond) : "None Reported") . "<br>";
            echo "<hr>";
            echo "<strong>Citizenship:</strong>&nbsp; " . strtoupper(htmlspecialchars($citizen)) . " &nbsp;(Origin: " . strtoupper(htmlspecialchars($bCountry)) . ")<br>";
            echo "</div>";
        }
        ?>

    </div>

    <footer>
        <p>Lab Activity 1 — PHP Variable &amp; Control Structures</p>
    </footer>

</body>
</html>
