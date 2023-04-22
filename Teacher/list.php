
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
			$sql1 = "Insert into tbl_auditstudent (e_name,e_action,e_date) values ('$name','Viewing Student list',NOW())";
			$result1 = $config->query($sql1);

?>
<?php
if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
$sql = "Select * from tbl_student where Stud_SID like '%$search%' or 
										Stud_ID like '%$search%' or
										FNAME like '%$search%' or
										MNAME like '%$search%' or
										LNAME like '%$search%' or
										BDAY like '%$search%' or
										AGE like '%$search%' or
										GENDER like '%$search%' or
										LEVEL like '%$search%' or
										YEAR like '%$search%' or
										LRN like '%$search%'";

}else{

$sql = "Select * from tbl_student";
}
}else{

$sql = "Select * from tbl_student";
}
?>
<html>
<head> 
<title> Announcement view</title>
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
<form method=POST action="list.php">
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
				<h1 id="announcemetfont">STUDENT LIST</h1>
				
				<hr id=line>
				
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="announcementtxt">
				<input type=submit name=sub class="announcementbtn"> 



</body>
</html>

<?php
include "../../sepi_connect.php";

$result = $config -> query($sql);
if($result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";
echo "<th Class=listheader1>ID: ";
echo "<th Class=listheader1>Student ID: ";
echo "<th Class=listheader1>Fullname: ";

echo "<th Class=listheader1>Birthday: ";
echo "<th Class=listheader1>Age: ";
echo "<th Class=listheader1>Gender: ";
echo "<th Class=listheader1>Yr Level & Section: ";
echo "<th Class=listheader1>School Year: ";
echo "<th Class=listheader1>LRN: ";

while($row = $result -> fetch_assoc()){
echo "<tr>";
echo "<td class=announcementinfograde>".$row['Stud_SID'];
echo "<td class=announcementinfograde>".$row['Stud_ID'];
echo "<td class=announcementinfograde>".$row['FNAME']." ".$row['MNAME']." ".$row['LNAME'];
echo "<td class=announcementinfograde>".$row['BDAY'];
echo "<td class=announcementinfograde>".$row['AGE'];
echo "<td class=announcementinfograde>".$row['GENDER'];
echo "<td class=announcementinfograde>".$row['LEVEL'];
echo "<td class=announcementinfograde>".$row['YEAR'];
echo "<td class=announcementinfograde>".$row['LRN'];



	

}	
}else{
echo "Empty";
}
?>
