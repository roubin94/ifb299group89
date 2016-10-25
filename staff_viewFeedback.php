<?php
    session_start();
    
    // Page Title
    $title = "PMA - View Feedback";

    // Content
    include "header.php";
    
    if (!isset($_SESSION['staff_id'])) {
        echo "You are not logged in as a staff member.";
    }
    else {
        include "db_credentials.php";
        include "db_connect.php";
        
        $db_feedback = db_connect($db_host, $db_user, $db_password, 'feedback');
        $sql = "SELECT * FROM staff_feedback";
        $result = mysqli_query($db_feedback, $sql);
        ?>
        
        <header>Feedback Provided by Students</header>
        <table class='overviewTable'>
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
        <p><a href="Management.php">Back</a><p/>

<?php    
        include 'footer.php';
    }