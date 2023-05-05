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
	<form method="POST" action="section.php">
		<?php
		include_once('SideNav.php');
		?>
		<div class="teacheradddiv">
			<h1 id="teacheraddfont">ADD TEACHER INFORMATION</h1>
				


            <p class="subjfont" style="margin-left:63%;margin-top:11%;">SUBJECT:</p>

<input type="checkbox" id="" name="subject" value="Filipino" style="margin-left:63%;">
<label for="subject"> Filipino</label><br>
<input type="checkbox" id="" name="subjecto" value="English" style="margin-left:63%;">
<label for="subjecto"> English</label><br>
<input type="checkbox" id="" name="subjectt" value="Mathematics" style="margin-left:63%;">
<label for="subjectt"> Mathematics</label><br>
<input type="checkbox" id="" name="subjectth" value="Science" style="margin-left:63%;">
<label for="subjectth"> Science</label><br>
<input type="checkbox" id="" name="subjectf" value="Araling Panlipunan" style="margin-left:63%;">
<label for="subjectf"> Araling Panlipunan</label><br>
<input type="checkbox" id="" name="subjectfi" value="T.L.E" style="margin-left:63%;">
<label for="subjectfi"> T.L.E</label><br>
<input type="checkbox" id="" name="subjects" value="M.A.P.E.H" style="margin-left:63%;">
<label for="subjects"> M.A.P.E.H</label><br>
<input type="checkbox" id="" name="subjectse" value="Christian Education" style="margin-left:63%;">
<label for="subjectse"> Christian Education</label><br>
<input type="checkbox" id="" name="subjecte" value="Computer" style="margin-left:63%;">
<label for="subjecte"> Computer</label><br>


<input type="checkbox" id="" name="section" value="Grade-1" style="margin-left:10%;" style="margin-left:0%;">
<label for="section"> Grade-1</label><br>
<input type="checkbox" id="" name="sectiono" value="Grade-2" style="margin-left:10%;">
<label for="sectiono"> Grade-2</label><br>
<input type="checkbox" id="" name="sectiont" value="Grade-3" style="margin-left:10%;">
<label for="sectiont"> Grade-3</label><br>
<input type="checkbox" id="" name="sectionth" value="Grade-4" style="margin-left:10%;">
<label for="sectionth"> Grade-4</label><br>
<input type="checkbox" id="" name="sectionf" value="Grade-5" style="margin-left:10%;">
<label for="sectionf"> Grade-5</label><br>
<input type="checkbox" id="" name="sectionfi" value="Grade-6" style="margin-left:10%;">
<label for="sectionfi"> Grade-6</label><br>
<input type="checkbox" id="" name="sections" value="Grade-7" style="margin-left:10%;">
<label for="sections"> Grade-7</label><br>
<input type="checkbox" id="" name="sectionse" value="Grade-8" style="margin-left:10%;">
<label for="sectionse"> Grade-8</label><br>
<input type="checkbox" id="" name="sectione" value="Grade-9" style="margin-left:10%;">
<label for="sectione"> Grade-9</label><br>
<input type="checkbox" id="" name="sectionn" value="Grade-10" style="margin-left:10%;">
<label for="sectionn"> Grade-10</label><br>
      

					<select id="addaccrole" name="role" value="Teacher" hidden>
						<option value="Teacher">Teacher</option>
					</select>
				<input type=submit name=subs value="Add Teacher" class="addteachbtn">
				<a href="teacher.php" class="addteacherback">Back</a>	


<?php
include "../sepi_connect.php";

if(isset($_POST['subs'])){
$firsts = $_POST['fnames'];
$middles = $_POST['mnames'];
$lasts = $_POST['lnames'];
$addres = $_POST['adds'];
$births = $_POST['bdays'];
$aging = $_POST['ages'];
$genders = $_POST['genders'];
$subject1 = !empty($_POST['subject'])?$_POST['subject']:0;
$subject2 = !empty($_POST['subjecto'])?$_POST['subjecto']:0;
$subject3 = !empty($_POST['subjectt'])?$_POST['subjectt']:0;
$subject4 = !empty($_POST['subjectth'])?$_POST['subjectth']:0;
$subject5= !empty($_POST['subjectf'])?$_POST['subjectf']:0;
$subject6 = !empty($_POST['subjectfi'])?$_POST['subjectfi']:0;
$subject7 = !empty($_POST['subjects'])?$_POST['subjects']:0;
$subject8 = !empty($_POST['subjectse'])?$_POST['subjectse']:0;
$subject9 = !empty($_POST['subjecte'])?$_POST['subjecte']:0;
$section1 = !empty($_POST['section'])?$_POST['section']:0;
$section2 = !empty($_POST['sectiono'])?$_POST['sectiono']:0;
$section3 = !empty($_POST['sectiont'])?$_POST['sectiont']:0;
$section4 = !empty($_POST['sectionth'])?$_POST['sectionth']:0;
$section5= !empty($_POST['sectionf'])?$_POST['sectionf']:0;
$section6 = !empty($_POST['sectionfi'])?$_POST['sectionfi']:0;
$section7 = !empty($_POST['sections'])?$_POST['sections']:0;
$section8 = !empty($_POST['sectionse'])?$_POST['sectionse']:0;
$section9 = !empty($_POST['sectione'])?$_POST['sectione']:0;
$section10 = !empty($_POST['sectionn'])?$_POST['sectionn']:0;
$role = $_POST['role'];
$email = $firsts."".$lasts."@teacher.sepi.edu.ph";
$username = $firsts."".$lasts;
$yearss = date("Y");


$config = new mysqli("localhost","root","","db_sepi");


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
$sql = "Insert into tbl_teacherinfo (FNAMES,MNAMES,LNAMES,USERNAME,ADDRESS,EMAIL,PASS,BDAYS,AGES,GENDERS,SUBJECT,SUBJECTO,
SUBJECTT,SUBJECTTH,SUBJECTF,SUBJECTFI,SUBJECTS,SUBJECTSE,SUBJECTE,SECTION,SECTION2,SECTION3,SECTION4,SECTION5,SECTION6,SECTION7,SECTION8,SECTION9,SECTION10,Role) values  
('$firsts','$middles','$lasts','$username','$addres','$email','$yearss','$births',$aging,'$genders','$subject1','$subject2',
'$subject3','$subject4','$subject5','$subject6','$subject7','$subject8','$subject9','$section1','$section2','$section3','$section4','$section5','$section6','$section7','$section8','$section9','$section10','$role')";
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

