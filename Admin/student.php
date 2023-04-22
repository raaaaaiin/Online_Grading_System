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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Students Information',NOW())";
		$result1 = $config->query($sql1);

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

<!DOCTYPE html>
<html>
<head> 
<title>Students</title>
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
<form method=POST action="student.php">
<?php
		include_once('SideNav.php');
		?>

<div class="studentdiv">
				<h1 id="studentfont">STUDENT INFORMATION</h1>
				<a href="studentadd.php" name="addstudent"><img src="../Images/add_icon.png" class="addstudentbtn"></a>
				<hr>
				<p class="searchstudent">Search:</p>
				<input type=text name=search class="bstudtext">

				<select name=category class=cat>
<option value="">Grade Level & Section</option>
<option>Grade 1 - Love	</option>
<option>Grade 2 - Hope</option>
<option>Grade 3 - Humility</option>
<option>Grade 4 - Meekness</option>
<option>Grade 5 - Gentleness</option>
<option>Grade 6 - Patience</option>
<option>Grade 7 - Perseverance</option>
<option>Grade 8 - Generosity</option>
<option>Grade 9 - Industriousness</option>
<option>Grade 10 - Prosperity</option>
</select>				
				<input type=submit name=sub class="bstudbtn"> 

				<a href="viewallstudents.php" class="viewallstudrecordbtn">View all student records</a>
				<a href="import.php" class="massupdbtn">Mass Upload</a>
<br>

<?php
include "../sepi_connect.php";
if(isset($_POST['sub'])){
	$search = $_POST['search'];
	$category = $_POST['category'];
	if($category != NULL){
	$sql = "SELECT * FROM tbl_student where LEVEL = '$category'";
	
	}
	else{
		$sql = "SELECT * FROM tbl_student ORDER BY Stud_SID DESC LIMIT 0";
		
		}
	if($search !=NULL){
	$sql = "SELECT * FROM tbl_student where Stud_SID LIKE '%$search%' or 
											FNAME LIKE '%$search%' or
											LNAME LIKE '%$search%' or
											USERNAME LIKE '%$search%' or
											EMAIL LIKE '%$search%'";
	}
	}else{
		$sql = "SELECT * FROM tbl_student ORDER BY Stud_SID DESC LIMIT 0";
	
	}
$result = $config -> query($sql);
if($result -> num_rows > 0){
echo"<div class=studenttbl style=overflow:auto;>";
echo"<table class=studenttbl1>";
echo "<tr>";
echo "<th Class=studentheaderadminview>STUDENT ID";
echo "<th Class=studentheaderadminview1>NAME";
echo "<th Class=studentheaderadminview1>USERNAME";
echo "<th Class=studentheaderadminview1>EMAIL";
echo "<th Class=studentheaderadminview1>LEVEL";
echo "<th Class=studentheaderadminview1 colspan=2>ACTION";
echo "<th Class=studentheaderadminview1>Send Email: ";

while($row = $result -> fetch_assoc()){
$zero = 0;
    $tz_object = new DateTimeZone('Brazil/East');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $dateformat = date_format($datetime,"y");

echo "<tr>";
echo "<td class=studentinfo>".$dateformat."-".$zero."".$zero."".$zero."-".$row['Stud_SID'];
echo "<td class=studentinfo>".$row['FNAME']." ".$row['MNAME']." ".$row['LNAME'];
echo "<td class=studentinfo>".$row['USERNAME'];
echo "<td class=studentinfo>".$row['EMAIL'];
echo "<td class=studentinfo>".$row['LEVEL'];
echo "<td class=studentinfo> <a href='studentupdate.php?ID=".$row['Stud_SID']."'> Update </a>";
echo "<td class=studentinfo> <a href='studentdelete.php?ID=".$row['Stud_SID']."'> Archive </a>";
echo "<td class=studentinfo> <a href='index.php'?ID=".$row['Stud_SID']."'> Send Email </a>";

}	
}else{
echo "<p class=empty>SELECT GRADE LEVEL AND SECTION</p>";
}
?>


</div>
</form>
</body>
</html>
