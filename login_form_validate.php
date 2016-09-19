<?php

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
    $email = test_input($_POST["email"]);
    $password = test_input($_POST["password"]);
    include('login_db.php');
  }
}

// Function to avoid unwanted inputs.
function test_input($data) {
  $data = trim($data);
  $data = htmlspecialchars($data);
  return $data;
}