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
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacherinfo WHERE TID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))

					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
					$subject = $rowedit['SUBJECTF'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing 1st Quarter Grades',NOW())";
			$result1 = $config->query($sql1);
?>
<html>
<head> 
<title> Fourth Quarter</title>
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
<form method=POST action="apfourth.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
						<a href="dashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announce.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="first.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="list.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="changepass.php"  class="Accounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>
		</div>
<div class="announcementdiv">
				<h1 id="announcemetfont">4TH QUARTER GRADES</h1>
				<input type="button" onclick="printDiv('printableArea')" value="PRINT" />
				<hr id=line>
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="gradetxt">

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
<input type=submit name=sub class="gradebtn"> 
				<a href="first.php" class="firstquarter">First Quarter</a>
				<a href="second.php" class="secondquarter">Second Quarter</a>
				<a href="third.php" class="thirdquarter">Third Quarter</a>
				<a href="fourth.php" class="fourthquarter">Fourth Quarter</a>



</body>
</html>
<div id=printableArea>
<?php
			include "../../sepi_connect.php";
			if(isset($_POST['sub'])){
				$search = $_POST['search'];
				$category = $_POST['category'];
				if($category != NULL){
				$sql = "SELECT * FROM tbl_studentinfo where LEVEL = '$category'";
				
				}
				else{
					$sql = "SELECT * FROM tbl_studentinfo ORDER BY Stud_SID DESC LIMIT 0";
					
					}
				if($search !=NULL){
				$sql = "SELECT * FROM tbl_studentinfo where Stud_SID LIKE '%$search%' or 
														FNAME LIKE '%$search%' or
														LNAME LIKE '%$search%' or
														USERNAME LIKE '%$search%' or
														EMAIL LIKE '%$search%'";
				}
				}else{
				$sql = "SELECT * FROM tbl_studentinfo ORDER BY Stud_SID DESC LIMIT 0";
				
				}

$result = $config -> query($sql);
if($result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";
	echo "<th Class=gradeheader>Student ID: ";
	echo "<th Class=gradeheader>NAME: ";
	echo "<th Class=gradeheader>Yr Level & Section: ";
	echo "<th Class=gradeheader>Grade: ";
	echo "<th Class=gradeheader>Email: ";
	echo "<th Class=gradeheader>Enter Grade: ";
	echo "<th Class=gradeheader>Send Email: ";
while($row = $result -> fetch_assoc()){
	$zero = 0;
$zero1 = 0;
$zero2 = 0;
$date=date_create("2023");
$dateformat=date_format($date,"y");
echo "<tr>";
echo "<td class=gradeinfo>".$dateformat."-".$zero."".$zero1."".$zero2."-".$row['Stud_SID'];
echo "<td class=gradeinfo>".$row['FNAME']."".$row['MNAME']."".$row['LNAME'];
echo "<td class=gradeinfo>".$row['LEVEL'];
echo "<td class=gradeinfo>".$row['APF'];
echo "<td class=gradeinfo>".$row['EMAIL'];
echo "<td class=gradeinfo> <a href='apfourthquarter.php?ID=".$row['Stud_SID']."'> Input Grade </a>";
echo "<td class=gradeinfo> <a href='index.php?ID=".$row['Stud_SID']."'> Send Email </a>";




	

}	
}else{
	echo "<p class=empty>SELECT GRADE LEVEL AND SECTION</p>";
}
?>

</div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>