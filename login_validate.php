<?php

    // Validate the input of the form, and set the resulting variables.

    // Check if inputted e-mail address isn't empty, and matches the e-mail format.
    if (empty($_POST["email"])) {
        $emailErr = "Your e-mail address is required.";
        $err_flag = TRUE;
    }
    else {
        $email = trim_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format.";
              $err_flag = TRUE;
        }
    }

    // Check if inputted passwords are valid.
    if (empty($_POST["password"])) {
        $passwordErr = "Please enter your password.";
        $err_flag = TRUE;
    }
    else {
        $password = trim_input($_POST["password"]);
    }

    // Function to filter unwanted inputs.
    function trim_input($data) {
      $data = trim($data);
      $data = htmlspecialchars($data);
      return $data;
    }