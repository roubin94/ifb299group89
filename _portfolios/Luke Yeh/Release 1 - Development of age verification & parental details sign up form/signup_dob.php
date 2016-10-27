<?php
    session_start();
    
    // Page title
    $title = "PMA - Sign Up";
    
    // Defining variables and setting them to be empty.
    $day = $month = $year = "";
    $dayErr = $monthErr = $yearErr = $message = "";
    
    // Form validation and submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $err_flag = FALSE; // Input error flag
        include "signup_dob_validate.php";

        // If no errors, continue and process the inputted date of birth
        if ($err_flag == FALSE) {
            // Create session variable 'date_of_birth' to pass to sign up form
            $_SESSION['date_of_birth'] = $year . "-" . $month . "-" . $day;

            // Calculate age
            $birthday = mktime(0, 0, 0, $month, $day, $year);
            $difference = time() - $birthday;
            $age = floor($difference / 31536000);

            // Set session variables 'over18' and 'over10' based on calculated age
            if($age >= 18){
                $_SESSION['over18'] = TRUE;
                $_SESSION['over10'] = TRUE;
            }
            else if($age >= 10) {
                $_SESSION['over18'] = FALSE;
                $_SESSION['over10'] = TRUE;
            }
            else
            {
                $_SESSION['over18'] = FALSE;
                $_SESSION['over10'] = FALSE;
            }

            // Direct the user to the sign up page. 
            header("location: signup.php");
        }
    }


// Content
include "header.php";
?>

<html>
    <!--Drop down menus to select day, month and year.-->
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <fieldset>
            <legend>Sign Up</legend>
            <p><b>Please select your date of birth.</b></p>
            
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
            
            <p>Year <br />
            <select name="year">
                <option disabled selected value>--</option>
                <?php
                for ($year_option = 1910; $year_option <= date("Y"); $year_option++) { ?>
                    <option><?php echo $year_option ?></option>
                <?php } ?>
            </select>
            <?php echo $yearErr; ?>
            </p>
            
            <input type="submit" value="Next" name="submit"><?php echo $message; ?>
        </fieldset>
    </form>
</html>

<?php
include 'footer.php';