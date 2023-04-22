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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Students Archive Records',NOW())";
		$result1 = $config->query($sql1);
if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
$sql = "Select * from tbl_archive_student where Stud_SID like '%$search%' or 
										FNAMElike '%$search%' or 
										LNAME like '%$search%' or 
										USERNAME like '%$search%' or 
										GENDER like '%$search%' or 
										ADDRESS like '%$search%' or 
										Role like '%$search%'";
}else{

$sql = "Select * from tbl_archive_student";
}
}else{

$sql = "Select * from tbl_archive_student";
}

	?>
<html>
	<head> 
		<title>Student Archive</title>
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
		<form method=POST action="studentarchive.php">
		<div class="archivedashboard">
			<img src="../Images/logo.png" class="dashboardlogo">
			<a href="archive.php" class="archivedashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcearchive.php" class="archiveannouncement"><img src="../Images/announcement.png" class="announcementicon">Announcements</a>
			<a href="studentarchive.php" class="archivestudents"><img src="../Images/studrecord.png" class="studenticon">Students</a>
			<a href="teacherarchive.php" class="archiveteachers"><img src="../Images/studrecord.png" class="teachericon">Teachers</a>
			<a href="accountarchive.php" class="archiveaccounts"><img src="../Images/account.png" class="accounticon">Admins</a>
			<a href="../Admin/dashboard.php" class="Returnarchive">Return</a>
		</div>
			<div class="studentdivarchive">
				<h1 id="studentfontarchive">STUDENTS</h1>
				<hr>
				<p class="searchstudentarchive">Search:</p>
				<input type=text name=search class="studenttxtarchive">
				<input type=submit name=sub class="studentbtnarchive"> <br>
				
<?php
	$result = $config -> query($sql);

if ($result -> num_rows > 0){
	echo"<div class=accountstbl style=overflow:auto;>";
	echo"<table class=accountstbl1>";
	echo "<tr>";
	echo "<th Class=studentheaderarchive2>STUDENT ID";
	echo "<th Class=studentheaderarchive3>NAME";
	echo "<th Class=studentheaderarchive3>USERNAME";
	echo "<th Class=studentheaderarchive4>EMAIL";
	echo "<th Class=studentheaderarchive3>LEVEL";
	echo "<th class=studentheaderarchive3>ACTION";
		
	while($row = $result -> fetch_assoc()){
$zero = 0;
$zero1 = 0;
$zero2 = 0;
$date=date_create("2023");
$dateformat=date_format($date,"y");

echo "<tr>";
echo "<td class=accountsinfo>".$dateformat."-".$zero."".$zero1."".$zero2."-".$row['Stud_SID'];
	echo "<td class=accountsinfo>".$row['FNAME']." ".$row['MNAME']." ".$row['LNAME'];
	echo "<td class=accountsinfo>".$row['USERNAME'];
	echo "<td class=accountsinfo>".$row['EMAIL'];
	echo "<td class=accountsinfo>".$row['LEVEL'];
	echo "<td class=accountsinfo><center> <a href='studentretrieveaccount.php?ID=".$row['Stud_SID']."'> Retrieve </a></center>";
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
