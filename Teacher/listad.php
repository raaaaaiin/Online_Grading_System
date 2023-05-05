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
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacherinfo WHERE Employee_ID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing Update Student List',NOW())";
			$result1 = $config->query($sql1);

?>
<?php
		include "../../sepi_connect.php";
			
?>
<html>
<body>
<head>
<title>Announcement</title>
</head>
<link rel="icon" href="">
<link rel="stylesheet" href="">
<body style="background-color:#E5E4E2">
<div class="header">


<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">© 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
<form method=POST action="announcead.php">


				<div class="announceadddiv">
					<h1 id="announceaddfont">ADD ANNOUNCEMENT</h1>
					<hr class="announceaddline">
					
					<input type="file" name="images" value="Choose File">

<input type=submit name=sub value="Add" class="addannouncebtn">
<a href="list.php" class="addannounceback">Back</a>	

</form>

</body>
</html>
<?php
include "../../sepi_connect.php";

if(isset($_POST['sub'])){

	
$announcement = $_POST['announce'];
$date = $_POST['date'];
$upload = $_POST['images'];
$sql = "Insert into tbl_announce (ANNOUNCEMENT,DATE,image) values  
('$announcement','$date','$upload')";
$insert = $config->query($sql);


// Display status message
echo $statusMsg;
if($insert == True){
?>
<script>
alert("Successfully Added")

</script>

<?php
header("refresh:0;url=announceview.php");
}else{
	echo $config->error;
}
}
	
?>
