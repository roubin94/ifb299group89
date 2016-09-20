<?php
    session_start();
    
    // Log the user out
    unset($_SESSION['student_id']);

    // Re-direct to home page
    header("location: index.php");