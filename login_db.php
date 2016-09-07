<?php
	session_start();
	include('db_users_connect.php');
	 
	$email = mysqli_real_escape_string($db, $email);
	$password = mysqli_real_escape_string($db, $password);
	$password = password_hash($password, PASSWORD_DEFAULT);

	// Get password hash for the provided email adress.
	$sql = "SELECT password FROM students WHERE email_address = '$email'";
	$password_hash = mysqli_query($db, $sql);

	// Log the user in if right password, otherwise provide an error message.
	if (password_verify($password, $password_hash) == TRUE) {
		$sql = "SELECT student_id FROM students WHERE email_address = '$email'";
		$student_id = mysqli_query($db, $sql);
		$_SESSION['login_user'] = $student_id;
		echo "You have successfully logged in.";
	}
	else {
		$emailErr = "Either the e-mail address or the password is incorrect.";
	}
?>