<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="Styles/StyleSheet.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="banner">             
        </div>
            
<?php
    if (isset($_SESSION['student_id'])) { ?>
        <nav id="navigation">
            <ul id="nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="teachers.php">Teachers</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
<?php
    }
    else { ?>
        <nav id="navigation">
            <ul id="nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="teachers.php">Teachers</a></li>
                <li><a href="signup_dob.php">Sign Up</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
<?php             
    }
?>           
        <div id="content_area">