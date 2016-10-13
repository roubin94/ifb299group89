<?php
    include "db_credentials.php";
    include "db_connect.php";
    
    // Connect to the students database.
    $db_students = db_connect($db_host, $db_user, $db_password, 'students');
    
    // Ensure inputted variables are mySQL friendly.
    $email = mysqli_real_escape_string($db_students, $email);
    $password = mysqli_real_escape_string($db_students, $password);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $first_name = mysqli_real_escape_string($db_students, $first_name);
    $last_name = mysqli_real_escape_string($db_students, $last_name);
    $mysql_date = date('Y-m-d', strtotime($_SESSION['date_of_birth']));
    
    // If student is under 18, ensure parental guardian variables are mySQL friendly.
    if($_SESSION['over18'] == FALSE){
        $parent_email = mysqli_real_escape_string($db_students, $parent_email);
        $parent_first_name = mysqli_real_escape_string($db_students, $parent_first_name);
        $parent_last_name = mysqli_real_escape_string($db_students, $parent_last_name);
        $parent_number = mysqli_real_escape_string($db_students, $parent_number);
    }
 

    // Find rows that match the entered e-mail adress.
    $sql = "SELECT * FROM students WHERE email_address = '$email'";
    $result = mysqli_query($db_students, $sql);
    $count = mysqli_num_rows($result);

    // Provide error message if account with that e-mail already exists.
    if ($count == 1)
    {
        $emailErr = "Sorry. This email already has an account associated with it.";
    }
    
    // Add the new user to the database if the e-mail is available.
    else
    {
        $query = mysqli_query($db_students, "INSERT INTO students (email_address, password, first_name, last_name, date_of_birth, active) VALUES ('$email', '$password', '$first_name', '$last_name', '$mysql_date', TRUE)");
        
        // Add parental guardian details if new student is under 18.
        if($_SESSION['over18'] == FALSE){
            $sql = "SELECT * FROM students WHERE email_address = '$email'";
            $result = mysqli_query($db_students, $sql);
            $row = mysqli_fetch_assoc($result);
            $student_id = $row['student_id'];
            $query = mysqli_query($db_students, "INSERT INTO guardians (student_id, first_name, last_name, email_address, phone_number) VALUES ('$student_id', '$parent_first_name', '$parent_last_name', '$parent_email', '$parent_number')");
        }

        if($query)
        {
            $message = "You have successfully signed up.";
        }
        else
        {
            $message = "mySQL query error:" . mysqli_error($db_students);
        }
    }
?>