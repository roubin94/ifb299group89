<?php
    session_start();

    // Page Title
    $title = "PMA - Home";

    // Content    
    include "header.php";
?>

    <header>Welcome to Pinelands Music Academy</header>
    
<?php if(!isset($_SESSION['student_id']) && !isset($_SESSION['teacher_id']) && !isset($_SESSION['staff_id'])) { ?>
    <br />
    <p>Want to book a lesson with one our teachers? Please log in.</p>
    <p>If you don't already have an account, please feel free to sign up.</p>
    <p>Looking to apply for a job as a teacher at the academy? Please go through <a href="hire.php">our online application process</a>.</p>
<?php
    }
    include "footer.php";