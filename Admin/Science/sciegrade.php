<?php
	include "../../sepi_connect.php";
	session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
 {
	 // When Not Login Return to this Page
	 header("refresh:0; ../Index.php");
	 exit;
 }else if(isset($_SESSION['Acc_ID']))
	{
		$userid = $_SESSION['Acc_ID'];
		
		$getrecord = mysqli_query($config,"SELECT * FROM tbl_sepi_account WHERE Acc_ID ='$userid'");
		while($rowedit = mysqli_fetch_assoc($getrecord))
		{
			$type = $rowedit['Role'];
			$name = $rowedit['Fname']." ".$rowedit['Lname'];
		}
	}
			$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Admin Dashboard',NOW())";
			$result1 = $config->query($sql1);
		
				
	
	
	
		

	$query = "SELECT COUNT(*) AS count FROM tbl_student GROUP BY ";
	$query_result = mysqli_query($config,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	$announcementrecord = $row['count']." Total(s)";
	}

	$query = "SELECT COUNT(*) AS count FROM tbl_student";
	$query_result = mysqli_query($config,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	$studentrecord = $row['count']." Total(s)";
	}		

	$query = "SELECT COUNT(*) AS count FROM tbl_teacher";
	$query_result = mysqli_query($config,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	$teacherrecord = $row['count']." Total(s)";
	}

	$query = "SELECT COUNT(*) AS count FROM tbl_sepi_account";
	$query_result = mysqli_query($config,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	$accountrecord = $row['count']." Total(s)";
	}
	
	$query = "SELECT COUNT(*) AS count FROM tbl_audithistory";
	$query_result = mysqli_query($config,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	$auditrecord = $row['count']." Total(s)";
	}
	
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard | S.E.P.I ONLINE GRADING SYSTEM</title> 
	</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../Css/sepi.css">
<body style="background-color:#E5E4E2">
		<div class="header">
		<p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>
			<form method="POST"action="logout.php" >
				<button type=submit name="logout" class="logout">Log Out</a>
			</form>
</div>
	<form method=POST action="dashboard.php">
	<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="../dashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="../announceview.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="../student.php" class="Student"><img src="../../Images/studrecord.png" class="studenticon">Student</a>
			<a href="../teacher.php" class="Teacher"><img src="../../Images/studrecord.png" class="teachericon">Teacher</a>
			<a href="../accounts.php" class="Accounts"><img src="../../Images/account.png" class="accounticon">Admin</a>
			<a href="../adchangepass.php" class="Changepassadmin"><img src="../../Images/pass.png" class="archiveicon">Account</a>
			<a href="../audit.php" class="Audit"><img src="../../Images/mag.png" class="auditicon">Audit Trail</a>
			<a href="../Archive/archive.php" class="Archive"><img src="../../Images/arc.png" class="archiveicon">Archive</a>
			<a href="../grade.php" class=""><img src="" class="">Grades</a>
			<a href="../grading.php" class=""><img src="" class="">Grading Policy</a>
		</div>


		</div>
		<div class="announcementbodyarchive">
			<a href="announceview.php" class="announcementbodylinkarch">
				<p id="announcementarchive">Announcements</p>
				<p id="announcementarchtotal"><?php echo "$announcementrecord"?></p></a>
		</div>
		<div class="studentsbodyarchive">
			<a href="student.php" class="studentbodylinkarch">
				<p id="studentarchive">Students</p>
				<p id="studentarchtotal"><?php echo "$studentrecord"?></p></a>
		</div>
		<div class="teachersbodyarchive">
			<a href="teacher.php" class="teacherbodylinkarch">
				<p id="teacherarchive">Teachers</p>
				<p id="teacherarchtotal"><?php echo "$teacherrecord"?></p></a>
		</div>
		<div class="accountsbodyarchive">
			<a href="accounts.php" class="Accountsbodylinkarch">
				<p id="accountarchive">Accounts</p>
				<p id="accountarchtotal"><?php echo "$accountrecord"?></p></a>
		</div>
		<div class="auditbodyarchive">
			<a href="audit.php" class="auditbodylinkarch">
				<p id="auditarchive">Audit</p>
				<p id="auditarchtotal"><?php echo "$auditrecord"?></p></a>
		</div>



			
	
	
	
	

	</form>
	</body>
	</html>
	
