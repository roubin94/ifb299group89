<?php
    session_start();
    
    // Page Title
    $title = "Pinelands Music Academy - Update Profile";

    // Defining variables and setting them to be empty.
    $student_id = $email_address = $current_password = $password = $password_repeat = $first_name = $last_name = "";
    $parent_email = $parent_first_name = $parent_last_name = $parent_number = "";
    $emailErr = $current_passwordErr = $passwordErr = $password_repeatErr = $first_nameErr = $last_nameErr  = $message = "";
    $parent_numErr = $parent_emailErr = $parent_first_nameErr = $parent_last_nameErr = "";
    
    
    // Check if the student is logged in, and get their information for the form if they are.
    if (isset($_SESSION['student_id'])) {
        include "profile_mysql.php";   
    }
    
    // Form validation and submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $err_Flag = FALSE; // Input error flag
        include "profile_update_validate.php";
        // If no errors, proceed to update the details in the database.
        if ($err_flag == FALSE) {
            include "profile_update_mysql.php";
        }
    }


    // Content
    include "header.php";
    ?>
    
    <?php 
        if (!isset($_SESSION['student_id'])) {
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
                          
                <!-- If guardian exists, allow user to update their details. -->
                <?php if($parent_email != "") { ?>
                <br  /><header>Parental Guardian Details</header>
                <p>First Name<br /><input type='text' name='parent_first_name' value='<?php echo $parent_first_name; ?>'>
                <?php echo $parent_first_nameErr; ?></p>
                <p>Last Name<br /><input type='text' name='parent_last_name' value='<?php echo $parent_last_name; ?>'>
                <?php echo $parent_last_nameErr; ?></p>
                <p>E-mail Address<br /><input type='text' name='parent_email' value='<?php echo $parent_email; ?>'>
                <?php echo $parent_emailErr; ?></p>
                <p>Contact Number<br /><input type='text' name='parent_number' value='<?php echo $parent_number; ?>'>
                <?php echo $parent_numErr; ?></p>
                <?php } ?>
                
                <input type='submit' value='Save'/><?php echo $message; ?>
              </fieldset>
        </form>
    </html>

    <?php
        }
        
        include 'footer.php';