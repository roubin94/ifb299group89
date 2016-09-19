<?php

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
  if (empty($_POST["parent_email"])) {
    $parent_emailErr = "Your parent or guardian's e-mail address is required.";
    $err_flag = TRUE;
  }
  else {
    $parent_email = test_input($_POST["parent_email"]);
    if (!filter_var($parent_email, FILTER_VALIDATE_EMAIL)) {
      $parent_emailErr = "Invalid email format";
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
    if (!preg_match("/^[a-zA-Z-']*$/",$first_name)) {
      $first_nameErr = "Your first name contains invalid characters for our system.";
      $err_flag = TRUE;
    }
  }
  if (empty($_POST["parent_first_name"])) {
    $parent_first_nameErr = "Your parent or guardian's first name is required.";
    $err_flag = TRUE;
  }
  else {
    $parent_first_name = test_input($_POST["parent_first_name"]);
    if (!preg_match("/^[a-zA-Z-']*$/",$parent_first_name)) {
      $praent_first_nameErr = "Your parent or guardian's first name contains invalid characters for our system.";
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
    if (!preg_match("/^[a-zA-Z-']*$/",$last_name)) {
      $last_nameErr = "Your last name contains invalid characters for our system.";
      $err_flag = TRUE;
    }
  }
  if (empty($_POST["parent_last_name"])) {
    $parent_last_nameErr = "Your parent or guardian's last name is required.";
    $err_flag = TRUE;
  }
  else {
    $parent_last_name = test_input($_POST["parent_last_name"]);
    if (!preg_match("/^[a-zA-Z-']*$/",$parent_last_name)) {
      $parent_last_nameErr = "Your parent or guardian's last name contains invalid characters for our system.";
      $err_flag = TRUE;
    }
  }
  // Check if input number is valid.
  if (empty($_POST["parent_number"])) {
    $parent_numErr = "Your parent or guardian's contact number is required.";
    $err_flag = TRUE;
  }
  else {
    $parent_number = test_input($_POST["parent_number"]);
    if (!preg_match("/^[0-9-']*$/",$parent_number)) {
      $parent_numErr = "Your parent or guardian's contact number contains invalid characters for our system";
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