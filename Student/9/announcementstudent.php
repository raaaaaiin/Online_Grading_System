
<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../login.php");
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
			$sql1 = "Insert into tbl_auditstudent (e_name,e_action,e_date) values ('$name','Viewing Student Announcement',NOW())";
			$result1 = $config->query($sql1);

?>

<?php
if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
$sql = "Select * from tbl_announce where AID like '%$search%' or 
										ANNOUNCEMENT like '%$search%'";

}else{

$sql = "Select * from tbl_announce ";
}
}else{

$sql = "Select * from tbl_announce ";
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
<p class="displayname"><?php echo "$name" ?> &nbsp&nbsp | &nbsp&nbsp <?php echo "$section" ?></p>

<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
<form method=POST action="announcementstudent.php">
<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboardstudent.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcementstudent.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="viewacc.php" class="Accountstudent"><img src="../../Images/pass.png" class="accounticon">Account</a>
			<a href="finalgrade.php" class="Gradesstudent"><img src="../../Images/studgrade.png" class="teachericon">Grades</a>
		</div>	
<div class="announcementdiv">
				<h1 id="announcemetfont">ANNOUNCEMENT</h1>
				<hr id=line>
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="announcementtxt">
				<input type=submit name=sub class="announcementbtn"> 


</body>
</html>
<?php


$result = $config -> query($sql);
if($result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";
echo "<th Class=announcementheaderstudent>ANNOUNCEMENT ";
echo "<th Class=announcementheaderstudent2>DATE ";
echo "<th Class=announcementheaderstudent1>IMAGE ";




while($row = $result -> fetch_assoc()){
	echo "<tr>";
		echo "<td class=announcementinfo>".$row['ANNOUNCEMENT'];
	echo "<td class=announcementinfo>".$row['DATE'];
	$source = "../../uploads/".$row['image'];
	echo "<td class='td'><img src=$source width=100% heigth=60%/>";

	

}	
}else{
echo "Empty";
}
