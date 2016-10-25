<?php
    session_start();
    
    // Page Title
    $title = "PMA - Teacher List";

    // Content
    include "header.php";
    
    if (!isset($_SESSION['staff_id'])) {
        echo "You are not logged in as a staff member.";
    }
    else {
        include "db_credentials.php";
        include "db_connect.php";
        
        $db_teachers = db_connect($db_host, $db_user, $db_password, 'teachers');
        $sql = "SELECT * FROM teachers";
        $result = mysqli_query($db_teachers, $sql);
        ?>
        
        <header>List of Teachers</header>
        <table class='overViewTable'>
                <tr>
                    <td><b>Teacher ID</b></td>
                    <td><b>Name</b></td>
                    <td><b>Date of Birth</b></td>
                    <td><b>Email Address</b></td>
                </tr>
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['teacher_id']."</td>";
                echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
                echo "<td>".$row['date_of_birth']."</td>";
                echo "<td>".$row['email_address']."</td>";
                echo "</tr>";
            }
        ?>
        </table>
        <p><a href="Management.php">Back</a><p/>

<?php    
        include 'footer.php';
    }