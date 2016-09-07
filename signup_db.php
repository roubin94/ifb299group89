<?php
	session_start();
	include('db_users_connect.php');
	
	// Ensure variables are mySQL friendly.
	$email = mysqli_real_escape_string($db, $email);
	$password = mysqli_real_escape_string($db, $password);
	$password = password_hash($password, PASSWORD_DEFAULT);
	$first_name = mysqli_real_escape_string($db, $first_name);
	$last_name = mysqli_real_escape_string($db, $last_name);

	// Find rows that match the entered e-mail adress.
	$sql = "SELECT * FROM students WHERE email_address = '$email'";
	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);
	
	// Provide error message if account with that e-mail already exists.
	if ($count == 1)
	{
		$emailErr = "Sorry. This email already has an account associated with it.";
	}
	// Add the new user to the database if the e-mail is available.
	else
	{
		$query = mysqli_query($db, "INSERT INTO students (email_address, password, first_name, last_name, active) VALUES ('$email', '$password', '$first_name', '$last_name', TRUE)");
		if($query)
		{
			echo "You have successfully signed up.";
		}
	}
?>