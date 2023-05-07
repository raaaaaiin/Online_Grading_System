<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../login.php");
			 exit;
		 }else if(isset($_SESSION['TID']))
			{
				$userid = $_SESSION['TID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacherinfo WHERE TID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))

					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
				
					$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing Teacher Dashboard',NOW())";
			$result1 = $config->query($sql1);

				}
			}
			

	
	
?>
<html>
<head>
<title>

</title>
<style>
	.in-range{
		background: #8e00505e;
	}
	</style>
</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../../Css/sepi.css">
<body style="background-color:#E5E4E2">
<div class="header">


<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
	<form method=POST action="apdashboard.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announce.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="first.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="list.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="changepass.php"  class="Accounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>


		</div>
		<div class="announcementdiv" style="overflow-x:hidden;overflow-y:hidden">
		<?php
/* draws a calendar */
// Fetch the dates from tbl_gradingsched
$date_from = ''; // Initialize date_from
$date_to = ''; // Initialize date_to

$grading_schedule_result = mysqli_query($config, "SELECT date_from, date_to FROM tbl_gradingsched");
if ($row = mysqli_fetch_assoc($grading_schedule_result)) {
    $date_from = strtotime($row['date_from']);
    $date_to = strtotime($row['date_to']);
}

// Modify the draw_calendar function
function draw_calendar($month, $year, $date_from, $date_to)
{
    $calendar = '<table cellpadding="5" cellspacing="5" class="calendar">';
    $headings = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    $calendar .= '<tr class="calendar-row"><td class="calendar-day-head">' . implode('</td> <td class="calendar-day-head">', $headings) . '</td></tr>';

    $running_day = date('w', mktime(0, 0, 0, $month, 1, $year));
    $days_in_month = date('t', mktime(0, 0, 0, $month, 1, $year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    $calendar .= '<tr class="calendar-row">';
    for ($x = 0; $x < $running_day; $x++):
        $calendar .= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    for ($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $current_date = strtotime("$year-$month-$list_day");
        $is_in_range = ($current_date >= $date_from && $current_date <= $date_to);
        $calendar .= '<td class="calendar-day' . ($is_in_range ? ' in-range' : '') . '">';
        $calendar .= '<div class="day-number">' . $list_day . '</div>';

        $calendar .= str_repeat('<p> </p>', 2);
        $calendar .= '</td>';
        if ($running_day == 6):
            $calendar .= '</tr>';
            if (($day_counter + 1) != $days_in_month):
                $calendar .= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++;
        $running_day++;
        $day_counter++;
    endfor;

    if ($days_in_this_week < 8):
        for ($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar .= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    $calendar .= '</tr>';
    $calendar .= '</table>';

    return $calendar;
}

// Add the following CSS class to your CSS file or inside a <style> tag in the <head> section
/*
.in-range .day-number {
    background-color: yellow; // Choose a background color to highlight the date
}
*/
$month = date('n');
$year = date('Y');

// Finally, pass the $date_from and $date_to variables to the draw_calendar function

global $month;
global $year;
/* sample usages */
echo "<h1>";

echo "" . date("l");
echo ", ";

date_default_timezone_set('Asia/Manila');
    echo "<span style='color:red;font-weight:bold;'>Date: </span>". date('F j, Y g:i:a  ');
echo draw_calendar($month, $year, $date_from, $date_to);

?>
			
	
	</form>
</body>
</html>
