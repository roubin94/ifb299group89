<?php

    // Validate the input of the drop down menus.
    
    // Check if day of the month has been selected.
    if (empty($_POST["day"])) {
        $dayErr = "Please select a day of the month.";
        $err_flag = TRUE;
    }
    
    // Check if month has been selected.
    if (empty($_POST["month"])) {
        $monthErr = "Please select a month.";
        $err_flag = TRUE;
    }
    
    // Check if year has been selected.
    if (empty($_POST["year"])) {
        $yearErr = "Please select a year.";
        $err_flag = TRUE;
    }
    
    // If no errors up until this point, check if it's a valid date.
    if ($err_flag == FALSE) {
        $day = $_POST["day"];
        $month = $_POST["month"];
        $year = $_POST["year"];
        if (!checkdate($month, $day, $year))
        {
            $err_flag = TRUE;
            $message = "You did not select a valid date.";
        }
    }