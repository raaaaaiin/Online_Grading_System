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
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacherinfo WHERE TID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
					$subject = $rowedit['SUBJECTS'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing Input 2nd Quarter Grade',NOW())";
			$result1 = $config->query($sql1);
			?>

			<?php
			include "../../sepi_connect.php";
$SID = $_GET['ID'];
$sql="Select *from tbl_studentinfo where Stud_SID = '$SID'";
$result = $config->query($sql);

$row = $result->fetch_assoc();
$zero = 0;
$zero1 = 0;
$zero2 = 0;
$date=date_create("2023");
$dateformat=date_format($date,"y");

$ASIT= $dateformat."-".$zero."".$zero1."".$zero2."-".$row['Stud_SID'];
$ASID = $row['Stud_SID'];
$STUD = $row['Stud_ID'];
$NAMEF = $row['FNAME'];
$NAMEM = $row['MNAME'];
$NAMEL = $row['LNAME'];
$LLEVEL = $row['LEVEL'];
$LYEAR = $row['YEAR'];
$LMAP = $row['MAPS'];



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
	<form method=POST action="mapsecondquarter2.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="mapdashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="mapannounce.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="mapfirst.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="maplist.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="mapchangepass.php"  class="BAccounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>


		</div>

				
		<div class="studgradet">

			<h1 id="studtitle">GRADE FOR M.A.P.E.H.</h1>
				<hr class="studentaddline">
<p class="studidtfont">STUDENT ID:</p>
<input type=text name=ASID class=studidt value="<?php echo $ASID; ?>" HIDDEN>
<input type=text name=ASIT class=studidt value="<?php echo $ASIT; ?>" readonly>
<input type=text name=STUD class=studidt value="<?php echo $STUD; ?>" hidden>

<p class="studnametfont">NAME:</p>
<input type=text name=NAMEF class=studnamet value="<?php echo $NAMEF." ".$NAMEM." ".$NAMEL; ?>" readonly>
<p class="yearleveltfont">YEAR LEVEL AND SECTION:</p>
<input type=text name=LLEVEL class=yearlevelt value="<?php echo $LLEVEL; ?>" readonly>
<p class="gradesubjecttfont">GRADE FOR FILIPINO:</p>
<input type=text name=LMAP class=gradesubjectt value="<?php echo $LMAP ; ?>" autofocus>

<input type=submit name=entgrade class=addstudbtn value="Enter Grade">
<a href="mapsecond.php" class=addstudentback> Back</a>


</table>
</form>
</body>
</html>
