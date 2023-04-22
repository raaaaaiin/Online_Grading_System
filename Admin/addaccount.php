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
	$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Adding Admin Account',NOW())";
	$result1 = $config->query($sql1);
			
?>
<html>
	<head> 
		<title>Add Admin</title>
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
			<form method="POST" action="addaccount.php">
		<?php
		include_once('SideNav.php');
		?>
				<div class="addaccountdiv">
					<h1 id="addaccountfont">ADD ADMIN ACCOUNT</h1>
					<hr class="addaccountline">
					<input type="text" name="fname" placeholder="FIRST NAME" autocomplete="off" size="30" required class="addaccountfnamefield">
					<input type="text" name="mname" placeholder="MIDDLE INITIAL" autocomplete="off" size="30" required class="addaccountmnamefield">
					<input type="text" name="lname" placeholder="LAST NAME" autocomplete="off" size="50" required class="addaccountlnamefield">
					<select name="genders" class="addaccountgenderfield" required>
					<option value="">----------GENDER----------</option>
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Others">Others</option>
					</select>
					<input type="text" name="address" placeholder="ADDRESS" autocomplete="off" size="11" required class="addaccountlocfield">
		
						<select id="addaccrole" name="role" value="Admin" hidden>
					<option value="Admin">Admin</option>

						</select>
			
<input type=submit name=subs value="Add Admin" class="addadminaccbtn">
<a href="accounts.php" class="addadminaccback">Back</a>	
<?php
	include "../sepi_connect.php";

if(isset($_POST['subs']))
	{
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Adding Admin Account',NOW())";
	$result1 = $config->query($sql1);
		$fname = $_POST['fname'];
		$mname = $_POST['mname'];
		$lname = $_POST['lname'];
		$gender = $_POST['genders'];
		$address = $_POST['address'];
		$role = $_POST['role'];
		$username = $fname."".$lname;
		$email = $fname."".$lname."@admin.sepi.edu.ph";
		$yearss = date("Y");




$check = mysqli_query($config,"select * from tbl_sepi_account where Fname='$fname' and Mname='$mname' and Lname='$lname'");
$checkrows = mysqli_num_rows($check);
if($checkrows>0) 
	{
	?>
	<script>
	alert("Admin already exists")
	</script>
	<?php
	} 
else
	{  
$sql = "Insert into tbl_sepi_account (Fname,Mname,Lname,Username,Email,Password,Gender,Address,Role,Hdate) values  
('$fname','$mname','$lname','$username','$email','$yearss','$gender','$address','$role',NOW())";
$insert = $config->query($sql);
if($insert == True){
?>
<script>
alert("Successfully Added")
</script>
<?php
header("refresh:0;url=accounts.php");
}else{
	echo $config->error;
}
}
}
?>
				</div>

</form>

</body>
</html>













