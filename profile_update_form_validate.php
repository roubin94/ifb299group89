<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Error flag - if remains false, continue on to connect and check with the database.
    $err_flag = FALSE; 
    // New password flag - if remains false, don't change the password.
    $new_password_flag = FALSE; //

    // Check if inputted e-mail adress isn't empty, and matches the e-mail format.
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

    // Check if inputted current password isn't empty.
    if (empty($_POST["current_password"])) {
      $current_passwordErr = "Please enter your current password.";
      $err_flag = TRUE;
    }
    else {
        $current_password = test_input($_POST["current_password"]);
    }

    // Check if inputted new passwords are empty.
    if (empty($_POST["password"])) {
        if (!empty($_POST["password_repeat"])){
            $passwordErr = "Please enter your new password.";
            $err_flag = TRUE;
        }
    }
    else {
        if (empty($_POST["password_repeat"])){
            $password_repeatErr = "Please repeat your new password.";
            $err_flag = TRUE;
        }
        else
        {
            // New passwords have been entered, so need to change password.
            $new_password_flag = TRUE;
            // Check if inputted new passwords match
            $password = test_input($_POST["password"]);
            $password_repeat = test_input($_POST["password_repeat"]);
            if ($password != $password_repeat) {
                $passwordErr = "Your entered new passwords did not match.";
                $err_flag = TRUE;
            }
        }
    }

    // Check if inputted first name isn't empty, and only contains expected characters.
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

    // Check if inputted last name isn't empty, and only contains expected characters.
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

    // If all inputs are valid, proceed to update the student's details in the database.
    if ($err_flag == FALSE) {
      include('profile_update_db.php');
    }
}

// Function to avoid unwanted inputs.
function test_input($data) {
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}