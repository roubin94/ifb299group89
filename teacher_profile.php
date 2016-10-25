<?php
    session_start();
    
    // Page Title
    $title = "PMA - Profile";
    
    // If logged in, get the teachers's details from the database.
    if (isset($_SESSION['teacher_id'])) {
        include "teacher_profile_mysql.php";
    }


    // Content
    include "header.php";
    ?>
    <?php 
        if (!isset($_SESSION['teacher_id'])) {
            echo "You are not logged in.";
        }
        else {?>   
    
    <html>
        <header>Your Details</header><br />
        <b>Teacher ID: </b><?php echo $teacher_id; ?><br />
        <b>E-mail Address: </b><?php echo $email_address; ?><br />
        <b>First Name: </b><?php echo $first_name; ?><br />
        <b>Last Name: </b><?php echo $last_name; ?><br />
        <b>Date of Birth: </b><?php echo $date_of_birth; ?><br />
        <br />

        <a href="teacher_profile_update.php">Update Your Details or Change Your Password</a>
    </html>

    <?php
    }

    include 'footer.php';