<?php
    include "db_credentials.php";
    include "db_connect.php";
    
    // Connect to the staff database.
    $db_staff = db_connect($db_host, $db_user, $db_password, 'staff');
    
    // Ensure inputted variables are mySQL friendly.
    $email = mysqli_real_escape_string($db_staff, $email);
    $password = mysqli_real_escape_string($db_staff, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $first_name = mysqli_real_escape_string($db_staff, $first_name);
    $last_name = mysqli_real_escape_string($db_staff, $last_name);
    $mysql_date = date('Y-m-d', strtotime($year . "-" . $month . "-" . $day));
    

    // Find rows that match the entered e-mail adress.
    $sql = "SELECT * FROM staff WHERE email_address = '$email'";
    $result = mysqli_query($db_staff, $sql);
    $count = mysqli_num_rows($result);

    // Provide error message if account with that e-mail already exists.
    if ($count == 1)
    {
        $emailErr = "Sorry. This email already has an account associated with it.";
    }
    
    // Add the new user to the database if the e-mail is available.
    else
    {
        $query = mysqli_query($db_staff, "INSERT INTO staff (email_address, password, first_name, last_name, date_of_birth, active) VALUES ('$email', '$password', '$first_name', '$last_name', '$mysql_date', TRUE)");

        if($query)
        {
            $message = "You have successfully created a staff profile.";
        }
        else
        {
            $message = "mySQL query error:" . mysqli_error($db_staff);
        }
    }