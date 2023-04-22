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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Admin Archive Records',NOW())";
		$result1 = $config->query($sql1);
if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
$sql = "Select * from tbl_archive_account where Acc_ID like '%$search%' or 
										Fname like '%$search%' or 
										Lname like '%$search%' or 
										Username like '%$search%' or 
										Gender like '%$search%' or 
										Address like '%$search%' or 
										Pnumber like '%$search%' or 
										Role like '%$search%'";
}else{

$sql = "Select * from tbl_archive_account";
}
}else{

$sql = "Select * from tbl_archive_account";
}

	?>
<html>
	<head> 
		<title>Account Archive</title>
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
		<form method=POST action="accountsarchive.php">
		<div class="archivedashboard">
			<img src="../Images/logo.png" class="dashboardlogo">
			<a href="archive.php" class="archivedashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcearchive.php" class="archiveannouncement"><img src="../Images/announcement.png" class="announcementicon">Announcements</a>
			<a href="studentarchive.php" class="archivestudents"><img src="../Images/studrecord.png" class="studenticon">Students</a>
			<a href="teacherarchive.php" class="archiveteachers"><img src="../Images/studrecord.png" class="teachericon">Teachers</a>
			<a href="accountarchive.php" class="archiveaccounts"><img src="../Images/account.png" class="accounticon">Admins</a>
			<a href="../Admin/dashboard.php" class="Returnarchive">Return</a>
		</div>
			<div class="accountsdivarchive">
				<h1 id="accountsfontarchive">ADMIN</h1>
				<hr>
				<p class="searchaccountsarchive">Search:</p>
				<input type=text name=search class="accountstxtarchive">
				<input type=submit name=sub class="accountsbtnarchive"> <br>
				
<?php
	$result = $config -> query($sql);

if ($result -> num_rows > 0){
	echo"<div class=accountstbl style=overflow:auto;>";
	echo"<table class=accountstbl1>";
	echo "<tr>";
	echo "<th Class=accountsheader1>ID";
	echo "<th Class=accountsheader>NAME";
	echo "<th Class=accountsheader>USERNAME";
	echo "<th Class=accountsheader1>GENDER";
	echo "<th Class=accountsheader>ADDRESS";
	echo "<th Class=accountsheader1>ROLE";
	echo "<th Class=accountsheader1>ADD DATE";
	echo "<th class=accountsheader1>ACTION";
		
	while($row = $result -> fetch_assoc()){
		$zero = 0;
		$tz_object = new DateTimeZone('Brazil/East');
		$datetime = new DateTime();
		$datetime->setTimezone($tz_object);
		$dateformat = date_format($datetime,"y");
	
	
	echo "<tr>";
	echo "<td class=accountsinfo>".$zero."".$zero."".$dateformat."-".$zero."".$zero."".$zero."-".$row['Acc_ID'];
		echo "<td class=accountsinfo>".$row['Fname']." ".$row['mname']." ".$row['Lname'];
		echo "<td class=accountsinfo>".$row['USERNAME'];
		echo "<td class=accountsinfo>".$row['Gender'];
		echo "<td class=accountsinfo>".$row['Address'];
		echo "<td class=accountsinfo>".$row['Role'];
		echo "<td class=accountsinfo>".$row['Hdate'];
	echo "<td class=accountsinfo><center> <a href='retrieveaccount.php?ID=".$row['Acc_ID']."'> Retrieve </a></center>";
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
