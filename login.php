<?php
    session_start();

    // Page title
    $title = "PMA - Login";

    // Defining variables and setting them to be empty.
    $email = $password = "";
    $emailErr = $passwordErr = $message = "";

    // Form validation and submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $err_flag = FALSE; // Input error flag
        include "login_validate.php";
        // If no errors, continue on to submit information to database.
        if ($err_flag == FALSE) {
            include('login_mysql.php');
        }
    }

    
    // Content
    include "header.php";
    ?>
    
    <html>
    <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
        <fieldset>
          <legend>Login</legend>
          <p>E-mail Address<br /><input type='text' name='email' value='<?php echo $email; ?>'>
          <?php echo $emailErr; ?></p>
          <p>Password<br /><input type='password' name='password'>
          <?php echo $passwordErr; ?></p>
          <input type='submit' value='Log In'/><?php echo $message; ?>
        </fieldset>
    </form>
    </html>

    <?php        
        include 'footer.php';