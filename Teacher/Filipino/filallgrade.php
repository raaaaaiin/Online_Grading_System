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
					$subject = $rowedit['SUBJECT'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing 1st Quarter Grades',NOW())";
			$result1 = $config->query($sql1);
?>
<html>
<head> 
<title> First Quarter</title>
</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../../Css/sepi.css">
<body style="background-color:#E5E4E2">
<div class="header">
<p class="displayname"><?php echo "$subject" ?>  <?php echo "$type" ?> | <?php echo "$name" ?> </p>

<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
<form method=POST action="filallgrade.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="fildashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="filannouncement.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="filfirst.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="fillist.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="filchangepass.php"  class="BAccounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>
		</div>
<div class="announcementdiv">
				<h1 id="announcemetfont">FINAL GRADES</h1>
				<hr id=line>
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="announcementtxt">
				<input type=submit name=sub class="announcementbtn"> 
				<a href="filfirst.php" class="firstquarter">First Quarter</a>
				<a href="filsecond.php" class="secondquarter">Second Quarter</a>
				<a href="filthird.php" class="thirdquarter">Third Quarter</a>
				<a href="filfourth.php" class="fourthquarter">Fourth Quarter</a>
				<a href="filallgrade.php" class="fourthquarter">Final Grade</a>
			


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
$sql = "SELECT * FROM tbl_studentinfo";
}

$result = $config -> query($sql);
if($result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";
echo "<th Class=filfirst1>Student ID: ";
echo "<th Class=filfirst>NAME: ";
echo "<th Class=filfirst1>Yr Level & Section: ";
echo "<th Class=filfirst1>Filipino Final: ";
echo "<th Class=filfirst1>Remarks: ";
echo "<th Class=filfirst1>Enter Grade: ";
echo "<th Class=filfirst1>Send Email: ";
while($row = $result -> fetch_assoc()){
$zero = 0;
$zero1 = 0;
$zero2 = 0;
$date=date_create("2023");
$dateformat=date_format($date,"y");

echo "<tr>";
echo "<td class=accountsinfo>".$dateformat."-".$zero."".$zero1."".$zero2."-".$row['Stud_SID'];
echo "<td class=announcementinfograde>".$row['FNAME']."".$row['MNAME']."".$row['LNAME'];
echo "<td class=announcementinfograde>".$row['LEVEL'];
echo "<td class=announcementinfograde>".$row['FILT'];
echo "<td class=announcementinfograde>".$row['REM'];
echo "<td class=announcementinfograde> <a href='filfinal.php?ID=".$row['Stud_SID']."'> Final Grade </a>";
echo "<td class=announcementinfograde> <a href='?ID=".$row['Stud_SID']."'> Send Email </a>";





	

}	
}else{
echo "Empty";
}
?>

