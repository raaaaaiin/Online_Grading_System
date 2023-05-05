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
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_studentinfo WHERE Stud_SID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAME']." ".$rowedit['LNAME'];
					$section = $rowedit['LEVEL'];
				}
			}
			$sql1 = "Insert into tbl_auditstudent (e_name,e_level,e_action,e_date) values ('$name','$section','Viewing 1st Quarter Grades',NOW())";
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
			<a href="dashboardstudent.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcestud.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="viewacc.php" class="Accountstudent"><img src="../../Images/pass.png" class="accounticon">Account</a>
			<a href="viewgrades.php" class="Gradesstudent"><img src="../../Images/studgrade.png" class="teachericon">Grades</a>
		</div>
<div class="announcementdiv">
				<h1 id="announcemetfont">3RD QUARTER GRADES</h1>
				<hr id=line>

				<a href="viewgrades.php" class="firstquarter">First Quarter</a>
				<a href="viewgrades2.php" class="secondquarter">Second Quarter</a>
				<a href="viewgrades3.php" class="thirdquarter">Third Quarter</a>
				<a href="viewgrades4.php" class="fourthquarter">Fourth Quarter</a>


</body>
</html>

<?php
include "../../sepi_connect.php";

if(isset($_POST['sub'])){
$search = $_POST['search'];
$category = $_POST['category'];
if($category != NULL){
$sql = "SELECT * FROM tbl_studentinfo where ANNOUNCEMENT = '$category'";
}elseif($search !=NULL){
$sql = "SELECT * FROM tbl_studentinfo where category LIKE '%$search%' or category LIKE '%$search%'";
}
}else{
$sql = "SELECT * FROM tbl_studentinfo where Stud_SID = '$userid'";
}

$result = $config -> query($sql);
if($result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";

echo "<th Class=listheader4>Filipino: ";
echo "<th Class=listheader4>English: ";
echo "<th Class=listheader4>Mathematics: ";
echo "<th Class=listheader4>Science: ";
echo "<th Class=listheader4>Araling Panlipunan: ";
echo "<th Class=listheader4>T.L.E.: ";
echo "<th Class=listheader4>M.A.P.E.H.: ";
echo "<th Class=listheader4>Christian Education: ";
echo "<th Class=listheader4>Computer: ";
echo "<th Class=listheader4>Average: ";
echo "<th Class=listheader4>Status: ";
echo "<th Class=listheader4>Remarks: ";

while($row = $result -> fetch_assoc()){
echo "<tr>";

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





	

}	
}else{
echo "Empty";
}
?>
