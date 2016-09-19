<?php
    
    session_start();
    
    // Page Title
    $title = "Pinelands Music Academy - Add Instrument";


    // Check if the student is logged in, and get their information for the form if they are.
    if (isset($_SESSION['student_id'])) {
        include "db_students_connect.php";
        include "profile_get.php";
        include "profile_update_form_validate.php";
    }
    else {
        $message = "You are not logged in.";
    }
