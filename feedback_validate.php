<?php

// Validate the input of the form, and set the resulting variables.

    // Check if inputted e-mail address isn't empty, and matches the e-mail format.
    if (empty($_POST["email"])) {
        $emailErr = "Please enter the teacher's email address.";
        $err_flag = TRUE;
    }
    else {
        $email = trim_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format.";
              $err_flag = TRUE;
        }
    }
    if (empty($_POST["feedback"])) {
        $feedbackErr = "Please enter your feedback.";
        $err_flag = TRUE;
    }
    

function trim_input($data) {
      $data = trim($data);
      $data = htmlspecialchars($data);
      return $data;
    }

