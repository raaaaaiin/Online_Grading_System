<?php
		include "../sepi_connect.php";
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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Archive Records',NOW())";
		$result1 = $config->query($sql1);

	$query = "SELECT COUNT(*) AS count FROM tbl_archive_announce ";
	$query_result = mysqli_query($config,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	$Announcearchiverecord = $row['count']." Record(s)";
	}
	
	$query = "SELECT COUNT(*) AS count FROM tbl_archive_student";
	$query_result = mysqli_query($config,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	$Studentarchiverecord = $row['count']." Record(s)";
	}

	$query = "SELECT COUNT(*) AS count FROM tbl_archive_teacher";
	$query_result = mysqli_query($config,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	$Teacherarchiverecord = $row['count']." Record(s)";
	}
	
	$query = "SELECT COUNT(*) AS count FROM tbl_archive_account";
	$query_result = mysqli_query($config,$query);
	while($row = mysqli_fetch_assoc($query_result)){
	$Accountarchiverecord = $row['count']." Record(s)";
	}
	
?>
<!DOCTYPE html>
<html>
	<head> 
		<title>Archive</title>
	</head>
<link rel="icon" href="../Images/logo.png">
<link rel="stylesheet" href="../Css/sepi.css">
<body style="background-color:#E5E4E2">
	<div class="header">
		
	<p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>
		<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
		</form>
	</div>
			<div class="footer">
				<h6 id="footer">© 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
	<form method="POST" action="archive.php">
		<div class="archivedashboard">
			<img src="../Images/logo.png" class="dashboardlogo">
			<a href="archive.php" class="archivedashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcearchive.php" class="archiveannouncement"><img src="../Images/announcement.png" class="announcementicon">Announcements</a>
			<a href="studentarchive.php" class="archivestudents"><img src="../Images/studrecord.png" class="studenticon">Students</a>
			<a href="teacherarchive.php" class="archiveteachers"><img src="../Images/studrecord.png" class="teachericon">Teachers</a>
			<a href="accountarchive.php" class="archiveaccounts"><img src="../Images/account.png" class="accounticon">Admins</a>
			<a href="../Admin/dashboard.php" class="Returnarchive">Return</a>
		</div>
		<div class="announcementbodyarchive">
			<a href="announcearchive.php" class="announcementbodylinkarch">
				<p id="announcementarchive">Announcements</p>
				<p id="announcementarchtotal"><?php echo "$Announcearchiverecord"?></p></a>
		</div>
		<div class="studentsbodyarchive">
			<a href="studentarchive.php" class="studentbodylinkarch">
				<p id="studentarchive">Students</p>
				<p id="studentarchtotal"><?php echo "$Studentarchiverecord"?></p></a>
		</div>
		<div class="teachersbodyarchive">
			<a href="teacherarchive.php" class="teacherbodylinkarch">
				<p id="teacherarchive">Teachers</p>
				<p id="teacherarchtotal"><?php echo "$Teacherarchiverecord"?></p></a>
		</div>
		<div class="accountsbodyarchive">
			<a href="accountarchive.php" class="Accountsbodylinkarch">
				<p id="accountarchive">Admins</p>
				<p id="accountarchtotal"><?php echo "$Accountarchiverecord"?></p></a>
		</div>
</form>
</body>
</html>