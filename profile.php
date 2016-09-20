<?php
    session_start();
    
    // Page Title
    $title = "Pinelands Music Academy - Profile";

    $student_id = $email_address = $first_name = $last_name = "";
    $emailErr = $passwordErr = $first_nameErr = $last_nameErr = $message = "";
    
    // If logged in, get the student's details from the database.
    if (isset($_SESSION['student_id'])) {
        include "profile_mysql.php";
    }
    else {
        $message = "You are not logged in.";
    }


    // Content
    include "header.php";
    ?>
    <?php 
        if (!isset($_SESSION['student_id'])) {
            echo "You are not logged in.";
        }
        else {?>   
    
    <html>
        <b>Your Details</b><br />
        Student ID: <?php echo $student_id; ?><br />
        E-mail Address: <?php echo $email_address; ?><br />
        First Name: <?php echo $first_name; ?><br />
        Last Name: <?php echo $last_name; ?><br />
        <br />
        <a href="profile_update.php">Update your details / Change password</a>
    </html>

    <?php  
        }

        include 'footer.php';