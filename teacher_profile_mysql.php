<?php
    include "db_credentials.php";
    include "db_connect.php";
    
    // Connect to the teachers database.
    $db_teachers = db_connect($db_host, $db_user, $db_password, 'teachers');
    
    // Get the row for the user.
    $teacher_id = mysqli_real_escape_string($db_teachers, $_SESSION['teacher_id']);
    
    $sql = "SELECT * FROM teachers WHERE teacher_id = '$teacher_id'";
    $result = mysqli_query($db_teachers, $sql);
    $row = mysqli_fetch_assoc($result);

    $teacher_id = $row['teacher_id'];
    $email_address = $row['email_address'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $date_of_birth = $row['date_of_birth'];