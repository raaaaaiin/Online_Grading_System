<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../login.php");
			 exit;
		 }else if(isset($_SESSION['TID']))
			{
				$userid = $_SESSION['TID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacher WHERE TID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
					$subject = $rowedit['SUBJECTFI'];
				}
			}
			$sql1 = "Insert into tbl_auditstudent (e_name,e_action,e_date) values ('$name','Viewing Account',NOW())";
			$result1 = $config->query($sql1);

?>
<!DOCTYPE html>
<html>
<head> 
<title> Update Profile</title>
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
			<form method=POST action="tlechangepass.php">

			<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="tledashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="tleannounce.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="tlefirst.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="tlelist.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="tlechangepass.php"  class="Accounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>
		</div>
<div class="viewaccdiv">
				<h1 id="announcemetfont">CHANGE PASSWORD</h1>
				<hr id=line>
<div><?php if(isset($message)) { echo $message; } ?></div>
<form method="post" action="" align="center">
<input type="password" name="currentPassword" required placeholder="Current password" class=currentpass><span id="currentPassword" class="required"  required ></span>
<input type="password" name="newPassword" required placeholder="New password" class=newpass><span id="newPassword" class="required" required ></span>
<input type="password" name="confirmPassword" required placeholder="Confirm password" class=confirmpass><span id="confirmPassword" class="required" required ></span>
<input type="submit" name='submit' class=viewaccsubmit>


<?php
		include "../../sepi_connect.php";

if (isset($_POST['submit']))
{
	global $confirmPassword;
	
    $result = mysqli_query($config, "SELECT *from tbl_teacher WHERE Employee_ID='" . $userid . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["PASS"] && $_POST["newPassword"] == $_POST["confirmPassword"]) {
		
        mysqli_query($config, "UPDATE tbl_teacher set PASS='" . $_POST["newPassword"] . "' WHERE Employee_ID='" . $userid . "'");
	
        ?>
			<script>
				alert("Passsword Change")
			</script>
			
			<?php
			
	
    }else
	{
			?>
			<script>
				alert("Incorrect Passsword")
			</script>
			<?php
}
}



?>



</div>
</body>
</html>
