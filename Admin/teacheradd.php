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
					$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Adding Teacher Information',NOW())";
					$result1 = $config->query($sql1);
			
?>
<html>
	<head> 
		<title>Add Teacher</title>
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
	<form method="POST" action="teacheradd.php">
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
		<div class="teacheradddiv" style="width: 30% !important;">
			<h1 id="teacheraddfont">ADD TEACHER INFORMATION</h1>
				<hr class="teacheraddline" style="width: 30% !important;">
					<input type="text" name="fnames" placeholder="FIRST NAME" autocomplete="off" size="50"  class="addtfnamefield">
					<input type="text" name="mnames" placeholder="M.I." autocomplete="off" size="50"  class="addtmnamefield">
					<input type="text" name="lnames" placeholder="LAST NAME" autocomplete="off" size="50"  class="addtlnamefield">
					<input type="text" name="email" placeholder="EMAIL ADDRESS" autocomplete="off" size="50"  class="addtemailfield">
					<select name="genders" class="addtgenderfield" required>
					<option value="">----------GENDER----------</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						<option value="Others">Others</option>
					</select>
					<input type="text" name="ages" placeholder="AGE" autocomplete="off" size="50"  class="addtagefield">
					<input type="text" name="adds" placeholder="ADDRESS" autocomplete="off" size="50"  class="addtaddressfield">

					<p class="tbdayfont">BIRTHDAY:</p><input type="date" name="bdays" value="BIRTHDAY" autocomplete="off" size="50"  class="addtbdayfield">
					





					<select id="addaccrole" name="role" value="Teacher" hidden>
						<option value="Teacher">Teacher</option>
					</select>
					<input type="submit" name="subs" value="Add Teacher" class="addteachbtn" style="width: 30%;margin-top: 60%;margin-left: 10% !important;">
<a href="teacher.php" class="addteacherback" style="
    margin-left: 15%;
    margin-top: 19%;
">Back</a>


<?php
include "../sepi_connect.php";
/**if(isset($_POST['subs'])){
$firsts = $_POST['fnames'];
$middles = $_POST['mnames'];
$lasts = $_POST['lnames'];
$addres = $_POST['adds'];
$births = $_POST['bdays'];
$aging = $_POST['ages'];
$genders = $_POST['genders'];
$subject1 = !empty($_POST['subject'])?$_POST['subject']:"<br>--";
$subject2 = !empty($_POST['subjecto'])?$_POST['subjecto']:"<br>--";
$subject3 = !empty($_POST['subjectt'])?$_POST['subjectt']:"<br>--";
$subject4 = !empty($_POST['subjectth'])?$_POST['subjectth']:"<br>--";
$subject5= !empty($_POST['subjectf'])?$_POST['subjectf']:"<br>--";
$subject6 = !empty($_POST['subjectfi'])?$_POST['subjectfi']:"<br>--";
$subject7 = !empty($_POST['subjects'])?$_POST['subjects']:"<br>--";
$subject8 = !empty($_POST['subjectse'])?$_POST['subjectse']:"<br>--";
$subject9 = !empty($_POST['subjecte'])?$_POST['subjecte']:"<br>--";
$role = $_POST['role'];
$email = $firsts."".$lasts."@gmail.com";
$username = $firsts."".$lasts;
$yearss = date("Y");


$check = mysqli_query($config,"select * from tbl_teacher where FNAMES='$firsts' and MNAMES='$middles' and LNAMES='$lasts'");
$checkrows = mysqli_num_rows($check);
if($checkrows>0) 
	{
	?>
	<script>
	alert("Teacher already exists")
	</script>
	<?php
	} 
else
	{  
$sql = "Insert into tbl_teacher (FNAMES,MNAMES,LNAMES,USERNAME,ADDRESS,EMAIL,PASS,BDAYS,AGES,GENDERS,Role) values  
('$firsts','$middles','$lasts','$username','$addres','$email','$yearss','$births',$aging,'$genders','$subject1','$subject2',
'$subject3','$subject4','$subject5','$subject6','$subject7','$subject8','$subject9','$role')";

$insert = $config->query($sql);
if($insert == True){
?>
<script>
alert("Successfully Added")
</script>
<?php
}else{
	echo $config->error;
}
}
}**/

if(isset($_POST['subs'])){
	$firsts = $_POST['fnames'];
	$middles = $_POST['mnames'];
	$lasts = $_POST['lnames'];
	$addres = $_POST['adds'];
	$births = $_POST['bdays'];
	$aging = $_POST['ages'];
	$genders = $_POST['genders'];
	$role = $_POST['role'];
	$email = $firsts."".$lasts."@gmail.com";
	$username = $firsts."".$lasts;
	$yearss = date("Y");
	
	
	$check = mysqli_query($config,"select * from tbl_teacherinfo where FNAMES='$firsts' and MNAMES='$middles' and LNAMES='$lasts'");
	$checkrows = mysqli_num_rows($check);
	if($checkrows>0) 
		{
		?>
		<script>
		alert("Teacher already exists")
		</script>
		<?php
		} 
	else
		{  
	$sql = "Insert into tbl_teacherinfo (FNAMES,MNAMES,LNAMES,USERNAME,ADDRESS,EMAIL,PASS,BDAYS,AGES,GENDERS,Role) values  
	('$firsts','$middles','$lasts','$username','$addres','$email','$yearss','$births',$aging,'$genders','$role')";
	
	$insert = $config->query($sql);
	if($insert == True){
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

