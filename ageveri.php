<?php
    session_start();
    
    // Page title
    $title = "Pinelands Music Academy - Sign Up";
    
    // Form submission handling
    if(isset($_POST['submit'])){
        // Get input from drop down menus
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];

        // Create session variable to pass to sign up form
        $_SESSION['date_of_birth'] = $year . "-" . $month . "-" . $day;

        // Calculate age
        $birthday = mktime(0,0,0,$month,$day,$year);
        $difference = time() - $birthday;
        $age = floor($difference / 31536000);

        // Set session variable 'over18' based on calculated age
        if($age >= 18){
            $_SESSION['over18'] = TRUE;
            header("location: signup.php");
        }
        else
        {
            $_SESSION['over18'] = FALSE;
            header("location: signup_under18.php");
        }
    }


//Content
include "header.php";
?>

<html>
    <!--Drop down menus-->
    <form action ="ageveri.php" method ="POST">
        Day <br /><select name="day">
            <option disabled selected value> -- select an option -- </option>
            <?php
            for ($day = 1; $day <= 31; $day++) { ?>
                <option><?php echo $day ?></option>
            <?php } ?>
        </select>
        <br />Month <br /><select name="month">
            <option disabled selected value> -- select an option -- </option>
            <option value="01">Jan</option>
            <option value="02">Feb</option>
            <option value="03">Mar</option>
            <option value="04">Apr</option>
            <option value="05">May</option>
            <option value="06">Jun</option>
            <option value="07">Jul</option>
            <option value="08">Aug</option>
            <option value="09">Sept</option>
            <option value="10">Oct</option>
            <option value="11">Nov</option>
            <option value="12">Dec</option>
        </select>
        <br />Year <br /><select name="year">
            <option disabled selected value> -- select an option -- </option>
            <?php
            for ($year = 1910; $year <= date("Y"); $year++) { ?>
                <option><?php echo $year ?></option>
            <?php } ?>
        </select>
        <br /><input type="submit" value="Enter" name="submit">
    </form>
</html>

<?php
include 'footer.php';