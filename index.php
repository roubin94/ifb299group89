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
    <p>If you would like to book a lesson with one our teachers, please log in.</p>
    <p>If you don't already have an account, please feel free to sign up.</p>
    <p>If you are looking to apply for a job as a teacher at the academy, please send us your resume online.</p>
<?php
    }
    include "footer.php";