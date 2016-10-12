<?php

    // Create a connection to a database.
    function db_connect($db_host, $db_user, $db_password, $db_database) {
        $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_database);

        if (!$db_connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        return $db_connection;
    }