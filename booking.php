<?php session_start();?>
<!DOCTYPE html>
<?php
    // Page Title
    $title = "PMA - Bookings";
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

include('db_connect_bookings.php'); 
include('classes/class_calendar.php');

$calendar = new booking_diary($link);

if(isset($_GET['month'])) $month = $_GET['month']; else $month = date("m");
if(isset($_GET['year'])) $year = $_GET['year']; else $year = date("Y");
if(isset($_GET['day'])) $day = $_GET['day']; else $day = 0;

// Unix Timestamp of the date a user has clicked on
$selected_date = mktime(0, 0, 0, $month, 01, $year); 

// Unix Timestamp of the previous month which is used to give the back arrow the correct month and year 
$back = strtotime("-1 month", $selected_date); 

// Unix Timestamp of the next month which is used to give the forward arrow the correct month and year 
$forward = strtotime("+1 month", $selected_date);

// Content
include "header.php";
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="Styles/Stylesheet.css" />
		<link href="\Styles\StyleSheet.css" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Droid+Serif" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    </head>
    <body>     
		<div id="calendar-content">
				<form action="" method="get">
					<select name="teacher">
					<?php
							$host="localhost";
							$user="root";
							$password="music";
							$db = "teachers";

							$con = mysqli_connect($host, $user, $password);
							mysqli_select_db($con, $db) or die(mysql_error());
							
							if (isset($_GET['teacher'])) {
								$t = mysqli_real_escape_string($con, $_GET['teacher']);
								$sql = "SELECT teacher_id, first_name, last_name FROM teachers WHERE teacher_id = $t"; 
								$res = mysqli_query($con, $sql);
								while($row=mysqli_fetch_row($res)) {
									echo '<option value="'.$row[0].'">'.$row[1] . ' ' . $row[2].'</option>';
								}
								echo "<option value='0'>-----------------</option>";
							}
							
							
							$sql = "SELECT teacher_id, first_name, last_name FROM teachers"; 
							$res = mysqli_query($con, $sql);
							while($row=mysqli_fetch_row($res)) {
								echo '<option value="'.$row[0].'">'.$row[1] . ' ' . $row[2].'</option>';
							}
						?>
					</select>
					<input type="submit" value="View Teacher Calendar" style="width: auto;" />
				</form>
				<script type="text/javascript">
				var check_array = [];

				$(document).ready(function(){

					$(".fields").click(function(){
					
						dataval = $(this).data('val');
					
						// Show the Selected Slots box if someone selects a slot
						if($("#outer_basket").css("display") == 'none') { 
							$("#outer_basket").css("display", "block");
						}

						if(jQuery.inArray(dataval, check_array) == -1) {
							check_array.push(dataval);
						} else {
							// Remove clicked value from the array
							check_array.splice($.inArray(dataval, check_array) ,1);	
						}
						
						slots=''; hidden=''; basket = 0;
						
						cost_per_slot = $("#cost_per_slot").val();
						//cost_per_slot = parseFloat(cost_per_slot).toFixed(2)

						for (i=0; i< check_array.length; i++) {
							slots += check_array[i] + '\r\n';
							hidden += check_array[i].substring(0, 8) + '|';
							basket = (basket + parseFloat(cost_per_slot));
						}
						
						// Populate the Selected Slots section
						$("#selected_slots").html(slots);
						
						// Update hidden slots_booked form element with booked slots
						$("#slots_booked").val(hidden);		

						// Update basket total box
						basket = basket.toFixed(2);
						$("#total").html(basket);	

						// Hide the basket section if a user un-checks all the slots
						if(check_array.length == 0)
						$("#outer_basket").css("display", "none");
						
					});
					
					
					$(".classname").click(function(){
					
						msg = '';
					
						if($("#name").val() == '')
						msg += 'Please enter a Name\r\n';

						if($("#email").val() == '')
						msg += 'Please enter an Email address\r\n';

						if($("#phone").val() == '')
						msg += 'Please enter a Phone number\r\n';	

						if(msg != '') {
							alert(msg);
							return false;
						}

					});

					// Firefox caches the checkbox state.  This resets all checkboxes on each page load 
					$('input:checkbox').removeAttr('checked');
					
				});
				</script>
				<?php     
					// Call calendar function
					if (isset($_GET['teacher']) && $_GET['teacher'] != 0) {
						$teacher_id = $_GET['teacher'];
						$calendar->make_calendar($selected_date, $back, $forward, $day, $month, $year, $teacher_id);
					}
				?>
		</div>
	</body>
</html>
<?php
include 'footer.php';
?>
