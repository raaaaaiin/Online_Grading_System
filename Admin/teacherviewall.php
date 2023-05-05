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
$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Teachers Information',NOW())";
$result1 = $config->query($sql1);
if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
$sql = "Select * from tbl_teacherinfo where TID like '%$search%' or 
										Employee_ID like '%$search%' or
										FNAMES like '%$search%' or
										MNAMES like '%$search%' or
										LNAMES like '%$search%' or
										BDAYS like '%$search%' or
										AGES like '%$search%' or
										GENDERS like '%$search%' or
										SUBJECTS like '%$search%'";
}else{

$sql = "Select * from tbl_teacherinfo";
}
}else{

$sql = "Select * from tbl_teacherinfo";
}


?>
<!DOCTYPE html>
<html>
<head> 
<title>Teacher</title>
</head>
<link rel="icon" href="../Images/logo.png">
<link rel="stylesheet" href="../Css/sepi.css">
<body style="background-color:#E5E4E2">
<div class="header">

<p class="displaynameviewall"><?php echo "$type" ?> | <?php echo "$name" ?></p>
<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
<form method=POST action="viewallstudents.php">

<div class="studentdivallrecs">
				<h1 id="studentfont">TEACHER INFORMATION</h1>
				<a href="teacheradd.php" name="addstudent"><img src="../Images/add_icon.png" class="addstudentbtnviewall"></a>
				<hr>
				<p class="searchstudent">Search:</p>
				<input type=text name=search class="studenttxtviewall">
				<input type=submit name=sub class="studentbtnviewall"> 				
				<a href="teacher.php" class="returnviewallbtn">Return</a>
				<a href="import.php" class="massupdbtnviewall">Mass Upload</a>



<?php
include "../sepi_connect.php";


$result = $config -> query($sql);
if($result -> num_rows > 0){
echo"<div class=teachertbl2 style=overflow:auto;>";
echo"<table class=teachertbl1>";
echo "<tr>";
echo "<th Class=teacherheader6>EMPLOYEE ID";
echo "<th Class=teacherheader4>NAME";
echo "<th Class=teacherheader4>USERNAME";
echo "<th Class=teacherheader4>EMAIL";
echo "<th Class=teacherheader4>ADDRESS";
echo "<th Class=teacherheader6>BIRTHDAY";
echo "<th Class=teacherheader6>AGE";
echo "<th Class=teacherheader6>GENDER";
echo "<th Class=teacherheader6 colspan=2>ACTION";
echo "<th Class=teacherheader6>Send Email: ";

while($row = $result -> fetch_assoc()){
	$zero = 0;
	$zero1 = 0;
	$zero2 = 0;
	$date=date_create("2023");
	$dateformat=date_format($date,"y");
	
	echo "<tr>";
	echo "<td class=teacherinfo>".$dateformat."-".$zero."".$zero1."".$zero2."-".$row['TID'];
echo "<td class=teacherinfo>".$row['FNAMES']." ".$row['MNAMES']." ".$row['LNAMES'];
echo "<td class=teacherinfo>".$row['USERNAME'];
echo "<td class=teacherinfo>".$row['EMAIL'];
echo "<td class=teacherinfo>".$row['ADDRESS'];
echo "<td class=teacherinfo>".$row['BDAYS'];
echo "<td class=teacherinfo>".$row['AGES'];
echo "<td class=teacherinfo>".$row['GENDERS'];
echo "<td class=teacherinfo> <a href='teacherupdate.php?ID=".$row['TID']."'> Update </a>";
echo "<td class=teacherinfo> <a href='teacherdelete.php?ID=".$row['TID']."'> Archive </a>";
echo "<td class=teacherinfo> <a href='index.php'?ID=".$row['TID']."'> Send Email </a>";	

}	
}else{
echo "Empty";
}
?>



</div>
</form>
</body>
</html>