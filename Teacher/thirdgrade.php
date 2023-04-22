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
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing 3rd Quarter Grades',NOW())";
			$result1 = $config->query($sql1);
?>
<html>
<head> 
<title> Third Quarter</title>
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
<form method=POST action="thirdgrade.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboardteacher.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announceteacher.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="grades.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="list.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="viewaccs.php"  class="Accounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>
			<a href="form.php" class="BForm137"><img src="../../Images/studrecord.png" class="teachericon">Form 137</a>
		</div>
<div class="announcementdiv">
				<h1 id="announcemetfont">3RD QUARTER GRADES</h1>
				<hr id=line>
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="announcementtxt">
				<input type=submit name=sub class="announcementbtn"> 
				<a href="grades.php" class="firstquarter">First Quarter</a>
				<a href="secondgrade.php" class="secondquarter">Second Quarter</a>
				<a href="thirdgrade.php" class="thirdquarter">Third Quarter</a>
				<a href="fourthgrade.php" class="fourthquarter">Fourth Quarter</a>

</body>
</html>

<?php
include "../../sepi_connect.php";

if(isset($_POST['sub'])){
$search = $_POST['search'];
$category = $_POST['category'];
if($category != NULL){
$sql = "SELECT * FROM tbl_student where ANNOUNCEMENT = '$category'";
}elseif($search !=NULL){
$sql = "SELECT * FROM tbl_student where category LIKE '%$search%' or category LIKE '%$search%'";
}
}else{
$sql = "SELECT * FROM tbl_student";
}

$result = $config -> query($sql);
if($result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";
echo "<th Class=listheader>Student ID: ";
echo "<th Class=listheader>NAME: ";
echo "<th Class=listheader>Yr Level & Section: ";
echo "<th Class=listheader2>Filipino: ";
echo "<th Class=listheader2>English: ";
echo "<th Class=listheader2>Mathematics: ";
echo "<th Class=listheader2>Science: ";
echo "<th Class=listheader2>Araling Panlipunan: ";
echo "<th Class=listheader2>T.L.E.: ";
echo "<th Class=listheader2>M.A.P.E.H.: ";
echo "<th Class=listheader2>Christian Education: ";
echo "<th Class=listheader2>Computer: ";
echo "<th Class=listheader>Average: ";
echo "<th Class=listheader>Status: ";
echo "<th Class=listheader>Remarks: ";
echo "<th Class=listheader>Enter Grade: ";
echo "<th Class=listheader>Send Email: ";
while($row = $result -> fetch_assoc()){
echo "<tr>";
echo "<td class=announcementinfograde>".$row['Stud_ID'];
echo "<td class=announcementinfograde>".$row['FNAME']."".$row['MNAME']."".$row['LNAME'];
echo "<td class=announcementinfograde>".$row['LEVEL'];
echo "<td class=announcementinfograde>".$row['FILSS'];
echo "<td class=announcementinfograde>".$row['ENGSS'];
echo "<td class=announcementinfograde>".$row['MATHSS'];
echo "<td class=announcementinfograde>".$row['SCISS'];
echo "<td class=announcementinfograde>".$row['APSS'];
echo "<td class=announcementinfograde>".$row['TLESS'];
echo "<td class=announcementinfograde>".$row['MAPSS'];
echo "<td class=announcementinfograde>".$row['CESS'];
echo "<td class=announcementinfograde>".$row['COMSS'];
echo "<td class=announcementinfograde>".$row['TOTALSS'],"%";
echo "<td class=announcementinfograde>".$row['STATUSSS'];
echo "<td class=announcementinfograde>".$row['REMARKSSS'];
echo "<td class=announcementinfograde> <a href='ent3grade.php?ID=".$row['Stud_SID']."'> Input Grade </a>";
echo "<td class=announcementinfograde> <a href='?ID=".$row['Stud_SID']."'> Send Email </a>";




	

}	
}else{
echo "Empty";
}
?>
