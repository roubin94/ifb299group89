<?php
	session_start();
	include('db_students_connect.php');
	
	// Ensure variables are mySQL friendly.
	$email = mysqli_real_escape_string($db_students, $email);
	$password = mysqli_real_escape_string($db_students, $password);
	$password = password_hash($password, PASSWORD_DEFAULT);
	$first_name = mysqli_real_escape_string($db_students, $first_name);
	$last_name = mysqli_real_escape_string($db_students, $last_name);
        $mysql_date = date("Y-m-d H:i:s", $date);
        if($_SESSION['under18'] == 0){
            $parent_email = mysqli_real_escape_string($db_students, $parent_email);
            $parent_first_name = mysqli_real_escape_string($db_students, $parent_first_name);
            $parent_last_name = mysqli_real_escape_string($db_students, $parent_last_name);
            $parent_number = mysqli_real_escape_string($db_students, $parent_number);
        }
	// Find rows that match the entered e-mail adress.
	$sql = "SELECT * FROM students WHERE email_address = '$email'";
	$result = mysqli_query($db_students, $sql);
	$count = mysqli_num_rows($result);
	
	// Provide error message if account with that e-mail already exists.
	if ($count == 1)
	{
		$emailErr = "Sorry. This email already has an account associated with it.";
	}
	// Add the new user to the database if the e-mail is available.
	else
	{
		$query = mysqli_query($db_students, "INSERT INTO students (email_address, password, first_name, last_name, date_of_birth, active) VALUES ('$email', '$password', '$first_name', '$last_name', '$mysql_date', TRUE)");
                if($_SESSION['under18'] == 0){
                    $sql = "SELECT * FROM students WHERE email_address = '$email'";
                    $result = mysqli_query($db_students, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $student_id = $row['student_id'];
                    $query = mysqli_query($db_students, "INSERT INTO guardians (id, first_name, last_name, email_address, phone_number) VALUES ('$student_id', '$parent_first_name', '$parent_last_name', '$parent_email', '$parent_number')");
                }
		if($query)
		{
			$message = "You have successfully signed up.";
		}
	}
?>