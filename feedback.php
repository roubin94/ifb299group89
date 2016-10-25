<?php
    session_start();

    // Page Title
    $title = "PMA - Send Feedback";

    // Defining variables and setting them to be empty.
    $email = $feedback = ""; 
    $emailErr = $feedbackErr = $message = ""; 

    // Check if user is logged in as a teacher.
    if (isset($_SESSION['student_id'])) {
        // Form validation and submission.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $err_flag = FALSE; // Input error flag
            include "feedback_validate.php";
            // If no errors, proceed to submit details to the database.
            if ($err_flag == FALSE) {
                include('feedback_mysql.php');
            }
        }
    }

    
    // Content
    include "header.php";
    
    if (!isset($_SESSION['student_id'])) {
        echo "You are not logged in as a student.";
    }
    
    else { ?>

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
    }
    include 'footer.php';