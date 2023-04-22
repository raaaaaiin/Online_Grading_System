
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
	$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Update Admin Account',NOW())";
	$result1 = $config->query($sql1);


$ID = $_GET['ID'];
$sql="Select *from tbl_sepi_account where Acc_ID = '$ID'";
$result = $config->query($sql);

$row = $result->fetch_assoc();
$ID = $row['Acc_ID'];
$FNAME = $row['Fname'];
$MNAME = $row['mname'];
$LNAME = $row['Lname'];
$GENDER = $row['Gender'];
$ADDRESS = $row['Address'];


	echo $config->error;
?>
<html>
	<head> 
		<title>Update Account</title>
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
<form method=POST action="accountupdate2.php">
		<div class="dashboard">
			<img src="../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboard.php" class="Dashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announceview.php" class="Announcement"><img src="../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="student.php" class="Student"><img src="../Images/studrecord.png" class="studenticon">Student</a>
			<a href="teacher.php" class="Teacher"><img src="../Images/studrecord.png" class="teachericon">Teacher</a>
			<a href="accounts.php" class="Accounts"><img src="../Images/account.png" class="accounticon">Admin</a>
			<a href="adchangepass.php" class="Changepassadmin"><img src="../Images/account.png" class="archiveicon">Account</a>
			<a href="audit.php" class="Audit"><img src="../Images/account.png" class="auditicon">Audit Trail</a>
			<a href="../Archive/archive.php" class="Archive"><img src="../Images/account.png" class="archiveicon">Archive</a>
			<a href="grade.php" class=""><img src="" class="">Grades</a>
			<a href="grading.php" class=""><img src="" class="">Grading Policy</a>
		</div>
				<div class="accupddiv">
					<h1 id="updstudentfont">UPDATE ACCOUNT</h1>
					<hr class="accupdline">
    				<input type=text name=ID value="<?php echo $ID; ?>" class=updateaccfnamefield>					
					<p id=updateaccfnamefield>FIRST NAME</p>					
					<input type=text name=FNAME value="<?php echo $FNAME; ?>" class=updateaccfnamefield>					
					<p id=updateaccmnamefield>MIDDLE INITIAL</p>					 
					<input type=text name=MNAME value="<?php echo $MNAME; ?>" class=updateaccmnamefield>					
					<p id=updateacclnamefield>LAST NAME</p>					
					<input type=text name=LNAME value="<?php echo $LNAME; ?>" class=updateacclnamefield>
					<p id=updateaccgenderfield>GENDER</p>
					<select name="GENDER" value="<?php echo $GENDER; ?>" class=updateaccgenderfield>
					<option value="">----------GENDER----------</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Others">Others</option>
					</select>
					<p id=updateaccaddressfield>ADDRESS</p>					
					<input type=text name=ADDRESS value="<?php echo $ADDRESS; ?>"  class=updateaccaddressfield>

					
					<input type=submit name=subs value="Update" class="updaccountbtn">
					<a href="accounts.php" class="updaccountback">Back</a>	
</form>
</div>

</body>

</html>