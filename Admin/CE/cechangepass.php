<?php
	include "../../sepi_connect.php";
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
			$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Account',NOW())";
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
<p class="displayname"> <?php echo "$type" ?> | <?php echo "$name" ?> </p>

<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
			<form method=POST action="cechangepass.php">

			<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="../dashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="../announceview.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="../student.php" class="Student"><img src="../../Images/studrecord.png" class="studenticon">Student</a>
			<a href="../teacher.php" class="Teacher"><img src="../../Images/studrecord.png" class="teachericon">Teacher</a>
			<a href="../accounts.php" class="Accounts"><img src="../../Images/account.png" class="accounticon">Admin</a>
			<a href="../adchangepass.php" class="Changepassadmin"><img src="../../Images/pass.png" class="archiveicon">Account</a>
			<a href="../audit.php" class="Audit"><img src="../../Images/mag.png" class="auditicon">Audit Trail</a>
			<a href="../Archive/archive.php" class="Archive"><img src="../../Images/arc.png" class="archiveicon">Archive</a>
			<a href="../grade.php" class=""><img src="" class="">Grades</a>
			<a href="../grading.php" class=""><img src="" class="">Grading Policy</a>
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
	
    $result = mysqli_query($config, "SELECT *from tbl_teacherinfo WHERE Employee_ID='" . $userid . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["PASS"] && $_POST["newPassword"] == $_POST["confirmPassword"]) {
		
        mysqli_query($config, "UPDATE tbl_teacherinfo set PASS='" . $_POST["newPassword"] . "' WHERE Employee_ID='" . $userid . "'");
	
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
