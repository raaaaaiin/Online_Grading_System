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
					$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Adding Admin Announcement',NOW())";
					$result1 = $config->query($sql1);
			
?>
<!DOCTYPE html>

<html>
<head> 
<title>Add Announcement</title>
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
<form method=POST action="announcead.php" enctype="multipart/form-data">
		<div class="dashboard">
			<img src="../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboard.php" class="Dashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announceview.php" class="Announcement"><img src="../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="student.php" class="Student"><img src="../Images/studrecord.png" class="studenticon">Student</a>
			<a href="teacher.php" class="Teacher"><img src="../Images/studrecord.png" class="teachericon">Teacher</a>
			<a href="accounts.php" class="Accounts"><img src="../Images/account.png" class="accounticon">Admin</a>
			<a href="adchangepass.php" class="Changepassadmin"><img src="../Images/pass.png" class="archiveicon">Account</a>
			<a href="audit.php" class="Audit"><img src="../Images/mag.png" class="auditicon">Audit Trail</a>
			<a href="../Archive/archive.php" class="Archive"><img src="../Images/arc.png" class="archiveicon">Archive</a>
			<a href="grade.php" class=""><img src="" class="">Grades</a>
			<a href="grading.php" class=""><img src="" class="">Grading Policy</a>
		</div>

				<div class="announceadddiv">
					<h1 id="announceaddfont">ADD ANNOUNCEMENT</h1>
					<hr class="announceaddline">
					<input type="text" name="announce" placeholder="ANNOUNCEMENT" autocomplete="off" size="50"  class="addannouncemntfield"><br>
					<input type="date" name="date" autocomplete="off" size="50"  class="adddatfield"><br>
					<input type="file" name="fileToUpload" id="fileToUpload" value="Choose File" class="addimage"><br>

<input type=submit name=sub value="Add" class="addannouncebtn">
<a href="announceview.php" class="addannounceback">Back</a>	

</form>

</body>
</html>
<?php
include "../sepi_connect.php";



if(isset($_POST['sub']) && isset($_FILES['fileToUpload'])){
	echo "<pre>";
	print_r($_FILES['fileToUpload']);
	echo "</pre>";

	$img_name = $_FILES['fileToUpload']['name'];
	$img_size = $_FILES['fileToUpload']['size'];
	$tmp_name = $_FILES['fileToUpload']['tmp_name'];
	$error = $_FILES['fileToUpload']['error'];



if ($error === 0) {
	if ($img_size > 12500000) {
		$em = "Sorry, your file is too large.";
		header("Location: announceview?error=$em");
	}else {
		$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
		$img_ex_lc = strtolower($img_ex);

		$allowed_exs = array("jpg", "jpeg", "png"); 

		if (in_array($img_ex_lc, $allowed_exs)) {
			$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
			$img_upload_path = '../uploads/'.$new_img_name;
			move_uploaded_file($tmp_name, $img_upload_path);

			// Insert into Database
			$announcement = $_POST['announce'];
			$date = $_POST['date'];
			$sql = "Insert into tbl_announce (ANNOUNCEMENT,DATE,image) values  
			('$announcement','$date','$new_img_name')";
			$insert = $config->query($sql);
			header("Location: announceview.php");
		}else {
			$em = "You can't upload files of this type";
			header("Location: announceview.php?error=$em");
		}
	}

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
}

?>