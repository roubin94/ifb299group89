<?php
    session_start();
    
    // Page Title
    $title = "PMA - View Bookings";

    // Content
    include "header.php";
    
    // Check if user is logged in as a student.
    if (!isset($_SESSION['student_id'])) {
        echo "You are not logged in as a student.";
    }
    
    else {
        // Connect to the bookings database.
        include "db_credentials.php";
        include "db_connect.php";
        $db_bookings = db_connect($db_host, $db_user, $db_password, 'bookings');
        
        // Get the bookings fot that student, and then display it in a table.
        $logged_in_student_id = $_SESSION['student_id'];
        $sql = "SELECT * FROM bookings WHERE student_id = '$logged_in_student_id'";
        $result = mysqli_query($db_bookings, $sql);
        ?>
        
        <header>List of Booked Lessons</header>
        <table class='overViewTable'>
                <tr>
                    <td><b>Date</b></td>
                    <td><b>Time</b></td>
                    <td><b>Teacher ID</b></td>
                </tr>
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['date']."</td>";
                echo "<td>".$row['start']."</td>";
                echo "<td>".$row['teacher_id']."</td>";
                echo "</tr>";
            }
        ?>
        </table>
        <a href="profile.php">Back</a>

<?php    
        include 'footer.php';
    }