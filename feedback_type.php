<?php
session_start();

$title = "Pinelands Music Academy - Feedback";

$message = "";

$_SESSION['teacher_fb'] = "";

include "header.php";

?>

<form method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
    <fieldset>      
        <legend>Feedback</legend>
        <select name='feedback_selection'>
        <option value=''></option>
        <option value='teacher_feedback'>Teacher Feedback</option>
        <option value='school_feedback'>School Feedback</option>
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
 
