<?php

    // Page Title
    $title = "Pinelands Music Academy - Sign Up";

    // Defining variables and setting them to be empty.
    $email = $password = $password_repeat = $first_name = $last_name = "";
    $emailErr = $passwordErr = $first_nameErr = $last_nameErr = $message = "";

    include "signup_form_validate.php";

    // Content
    include "header.php";
    ?>

    <form method='post' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
        <fieldset>
          <legend>Sign Up Form</legend>
          <p>E-mail Address<br /><input type='text' name='email' value='<?php echo $email; ?>'>
          <?php echo $emailErr; ?></p>
          <p>Password<br /><input type='password' name='password'>
          <?php echo $passwordErr; ?></p>
          <p>Repeat Password<br /><input type='password' name='password_repeat'></p>
          <p>First Name<br /><input type='text' name='first_name' value='<?php echo $first_name; ?>'>
          <?php echo $first_nameErr; ?></p>
          <p>Last Name<br /><input type='text' name='last_name' value='<?php echo $last_name; ?>'>
          <?php echo $last_nameErr; ?></p>
          <input type='submit' value='Sign Up'/><?php echo $message; ?>
        </fieldset>
    </form>

<?php
    include 'footer.php';