<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../login.php");
			 exit;
		 }else if(isset($_SESSION['TID']))
			{
				$userid = $_SESSION['TID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacher WHERE TID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))

					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
					$subject = $rowedit['SUBJECTT'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing Input 2nd Quarter Grade',NOW())";
			$result1 = $config->query($sql1);
			?>

			<?php
			include "../../sepi_connect.php";
$SID = $_GET['ID'];
$sql="Select *from tbl_student where Stud_SID = '$SID'";
$result = $config->query($sql);

$row = $result->fetch_assoc();
$ASID = $row['Stud_SID'];
$STUD = $row['Stud_ID'];
$NAMEF = $row['FNAME'];
$NAMEM = $row['MNAME'];
$NAMEL = $row['LNAME'];
$LLEVEL = $row['LEVEL'];
$LYEAR = $row['YEAR'];
$LMATH = $row['MATHS'];



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

<p class="displayname"><?php echo "$subject" ?> | <?php echo "$type" ?> | <?php echo "$name" ?> </p>
<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
	<form method=POST action="mathsecondquarter2.php">
    <div class="dashboard">
		<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="mathdashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="mathannouncement.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="mathfirst.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="mathlist.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="mathchangepass.php"  class="Accounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>
		</div>
        <div class="announcementdiv">
Student 2nd Quarter Grade:
<table border=3>
<td>ID:
<td><input type=text name=ASID value="<?php echo $ASID; ?>" readonly>
<tr>
<td>Student ID:
<td><input type=text name=STUD value="<?php echo $STUD; ?>"  readonly>
<tr>
<td>Name:
<td><input type=text name=NAMEF value="<?php echo $NAMEF." ".$NAMEM." ".$NAMEL; ?>" readonly>
<tr>
<td>Year Level & Section:
<td><input type=text name=LLEVEL value="<?php echo $LLEVEL; ?>" readonly>
<tr>
<td>Grade For Mathematics
<td><input type=text name=LMATH  value="<?php echo $LMATH ; ?>" >
<tr>
<td><input type=submit name=entgrade value="Enter Grade">
<td><a href="mathsecond.php" > Exit


</table>
</form>
</body>
</html>
