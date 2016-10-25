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
        <header>Website Management</header>
        <p><b>Instrument Catalogue</b></p>
        <p><a href="InstrumentAdd.php">Add New Instrument to the Instrument Catalogue</a><p/>
        <p><a href="InstrumentOverview.php">Update Instrument Catalogue</a><p/>
        <p><a href="UploadImage.php">Upload an Instrument Image</a><p/>
        <br />
        <p><b>Teacher Profiles</b></p>
        <p><a href="staff_teacherlist.php">View List of Teachers</a><p/>
        <p><a href="staff_addTeacher.php">Create a Teacher Profile</a><p/>
        <br />
        <p><b>Staff Profiles</b></p>
        <p><a href="staff_stafflist.php">View List of Staff</a><p/>
        <p><a href="staff_addStaff.php">Create a Staff Profile</a><p/>
        <br />
        <p><b>Feedback</b></p>
        <p><a href="staff_viewFeedback.php">View Student Feedback</a><p/>        
    </html>
    
<?php
    include "footer.php";
    }
?>