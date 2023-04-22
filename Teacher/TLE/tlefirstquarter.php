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
					$subject = $rowedit['SUBJECTFI'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing Input 1st Quarter Grade',NOW())";
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
$LTLE = $row['TLE'];



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
	<form method=POST action="tlefirstquarter2.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="tledashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="tleannounce.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="tlefirst.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="tlelist.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>

			<a href="tlechangepass.php"  class="Accounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>
		</div>
		<div class="tlediv">
		<h1 id="teacheraddfont">INPUT GRADES</h1>
				<hr id="line">
<input type=text name=ASID class=idfirstquarter value="<?php echo $ASID; ?>" hidden>
<p id="studidfirst">Student ID:</p><input type=text name=STUD class=studidfirst  value="<?php echo $STUD; ?>"  readonly>
<p id="namefirst">Name:</p><input type=text name=NAMEF class=namefirst  value="<?php echo $NAMEF." ".$NAMEM." ".$NAMEL; ?>" readonly>
<p id="yrandlvlfirst">Year Level & Section:</p><input type=text name=LLEVEL class=yrandlvlfirst  value="<?php echo $LLEVEL; ?>" readonly>
<p id="gradefirst">Grade For T.L.E.</p><input type=text name=LTLE class=gradefirst   value="<?php echo $LTLE ; ?>" >

<input type=submit name=entgrade value="Enter Grade" class=submitbtnfirst>
<a href="tlefirst.php" class=backfirst> Exit</a>


</table>
		</div>
</form>
</body>
</html>
