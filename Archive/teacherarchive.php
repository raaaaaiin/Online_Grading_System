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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Teachers Archive Records',NOW())";
		$result1 = $config->query($sql1);
if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
$sql = "Select * from tbl_archive_teacher where TID like '%$search%' or 
										FNAMES like '%$search%' or 
										LNAMES like '%$search%' or 
										EMAIL like '%$search%' or 
										GENDERS like '%$search%' or 
										SUBJECTS like '%$search%' or 
										Role like '%$search%'";
}else{

$sql = "Select * from tbl_archive_teacher";
}
}else{

$sql = "Select * from tbl_archive_teacher";
}

	?>
<html>
	<head> 
		<title>Teacher Archive</title>
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
		<form method=POST action="teacherarchive.php">
		<div class="archivedashboard">
			<img src="../Images/logo.png" class="dashboardlogo">
			<a href="archive.php" class="archivedashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcearchive.php" class="archiveannouncement"><img src="../Images/announcement.png" class="announcementicon">Announcements</a>
			<a href="studentarchive.php" class="archivestudents"><img src="../Images/studrecord.png" class="studenticon">Students</a>
			<a href="teacherarchive.php" class="archiveteachers"><img src="../Images/studrecord.png" class="teachericon">Teachers</a>
			<a href="accountarchive.php" class="archiveaccounts"><img src="../Images/account.png" class="accounticon">Admins</a>
			<a href="../Admin/dashboard.php" class="Returnarchive">Return</a>
		</div>
			<div class="teacherdivarchive">
				<h1 id="teacherfontarchive">TEACHER</h1>
				<hr>
				<p class="searchteacherarchive">Search:</p>
				<input type=text name=search class="teachertxtarchive">
				<input type=submit name=sub class="teacherbtnarchive"> <br>
				
<?php
	$result = $config -> query($sql);

if ($result -> num_rows > 0){
	echo"<div class=teachertbl style=overflow:auto;>";
	echo"<table class=teachertbl1>";
	echo "<tr>";
	echo "<th Class=teacherheader>ID";
	echo "<th Class=teacherheader>NAME";
	echo "<th Class=teacherheader>EMAIL";
	echo "<th Class=teacherheader1>SUBJECT";
	echo "<th Class=teacherheader>ACTION";
		
	while($row = $result -> fetch_assoc()){
		$zero = 0;
		$tz_object = new DateTimeZone('Brazil/East');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		$dateformat = date_format($datetime,"y");
	
	
	echo "<tr>";
	echo "<td class=teacherinfo>".$zero."".$dateformat."-".$zero."".$zero."".$zero."-".$row['TID'];
	echo "<td class=teacherinfo>".$row['FNAMES']." ".$row['MNAMES']." ".$row['LNAMES'];
	echo "<td class=teacherinfo>".$row['EMAIL'];
	echo "<td class=teacherinfo1>".$row['SUBJECT']." | ".$row['SUBJECTO']." | ".$row['SUBJECTT']." | ".$row['SUBJECTTH']." | ".$row['SUBJECTF']." | ".$row['SUBJECTFI']." | ".$row['SUBJECTS']." | ".$row['SUBJECTSE']." | ".$row['SUBJECTE'];
	echo "<td class=accountsinfo><center> <a href='teacherretrieveaccount.php?ID=".$row['TID']."'> Retrieve </a></center>";
	}
		echo "</table>";
	}
	else
	{
		echo "<center>The record is not found</center";			
	}
	?>	
			</div>
			
		</form>
	</body>
	</html>
