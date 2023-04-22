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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Archive Admin Account',NOW())";
		$result1 = $config->query($sql1);
?>
<?php
	include "../sepi_connect.php";
error_reporting(0);

$ID=$_GET['ID'];
$sql = "INSERT INTO tbl_archive_account SELECT * FROM tbl_sepi_account WHERE Acc_ID = '$ID'";
		$viewloginl = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('briandemesa','Archived a record in Account',NOW())";
		$result1 = mysqli_query($config,$viewloginl);
$result = $config->query($sql);
if($result == True)
{
	$query = "DELETE FROM tbl_sepi_account WHERE Acc_ID = '$ID'";
	if ($config->query($query) == TRUE) 
	{
		?>
		<script>
		alert("Successfully Deleted")
		</script>
		<?php
		header("refresh:0;url=accounts.php");
	}
}
else
{
echo "";
}

?>