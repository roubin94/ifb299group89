<?php

// Defining variables and setting them to be empty.
$email = $password = $password_repeat = $first_name = $last_name = "";
$emailErr = $passwordErr = $first_nameErr = $last_nameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // First, validate the input of the form.
  $err_flag = FALSE;
  // Check if inputted e-mail adress is valid.
  if (empty($_POST["email"])) {
    $emailErr = "Your e-mail address is required.";
    $err_flag = TRUE;
  }
  else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
      $err_flag = TRUE;
    }
  }
  // Check if inputted passwords are valid.
  if (empty($_POST["password"])) {
    $passwordErr = "Please enter a password.";
    $err_flag = TRUE;
  }
  else if (empty($_POST["password_repeat"])){
    $password_repeatErr = "Please repeat your password.";
    $err_flag = TRUE;
  }
  else {
    $password = test_input($_POST["password"]);
    $password_repeat = test_input($_POST["password_repeat"]);
    if ($password != $password_repeat) {
      $passwordErr = "Your entered passwords did not match.";
      $err_flag = TRUE;
    }
  }
  // Check if inputted first name is valid.
  if (empty($_POST["first_name"])) {
    $first_nameErr = "Your first name is required.";
    $err_flag = TRUE;
  }
  else {
    $first_name = test_input($_POST["first_name"]);
    if (!preg_match("/^[a-zA-Z-']*$/",$name)) {
      $first_nameErr = "Your first name contains invalid characters for our system.";
      $err_flag = TRUE;
    }
  }
  // Check if inputter last name is valid.
  if (empty($_POST["last_name"])) {
    $last_nameErr = "Your last name is required.";
    $err_flag = TRUE;
  }
  else {
    $last_name = test_input($_POST["last_name"]);
    if (!preg_match("/^[a-zA-Z-']*$/",$name)) {
      $last_nameErr = "Your last name contains invalid characters for our system.";
      $err_flag = TRUE;
    }
  }
  
  // If all inputs are valid, proceed to add the new user to the database.
  if ($err_flag == FALSE) {
    include('signup_db.php');
  }
}

// Function to avoid unwanted inputs.
function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}

// Output page data
$title = "Pinelands Music School - Sign Up";
// The sign-up form is the content of this page.
$content = "
<form method='post' action=" . htmlspecialchars($_SERVER["PHP_SELF"]) . ">
    <fieldset>
      <legend>Enter Your Details</legend>
      <p>E-mail Address<br /><input type='text' name='email' value=" . $email . ">  " . 
      $emailErr . "</p>
      <p>Password<br /><input type='password' name='password'>  " .
      $passwordErr . "</p>
      <p>Repeat Password<br /><input type='password' name='password_repeat'></p>
      <p>First Name<br /><input type='text' name='first_name' value=" . $first_name . ">  " .
      $first_nameErr . "</p>
      <p>Last Name<br /><input type='text' name='last_name' value=" . $last_name . ">  " .
      $last_nameErr . "</p>
      <input type='submit' value='Sign Up'/>  " . $message . 
    "</fieldset>
</form>";

include 'Template.php';


// Original, non brute-forced HTML code.
/*
<form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
    <fieldset>
      <legend>Sign Up Form</legend>
      <p>E-mail Address<br /><input type='text' name='email' value='<?php echo $email; ?>'>
      <?php echo $emailErr; ?></p>
      <p>Password<br /><input type='password' name='password'>
      <?php echo $passwordErr; ?></p>
      <p>Repeat Password<br /><input type='password' name='password_repeat'></p>
      <p>First Name<br /><input type='text' name='first_name' value='<?php echo $first_name; ?>'>
      <?php echo $first_nameErr; ?></p>
      <p>Last Name<br /><input type='text' name='last_name' value='<?php echo $last_name; ?>'>
      <?php echo $last_nameErr; ?></p>
      <input type='submit' value='Sign Up'/>
    </fieldset>
</form>
*/

?>