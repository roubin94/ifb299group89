<?php
    include "db_credentials.php";
    include "db_connect.php";
    
    // Connect to the teachers database.
    $db_teachers = db_connect($db_host, $db_user, $db_password, 'teachers');

    // Ensure variables are mySQL friendly.
    $teacher_id = mysqli_real_escape_string($db_teachers, $_SESSION['teacher_id']);
    $email = mysqli_real_escape_string($db_teachers, $email);
    $current_password = mysqli_real_escape_string($db_teachers, $current_password);
    $password = mysqli_real_escape_string($db_teachers, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $first_name = mysqli_real_escape_string($db_teachers, $first_name);
    $last_name = mysqli_real_escape_string($db_teachers, $last_name);

    // Check if inputted current password is correct.
    // Start by getting the password from the database.
    $sql = "SELECT * FROM teachers WHERE teacher_id = '$teacher_id'";
    $result = mysqli_query($db_teachers, $sql);
    $row = mysqli_fetch_assoc($result);
    $password_hash = $row['password'];
    // Then check if the password is correct.
    if (password_verify($current_password, $password_hash) == FALSE) {
        $current_passwordErr = "Your current password was incorrect.";
        $err_flag = TRUE;
    } 

    // Check if any other rows match the entered e-mail adress.
    // Start by getting any possible rows the e-mail address is being used by.
    $sql = "SELECT * FROM teachers WHERE email_address = '$email' AND teacher_id <> '$teacher_id'";
    $result = mysqli_query($db_teachers, $sql);
    $count = mysqli_num_rows($result);
    // Provide error message if an account with that e-mail already exists.
    if ($count >= 1)
    {
        $emailErr = "Sorry. This email already has an account associated with it.";
        $err_flag = TRUE;
    }

    // Having passed all checks, update the teacher's details in the database.
    if ($err_flag == FALSE)
    {
        $sql = "UPDATE teachers SET email_address='$email', first_name='$first_name', last_name='$last_name' WHERE teacher_id='$teacher_id'";
        mysqli_query($db_teachers, $sql);
        $message = "  You have successfully saved your details.";
        
        // Change the password if required.
        if ($new_password_flag == TRUE) {
            $sql = "UPDATE teachers SET password='$password' WHERE teacher_id='$teacher_id'";
            if(mysqli_query($db_teachers, $sql))
            {
                $message = "  You have successfully saved your details, and have changed your password.";
            }
            else {
                $message = "  mySQL query error:" . mysqli_error($db_teachers);
            }
        }
    }