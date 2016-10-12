<?php
    session_start();

    // Page Title
    $title = "Pinelands Music Academy - Management";
    
                
    // Content
    include "header.php";

    if (!isset($_SESSION['staff_id'])) {
        echo "You are not logged in as a staff member.";
    }
    else {
?>  

    <html>
        <header>Management</header>
        <p><a href="InstrumentAdd.php">Add New Instrument to Catalogue</a><p/>
        <p><a href="UploadImage.php">Upload an Image</a><p/>
        <p><a href="InstrumentOverview.php">Instrument Overview</a><p/>
        <p><a href="staff_addTeacher.php">Create a Teacher Profile</a><p/>
        <p><a href="staff_addStaff.php">Create a Staff Profile</a><p/>
    </html>
    
<?php
    include "footer.php";
    }
?>