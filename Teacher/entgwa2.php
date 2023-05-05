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
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Inputting General Weighted Average',NOW())";
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
$TOTALO = $row['TOTAL'];
$TOTALS = $row['TOTALS'];
$TOTALT = $row['TOTALSS'];
$TOTALF = $row['TOTALSF'];



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
	<form method=POST action="entgwa.php">
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
Student Grade:
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
<td>1ST GRADING:
<td><input type=text name=TOTALO value="<?php echo $TOTALO; ?>"  readonly>
<tr>
<td>2ND GRADING:
<td><input type=text name=TOTALS value="<?php echo $TOTALS; ?>" readonly>
<tr>
<td>3RD GRADING:
<td><input type=text name=TOTALT value="<?php echo $TOTALT; ?>" readonly>
<tr>
<td>4TH GRADING:
<td><input type=text name=TOTALF value="<?php echo $TOTALF; ?>" readonly>
<tr>
<td><input type=submit name=entgrade value="Compute Grade">
<td><a href="form.php" > Exit


</table>
</form>
</body>
</html>
