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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Adding Student Information',NOW())";
		$result1 = $config->query($sql1);
?>
<!DOCTYPE html>
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
	<form method=POST action="studentadd.php">
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
			<a href="grading.php" class=""><img src="" class="">Grading Policy</a>
		</div>
		<div class="studentadddiv">
			<h1 id="studentaddfont">ADD STUDENT INFORMATION</h1>
				<hr class="studentaddline">
					<input type="text" name="fname" placeholder="FIRST NAME" autocomplete="off" size="50"  class="addfnamefield">
					<input type="text" name="mname" placeholder="M.I." autocomplete="off" size="50"  class="addmnamefield">
					<input type="text" name="lname" placeholder="LAST NAME" autocomplete="off" size="50"  class="addlnamefield">
					<input type="text" name="email" placeholder="EMAIL ADDRESS" autocomplete="off" size="50"  class="addemailfield">
					<select name="section" class="addsectionfield" required>
						<option value="">GRADE & SECTION</option>
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
					<input type="text" name="age" placeholder="AGE" autocomplete="off" size="50"  class="addagefield">
					<input type="text" name="add" placeholder="ADDRESS" autocomplete="off" size="50"  class="addaddressfield">
					<p class="bdayfont">BIRTHDAY:</p>
					<input type="date" name="bday" value="BIRTHDAY" autocomplete="off" size="50"  class="addbdayfield">
					<select name="gender" class="addgenderfield" required>
						<option value="">GENDER</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						<option value="Others">Others</option>
					</select>

					<input type="text" name="year" placeholder="SCHOOL YEAR" autocomplete="off" size="50"  class="addyearfield" hidden>
					<select id="addaccrole" name="role" value="Student" hidden>
						<option value="Student">Student</option>
					</select>
					<p class="classifiedfont">CLASSIFIED AS:</p>
					<select name="classified" class=classified>
						<option value="">CLASSIFIED AS</option>
						<option value="Regular">Regular</option>
						<option value="Graduating">Graduating</option>
						<option value="Others">Others</option>
					</select>
<input type=submit name=subs value="Add Student" class="Baddstudbtn">
<a href="student.php" class="Baddstudentback">Back</a>	
		
<?php
include "../sepi_connect.php";
if(isset($_POST['subs'])){
$first = $_POST['fname'];
$middle = $_POST['mname'];
$last = $_POST['lname'];
$address = $_POST['add'];
$birth = $_POST['bday'];
$agess = $_POST['age'];
$gender = $_POST['gender'];
$levels = $_POST['section'];
$years = $_POST['year'];
$role = $_POST['role'];
$username = $first."".$last;
$email = $first."".$last.""."@gmail.com";
$status = $_POST['classified'];

$yearss = date("Y");
$date = date('Y', strtotime($yearss. ' + 1 years'));
$sy = $yearss." - ".$date;


$check = mysqli_query($config,"select * from tbl_student where FNAME='$first' and MNAME='$middle' and LNAME='$last'");
$checkrows = mysqli_num_rows($check);
if($checkrows>0) 
	{
	?>
	<script>
	alert("Student already exists")
	</script>
	<?php
	} 
else
	{  
		$sql = "Insert into tbl_student (FNAME,MNAME,LNAME,ADDRESS,USERNAME,EMAIL,PASS,BDAY,AGE,GENDER,LEVEL,YEAR,Role,STATUS) values  
		('$first','$middle','$last','$address','$username','$email','$yearss','$birth','$agess','$gender','$levels','$sy','$role','$status')";
		$insert = $config->query($sql);
	if($insert == True)
	{
?>
<script>
alert("Successfully Added")
</script>
<?php
}else{
	echo $config->error;
}
}
}
?>
</form>
</body>
</html>
