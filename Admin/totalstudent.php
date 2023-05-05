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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Total of Students',NOW())";
		$result1 = $config->query($sql1);

if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
$sql = "Select * from tbl_studentinfo where Stud_SID like '%$search%' or 
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

$sql = "Select * from tbl_studentinfo";
}
}else{

$sql = "Select * from tbl_studentinfo";
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

		<div class="dashboard">
			<img src="../Images/logo.png" class="dashboardlogocvgs">
			
            <a href="../Admin/dashboard.php" class="Returnarchive">Return</a>
		</div>

<div class="studentdiv">
				<h1 id="studentfont">TOTAL OF STUDENTS</h1>
				<a href="studentadd.php" name="addstudent" class="addstudentbtn"></a>
				<hr>
				<p class="searchstudent">Search:</p>
				<input type=text name=search class="studenttxt">
				<input type=submit name=sub class="studentbtn"> 

<?php
include "../sepi_connect.php";


$result = $config -> query($sql);
if($result -> num_rows > 0){
echo"<div class=studenttbl style=overflow:auto;>";
echo"<table class=studenttbl1>";
echo "<tr>";
echo "<th Class=studentheader>STUDENT ID";
echo "<th Class=studentheader1>NAME";
echo "<th Class=studentheader1>LEVEL";



while($row = $result -> fetch_assoc()){
echo "<tr>";
echo "<td class=studentinfo>".$row['Stud_ID'];
echo "<td class=studentinfo>".$row['FNAME']." ".$row['MNAME']." ".$row['LNAME'];
echo "<td class=studentinfo>".$row['LEVEL'];

	

}	
}else{
echo "Empty";
}
?>


</div>
</form>
</body>
</html>
