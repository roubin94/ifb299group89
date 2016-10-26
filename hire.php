<?php
    session_start();

    // Page Title
    $title = "PMA - Job Application";

    $message = "";

    require './Entities/hireEntity.php';   

    if (isset($_POST['submit'])) {
        $fileType = $_FILES["file"]["type"];

        if (($fileType == "application/msword") ||
                ($fileType == "application/vnd.openxmlformats-officedocument.wordprocessingml.document") ||
                ($fileType == "application/pdf")) {
            //Check if file exists
            if (file_exists("resume/" . $_FILES["file"]["name"])) {
                $message = "  A resume with that name already exists in our database.";
            } else {
                move_uploaded_file($_FILES["file"]["tmp_name"], "resume/" . $_FILES["file"]["name"]);
                $content ="<fieldset>
                <legend>Apply to Become a Pinelands Music Academy Teacher</legend>

                <p>You have successfully uploaded your resume. Next, please provide us with your details.</p>
                    
                <form action='' method='post'>

                <p>First Name<br />
                <input type='text' class='inputField' name='firstname' /></p>

                <p>Last Name<br />
                <input type='text' class='inputField' name='lastname' /></p>

                <p>Street Address 1<br />
                <input type='text' class='inputField' name='address1' /></p>

                <p>Street Address 2<br />
                <input type='text' class='inputField' name='address2' /></p>

                <p>State<br />
                <input type='text' class='inputField' name='state' /></p>

                <p>Postcode<br />
                <input type='text' class='inputField' name='postcode' /></p>

                <p>Phone Number<br />
                <input type='text' class='inputField' name='phonenumber' /></p>

                <p>E-mail Address<br />
                <input type='text' class='inputField' name='email' /></p>

                <p>Are you an Australian citizen?<br />
                <select class='inputField' name='citizen'>
                    <option value=''>Select...</option>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select></p>

                <p>In 100 words or less tell us why you are suitable for this position.</p>
                <textarea cols='200'rows='15' name='application'></textarea><br />

                <input type='submit' value='Apply'> . $message .
            </fieldset>
            </form>"; 
            }
        }
        
        else {
            $message = "  Invalid resume format. Please use .pdf, .doc or .docx.";
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
        $message = "  You have successfully submitted your application to become a teacher.";
    }

    
    // Content
    $content2 = '<fieldset>  
        <legend>Apply to Become a Pinelands Music Academy Teacher</legend>
        <form action="" method="post" enctype="multipart/form-data">   
        <p>Firstly, please upload your resume. Name your resume as your first name and last name.<br />
        For example, if your name is Sam Wood, you must name your resume file <b>SamWood</b>.</p>
        <label for="file">Resume: </label>
        <input type="file" name="file" id="file"><br /><br />
        <input type="submit" name="submit" value="Next">' . $message . '
        </form>
        </fieldset>';
    
    include "header.php";
    
    if (isset($content))
    {
        echo $content;
    }
    else {
        echo $content2;
    }
    include "footer.php";