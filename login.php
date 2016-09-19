<?php

session_start();

// Page Title
$title = "Pinelands Music Academy - Log In";

// Defining variables and setting them to be empty.
$email = $password = "";
$emailErr = $passwordErr = $message = "";

include "login_form_validate.php";

// Content
include "header.php";
?>

<html>
<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
    <fieldset>
      <legend>Log In</legend>
      <p>E-mail Address<br /><input type='text' name='email' value='<?php echo $email; ?>'>
      <?php echo $emailErr; ?></p>
      <p>Password<br /><input type='password' name='password'>
      <?php echo $passwordErr; ?></p>
      <input type='submit' value='Log In'/><?php echo $message; ?>
    </fieldset>
</form>
</html>

<?php
include 'footer.php';