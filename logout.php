<?php
    session_start();
    
    // Log the user out
    unset($_SESSION['student_id']);
    unset($_SESSION['teacher_id']);
    unset($_SESSION['staff_id']);

    // Re-direct to home page
    header("location: index.php");