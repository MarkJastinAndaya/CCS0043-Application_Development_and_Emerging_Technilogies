<?php
$submitted = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = true;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Feedback Form</title>
    <link rel="stylesheet" type="text/css" href="style-form.css">
</head>
<body>

<h1>Student Feedback Form</h1>
<p>Please fill out all fields and click Submit when done.</p>

<?php if ($submitted): ?>

    <div class="success">
        <strong>Form submitted successfully!</strong>
        <div class="submitted-data">
            <strong>Name:</strong> <?= htmlspecialchars($_POST['first_name']) ?> <?= htmlspecialchars($_POST['last_name']) ?><br>
            <strong>Email:</strong> <?= htmlspecialchars($_POST['email']) ?><br>
            <strong>Year Level:</strong> <?= htmlspecialchars($_POST['year_level'] ?? 'Not selected') ?><br>
            <strong>Topics enjoyed:</strong> <?= isset($_POST['topics']) ? implode(', ', array_map('htmlspecialchars', $_POST['topics'])) : 'None selected' ?><br>
            <strong>Class pace:</strong> <?= htmlspecialchars($_POST['pace'] ?? 'Not selected') ?><br>
            <strong>Comments:</strong> <?= htmlspecialchars($_POST['comments']) ?>
        </div>
    </div>

<?php endif; ?>

<form method="POST" action="">

    <!-- Section 1: Personal Info -->
    <h2>1. Personal Information</h2>

    <label>First Name</label>
    <input type="text" name="first_name" placeholder="Juan">

    <label>Last Name</label>
    <input type="text" name="last_name" placeholder="dela Cruz">

    <label>Email Address</label>
    <input type="email" name="email" placeholder="student@feutech.edu.ph">

    <!-- Section 2: Radio Buttons -->
    <h2>2. Year Level</h2>

    <label class="option"><input type="radio" name="year_level" value="1st Year"> 1st Year</label>
    <label class="option"><input type="radio" name="year_level" value="2nd Year"> 2nd Year</label>
    <label class="option"><input type="radio" name="year_level" value="3rd Year"> 3rd Year</label>
    <label class="option"><input type="radio" name="year_level" value="4th Year"> 4th Year</label>

    <!-- Section 3: Checkboxes -->
    <h2>3. Which topics did you enjoy? (Check all that apply)</h2>

    <label class="option"><input type="checkbox" name="topics[]" value="Arrays"> Arrays</label>
    <label class="option"><input type="checkbox" name="topics[]" value="Linked Lists"> Linked Lists</label>
    <label class="option"><input type="checkbox" name="topics[]" value="Stacks and Queues"> Stacks and Queues</label>
    <label class="option"><input type="checkbox" name="topics[]" value="Sorting Algorithms"> Sorting Algorithms</label>
    <label class="option"><input type="checkbox" name="topics[]" value="Trees and Graphs"> Trees and Graphs</label>

    <!-- Section 4: Radio Buttons -->
    <h2>4. How was the pace of the class?</h2>

    <label class="option"><input type="radio" name="pace" value="Too slow"> Too slow</label>
    <label class="option"><input type="radio" name="pace" value="Just right"> Just right</label>
    <label class="option"><input type="radio" name="pace" value="Too fast"> Too fast</label>

    <!-- Section 5: Textarea -->
    <h2>5. Additional Comments</h2>

    <label>Any suggestions or feedback for the instructor?</label>
    <textarea name="comments" rows="5" cols="50" placeholder="Write your comments here..."></textarea>

    <!-- Buttons -->
    <br>
    <button type="submit">Submit</button>
    <button type="reset">Clear</button>

</form>

</body>
</html>
