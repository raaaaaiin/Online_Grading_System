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
					$subject = $rowedit['SUBJECTS'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing Teacher Dashboard',NOW())";
			$result1 = $config->query($sql1);


	
	
?>
<html>
<head>
<title>

</title>
</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../../Css/sepi.css">
<body style="background-color:#E5E4E2">
<div class="header">

<p class="displayname"><?php echo "$subject" ?> | <?php echo "$type" ?> | <?php echo "$name" ?> </p>
<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
	<form method=POST action="mapdashboard.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="mapdashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="mapannounce.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="mapfirst.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="maplist.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="mapchangepass.php"  class="BAccounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>


		</div>
		<div class="announcementdiv">
		<?php
/* draws a calendar */
function draw_calendar($month,$year){

	/* draw table */
	$calendar = '<table cellpadding="5" cellspacing="5" class="calendar">';

	/* table headings */
	$headings = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td> <td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';

			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
			
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}
global $month;
global $year;
/* sample usages */
echo "<h1>";

echo "" . date("l");
echo ", ";

date_default_timezone_set('Asia/Manila');
    echo "<span style='color:red;font-weight:bold;'>Date: </span>". date('F j, Y g:i:a  ');
echo draw_calendar($month,$year);


?>
			
	
	</form>
</body>
</html>
