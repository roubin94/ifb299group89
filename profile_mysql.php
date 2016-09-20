<?php

    // Connect to the students database
    include "db_connect_students.php";
    
    // Get the row for the user.
    $student_id = mysqli_real_escape_string($db_students, $_SESSION['student_id']);
    
    $sql = "SELECT * FROM students WHERE student_id = '$student_id'";
    $result = mysqli_query($db_students, $sql);
    $row = mysqli_fetch_assoc($result);

    $student_id = $row['student_id'];
    $email_address = $row['email_address'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
