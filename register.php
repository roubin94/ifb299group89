<!DOCTYPE html>
<html>
    <head>
        <title>Pinelands Music School - Registration</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back.</a><br /><br />
        <form action="register.php" method="post">
           Name: <input type="text" name="name" required="required"/><br />
           E-mail Address: <input type="text" name="email" required="required"/><br />
           Password: <input type="password" name="password" required="required"/><br />
           <input type="submit" value="Register"/>
        </form>
    </body>
</html>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = mysql_real_escape_string($_POST['name']);
  $email = mysql_real_escape_string($_POST['email']);
  $password = mysql_real_escape_string($_POST['password']);

  echo "Name entered is: ". $username . "<br />";
  echo "Email entered is: ". $email . "<br />";
  echo "Password entered is: ". $password;
}
?>