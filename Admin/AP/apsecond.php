<?php
	include "../../sepi_connect.php";
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
			$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing 2nd Quarter Grades',NOW())";
			$result1 = $config->query($sql1);
?>
<html>
<head> 
<title> Second Quarter</title>
</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../../Css/sepi.css">
<body style="background-color:#E5E4E2">
<div class="header">
<p class="displayname"> <?php echo "$type" ?> | <?php echo "$name" ?> </p>

<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
<form method=POST action="apsecond.php">
<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="../dashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="../announceview.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="../student.php" class="Student"><img src="../../Images/studrecord.png" class="studenticon">Student</a>
			<a href="../teacher.php" class="Teacher"><img src="../../Images/studrecord.png" class="teachericon">Teacher</a>
			<a href="../accounts.php" class="Accounts"><img src="../../Images/account.png" class="accounticon">Admin</a>
			<a href="../adchangepass.php" class="Changepassadmin"><img src="../../Images/pass.png" class="archiveicon">Account</a>
			<a href="../audit.php" class="Audit"><img src="../../Images/mag.png" class="auditicon">Audit Trail</a>
			<a href="../Archive/archive.php" class="Archive"><img src="../../Images/arc.png" class="archiveicon">Archive</a>
			<a href="../grade.php" class=""><img src="" class="">Grades</a>
			<a href="../grading.php" class=""><img src="" class="">Grading Policy</a>
		</div>
<div class="announcementdiv">
				<h1 id="announcemetfont">2ND QUARTER GRADES</h1>
				<input type="button" onclick="printDiv('printableArea')" value="PRINT" />
				<hr id=line>
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="gradetxt">

<select name=category class=cat>
<option value="">Grade Level & Section</option>
<option>Grade 1 - Love	</option>
<option>Grade 2 - Hope</option>
<option>Grade 3 - Humility</option>
<option>Grade 4 - Meekness</option>
<option>Grade 5 - Gentleness</option>
<option>Grade 6 - Patience</option>
<option>Grade 7 - Perseverance</option>
<option>Grade 8 - Generosity</option>
<option>Grade 9 - Industriousness</option>
<option>Grade 10 - Prosperity</option>
</select>
<input type=submit name=sub class="gradebtn"> 
				<a href="first.php" class="firstquarter">First Quarter</a>
				<a href="second.php" class="secondquarter">Second Quarter</a>
				<a href="third.php" class="thirdquarter">Third Quarter</a>
				<a href="fourth.php" class="fourthquarter">Fourth Quarter</a>


</body>
</html>
<div id=printableArea>
<?php
			include "../../sepi_connect.php";
			if(isset($_POST['sub'])){
				$search = $_POST['search'];
				$category = $_POST['category'];
				if($category != NULL){
				$sql = "SELECT * FROM tbl_studentinfo where LEVEL = '$category'";
				
				}
				else{
					$sql = "SELECT * FROM tbl_studentinfo ORDER BY Stud_SID DESC LIMIT 0";
					
					}
				if($search !=NULL){
				$sql = "SELECT * FROM tbl_studentinfo where Stud_SID LIKE '%$search%' or 
														FNAME LIKE '%$search%' or
														LNAME LIKE '%$search%' or
														USERNAME LIKE '%$search%' or
														EMAIL LIKE '%$search%'";
				}
				}else{
				$sql = "SELECT * FROM tbl_studentinfo ORDER BY Stud_SID DESC LIMIT 0";
				
				}

$result = $config -> query($sql);
if($result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";
	echo "<th Class=gradeheader>Student ID: ";
	echo "<th Class=gradeheader>NAME: ";
	echo "<th Class=gradeheader>Yr Level & Section: ";
	echo "<th Class=gradeheader>Grade: ";
	echo "<th Class=gradeheader>Email: ";
	echo "<th Class=gradeheader>Enter Grade: ";
	echo "<th Class=gradeheader>Send Email: ";
while($row = $result -> fetch_assoc()){
	$zero = 0;
$zero1 = 0;
$zero2 = 0;
$date=date_create("2023");
$dateformat=date_format($date,"y");
echo "<tr>";
echo "<td class=gradeinfo>".$dateformat."-".$zero."".$zero1."".$zero2."-".$row['Stud_SID'];
echo "<td class=gradeinfo>".$row['FNAME']."".$row['MNAME']."".$row['LNAME'];
echo "<td class=gradeinfo>".$row['LEVEL'];
echo "<td class=gradeinfo>".$row['APS'];
echo "<td class=gradeinfo>".$row['EMAIL'];
echo "<td class=gradeinfo> <a href='apsecondquarter.php?ID=".$row['Stud_SID']."'> Input Grade </a>";
echo "<td class=gradeinfo> <a href='index.php?ID=".$row['Stud_SID']."'> Send Email </a>";




	

}	
}else{
	echo "<p class=empty>SELECT GRADE LEVEL AND SECTION</p>";
}
?>

</div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
