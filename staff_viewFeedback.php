<?php
    session_start();
    
    // Page Title
    $title = "PMA - View Feedback";

    // Content
    include "header.php";
    
    // Check if user is logged in as a staff member.
    if (!isset($_SESSION['staff_id'])) {
        echo "You are not logged in as a staff member.";
    }
    
    else {
        // Connect to the feedback database.
        include "db_credentials.php";
        include "db_connect.php";        
        $db_feedback = db_connect($db_host, $db_user, $db_password, 'feedback');
        
        // Get the feedback for the staff, and then display it in a table.
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