<?php
session_start();
$title = "Upload new image";

$content = '<form action="" method="post" enctype="multipart/form-data">
    <label for="file">Filename: </label>
    <input type="file" name="file" id="file"><br/>
    <input type="submit" name="submit" value="submit">
</form>';

//Check if filetype is a valid format
if (isset($_POST["submit"])) {
    $fileType = $_FILES["file"]["type"];

    if (($fileType == "image/gif") ||
            ($fileType == "image/jpeg") ||
            ($fileType == "image/jpg") ||
            ($fileType == "image/png")) {
        //Check if file exists
        if (file_exists("Images/instruments/" . $_FILES["file"]["name"])) {
            echo "File already exists";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], "Images/instruments/" . $_FILES["file"]["name"]);
            echo "Uploaded in " . "Images/Instruments/" . $_FILES["file"]["name"];
        }
    }
}

// Content
    include "header.php";
    echo $content;
    include "footer.php";
?>

