<?php
    session_start();
    
    // Page Title
    $title = "PMA - Staff List";

    // Content
    include "header.php";
    
    // Check if user is logged in as a staff member.
    if (!isset($_SESSION['staff_id'])) {
        echo "You are not logged in as a staff member.";
    }
    
    else {
        // Connect to the staff database.
        include "db_credentials.php";
        include "db_connect.php";        
        $db_staff = db_connect($db_host, $db_user, $db_password, 'staff');
        
        // Get a list of staff members, and display it in a table.
        $sql = "SELECT * FROM staff";
        $result = mysqli_query($db_staff, $sql);
        ?>
        
        <header>List of Staff Members</header>
        <table class='overViewTable'>
                <tr>
                    <td><b>Staff ID</b></td>
                    <td><b>Name</b></td>
                    <td><b>Date of Birth</b></td>
                    <td><b>Email Address</b></td>
                </tr>
        <?php
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['staff_id']."</td>";
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