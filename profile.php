<?php
    session_start();
    
    // Page Title
    $title = "Pinelands Music Academy - Profile";

    $parent_email = "";
    
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
        <header>Your Details</header><br />
        <b>Student ID: </b><?php echo $student_id; ?><br />
        <b>E-mail Address: </b><?php echo $email_address; ?><br />
        <b>First Name: </b><?php echo $first_name; ?><br />
        <b>Last Name: </b><?php echo $last_name; ?><br />
        <b>Date of Birth: </b><?php echo $date_of_birth; ?><br />
        <br />
    <?php
    if ($parent_email != "") { ?>
        <header>Guardian Details</header><br />
        <b>Guardian E-mail Address: </b><?php echo $parent_email; ?><br />
        <b>First Name: </b><?php echo $parent_first_name; ?><br />
        <b>Last Name: </b><?php echo $parent_last_name; ?><br />
        <b>Phone Number: </b><?php echo $parent_number; ?><br />
        <br />
    <?php } ?>
        <a href="profile_update.php">Update your details / Change password</a>
    </html>

    <?php
    }

    include 'footer.php';