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
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing Update Account',NOW())";
			$result1 = $config->query($sql1);



$sql="Select *from tbl_teacher where Employee_ID = '$userid' ";
$result = $config->query($sql);

$row = $result->fetch_assoc();
$ACIDIC = $row['TID'];
$UNAMES = $row ['EMAIL'];
$PWORDS = $row ['PASS'];




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
			<form method="POST" action="logout.php" >
				<button type="submit" name="logout" class="logout">Log Out</a>
			</form>
		</div>
		<div class="footer">
				<h6 id="footer">© 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
		</div>
<form method=POST action="viewaccsup2.php">
<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboardteacher.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announceteacher.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="grades.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="list.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="form.php" class="BForm137"><img src="../../Images/studrecord.png" class="teachericon">Form 137</a>
			<a href="viewaccs.php" class="">Account</a>
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
<td>PASSWORD:
<td><input type=password name=PWORDS value="<?php echo $PWORDS; ?>" >
<tr>
<td colspan =2><input type=submit name=upacc value="UPDATE PROFILE" >

</table>
</form>
</body>
</html>
