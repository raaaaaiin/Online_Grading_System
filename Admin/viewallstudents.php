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
				<h1 id="studentfont">STUDENT INFORMATION</h1>
				<a href="studentadd.php" name="addstudent"><img src="../Images/add_icon.png" class="addstudentbtnviewall"></a>
				<hr>
				<p class="searchstudent">Search:</p>
				<input type=text name=search class="studenttxtviewall">
				
				
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
<input type=submit name=sub class="studentbtnviewall"> 
</form>
<form method='POST' action='index.php'>
				<a href="student.php" class="returnviewallbtn">Return</a>
				<a href="import.php" class="massupdbtnviewall">Mass Upload</a>



<?php
include "../sepi_connect.php";

if(isset($_POST['sub'])){
	$search = $_POST['search'];
	$category = $_POST['category'];
	if($category != NULL){
	$sql = "SELECT * FROM tbl_studentinfo where LEVEL = '$category'";
	
	}
	else{
		$sql = "SELECT * FROM tbl_studentinfo ";
		
		}
	if($search !=NULL){
	$sql = "SELECT * FROM tbl_studentinfo where Stud_SID LIKE '%$search%' or 
											FNAME LIKE '%$search%' or
											LNAME LIKE '%$search%' or
											USERNAME LIKE '%$search%' or
											EMAIL LIKE '%$search%'";
	}
	}else{
	$sql = "SELECT * FROM tbl_studentinfo";
	
	}
	
	
$result = $config->query($sql);
echo"<div class=studenttbl2 style=overflow:auto;>";

echo "<table class=studenttbl1>";
echo "<tr>";
echo "<th Class=studentheader4>Select";
echo "<th Class=studentheader4>STUDENT ID";
echo "<th Class=studentheader4>NAME";
echo "<th Class=studentheader4>USERNAME";
echo "<th Class=studentheader5>EMAIL";
echo "<th Class=studentheader4>BIRTHDAY";
echo "<th Class=studentheader4>AGE";
echo "<th Class=studentheader4>ADDRESS";
echo "<th Class=studentheader4>GENDER";
echo "<th Class=studentheader4>LEVEL";
echo "<th Class=studentheader4>YEAR";
echo "<th Class=studentheader4 colspan=3>ACTION";
echo "</tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
		$zero = 0;
		$zero1 = 0;
		$zero2 = 0;
		$date=date_create("2023");
		$dateformat=date_format($date,"y");
        echo "<tr>";
        echo "<td class=studentinfo><input type='checkbox' name='teacher[]' value='" . $row['EMAIL'] . "'>";
        echo "<td class=studentinfo>" . $dateformat . "-" . $zero . "" . $zero1 . "" . $zero2 . "-" . $row['Stud_SID'];
        echo "<td class=studentinfo>" . $row['FNAME'] . " " . $row['MNAME'] . " " . $row['LNAME'];
        echo "<td class=studentinfo>" . $row['USERNAME'];
        echo "<td class=studentinfo>" . $row['EMAIL'];
        echo "<td class=studentinfo>" . $row['BDAY'];
        echo "<td class=studentinfo>" . $row['AGE'];
        echo "<td class=studentinfo>" . $row['ADDRESS'];
        echo "<td class=studentinfo>" . $row['GENDER'];
        echo "<td class=studentinfo>" . $row['LEVEL'];
        echo "<td class=studentinfo>" . $row['YEAR'];
        echo "<td class=studentinfo> <a href='studentupdate.php?ID=" . $row['Stud_SID'] . "'> Update </a>";
        echo "<td class=studentinfo> <a href='studentdelete.php?ID=" . $row['Stud_SID'] . "'> Archive </a>";
        echo "<td class=studentinfo> <a href='viewstudgrades.php?ID=" .$row['Stud_SID'] . "'> View Grades </a>";
		echo "</tr>";
		}
		} else {
		echo "<tr><td colspan='12'>No records found.</td></tr>";
		}
		echo "</table>";
		echo "<input type='submit' name='emailButton' value='EMAIL' class='emailButton'>";
		echo "</form>";
		
		?>



</div>
</form>
</body>
</html>