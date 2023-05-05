<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../login.php");
			 exit;
		 }else if(isset($_SESSION['Employee_ID']))
			{
				$userid = $_SESSION['Employee_ID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacher WHERE Employee_ID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing Input 1st Quarter Grade',NOW())";
			$result1 = $config->query($sql1);
?>



<?php
include "../../sepi_connect.php";


$SID = $_GET['ID'];
$sql="Select *from tbl_studentinfo where Stud_SID = '$SID'";
$result = $config->query($sql);

$row = $result->fetch_assoc();
$ASID = $row['Stud_SID'];
$STUD = $row['Stud_ID'];
$NAMEF = $row['FNAME'];
$NAMEM = $row['MNAME'];
$NAMEL = $row['LNAME'];
$LLEVEL = $row['LEVEL'];
$LYEAR = $row['YEAR'];
$LFIL = $row['FIL'];
$LENG = $row['ENG'];
$LMATH = $row['MATH'];
$LSCI = $row['SCI'];
$LAP = $row['AP'];
$LTLE = $row['TLE'];
$LMAP = $row['MAP'];
$LCE = $row['CE'];
$LCOM = $row['COM'];



	echo $config->error;
?>
<html>
<head>
<title>

</title>
</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../../Css/sepi.css">
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
	<form method=POST action="entgrade2.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboardteacher.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announceteacher.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="grades.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="list.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="form.php" class="BForm137"><img src="../../Images/studrecord.png" class="teachericon">Form 137</a>
			<a href="viewaccs.php" class="">Account</a>
		</div>
		<div class="announcementdiv">
Student 1st Quarter Grade:
<table border=3>
<td>ID:
<td><input type=text name=ASID value="<?php echo $ASID; ?>" readonly>
<tr>
<td>Student ID:
<td><input type=text name=STUD value="<?php echo $STUD; ?>"  readonly>
<tr>
<td>First Name:
<td><input type=text name=NAMEF value="<?php echo $NAMEF; ?>" readonly>
<tr>
<td>Middle Name:
<td><input type=text name=NAMEM value="<?php echo $NAMEM; ?>"  readonly>
<tr>
<td>Last Name:
<td><input type=text name=NAMEL value="<?php echo $NAMEL; ?>" readonly>
<tr>
<td>Year Level & Section:
<td><input type=text name=LLEVEL value="<?php echo $LLEVEL; ?>" readonly>
<tr>
<td>School Year:
<td><input type=text name=LYEAR value="<?php echo $LYEAR; ?>" readonly>
<tr>
<td>Grade For Filipino:
<td><input type=text name=LFIL value="<?php echo $LFIL; ?>" >
<tr>
<td>Grade For English:
<td><input type=text name=LENG value="<?php echo $LENG; ?>" >
<tr>
<td>Grade For Mathematics:
<td><input type=text name=LMATH value="<?php echo $LMATH; ?>" >
<tr>
<td>Grade For Science:
<td><input type=text name=LSCI value="<?php echo $LSCI; ?>" >
<tr>
<td>Grade For Araling Panlipunan:
<td><input type=text name=LAP value="<?php echo $LAP; ?>" >
<tr>
<td>Grade For T.L.E.:
<td><input type=text name=LTLE value="<?php echo $LTLE; ?>" >
<tr>
<td>Grade For M.A.P.E.H.:
<td><input type=text name=LMAP value="<?php echo $LMAP; ?>" >
<tr>
<td>Grade For Christian Education:
<td><input type=text name=LCE value="<?php echo $LCE; ?>" >
<tr>
<td>Grade For Computer:
<td><input type=text name=LCOM value="<?php echo $LCOM; ?>" >
<tr>
<td><input type=submit name=entgrade value="Enter Grade">
<td><a href="grades.php" > Exit


</table>
</form>
</body>
</html>
