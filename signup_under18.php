<?php

    session_start();

    // Page Title
    $title = "Pinelands Music Academy - Sign Up";

    // Defining variables and setting them to be empty.
    $email = $password = $password_repeat = $first_name = $last_name = $parent_email = $parent_first_name = $parent_last_name = $parent_number = "";
    $emailErr = $passwordErr = $first_nameErr = $last_nameErr = $parent_numErr = $parent_emailErr = $parent_first_nameErr = $parent_last_nameErr = $message = "";

    // Form submission handling
    include "signup_form_validate.php";


    // Content
    include "header.php";
?>

<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
    <fieldset>      
        <legend>Sign Up Form</legend>
        <!--      Fix this-->
        <?php echo $_SESSION['date_of_birth'];?>
        <p>E-mail Address<br /><input type='text' name='email' value='<?php echo $email; ?>'>
        <?php echo $emailErr; ?></p>
        <p>Password<br /><input type='password' name='password'>
        <?php echo $passwordErr; ?></p>
        <p>Repeat Password<br /><input type='password' name='password_repeat'></p>
        <p>First Name<br /><input type='text' name='first_name' value='<?php echo $first_name; ?>'>
        <?php echo $first_nameErr; ?></p>
        <p>Last Name<br /><input type='text' name='last_name' value='<?php echo $last_name; ?>'>
        <?php echo $last_nameErr; ?></p>
        <br  /><p><header><?php echo "Parent/Guardian Details"; ?></header></p>
        <p>First Name<br /><input type='text' name='parent_first_name' value='<?php echo $parent_first_name; ?>'>
        <?php echo $parent_first_nameErr; ?></p>
        <p>Last Name<br /><input type='text' name='parent_last_name' value='<?php echo $parent_last_name; ?>'>
        <?php echo $parent_last_nameErr; ?></p>
        <p>E-mail Address<br /><input type='text' name='parent_email' value='<?php echo $parent_email; ?>'>
        <?php echo $parent_emailErr; ?></p>
        <p>Phone/Mobile Number<br /><input type='text' name='parent_number' value='<?php echo $parent_number; ?>'>
        <?php echo $parent_numErr; ?></p>
        <input type='submit' value='Sign Up'/><?php echo $message; ?>
    </fieldset>
</form>

<?php
include 'footer.php';