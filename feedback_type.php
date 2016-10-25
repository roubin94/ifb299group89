<?php
    session_start();

    // Page Title
    $title = "PMA - Send Feedback";

    // Defining variables and setting them to be empty.
    $message = "";
    $_SESSION['teacher_fb'] = "";

    
    // Content
    include "header.php";

    if (!isset($_SESSION['student_id'])) {
        echo "You are not logged in as a student.";
    }
    
    else { ?>

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
            <br /><input type='submit' value='Next'/><?php echo $message; ?>
        </fieldset>
    </form>

<?php
    }
    include 'footer.php';