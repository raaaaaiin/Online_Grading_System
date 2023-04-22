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
$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Total of Teachers',NOW())";
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

$sql = "Select * from tbl_teacher0";
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
			<a href="../Admin/dashboard.php" class="Returnarchive">Return</a>

		</div>

<div class="teacherdiv">
				<h1 id="teacherfont">TOTAL OF TEACHERS</h1>
				<a href="teacheradd.php" name="addstudent" class="addteacherbtn"></a>
				<hr>
				<p class="searchteacher">Search:</p>
				<input type=text name=search class="teachertxt">
				<input type=submit name=sub class="teacherbtn">  
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
echo "<th Class=teacherheader1>EMPLOYEE ID";
echo "<th Class=teacherheader>NAME";
echo "<th Class=teacherheader>SUBJECT";



while($row = $result -> fetch_assoc()){
echo "<tr>";
echo "<td class=teacherinfo>".$row['Employee_ID'];
echo "<td class=teacherinfo>".$row['FNAMES']." ".$row['MNAMES']." ".$row['LNAMES'];
echo "<td class=teacherinfo>".$row['SUBJECTS'];

	

}	
}else{
echo "Empty";
}
?>