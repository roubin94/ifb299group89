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
        $passwordErr = "Please enter a password.";
        $err_flag = TRUE;
    }
    else if (empty($_POST["password_repeat"])){
        $password_repeatErr = "Please repeat the password.";
        $err_flag = TRUE;
    }
    else {
        $password = trim_input($_POST["password"]);
        $password_repeat = trim_input($_POST["password_repeat"]);
        if ($password != $password_repeat) {
          $passwordErr = "The entered passwords did not match.";
          $err_flag = TRUE;
        }
    }

    // Check if inputted first name is valid.
    if (empty($_POST["first_name"])) {
        $first_nameErr = "A first name is required.";
        $err_flag = TRUE;
    }
    else {
        $first_name = trim_input($_POST["first_name"]);
            if (!preg_match("/^[a-zA-Z-']*$/",$first_name)) {
              $first_nameErr = "The first name contains invalid characters for our system.";
              $err_flag = TRUE;
            }
    }

    // Check if inputter last name is valid.
    if (empty($_POST["last_name"])) {
        $last_nameErr = "A last name is required.";
        $err_flag = TRUE;
    }
    else {
        $last_name = trim_input($_POST["last_name"]);
        if (!preg_match("/^[a-zA-Z-']*$/",$last_name)) {
          $last_nameErr = "The last name contains invalid characters for our system.";
          $err_flag = TRUE;
        }
    }
    
        if (empty($_POST["day"])) {
        $dayErr = "Please select a day of the month.";
        $err_flag = TRUE;
    }
    
    // Check if month has been selected.
    if (empty($_POST["month"])) {
        $monthErr = "Please select a month.";
        $err_flag = TRUE;
    }
    
    // Check if year has been selected.
    if (empty($_POST["year"])) {
        $yearErr = "Please select a year.";
        $err_flag = TRUE;
    }
    
    // If no errors up until this point, check if it's a valid date.
    if ($err_flag == FALSE) {
        $day = $_POST["day"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        if (!checkdate($month, $day, $year))
        {
            $err_flag = TRUE;
            $message = "You did not select a valid date.";
        }
    }


    // Function to filter unwanted inputs.
    function trim_input($data) {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }