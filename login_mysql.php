<?php
    include "db_credentials.php";
    include "db_connect.php";
    
    // Connect to the databases.
    $db_students = db_connect($db_host, $db_user, $db_password, 'students');
    $db_teachers = db_connect($db_host, $db_user, $db_password, 'teachers');
    $db_staff = db_connect($db_host, $db_user, $db_password, 'staff');
    
    // Ensure the variables are mySQL friendly.
    $email = mysqli_real_escape_string($db_students, $email);
    $password = mysqli_real_escape_string($db_students, $password);
    
    // Check each user database for the login details.
    if ($user_details = login($db_students, 'students', $email, $password)) {
        $_SESSION['student_id'] = $user_details['student_id'];
        $message = "You have successfully logged in.";
    }
    else if ($user_details = login($db_teachers, 'teachers', $email, $password)) {
        $_SESSION['teacher_id'] = $user_details['teacher_id'];
        $message = "You have successfully logged in.";
    }
    else if ($user_details = login($db_staff, 'staff', $email, $password)) {
        $_SESSION['staff_id'] = $user_details['staff_id'];
        $message = "You have successfully logged in.";
    }
    else {
        $message = "Wrong e-mail address or password.";
    }
        
    
    // Functions
 
    // Checks a specific table of a database to see if a matching email and password exists.
    function login($db_connection, $table_name, $email, $password) {
        $verified_details = FALSE;
        $table_name = mysqli_real_escape_string($db_connection, $table_name);
        
        $sql = "SELECT * FROM $table_name WHERE email_address = '$email'";    
        if (!$result = mysqli_query($db_connection, $sql)) {
            die("MySQL query error: " . mysqli_error($db_connection));
        }
        $num_matches = mysqli_num_rows($result);
        
        if ($num_matches == 1) {
            $user_details = mysqli_fetch_assoc($result);
            $password_hash = $user_details['password'];
            // Check if the password is correct.
            if (password_verify($password, $password_hash) == TRUE) {
                $verified_details = $user_details;
            }
        }  
        return $verified_details;
    }