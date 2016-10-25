<?php
    session_start();
    
    // Page Title
    $title = "PMA - View Feedback";

    // Content
    include "header.php";
    
    if (!isset($_SESSION['teacher_id'])) {
        echo "You are not logged in as a teacher.";
    }
    else {
        include "db_credentials.php";
        include "db_connect.php";
        
        $db_feedback = db_connect($db_host, $db_user, $db_password, 'feedback');
        $logged_in_teacher_id = $_SESSION['teacher_id'];
        $sql = "SELECT * FROM feedback WHERE teacher_id = '$logged_in_teacher_id'";
        $result = mysqli_query($db_feedback, $sql);
        ?>
        
        <header>Feedback Provided by Students</header>
        <table class='overViewTable'>
                <tr>
                    <td><b>Student ID</b></td>
                    <td><b>Feedback</b></td>
                </tr>
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['student_id']."</td>";
                echo "<td>".$row['feedback']."</td>";
                echo "</tr>";
            }
        ?>
        </table>      

<?php    
        include 'footer.php';
    }