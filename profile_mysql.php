<?php
    include "db_credentials.php";
    include "db_connect.php";
    
    // Connect to the students database.
    $db_students = db_connect($db_host, $db_user, $db_password, 'students');
    
    // Get the row for the user.
    $student_id = mysqli_real_escape_string($db_students, $_SESSION['student_id']);
    
    $sql = "SELECT * FROM students WHERE student_id = '$student_id'";
    $result = mysqli_query($db_students, $sql);
    $row = mysqli_fetch_assoc($result);

    $student_id = $row['student_id'];
    $email_address = $row['email_address'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $date_of_birth = $row['date_of_birth'];
    
    // Check for parental guardian information
    $sql = "SELECT * FROM guardians WHERE student_id = '$student_id'";
    $result = mysqli_query($db_students, $sql);
    $count = mysqli_num_rows($result);
    
    if ($count == 1) {
        $row = mysqli_fetch_assoc($result);
        
        $parent_email = $row['email_address'];
        $parent_first_name = $row['first_name'];
        $parent_last_name = $row['last_name'];
        $parent_number = $row['phone_number'];
    }