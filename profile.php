<?php
    session_start();
    
    // Page Title
    $title = "Pinelands Music Academy - Profile";

    $student_id = $email_address = $first_name = $last_name = "";
    $emailErr = $passwordErr = $first_nameErr = $last_nameErr = $message = "";

    if (isset($_SESSION['student_id'])) {
        include "db_students_connect.php";
        include "profile_get.php";
    }
    else {
        $message = "You are not logged in.";
    }


    // Content
    include "header.php";
    ?>

    <html>
        <?php echo $message ?><br />
        Student ID: <?php echo $student_id; ?><br />
        E-mail Address: <?php echo $email_address; ?><br />
        First Name: <?php echo $first_name; ?><br />
        Last Name: <?php echo $last_name; ?><br />
        <br />
        <a href="profile_update.php">Update your profile.</a>
    </html>

    <?php
    include 'footer.php';