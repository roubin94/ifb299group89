<?php
    session_start();
    
    // Page Title
    $title = "PMA - View Feedback";

    // Content
    include "header.php";
    
    // Check if user is logged in as a teacher.
    if (!isset($_SESSION['teacher_id'])) {
        echo "You are not logged in as a teacher.";
    }
    
    else {
        // Connect to the feedback database.
        include "db_credentials.php";
        include "db_connect.php";
        $db_feedback = db_connect($db_host, $db_user, $db_password, 'feedback');
        
        // Get the feedback for that teacher, and then display it in a table.
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
        <p><a href="teacher_profile.php">Back</a><p/>

<?php    
        include 'footer.php';
    }