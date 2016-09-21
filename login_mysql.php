<?php

    // Connect to the students database
    include "db_connect_students.php";

    // Ensure variables are mySQL friendly.
    $email = mysqli_real_escape_string($db_students, $email);
    $password = mysqli_real_escape_string($db_students, $password);

    // Find rows that match the entered e-mail adress.
    $sql = "SELECT * FROM students WHERE email_address = '$email'";
    $result = mysqli_query($db_students, $sql);
    $count = mysqli_num_rows($result);

    // Get password hash for the provided email adress, if it exists.
    if ($count == 1) {
        $row = mysqli_fetch_assoc($result);
        $password_hash = $row['password'];
        // Then check if the password is correct.
        if (password_verify($password, $password_hash) == TRUE) {
            $student_id = $row['student_id'];
            $_SESSION['student_id'] = $student_id;
            $message = "You have successfully logged in.";
        }
        // Provide error message if password is wrong.
        else {
            $message = "Wrong e-mail address or password.";
        }
    }
    // Provide error message if e-mail isn't valid.
    else {
        $message = "Wrong e-mail address or password.";
    }