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
	$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Update Student Information',NOW())";
	$result1 = $config->query($sql1);


$SID = $_GET['ID'];
$sql="Select *from tbl_student where Stud_SID = '$SID'";
$result = $config->query($sql);

$row = $result->fetch_assoc();
$zero = 0;
$zero1 = 0;
$zero2 = 0;
$date=date_create("2023");
$dateformat=date_format($date,"y");
$idstud = $dateformat."-".$zero."".$zero1."".$zero."-".$row['Stud_SID'];

$SID = $row['Stud_SID'];
$Stud_ID = $row ['Stud_ID'];
$FNAME = $row ['FNAME'];
$MNAME = $row ['MNAME'];
$LNAME = $row ['LNAME'];
$EADDRESS = $row ['EMAIL'];
$ADDRESS = $row ['ADDRESS'];
$BDAY = $row ['BDAY'];
$AGE = $row ['AGE'];
$GENDER = $row ['GENDER'];
$LEVEL = $row ['LEVEL'];
$YEAR = $row ['YEAR'];
$LRN = $row ['LRN'];
$STATUS = $row ['STATUS'];
	echo $config->error;
?>
<html>
	<head> 
		<title>Add Student</title>
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
<form method=POST action="studentupdate2.php">
		<div class="dashboard">
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
		</div>
				<div class="updstudentdiv">
					<h1 id="updstudentfont">UPDATE STUDENT</h1>
					<hr class="updstudentline">
					<input type=text name=Stud_SID value="<?php echo $idstud; ?>" class=studidupd readonly>					
					<p id=studidupd>STUDENT ID</p>					
					<input type=text name=idstud value="<?php echo $idstud; ?>" hidden class=studidupd>
					<p id=fnameupd>FIRST NAME</p>					
					<input type=text name=FNAME value="<?php echo $FNAME; ?>" class=fnameupd>					
					<p id=mnameupd>M.I</p>					
					<input type=text name=MNAME value="<?php echo $MNAME; ?>" class=mnameupd>					
					<p id=lnameupd>LAST NAME</p>	
					<input type=text name=LNAME value="<?php echo $LNAME; ?>" class=lnameupd>
					<p id=emailupd>EMAIL ADDRESS</p>	
					<input type=text name=EMAIL value="<?php echo $EADDRESS; ?>" class=emailupd>
					<select name="LEVEL" class="levelupd" value="<?php echo $LEVEL; ?>">
					<option value="">SECTION</option>
					
						<option value="Grade 1 - Love">Grade 1 - Love</option>
						<option value="Grade 2 - Hope"> Grade 2 - Hope</option>
						<option value="Grade 3 - Humility">Grade 3 - Humility</option>
						<option value="Grade 4 - Meekness">Grade 4 - Meekness</option>
						<option value="Grade 5 - Gentleness">Grade 5 - Gentleness</option>
						<option value="Grade 6 - Patience">Grade 6 - Patience</option>
						<option value="Grade 7 - Perseverance">Grade 7 - Perseverance</option>
						<option value="Grade 8 - Generosity">Grade 8 - Generosity</option>
						<option value="Grade 9 - Industriousness">Grade 9 - Industriousness</option>
						<option value="Grade 10 - Prosperity">Grade 10 - Prosperity</option>
					</select>
					<p id=addressupd>ADDRESS</p>		
					<input type=text name=ADDRESS value="<?php echo $ADDRESS; ?>" class=addressupd>		
					<p id=bdayupd>BIRTHDAY</p>
					<input type=date name=BDAY value="<?php echo $BDAY; ?>" class=bdayupd>
					<p id=ageupd>AGE</p>					
					<input type=text name=AGE value="<?php echo $AGE; ?>"  class=ageupd>
					<select name=GENDER class=genderupd value="<?php echo $GENDER; ?>">
						<option value="">GENDER</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						<option value="Others">Others</option>
					</select>
					<select name="STATUS" class=classifiedupd value="<?php echo $STATUS; ?>">
						<option value="">CLASSIFIED AS</option>
						<option value="Regular">Regular</option>
						<option value="Graduating">Graduating</option>
						<option value="Others">Others</option>
					</select>
					<input type=submit name=subs value="Update" class="updstudentbtn">
					<a href="student.php" class="updstudentback">Back</a>	
</form>
</div>

</body>

</html>
