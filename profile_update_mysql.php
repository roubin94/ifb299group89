<?php
    include "db_credentials.php";
    include "db_connect.php";
    
    // Connect to the students database.
    $db_students = db_connect($db_host, $db_user, $db_password, 'students');

    // Ensure variables are mySQL friendly.
    $student_id = mysqli_real_escape_string($db_students, $_SESSION['student_id']);
    $email = mysqli_real_escape_string($db_students, $email);
    $current_password = mysqli_real_escape_string($db_students, $current_password);
    $password = mysqli_real_escape_string($db_students, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $first_name = mysqli_real_escape_string($db_students, $first_name);
    $last_name = mysqli_real_escape_string($db_students, $last_name);
    
    if($parent_email != "") {
        $parent_email = mysqli_real_escape_string($db_students, $parent_email);
        $parent_first_name = mysqli_real_escape_string($db_students, $parent_first_name);
        $parent_last_name = mysqli_real_escape_string($db_students, $parent_last_name);
        $parent_number = mysqli_real_escape_string($db_students, $parent_number);
    }

    // Check if inputted current password is correct.
    // Start by getting the password from the database.
    $sql = "SELECT * FROM students WHERE student_id = '$student_id'";
    $result = mysqli_query($db_students, $sql);
    $row = mysqli_fetch_assoc($result);
    $password_hash = $row['password'];
    // Then check if the password is correct.
    if (password_verify($current_password, $password_hash) == FALSE) {
        $current_passwordErr = "Your current password was incorrect.";
        $err_flag = TRUE;
    } 

    // Check if any other rows match the entered e-mail adress.
    // Start by getting any possible rows the e-mail address is being used by.
    $sql = "SELECT * FROM students WHERE email_address = '$email' AND student_id <> '$student_id'";
    $result = mysqli_query($db_students, $sql);
    $count = mysqli_num_rows($result);
    // Provide error message if an account with that e-mail already exists.
    if ($count >= 1)
    {
        $emailErr = "Sorry. This email already has an account associated with it.";
        $err_flag = TRUE;
    }

    // Having passed all checks, update the student's details in the database.
    if ($err_flag == FALSE)
    {
        $sql = "UPDATE students SET email_address='$email', first_name='$first_name', last_name='$last_name' WHERE student_id='$student_id'";
        mysqli_query($db_students, $sql);
        if($parent_email != "") {
            $sql = "UPDATE guardians SET email_address='$parent_email', first_name='$parent_first_name', last_name='$parent_last_name', phone_number='$parent_number' WHERE student_id='$student_id'";
            mysqli_query($db_students, $sql);
        }
        $message = "You have successfully saved your details.";
        
        // Change the password if required.
        if ($new_password_flag == TRUE) {
            $sql = "UPDATE students SET password='$password' WHERE student_id='$student_id'";
            if(mysqli_query($db_students, $sql))
            {
                $message = "You have successfully saved your details, and have changed your password.";
            }
        }
    }