<?php
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'music');
    define('DB_DATABASE', 'users');

    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }