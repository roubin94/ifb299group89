<?php

// Defining variables and setting them to be empty.
$email = $password = "";
$emailErr = $passwordErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // First, validate the input of the form.
  $err_flag = FALSE;
  // Check if inputted e-mail adress is valid.
  if (empty($_POST["email"])) {
    $emailErr = "Please enter your e-mail address.";
    $err_flag = TRUE;
  }
  // Check if inputted passwords are valid.
  if (empty($_POST["password"])) {
    $passwordErr = "Please enter your password.";
    $err_flag = TRUE;
  }
  
  // If all inputs are valid, proceed to check database and log user in.
  if ($err_flag == FALSE) {
    include('login_db.php');
  }
}

// Function to avoid unwanted inputs.
function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Output page data
$title = "Pinelands Music School - Sign Up:";
// The sign-up form is the content of this page.
$content = "
<html>
<form method='post' action='<?php" . htmlspecialchars($_SERVER["PHP_SELF"]) . ">
    <fieldset>
      <legend>Log In</legend>
      <p>E-mail Address<br /><input type='text' name='email' value=" . $email . ">" .
      $emailErr . "</p>
      <p>Password<br /><input type='password' name='password'>" .
      $passwordErr . "</p>
      <input type='submit' value='Log In'/>
    </fieldset>
</form>
</html>";

include 'Template.php';


// Original, non brute-forced HTML code.
/*
<html>
<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
    <fieldset>
      <legend>Log In</legend>
      <p>E-mail Address<br /><input type='text' name='email' value='<?php echo $email; ?>'>
      <?php echo $emailErr; ?></p>
      <p>Password<br /><input type='password' name='password'>
      <?php echo $passwordErr; ?></p>
      <input type='submit' value='Log In'/>
    </fieldset>
</form>
</html>
*/

?>