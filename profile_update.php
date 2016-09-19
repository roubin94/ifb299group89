<?php
    session_start();
    
    // Page Title
    $title = "Pinelands Music Academy - Update Profile";

    // Defining variables and setting them to be empty.
    $student_id = $email_address = $current_password = $password = $password_repeat = $first_name = $last_name = "";
    $emailErr = $current_passwordErr = $passwordErr = $password_repeatErr = $first_nameErr = $last_nameErr  = $message = "";
    
    // Check if the student is logged in, and get their information for the form if they are.
    if (isset($_SESSION['student_id'])) {
        include "db_students_connect.php";
        include "profile_get.php";
        include "profile_update_form_validate.php";
    }
    else {
        $message = "You are not logged in.";
    }

    // Content
    include "header.php";
    ?>

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
                <input type='submit' value='Update'/><?php echo $message; ?>
              </fieldset>
        </form>
    </html>

    <?php
    include 'footer.php';