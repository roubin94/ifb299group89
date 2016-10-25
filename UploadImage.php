<?php
    session_start();
    
    // Page Title
    $title = "PMA - Upload New Instrument Image";

    $message = "";

    //Check if filetype is a valid format
    if (isset($_POST["submit"])) {
        $fileType = $_FILES["file"]["type"];

        if (($fileType == "image/gif") ||
                ($fileType == "image/jpeg") ||
                ($fileType == "image/jpg") ||
                ($fileType == "image/png")) {
            //Check if file exists
            if (file_exists("Images/instruments/" . $_FILES["file"]["name"])) {
                $message = "  An image with that name already exists.";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], "Images/instruments/" . $_FILES["file"]["name"]);
                $message = "  You have successfully uploaded your image.";
            }
        }
        
        else {
            $message = "  Invalid image format. Please use .gif, .jpeg, .jpg or .png.";
        }
    }

    // Content
    if(!isset($_SESSION['staff_id'])) {
        $content = 'You are not logged in as a staff member.';
    }
    else {
        $content = '<header>Upload an Instrument Image</header><br />
            <form action="" method="post" enctype="multipart/form-data">
        <label for="file">Filename: </label>
        <input type="file" name="file" id="file"><br/><br />
        <input type="submit" name="submit" value="Upload">' . $message . '
        </form>';
    }

    include "header.php";
    echo $content;
    include "footer.php";
?>