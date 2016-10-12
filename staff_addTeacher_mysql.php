<?php
    include "db_credentials.php";
    include "db_connect.php";
    
    // Connect to the teachers database.
    $db_teachers = db_connect($db_host, $db_user, $db_password, 'teachers');
    
    // Ensure inputted variables are mySQL friendly.
    $email = mysqli_real_escape_string($db_teachers, $email);
    $password = mysqli_real_escape_string($db_teachers, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $first_name = mysqli_real_escape_string($db_teachers, $first_name);
    $last_name = mysqli_real_escape_string($db_teachers, $last_name);
    $mysql_date = date('Y-m-d', strtotime($year . "-" . $month . "-" . $day));
    

    // Find rows that match the entered e-mail adress.
    $sql = "SELECT * FROM teachers WHERE email_address = '$email'";
    $result = mysqli_query($db_teachers, $sql);
    $count = mysqli_num_rows($result);

    // Provide error message if account with that e-mail already exists.
    if ($count == 1)
    {
        $emailErr = "Sorry. This email already has an account associated with it.";
    }
    
    // Add the new user to the database if the e-mail is available.
    else
    {
        $query = mysqli_query($db_teachers, "INSERT INTO teachers (email_address, password, first_name, last_name, date_of_birth, active) VALUES ('$email', '$password', '$first_name', '$last_name', '$mysql_date', TRUE)");

        if($query)
        {
            $message = "You have successfully created a teacher profile.";
        }
        else
        {
            $message = "mySQL query error:" . mysqli_error($db_teachers);
        }
    }