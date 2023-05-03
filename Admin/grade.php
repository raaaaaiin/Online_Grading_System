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
			$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Admin Dashboard',NOW())";
			$result1 = $config->query($sql1);
		
				
	
	
	
		

	
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Dashboard | S.E.P.I ONLINE GRADING SYSTEM</title> 
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
	<form method=POST action="dashboard.php">
		<!--<div class="dashboard">
			<img src="../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboard.php" class="Dashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announceview.php" class="Announcement"><img src="../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="student.php" class="Student"><img src="../Images/studrecord.png" class="studenticon">Student</a>
			<a href="teacher.php" class="Teacher"><img src="../Images/studrecord.png" class="teachericon">Teacher</a>
			<a href="accounts.php" class="Accounts"><img src="../Images/account.png" class="accounticon">Admin</a>
			<a href="adchangepass.php" class="Changepassadmin"><img src="../Images/pass.png" class="archiveicon">Account</a>
			<a href="audit.php" class="Audit"><img src="../Images/mag.png" class="auditicon">Audit Trail</a>
			<a href="../Archive/archive.php" class="Archive"><img src="../Images/arc.png" class="archiveicon">Archive</a>
            <a href="grade.php" class=""><img src="" class="">Grades</a>
			<a href="grading.php" class=""><img src="" class="">Grading Policy</a>
		</div>-->
		<?php
		include_once('SideNav.php');
		?>


		</div>
		<div class="announcementbodyarchive">
			<a href="Filipino/filfirst.php" class="announcementbodylinkarch">
				<p id="announcementarchive">Filipino</p>
		
		</div>
		<div class="studentsbodyarchive">
			<a href="English/engfirst.php" class="studentbodylinkarch">
				<p id="studentarchive">English</p>
		
		</div>
		<div class="teachersbodyarchive">
			<a href="Math/mathfirst.php" class="teacherbodylinkarch">
				<p id="teacherarchive">Mathematics</p>

		</div>
		<div class="accountsbodyarchive">
			<a href="Science/scifirstquarter.php" class="Accountsbodylinkarch">
				<p id="accountarchive">Science</p>
	
		</div>
		<div class="auditbodyarchive">
			<a href="AP/apfirst.php" class="auditbodylinkarch">
				<p id="auditarchive">Araling Panlipunan</p>
		
		</div>
        <div class="auditbodyarchive">
			<a href="TLE/tlefirst.php" class="auditbodylinkarch">
				<p id="auditarchive">T.L.E</p>
		
		</div>
        <div class="auditbodyarchive">
			<a href="MAPEH/mapfirst.php" class="auditbodylinkarch">
				<p id="auditarchive">M.A.P.E.H</p>
			
		</div>
        <div class="auditbodyarchive">
			<a href="CE/cefirst.php" class="auditbodylinkarch">
				<p id="auditarchive">Christian Education</p>
			
		</div>
        <div class="auditbodyarchive">
			<a href="COMPUTER/comfirst.php" class="auditbodylinkarch">
				<p id="auditarchive">Computer</p>
		
		</div>
     
	
	
	
	

	</form>
	</body>
	</html>
	