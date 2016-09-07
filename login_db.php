<?php
	session_start();
	include('db_users_connect.php');
	 
	$email = mysqli_real_escape_string($db, $email);
	$password = mysqli_real_escape_string($db, $password);

	// Get password hash for the provided email adress.
	$sql = "SELECT * FROM students WHERE email_address = '$email'";
	$result = mysqli_query($db, $sql);
	$row = mysqli_fetch_assoc($result);
	$password_hash = $row['password'];
	echo $password_hash;

	// Log the user in if right password, otherwise provide an error message.
	if (password_verify($password, $password_hash) == TRUE) {
		$student_id = $row['student_id'];
		$_SESSION['login_user'] = $student_id;
		echo "You have successfully logged in.";
	}
	else {
		$emailErr = "Either the e-mail address or the password is incorrect.";
	}
?>