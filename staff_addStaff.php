<?php

    session_start();

    // Page title
    $title = "PMA - Add Staff";

    // Defining variables and setting them to be empty.
    $email = $password = $password_repeat = $first_name = $last_name = $day = $month = $year = "";
    $emailErr = $passwordErr = $password_repeatErr = $first_nameErr = $last_nameErr = $dayErr = $monthErr = $yearErr = $message = "";

    // Form validation and submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $err_flag = FALSE; // Input error flag
        include "staff_addStaff_validate.php";
        // If no errors, proceed to submit details to the database.
        if ($err_flag == FALSE) {
            include('staff_addStaff_mysql.php');
        }
    }
    

    // Content
    include "header.php";
    
    if (!isset($_SESSION['staff_id'])) {
        echo "You are not logged in as a staff member.";
    }
    else {
?>

<form method='POST' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>'>
    <fieldset>      
        <legend>Create a Staff Member Profile</legend>
        <br /><header>New Staff Member Details</header>
        <p>E-mail Address<br /><input type='text' name='email' value='<?php echo $email; ?>'>
        <?php echo $emailErr; ?></p>
        <p>Password<br /><input type='password' name='password'>
        <?php echo $passwordErr; ?></p>
        <p>Repeat Password<br /><input type='password' name='password_repeat'>
        <?php echo $password_repeatErr; ?></p>
        <p>First Name<br /><input type='text' name='first_name' value='<?php echo $first_name; ?>'>
        <?php echo $first_nameErr; ?></p>
        <p>Last Name<br /><input type='text' name='last_name' value='<?php echo $last_name; ?>'>
        <?php echo $last_nameErr; ?></p>
        
        <p><b>Date of Birth</b></p>
            
        <p>Day<br />
        <select name="day">
            <option disabled selected value>--</option>
            <?php
            for ($day_option = 1; $day_option <= 31; $day_option++) { ?>
                <option><?php echo $day_option ?></option>
            <?php } ?>
        </select>
        <?php echo $dayErr; ?>
        </p>

        <p>Month<br />
        <select name="month">
            <option disabled selected value>--</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>
        <?php echo $monthErr; ?>
        </p>

        <p>Year<br />
        <select name="year">
            <option disabled selected value>--</option>
            <?php
            for ($year_option = 1910; $year_option <= date("Y"); $year_option++) { ?>
                <option><?php echo $year_option ?></option>
            <?php } ?>
        </select>
        <?php echo $yearErr; ?>
        </p>
      
        <input type='submit' value='Create'/><?php echo $message; ?>
        <p><a href="Management.php">Back</a><p/>
    </fieldset>    
</form>

<?php
        include 'footer.php';
    }