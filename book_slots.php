<?php
session_start();
include('db_connect_bookings.php');

    // Page Title
    $title = "PMA - Successfully Booked";

include "header.php"; 

if(isset($_POST['slots_booked'])) $slots_booked = mysqli_real_escape_string($link, $_POST['slots_booked']);
if(isset($_POST['name'])) $name = mysqli_real_escape_string($link, $_POST['name']);
if(isset($_POST['email'])) $email = mysqli_real_escape_string($link, $_POST['email']);
if(isset($_POST['phone'])) $phone = mysqli_real_escape_string($link, $_POST['phone']);
if(isset($_POST['booking_date'])) $booking_date = mysqli_real_escape_string($link, $_POST['booking_date']);
if(isset($_POST['cost_per_slot'])) $cost_per_slot = mysqli_real_escape_string($link, $_POST['cost_per_slot']);
if(isset($_POST['student_id'])) $student_id = mysqli_real_escape_string($link, $_POST['student_id']);
if(isset($_POST['teacher_id'])) $teacher_id = mysqli_real_escape_string($link, $_POST['teacher_id']);



$explode = explode('|', $slots_booked);

foreach($explode as $slot) {

	if(strlen($slot) > 0) {

		$stmt = $link->prepare("INSERT INTO bookings (date, start, name, email, phone, teacher_id, student_id) VALUES (?, ?, ?, ?, ?, ?, ?)"); 
		$stmt->bind_param('sssssdd', $booking_date, $slot, $name, $email, $phone, $teacher_id, $student_id);
		$stmt->execute();
		
	} // Close if
	
} // Close foreach


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="\Styles\StyleSheet.css" rel="stylesheet" type="text/css">

<link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

</head>

<body>

<div class='success'>The booking has sucessfully been made into the database.</div>

<p style='font-family:courier; font-size:13px; margin-top:25px'>
The booking has been inserted into the database.<br>
The array above shows you details of the $_POST.<br>
</p>

<p style='font-family:courier; font-size:13px; margin-top:25px'>
WILL USE THIS PAGE TO
</p>

<ul style='font-family:courier; font-size:13px'>
	<li>Redirect the user to a payment gateway (Paypal)</li>
</ul>

</body>

</html>
<?php
include "footer.php";
?>
