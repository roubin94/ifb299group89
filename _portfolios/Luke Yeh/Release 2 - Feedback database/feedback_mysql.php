<?php
    include "db_credentials.php";
    include "db_connect.php";
    
    // Connect to the databases.
    $db_teachers = db_connect($db_host, $db_user, $db_password, 'teachers');
    $db_feedback = db_connect($db_host, $db_user, $db_password, 'feedback');
    
    $feedback = mysqli_real_escape_string($db_feedback, $_POST["feedback"]);
        
    $student_id = $_SESSION['student_id'];

    if($_SESSION['teacher_fb'] == '1'){
        // Ensure variables are mySQL friendly.
        $email = mysqli_real_escape_string($db_feedback, $_POST["email"]);
        
         // Find rows that match the entered e-mail adress.
        $sql = "SELECT * FROM teachers WHERE email_address = '$email'";
        $result = mysqli_query($db_teachers, $sql);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_assoc($result);
        $teacher_id = $row["teacher_id"];
        
        if($count ==  1){
            $query = mysqli_query($db_feedback, "INSERT INTO `feedback` (`teacher_id`, `feedback`, `student_id`) VALUES ('$teacher_id', '$feedback', $student_id)");
            if($query)
            {
                $message = "  Feedback successfully submitted.";
            }
            else
            {
                $message = "  mySQL query error:" . mysqli_error($db_feedback);
            }
        }
        else
        {
            $emailErr = "  Wrong e-mail address";
        }
    }
    
    else if($_SESSION['teacher_fb'] == '0'){
        $query = mysqli_query($db_feedback, "INSERT INTO `staff_feedback` (`feedback`, `student_id`) VALUES ('$feedback', $student_id)");

        if($query)
        {
            $message = "  Feedback successfully submitted.";
        }
        else
        {
            $message = "  mySQL query error:" . mysqli_error($db_feedback);
        }
    }    