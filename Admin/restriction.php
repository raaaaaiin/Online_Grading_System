<?php	include "../sepi_connect.php";
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
			$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Admin Announcement',NOW())";
			$result1 = $config->query($sql1);
if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
	$sql = "SELECT * FROM `tbl_subject` WHERE `ID` LIKE '%$search%' OR `Subject_code` LIKE '%$search%' OR `Subject_name` LIKE '%$search%' OR `Grade_level` LIKE '%$search%'";										

}else{

$sql = "SELECT 
ID,Teacher_Code, 
GROUP_CONCAT(Subject_Code SEPARATOR ', ') as Subject_Codes, 
Sy 
FROM tbl_restriction 
GROUP BY Teacher_Code, Sy;";
}
}else{

$sql = "SELECT 
ID,Teacher_Code, 
GROUP_CONCAT(Subject_Code SEPARATOR ', ') as Subject_Codes, 
Sy 
FROM tbl_restriction 
GROUP BY Teacher_Code, Sy;";
}


?>



<html>
<head> 
<title> Add Restriction</title>
</head>
<link rel="icon" href="../Images/logo.png">
<link rel="stylesheet" href="../Css/sepi.css">
<body style="background-color:#E5E4E2">
<div class="header">


<form method="POST"action="logout.php" >
<p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">© 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
<form method=POST action="restriction.php">
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
<div class="announcementdiv">
				<h1 id="announcemetfont">Restriction</h1>
				<a href="restrictionadd.php" name="addannouncement"><img src="../Images/add_icon.png" class="addannouncementbtn"></a>
				<hr>
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="announcementtxt">
				<input type=submit name=sub class="announcementbtn"> 




<?php
include "../sepi_connect.php";


$result = $config -> query($sql);
if($result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";
echo "<th Class=announcementheader>Teacher Name";
echo "<th Class=announcementheader1>Subjects";
echo "<th Class=announcementheader2>Sy";
echo "<th Class=announcementheader1>ACTION";


while($row = $result -> fetch_assoc()){
echo "<tr>";
echo "<td class=announcementinfo rowspan=2>".$row['Teacher_Code'];
echo "<td class=announcementinfo rowspan=2>".$row['Subject_Codes'];
echo "<td class=announcementinfo rowspan=2>".$row['Sy'];
echo "<td class=announcementinfo> <a href='announceupdate.php?ID=".$row['ID']."'> Update </a>";
echo "<tr>";
echo "<td class=announcementinfo> <a href='deleteannounce.php?ID=".$row['ID']."'> Archive </a>";
echo"<tr>";
echo "<td class=announcementinfo1 colspan=4>";

	

}	
}else{
echo "No Announcement Display";
}
?>
</div>
</body>
</html>