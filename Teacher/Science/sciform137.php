
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
					$subject = $rowedit['SUBJECTTH'];
				}
			}
			$sql1 = "Insert into tbl_auditstudent (e_name,e_action,e_date) values ('$name','Viewing Form 137',NOW())";
			$result1 = $config->query($sql1);
?>
<html>
<head> 
<title> FORM 137</title>
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
<form method=POST action="scifirstquarter.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
		
			<a href="scidashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="sciannouncement.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="scifirstquarter.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="scilist.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="scichangepass.php"  class="BAccounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>
		</div>
<div class="announcementdiv">
				<h1 id="announcemetfont">FORM 137</h1>
				<hr id=line>
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="announcementtxt">
				<input type=submit name=sub class="announcementbtn"> 
		


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
echo "<th Class=listheader>Student ID: ";
echo "<th Class=listheader>NAME: ";
echo "<th Class=listheader>Yr Level & Section: ";
echo "<th Class=listheader>1ST Quarter Average: ";
echo "<th Class=listheader>2ND Quarter Average: ";
echo "<th Class=listheader>3RD Quarter Average: ";
echo "<th Class=listheader>4TH Quarter Average: ";
echo "<th Class=listheader>Status: ";
echo "<th Class=listheader>Remarks: ";
echo "<th Class=listheader>FINAL GRADE: ";
echo "<th Class=listheader>ACTION: ";
echo "<th Class=listheader>Send Email: ";
while($row = $result -> fetch_assoc()){
echo "<tr>";
echo "<td class=announcementinfograde>".$row['Stud_ID'];
echo "<td class=announcementinfograde>".$row['FNAME']."".$row['MNAME']."".$row['LNAME'];
echo "<td class=announcementinfograde>".$row['LEVEL'];
echo "<td class=announcementinfograde>".$row['TOTAL'],"%";
echo "<td class=announcementinfograde>".$row['TOTALS'],"%";
echo "<td class=announcementinfograde>".$row['TOTALSS'],"%";
echo "<td class=announcementinfograde>".$row['TOTALSF'],"%";
echo "<td class=announcementinfograde>".$row['STAT'];
echo "<td class=announcementinfograde>".$row['REM'];
echo "<td class=announcementinfograde>".$row['GWA'],"%";
echo "<td class=announcementinfograde> <a href='entgwa2.php?ID=".$row['Stud_SID']."'> ENTER GWA </a>";
echo "<td class=announcementinfograde> <a href='?ID=".$row['Stud_SID']."'> Send Email </a>";





	

}	
}else{
echo "Empty";
}
?>
