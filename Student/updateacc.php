
<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../login.php");
			 exit;
		 }else if(isset($_SESSION['Stud_SID']))
			{
				$userid = $_SESSION['Stud_SID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_student WHERE Stud_SID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					$name = $rowedit['FNAME']." ".$rowedit['LNAME'];
					$section = $rowedit['LEVEL'];
				}
			}
			$sql1 = "Insert into tbl_auditstudent (e_name,e_level,e_action,e_date) values ('$name','$section','Viewing 1st Quarter Grades',NOW())";
			$result1 = $config->query($sql1);


$sql="Select *from tbl_student WHERE Stud_SID ='$userid'";
$result = $config->query($sql);

$row = $result->fetch_assoc();
$ACIDIC = $row['Stud_SID'];
$UNAMES = $row ['EMAIL'];
$PWORDS = $row ['PASS'];
$currentPassword;
$confirmPassword;


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
			<form method="POST" action="logout.php" >
				<button type="submit" name="logout" class="logout">Log Out</a>
			</form>
		</div>
		<div class="footer">
				<h6 id="footer">© 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
		</div>
<form method=POST action="updateacc2.php">
<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboardstudent.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcestud.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="viewacc.php" class="Accountstudent"><img src="../../Images/pass.png" class="accounticon">Account</a>
			<a href="viewgrades.php" class="Gradesstudent"><img src="../../Images/studgrade.png" class="teachericon">Grades</a>
		</div>				<div class="updstudentdiv">
					<h1 id="updstudentfont">UPDATE ACCOUNT</h1>
					<hr class="updstudentline">
					
					<BR>
					<BR>
					<BR>
					<BR>
					<BR>
<table border=3>
<td>ID:
<td><input type=text name=ACIDIC value="<?php echo $ACIDIC; ?>" readonly>
<tr>
<td>USERNAME:
<td><input type=text name=UNAMES value="<?php echo $UNAMES; ?>" readonly>
<tr>
<td>CURRENT PASSWORD:
<td><input type=text name=$currentPassword >
<tr>
<td>PASSWORD:
<td><input type=password name=PWORDS value="<?php echo $PWORDS; ?>" >
<tr>
<td>CONFIRM PASSWORD:
<td><input type=text name=$confirmPassword >
<tr>
<td colspan =2><input type=submit name=upacc value="UPDATE PROFILE" >
</table>
</form>
</body>
</html>
