<?php

// Make a MySQL Connection
$host="localhost";
$user="root";
$password="music";
$db = "bookings";

$link = mysqli_connect($host, $user, $password);
mysqli_select_db($link, $db) or die(mysql_error());

?>
