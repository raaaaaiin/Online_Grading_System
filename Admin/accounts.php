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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Admin Account',NOW())";
		$result1 = $config->query($sql1);

if(isset($_POST['search'])){
$search = $_POST['search'];

if ($search != NULL){
$sql = "Select * from tbl_sepi_account where Acc_ID like '%$search%' or 
										Fname like '%$search%' or 
										Lname like '%$search%' or 
										Username like '%$search%' or 
										Gender like '%$search%' or 
										Address like '%$search%' or 
										Role like '%$search%'";

}else{

$sql = "Select * from tbl_sepi_account";
}
}else{

$sql = "Select * from tbl_sepi_account";
}
?>

<!DOCTYPE html>
<html>
	<head> 
		<title>Admin</title>
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
<form method="POST" action="accounts.php">
		<?php
		include_once('SideNav.php');
		?>
	<div class="accountsdiv">
		<h1 id="accountsfont">ADMIN INFORMATION</h1>
			<a href="addaccount.php" name=addsupplier><img src="../Images/add_icon.png" class="addaccountsbtn"></a>
		<hr>
		<p class="searchaccounts">Search:</p>
		<input type=text name=search class="accountstxt">
		<input type=submit name=sub class="accountsbtn"> 
		
<?php
$result = $config -> query($sql);

if ($result -> num_rows > 0){
	echo"<div class=accountstbl style=overflow:auto;>";
	echo"<table class=accountstbl1>";
	echo "<tr>";
	echo "<th Class=accountsheader1>ID";
	echo "<th Class=accountsheader>NAME";
	echo "<th Class=accountsheader>USERNAME";
	echo "<th Class=accountsheader1>GENDER";
	echo "<th Class=accountsheader>ADDRESS";
	echo "<th Class=accountsheader1>ROLE";
	echo "<th Class=accountsheader1>ADD DATE";
	echo "<th class=accountsheader1 colspan=2>ACTION";
	
	while($row = $result -> fetch_assoc()){
$zero = 0;
    $tz_object = new DateTimeZone('Brazil/East');
	$datetime = new DateTime();
    $datetime->setTimezone($tz_object);
    $dateformat = date_format($datetime,"y");


echo "<tr>";
echo "<td class=accountsinfo>".$zero."".$zero."".$dateformat."-".$zero."".$zero."".$zero."-".$row['Acc_ID'];
	echo "<td class=accountsinfo>".$row['Fname']." ".$row['mname']." ".$row['Lname'];
	echo "<td class=accountsinfo>".$row['Username'];
	echo "<td class=accountsinfo>".$row['Gender'];
	echo "<td class=accountsinfo>".$row['Address'];
	echo "<td class=accountsinfo>".$row['Role'];
	echo "<td class=accountsinfo>".$row['Hdate'];
	echo "<td class=accountsinfo><center> <a href='accountupdate.php?ID=".$row['Acc_ID']."'> Update </a></center>";
	echo "<td class=accountsinfo><center> <a href='deleteaccount.php?ID=".$row['Acc_ID']."'> Archive </a></center>";
}
		echo "</table>";
	}
	else
	{
		echo "The record is not found";			
	}
	?>	
</div>


</form>
</body>
</html>