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
	$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Updating Admin Announcement',NOW())";
	$result1 = $config->query($sql1);


$AID = $_GET['ID'];
$sql="Select *from tbl_announce where AID = '$AID'";
$result = $config->query($sql);

$row = $result->fetch_assoc();
$AAID = $row['AID'];
$ANNOUNCE = $row ['ANNOUNCEMENT'];
$date = $row ['DATE'];
$fileToUpload = $row['image'];


	echo $config->error;
?>
<html>
<head> 
<title>Update Announcement</title>
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
<form method=POST action="announceupdate2.php">
		<?php
		include_once('SideNav.php');
		?>
				<div class="updannouncediv">
					<h1 id="updannouncefont">UPDATE ANNOUNCEMENT</h1>
					<hr class="updannounceline">
					<p id=aidupd>ID</p>					
					<input type=text name=AIDS value="<?php echo $AAID; ?>" readonly class=aidupd>
					<p id=announceupd>ANNOUNCEMENT</p>					
					<input type=text name=ANN value="<?php echo $ANNOUNCE; ?>" class=announceupd>
					<p id=dateupd>DATE</p>					
					<input type=date name=DATE value="<?php echo $date; ?>" class=dateupd>
					<input type="file" name="fileToUpload" value="<?php echo $fileToUpload; ?>" class="updateaddimageannouncement">
					<br>
					<input type=submit name=subs value="Update" class="aupdannouncebtn">
					<a href="announceview.php" class="updannounceback">Back</a>	

</form>
</body>

</html>