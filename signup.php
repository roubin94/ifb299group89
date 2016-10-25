<?php
    session_start();

    // Page title
    $title = "PMA - Sign Up";

    // Defining variables and setting them to be empty.
    $email = $password = $password_repeat = $first_name = $last_name = $parent_email = $parent_first_name = $parent_last_name = $parent_number = "";
    $emailErr = $passwordErr = $password_repeatErr = $first_nameErr = $last_nameErr = $parent_numErr = $parent_emailErr = $parent_first_nameErr = $parent_last_nameErr = $message = "";

    // Check if user has entered their date of birth, and redirect if necessary.
    if (!isset($_SESSION['date_of_birth'])) {
        header("location: signup_dob.php");
    }
    
    // Form validation and submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $err_flag = FALSE; // Input error flag
        include "signup_validate.php";
        // If no errors, proceed to submit details to the database.
        if ($err_flag == FALSE) {
            include('signup_mysql.php');
        }
    }


    // Content
    include "header.php";
    
    if($_SESSION['over10'] == FALSE) { ?>
        <p>Sorry. We are currently only accepting students over the age of 10.</p>
<?php
    }
    else {
?>

<form method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
    <fieldset>      
        <legend>Sign Up</legend>
        <p><b>Please enter your details.</b></p>
        <p>E-mail Address<br /><input type='text' name='email' value='<?php echo $email; ?>'>
        <?php echo $emailErr; ?></p>
        <p>Password<br /><input type='password' name='password'>
        <?php echo $passwordErr; ?></p>
        <p>Repeat Password<br /><input type='password' name='password_repeat'>
		<?php echo $password_repeatErr; ?></p>
        <p>First Name<br /><input type='text' name='first_name' value='<?php echo $first_name; ?>'>
        <?php echo $first_nameErr; ?></p>
        <p>Last Name<br /><input type='text' name='last_name' value='<?php echo $last_name; ?>'>
        <?php echo $last_nameErr; ?></p>
        
        <!-- If under 18, ask for parental guardian information-->
        <?php if($_SESSION['over18'] == FALSE) { ?>
            <br  /><p><b>Please enter your parental guardian's details.</b></p>
            <p>First Name<br /><input type='text' name='parent_first_name' value='<?php echo $parent_first_name; ?>'>
            <?php echo $parent_first_nameErr; ?></p>
            <p>Last Name<br /><input type='text' name='parent_last_name' value='<?php echo $parent_last_name; ?>'>
            <?php echo $parent_last_nameErr; ?></p>
            <p>E-mail Address<br /><input type='text' name='parent_email' value='<?php echo $parent_email; ?>'>
            <?php echo $parent_emailErr; ?></p>
            <p>Contact Number<br /><input type='text' name='parent_number' value='<?php echo $parent_number; ?>'>
            <?php echo $parent_numErr; ?></p>
        <?php } ?>
      
        <input type='submit' value='Sign Up'/><?php echo $message; ?>
    </fieldset>
</form>

<?php
    }
    include 'footer.php';