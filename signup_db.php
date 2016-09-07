<?php
	session_start();
	include('db_users_connect.php');
	 
	$email = mysqli_real_escape_string($db, $email);
	$password = mysqli_real_escape_string($db, $password);
	$password = password_hash($password, PASSWORD_DEFAULT);
	$first_name = mysqli_real_escape_string($db, $first_name);
	$last_name = mysqli_real_escape_string($db, $last_name);

	$sql_emailcheck = "SELECT email_address FROM students WHERE email_address = '$email'";
	$result = mysqli_query($db, $sql_emailcheck);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	 
	if (mysqli_num_rows($result) == 1)
	{
		$emailErr = "Sorry. This email already has an account associated with it.";
	}
	else
	{
		$query = mysqli_query($db, "INSERT INTO students (email_address, password, first_name, last_name, active) VALUES ('$email', '$password', '$first_name', '$last_name', TRUE)");
		if($query)
		{
			echo "You have successfully signed up.";
		}
	}
?>