

<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../login.php");
			 exit;
		 }else if(isset($_SESSION['Stud_SID']))
			{
				$userid = $_SESSION['Stud_SID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_student WHERE Stud_SID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					$name = $rowedit['FNAME']." ".$rowedit['LNAME'];
					$section = $rowedit['LEVEL'];
				}
			}
			$sql1 = "Insert into tbl_auditstudent (e_name,e_level,e_action,e_date) values ('$name','$section','Viewing Stundent Account',NOW())";
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

<p class="displayname"><?php echo "$name" ?> &nbsp&nbsp | &nbsp&nbsp <?php echo "$section" ?></p>
<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
			<form method=POST action="viewacc.php">

<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboardstudent.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcementstudent.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="viewacc.php" class="Accountstudent"><img src="../../Images/pass.png" class="accounticon">Account</a>
			<a href="finalgrade.php" class="Gradesstudent"><img src="../../Images/studgrade.png" class="teachericon">Grades</a>
		</div>	
<div class="viewaccdiv">
				<h1 id="announcemetfont">CHANGE PASSWORD</h1>
				<hr id=line>
				
<div><?php if(isset($message)) { echo $message; } ?></div>
<form method="post" action="" align="">
<input type="password" name="currentPassword" required placeholder="Current password" class=currentpass><span id="currentPassword" class="required"  required ></span>
<input type="password" name="newPassword" required placeholder="New password" class=newpass><span id="newPassword" class="required" required ></span>
<input type="password" name="confirmPassword" required placeholder="Confirm password" class=confirmpass><span id="confirmPassword" class="required" required ></span>

<input type="submit" name='submit' class=viewaccsubmit>


<?php

if (isset($_POST['submit']))
{
	global $confirmPassword;
	
    $result = mysqli_query($config, "SELECT *from tbl_student WHERE Stud_SID='" . $userid . "'");
    $row = mysqli_fetch_array($result);
    if ($_POST["currentPassword"] == $row["PASS"] && $_POST["newPassword"] == $_POST["confirmPassword"]) {
		
        mysqli_query($config, "UPDATE tbl_student set PASS='" . $_POST["newPassword"] . "' WHERE Stud_SID='" . $userid . "'");
	
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
