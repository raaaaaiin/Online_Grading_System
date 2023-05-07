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

$sql = "Select * from tbl_subject";
}
}else{

$sql = "Select * from tbl_subject";
}


?>



<html>
<head> 
<title> Add Subject</title>
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
<form method=POST action="subject.php">
		<?php
		include_once('SideNav.php');
		?>
<div class="announcementdiv">
				<h1 id="announcemetfont">Subjects</h1>
				<a href="subjectadd.php" name="addannouncement"><img src="../Images/add_icon.png" class="addannouncementbtn"></a>
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
echo "<th Class=announcementheader>Grade Level";
echo "<th Class=announcementheader1>Subject Name";
echo "<th Class=announcementheader2>Subject Code";
echo "<th Class=announcementheader1>ACTION";


while($row = $result -> fetch_assoc()){
echo "<tr>";
echo "<td class=announcementinfo rowspan=2>".$row['Grade_level'];
echo "<td class=announcementinfo rowspan=2>".$row['Subject_name'];
echo "<td class=announcementinfo rowspan=2>".$row['Subject_code'];
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