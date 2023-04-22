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
$sql = "Select * from tbl_announce where AID like '%$search%' or 
										ANNOUNCEMENT like '%$search%'";

}else{

$sql = "Select * from tbl_announce";
}
}else{

$sql = "Select * from tbl_announce";
}


?>



<html>
<head> 
<title> Add Section</title>
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
<form method=POST action="announceview.php">
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
				<h1 id="announcemetfont">Sections</h1>
				<a href="sectionadd.php" name="addannouncement"><img src="../Images/add_icon.png" class="addannouncementbtn"></a>
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
echo "<th Class=announcementheader>Section Name";
echo "<th Class=announcementheader1>Grade Level";
echo "<th Class=announcementheader2>Section Code";
echo "<th Class=announcementheader1>ACTION";


/**while($row = $result -> fetch_assoc()){
echo "<tr>";
echo "<td class=announcementinfo rowspan=2>".$row['ANNOUNCEMENT'];
echo "<td class=announcementinfo rowspan=2>".$row['DATE'];
$source = "../uploads/".$row['image'];
	echo "<td class='td' rowspan=2><img src=$source width=100% heigth=60%/>";
echo "<td class=announcementinfo> <a href='announceupdate.php?ID=".$row['AID']."'> Update </a>";
echo "<tr>";
echo "<td class=announcementinfo> <a href='deleteannounce.php?ID=".$row['AID']."'> Archive </a>";
echo"<tr>";
echo "<td class=announcementinfo1 colspan=4>";

	

}	**/
}else{
echo "No Announcement Display";
}
?>
</div>
</body>
</html>