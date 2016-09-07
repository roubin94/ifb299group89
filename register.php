<!DOCTYPE html>
<html>
<head>
  <title>Pinelands Music School - Registration</title>
</head>
    
<body>

<?php

// Defining variables and setting them to be empty.
$email = $password = $password_repeat = $first_name = $last_name = "";
$emailErr = $passwordErr = $first_nameErr = $last_nameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if inputted e-mail adress is valid.
  $email = test_input($_POST["email"]);
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format"; 
  }
  // Check if inputted password is valid.
  $password = htmlspecialchars($_POST["password"]);
  $password_repeat = test_input($_POST["password_repeat"]);
  if ($password != $password_repeat) {
    $passwordErr = "Your entered passwords did not match."
  }
  // Check if inputted first name is valid.
  $first_name = test_input($_POST["first_name"]);
  if (!preg_match("/^[a-zA-Z-']*$/",$name)) {
    $first_nameErr = "Your first name contains invalid characters for our system."; 
  }
  // Check if inputter last name is valid.
  $last_name = test_input($_POST["last_name"]);
  if (!preg_match("/^[a-zA-Z-']*$/",$name)) {
      $last_nameErr = "Your last name contains invalid characters for our system."; 
  }
}

function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Registration Page</h2>
<a href="index.php">Click here to go back.</a><br /><br />
        
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  E-mail Address: <input type="text" name="email" required="Your e-mail address is required."/>
    <span class="error"><?php echo $emailErr; ?></span>
    <br />
    Password: <input type="password" name="password" required="A password is required."/>
    <span class="error"><?php echo $passwordErr; ?></span>
    <br />
    Repeat Password: <input type="password" name="password_repeat" required="Please re-enter your password."/>
    <br />   
    First Name: <input type="text" name="first_name" required="Your first name is required."/>
    <span class="error"><?php echo $emailErr; ?></span>
    <br />
    Last Name: <input type="text" name="last_name" required="Your last name is required."/>
    <span class="error"><?php echo $emailErr; ?></span>
    <br />
    <input type="submit" value="Register"/>
</form> 

<?php
  echo "<h2>Your Input:</h2>";
  echo $email;
  echo "<br>";
  echo $password;
  echo "<br>";
  echo $password_repeat;
  echo "<br>";
  echo $first_name;
  echo "<br>";
  echo $last_name;
?>

</body>

</html>