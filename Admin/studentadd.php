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
		<?php
		include_once('SideNav.php');
		?>
		<div class="studentadddiv">
			<h1 id="studentaddfont">ADD STUDENT INFORMATION</h1>
				<hr class="studentaddline">
					<input type="text" name="fname" placeholder="FIRST NAME" autocomplete="off" size="50"  class="addfnamefield">
					<input type="text" name="mname" placeholder="M.I." autocomplete="off" size="50"  class="addmnamefield">
					<input type="text" name="lname" placeholder="LAST NAME" autocomplete="off" size="50"  class="addlnamefield">
					<input type="text" name="email" placeholder="EMAIL ADDRESS" autocomplete="off" size="50"  class="addemailfield">
					<select name="section" class="addsectionfield" required>
						<option value="">GRADE & SECTION</option>
						<?php
						$today = new DateTime();
						$currentMonth = (int) $today->format('m');
						$currentYear = (int) $today->format('Y');
						
						// Determine the school year for enrollment
						if ($currentMonth >= 9) {
							$enrollmentSY = ($currentYear + 1) . ' - ' . ($currentYear + 2);
						} else {
							$enrollmentSY = $currentYear . ' - ' . ($currentYear + 1);
						}
						
						// Fetch sections for the enrollment school year
						$query = "SELECT tbl_section.Section FROM `tbl_section` WHERE SY = '$enrollmentSY'";
						$result = mysqli_query($config, $query);
						$num_rows = mysqli_num_rows($result);
						if ($num_rows > 0) {
							while ($row = mysqli_fetch_assoc($result)) {
								echo '<option value="' . $row['Section'] . '">' . $row['Section'] . '</option>';
							}
						} else {
							echo '<option>Please add new section for the School Year: "' . $enrollmentSY . '"</option>';
							echo '<option>You cannot add new students for previous school years</option>';
						}
?>
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
