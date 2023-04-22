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
$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Teachers Information',NOW())";
$result1 = $config->query($sql1);
if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
$sql = "Select * from tbl_teacher where TID like '%$search%' or 
										Employee_ID like '%$search%' or
										FNAMES like '%$search%' or
										MNAMES like '%$search%' or
										LNAMES like '%$search%' or
										BDAYS like '%$search%' or
										AGES like '%$search%' or
										GENDERS like '%$search%' or
										SUBJECTS like '%$search%'";
}else{

$sql = "Select * from tbl_teacher";
}
}else{

$sql = "Select * from tbl_teacher";
}


?>
<html>
<head> 
<title>Teacher</title>
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
<form method="POST" action=teacher.php>
		<div class="dashboard">
			<img src="../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboard.php" class="Dashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announceview.php" class="Announcement"><img src="../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="student.php" class="Student"><img src="../Images/studrecord.png" class="studenticon">Student</a>
			<a href="teacher.php" class="Teacher"><img src="../Images/studrecord.png" class="teachericon">Teacher</a>
			<a href="accounts.php" class="Accounts"><img src="../Images/account.png" class="accounticon">Admin</a>
			<a href="adchangepass.php" class="Changepassadmin"><img src="../Images/pass.png" class="archiveicon">Account</a>
			<a href="audit.php" class="Audit"><img src="../Images/mag.png" class="auditicon">Audit Trail</a>
			<a href="../Archive/archive.php" class="Archive"><img src="../Images/arc.png" class="archiveicon">Archive</a>
			<a href="grade.php" class=""><img src="" class="">Grades</a>
			<a href="grading.php" class=""><img src="" class="">Grading Policy</a>
		</div>

<div class="teacherdiv">
				<h1 id="teacherfont">TEACHER INFORMATION</h1>
				<a href="teacheradd.php" name="addstudent"><img src="../Images/add_icon.png" class="addteacherbtn"></a>
				<hr>
				<p class="searchteacher">Search:</p>
				<input type=text name=search class="teachertxt">
				<input type=submit name=sub class="teacherbtn">
				<a href="teacherviewall.php" class="viewallteacherrecordbtn">View all teacher records</a>
				<a href="importteacher.php" class="massupdbtntchr">Mass Upload</a>
</form>
</center>
</body>
</html>

<?php
include "../sepi_connect.php";


$result = $config -> query($sql);
if($result -> num_rows > 0){
echo"<div class=teachertbl style=overflow:auto;>";
echo"<table class=teachertbl1>";
echo "<tr>";
echo "<th Class=teacherheader>ID";
echo "<th Class=teacherheader>NAME";
echo "<th Class=teacherheader>USERNAME";
echo "<th Class=teacherheader>EMAIL";

echo "<th Class=teacherheader1>SUBJECT";

echo "<th Class=teacherheader colspan=2>ACTION";
echo "<th Class=teacherheader>Send Email: ";

while($row = $result -> fetch_assoc()){
$zero = 0;
    $tz_object = new DateTimeZone('Brazil/East');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $dateformat = date_format($datetime,"y");


echo "<tr>";
echo "<td class=teacherinfo>".$zero."".$dateformat."-".$zero."".$zero."".$zero."-".$row['TID'];
echo "<td class=teacherinfo>".$row['FNAMES']." ".$row['MNAMES']." ".$row['LNAMES'];
echo "<td class=teacherinfo>".$row['USERNAME'];
echo "<td class=teacherinfo>".$row['EMAIL'];

echo "<td class=teacherinfo1>".$row['SUBJECT']." | ".$row['SUBJECTO']." | ".$row['SUBJECTT']." | ".$row['SUBJECTTH']." | ".$row['SUBJECTF']." | ".$row['SUBJECTFI']." | ".$row['SUBJECTS']." | ".$row['SUBJECTSE']." | ".$row['SUBJECTE'];
echo "<td class=teacherinfo> <a href='teacherupdate.php?ID=".$row['TID']."'> Update </a>";
echo "<td class=teacherinfo> <a href='teacherdelete.php?ID=".$row['TID']."'> Archive </a>";
echo "<td class=teacherinfo> <a href='index.php'?ID=".$row['TID']."'> Send Email </a>";	

}	
}else{
echo "Empty";
}
?>