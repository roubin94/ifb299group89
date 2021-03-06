<?php
    session_start();
    
    // Page Title
    $title = "PMA - Profile";

    $parent_email = "";
    
    // If logged in, get the student's details from the database.
    if (isset($_SESSION['student_id'])) {
        include "profile_mysql.php";
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
        <header>My Profile</header>
        <p>
        <b>Name: </b><?php echo $first_name . ' ' . $last_name; ?><br />
        <b>Student ID: </b><?php echo $student_id; ?><br />
        <b>E-mail Address: </b><?php echo $email_address; ?><br />
        <b>Date of Birth: </b><?php echo $date_of_birth; ?><br />
        <br />
    <?php
    if ($parent_email != "") { ?>
        <header>Guardian Details</header><br />
        <b>Name: </b><?php echo $parent_first_name . ' ' . $parent_last_name; ?><br />
        <b>Guardian E-mail Address: </b><?php echo $parent_email; ?><br />   
        <b>Phone Number: </b><?php echo $parent_number; ?><br />
        <br />
    <?php } ?>
        <a href="profile_update.php">Update Your Details or Change Your Password</a><br />
        <a href="profile_viewbookings.php">View Your Lesson Bookings</a><br />
        <a href="feedback_type.php">Send Us Feedback</a>
        </p>
    </html>

    <?php
    }

    include 'footer.php';