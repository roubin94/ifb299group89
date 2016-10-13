<?php

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
      $email = trim_input($_POST["email"]);
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
        $current_password = trim_input($_POST["current_password"]);
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
            $password = trim_input($_POST["password"]);
            $password_repeat = trim_input($_POST["password_repeat"]);
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
      $first_name = trim_input($_POST["first_name"]);
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
      $last_name = trim_input($_POST["last_name"]);
      if (!preg_match("/^[a-zA-Z-']*$/",$last_name)) {
        $last_nameErr = "Your last name contains invalid characters for our system.";
        $err_flag = TRUE;
      }
    }
    
    // If the user has a guardian, validate the inputted parent's information.
    if ($parent_email != "") {
        if (empty($_POST["parent_email"])) {
            $parent_emailErr = "Your guardian's e-mail address is required.";
            $err_flag = TRUE;
        }
        else {
            $parent_email = trim_input($_POST["parent_email"]);
            if (!filter_var($parent_email, FILTER_VALIDATE_EMAIL)) {
                $parent_emailErr = "Invalid email format";
                $err_flag = TRUE;
            }
        }

        if (empty($_POST["parent_first_name"])) {
            $parent_first_nameErr = "Your guardian's first name is required.";
            $err_flag = TRUE;
        }
        else {
            $parent_first_name = trim_input($_POST["parent_first_name"]);
            if (!preg_match("/^[a-zA-Z-']*$/",$parent_first_name)) {
              $parent_first_nameErr = "Your guardian's first name contains invalid characters for our system.";
              $err_flag = TRUE;
            }
        }

        if (empty($_POST["parent_last_name"])) {
            $parent_last_nameErr = "Your guardian's last name is required.";
            $err_flag = TRUE;
        }
        else {
            $parent_last_name = trim_input($_POST["parent_last_name"]);
            if (!preg_match("/^[a-zA-Z-']*$/",$parent_last_name)) {
                $parent_last_nameErr = "Your guardian's last name contains invalid characters for our system.";
                $err_flag = TRUE;
            }
        }

        // Check if inputted parent's phone number is valid.
        if (empty($_POST["parent_number"])) {
            $parent_numErr = "Your guardian's contact number is required.";
            $err_flag = TRUE;
        }
        else {
            $parent_number = trim_input($_POST["parent_number"]);
            if (!preg_match("/^[0-9-]*$/",$parent_number)) {
                $parent_numErr = "Your guardian's contact number contains invalid characters for our system";
                $err_flag = TRUE;
            }
        }
    }


    // Function to avoid unwanted inputs.
    function trim_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }