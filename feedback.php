<?php
session_start();

$title = "PMA - Send Feedback";

$email = $feedback = ""; 
$emailErr = $feedbackErr = $message = "";

if($_SESSION['teacher_fb'] == '0'){
    $email = "pinelands@gmail.com";
}

include "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $err_flag = FALSE; // Input error flag
        include "feedback_validate.php";
        // If no errors, proceed to submit details to the database.
        if ($err_flag == FALSE) {
            include('feedback_mysql.php');
        }
    }
?>

<form method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
    <fieldset>
        <legend>Provide Feedback</legend>
        <p>Teacher Email Address</p>
        <input type='text' name='email' value='<?php echo $email; ?>'>
        <?php echo $emailErr; ?>
        <br /><p>Your Feedback</p>
        <textarea name="feedback" rows="8"></textarea>
        <?php echo $feedbackErr; ?> 
        <br /><input type='submit' value='Send'/><?php echo $message; ?>
    </fieldset>
</form>

<?php
include 'footer.php';
 
