<?php
session_start();

$title = "PMA - Send Feedback";

$message = "";

$_SESSION['teacher_fb'] = "";

include "header.php";

?>

<form method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
    <fieldset>      
        <legend>Provide Feedback</legend>
        <p>Please select who you would like to send feedback to.</p>
        <select name='feedback_selection'>
        <option value='teacher_feedback'>A teacher</option>
        <option value='school_feedback'>Pinelands Music Academy</option>
        </select>
        <?php if(isset($_POST['feedback_selection'])) { 
            switch($_POST['feedback_selection']){
                case 'teacher_feedback': 
                    $_SESSION['teacher_fb'] = '1';
                    header("location: feedback.php");      
                break;
                case 'school_feedback': 
                    $_SESSION['teacher_fb'] = '0';
                    header("location: feedback.php"); 
                break;
                }
            } ?>
        <br /><input type='submit' value='Submit'/><?php echo $message; ?>
    </fieldset>
</form>

<?php
include 'footer.php';
 
