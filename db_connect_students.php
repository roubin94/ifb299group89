<?php
    // Connect to the students database
    $db_students = mysqli_connect('localhost', 'root', 'music', 'students');

    if (!$db_students) {
        die("Connection failed: " . mysqli_connect_error());
    }