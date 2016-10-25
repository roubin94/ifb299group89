<?php
    session_start();
    
    // Page Title
    $title = "PMA - Update Profile";

    // Defining variables and setting them to be empty.
    $teacher_id = $email_address = $current_password = $password = $password_repeat = $first_name = $last_name = "";
    $emailErr = $current_passwordErr = $passwordErr = $password_repeatErr = $first_nameErr = $last_nameErr  = $message = "";
    
    
    // Check if the teacher is logged in, and get their information for the form if they are.
    if (isset($_SESSION['teacher_id'])) {
        include "teacher_profile_mysql.php";   
    }
    
    // Form validation and submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $err_Flag = FALSE; // Input error flag
        include "teacher_profile_update_validate.php";
        // If no errors, proceed to update the details in the database.
        if ($err_flag == FALSE) {
            include('teacher_profile_update_mysql.php');
        }
    }


    // Content
    include "header.php";
    ?>
    
    <?php 
        if (!isset($_SESSION['teacher_id'])) {
            echo "You are not logged in.";
        }
        else {?>         
    
    <html>
        <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
            <fieldset>
                <legend>Update Your Details</legend>
                <p>E-mail Address<br /><input type='text' name='email' value='<?php echo $email_address; ?>'>
                <?php echo $emailErr; ?></p>
                <p>Current Password<br /><input type='password' name='current_password'>
                <?php echo $current_passwordErr; ?></p>
                <p>New Password (optional)<br /><input type='password' name='password'>
                <?php echo $passwordErr; ?></p>
                <p>Repeat New Password (optional)<br /><input type='password' name='password_repeat'>
                <?php echo $password_repeatErr; ?></p>
                <p>First Name<br /><input type='text' name='first_name' value='<?php echo $first_name; ?>'>
                <?php echo $first_nameErr; ?></p>
                <p>Last Name<br /><input type='text' name='last_name' value='<?php echo $last_name; ?>'>
                <?php echo $last_nameErr; ?></p>                
                <input type='submit' value='Save'/><?php echo $message; ?>
                <p><a href="teacher_profile.php">Back</a><p/>
              </fieldset>
        </form>
    </html>

    <?php
        }
        
        include 'footer.php';