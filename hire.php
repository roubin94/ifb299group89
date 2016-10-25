<?php
session_start();
$title = "Job Applications";
require './Entities/hireEntity.php';
     

$content2 = '<form action="" method="post" enctype="multipart/form-data">
    <header>Apply to Become a Pinelands Music Academy Teacher</header>
    <p>Firstly, please upload your Resume. Name your resume as your first name and last name.<br />
    For example, if your name is Sam Wood, you must name your resume file <b>SamWood</b>.</p>
    <label for="file">Resume: </label>
    <input type="file" name="file" id="file"><br /><br />
    <input type="submit" name="submit" value="Submit">
</form>';

   if (isset($_POST['submit'])) {
    $fileType = $_FILES["file"]["type"];

    if (($fileType == "application/doc") ||
            ($fileType == "application/docx") ||
            ($fileType == "application/pdf")) {
        //Check if file exists
        if (file_exists("resume/" . $_FILES["file"]["name"])) {
            echo "File already exists";
        } else {
            move_uploaded_file($_FILES["file"]["tmp_name"], "resume/" . $_FILES["file"]["name"]);
            echo "Uploaded in " . "resume/" . $_FILES["file"]["name"];
            $content ="<form action='' method='post'>
    
            <legend>Job Application</legend>
            <label for='firstname'>First Name: </label>
            <input type='text' class='inputField' name='firstname' /><br/></br>

            <label for='lastname'>Last Name: </label>
            <input type='text' class='inputField' name='lastname' /><br/></br>

            <label for='address1'>Street Address 1: </label>
            <input type='text' class='inputField' name='address1' /><br/></br>

            <label for='address2'>Street Address 2: </label>
            <input type='text' class='inputField' name='address2' /><br/></br>

            <label for='state'>State: </label>
            <input type='text' class='inputField' name='state' /><br/></br>

            <label for='postcode'>Postcode: </label>
            <input type='text' class='inputField' name='postcode' /><br/></br>

            <label for='phonenumber'>Phone number: </label>
            <input type='text' class='inputField' name='phonenumber' /><br/></br>

            <label for='email'>Email: </label>
            <input type='text' class='inputField' name='email' /><br/></br>

            <label for='citizen'>Are you an Australian citizen?: </label>
            <select class='inputField' name='citizen'>
                <option value=''>Select...</option>
                <option value='yes'>yes</option>
                <option value='no'>no</option>
            </select></br></br></br>

            <strong>In 100words or less tell us why you are suitable for this position: </br></br>
            <textarea cols='200'rows='15' name='application'></textarea></br></br>

            <input type='submit' value='Submit'>
        </fieldset>
        </form>"; 
        }
    }
}
  
    if(isset($_POST["firstname"]))
    {
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $address1 = $_POST["address1"];
        $address2 = $_POST["address2"];
        $state = $_POST["state"];
        $postcode = $_POST["postcode"];
        $phonenumber = $_POST["phonenumber"];
        $email = $_POST["email"];
        $citizen = $_POST["citizen"];
        $application = $_POST["application"];

        $applications = new hireEntity(-1, $firstname, $lastname, $address1, $address2, $state, $postcode, $phonenumber, $email, $citizen, $application);
        
        require './Model/Credentials.php';

        //Open connection and Select database.     
        $link = mysqli_connect($host, $user, $passwd) or die(mysql_error);
        $query = sprintf("INSERT INTO applications
                          (firstname,lastname,address1,address2,state,postcode,phonenumber,email,citizen,application)
                          VALUES
                          ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
                mysqli_real_escape_string($link,$applications->firstname),
                mysqli_real_escape_string($link,$applications->lastname),
                mysqli_real_escape_string($link,$applications->address1),
                mysqli_real_escape_string($link,$applications->address2),
                mysqli_real_escape_string($link,$applications->state),
                mysqli_real_escape_string($link,$applications->postcode),
                mysqli_real_escape_string($link,$applications->phonenumber),
                mysqli_real_escape_string($link,$applications->email),
                mysqli_real_escape_string($link,$applications->citizen),
                mysqli_real_escape_string($link,$applications->application));
        mysqli_select_db($link, "applications");
        
        //Execute query and close connection
        mysqli_query($link, $query) or die(mysql_error());
        mysqli_close($link);
        header("Refresh:0");
    }
    
    // Content
    include "header.php";
    echo $content2;
    if (isset($content))
    {
        echo $content;
    }
    include "footer.php";