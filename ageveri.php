<?php

session_start();

error_reporting(0);
$title = "Pinelands Music Academy - Sign Up";
include "header.php";
/*
if(isset($_SESSION['over18'])){
    header("location: signup.php");
}
*/
if(isset($_POST['submit'])){
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    
    $birthday = mktime(0,0,0,$month,$day,$year);
    $difference = time() - $birthday;
    $age = floor($difference / 31536000);
    
    
    if($age >= 18){
        $_SESSION['over18'] = 1;
        $_SESSION['day'] = $day;
        $_SESSION['month'] = $month;
        $_SESSION['year'] = $year;
        //include "signup.php";
        header("location: signup.php");
    }else{
        $_SESSION['under18'] = 0;
        $_SESSION['day'] = $day;
        $_SESSION['month'] = $month;
        $_SESSION['year'] = $year;
        header("location: signup_under18.php");
    } 
    
}
?>


<html>
    
    <form action ="ageveri.php" method ="POST">
        Day <br /><select name="day">
            <option disabled selected value> -- select an option -- </option>
            <?php
            //$no_days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
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