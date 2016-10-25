<?php
session_start();

$title = "Pinelands Music Academy - Feedback";

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
        <br /><header>Email</header>
        <p><input type='text' name='email' value='<?php echo $email; ?>'>
        <?php echo $emailErr; ?></p>
        <br /><header>Feedback</header>
        <p><textarea type='text' name="feedback" rows="6" cols="100"></textarea>
        <?php echo $feedbackErr; ?></p>    
        <br /><input type='submit' value='Submit'/><?php echo $message; ?>
    </fieldset>
</form>

<?php
include 'footer.php';
 
