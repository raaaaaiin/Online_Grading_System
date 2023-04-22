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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Update Teacher Information',NOW())";
		$result1 = $config->query($sql1);
     


$TID = $_GET['ID']; 
$sql="Select *from tbl_teacher where TID = '$TID'";
$result = $config->query($sql);

$row = $result->fetch_assoc();
$TID = $row['TID'];
$Employee_ID = $row['Employee_ID'];
$FNAME = $row['FNAMES'];
$MNAME = $row['MNAMES'];
$LNAME = $row['LNAMES'];
$ADDRESS = $row['ADDRESS'];
$BDAY = $row['BDAYS'];
$AGE = $row['AGES'];
$GENDER = $row ['GENDERS'];
$SUBJECTS = $row['SUBJECTS'];


	echo $config->error;
?>
<html>
	<head> 
		<title>Update Teacher</title>
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
<form method=POST action="teacherupdate2.php">
		<?php
		include_once('SideNav.php');
		?>
				<div class="updteacherdiv">
					<h1 id="updteacherfont">UPDATE TEACHER</h1>
					<hr class="updteacherline">
					<input type=text name=TID value="<?php echo $TID; ?>" class=studidupd HIDDEN>					
					<p id=tfnameupd>FIRST NAME</p>					
					<input type=text name=FNAME value="<?php echo $FNAME; ?>" class=tfnameupd>					
					<p id=tmnameupd>MIDDLE INITIAL</p>					
					<input type=text name=MNAME value="<?php echo $MNAME; ?>" class=tmnameupd>					
					<p id=tlnameupd>LAST NAME</p>					
					<input type=text name=LNAME value="<?php echo $LNAME; ?>" class=tlnameupd>
					<p id=taddressupd>ADDRESS</p>					
					<input type=text name=ADDRESS value="<?php echo $ADDRESS; ?>" class=taddressupd>
					<p id=tbdayupd>BIRTHDAY</p>
					<input type=date name=BDAY value="<?php echo $BDAY; ?>" class=tbdayupd>
					<p id=tageupd>AGE</p>					
					<input type=text name=AGE value="<?php echo $AGE; ?>"  class=tageupd>
			
				
					
					<select name=GENDER class=tgenderupd value="<?php echo $GENDER; ?>">
						<option value="">----------GENDER----------</option>
						<option value="Male">Male</option>
						<option value="Female">Female</option>
						<option value="Others">Others</option>
					</select>
										<p class="subjfont" style="margin-left:70%;margin-top:11%;">SUBJECT:</p>

					<input type="checkbox" id="" name="subject" value="Filipino" style="margin-left:70%;">
<label for="subject"> Filipino</label><br>
<input type="checkbox" id="" name="subjecto" value="English" style="margin-left:70%;">
<label for="subjecto"> English</label><br>
<input type="checkbox" id="" name="subjectt" value="Mathematics" style="margin-left:70%;">
<label for="subjectt"> Mathematics</label><br>
<input type="checkbox" id="" name="subjectth" value="Science" style="margin-left:70%;">
<label for="subjectth"> Science</label><br>
<input type="checkbox" id="" name="subjectf" value="Araling Panlipunan" style="margin-left:70%;">
<label for="subjectf"> Araling Panlipunan</label><br>
<input type="checkbox" id="" name="subjectfi" value="T.L.E" style="margin-left:70%;">
<label for="subjectfi"> T.L.E</label><br>
<input type="checkbox" id="" name="subjects" value="M.A.P.E.H" style="margin-left:70%;">
<label for="subjects"> M.A.P.E.H</label><br>
<input type="checkbox" id="" name="subjectse" value="Christian Education" style="margin-left:70%;">
<label for="subjectse"> Christian Education</label><br>
<input type="checkbox" id="" name="subjecte" value="Computer" style="margin-left:70%;">
<label for="subjecte"> Computer</label><br>


					<input type=submit name=subs value="Update" class="updteacherbtn">
					<a href="teacher.php" class="updteacherback">Back</a>	
</form>
</div>

</body>

</html>