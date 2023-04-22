<?php
	include "../../sepi_connect.php";

session_start();
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../Index.php");
			 exit;
		 }else if(isset($_SESSION['Acc_ID']))
			{
				$userid = $_SESSION['Acc_ID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_sepi_account WHERE Acc_ID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					$type = $rowedit['Fname']." ".$rowedit['Lname'];
					$types = $rowedit['Role'];
					
					$name = $rowedit['Fname']." ".$rowedit['Lname'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Logging Out',NOW())";
			$result1 = $config->query($sql1);
if(isset($_POST['logout']))
{
	#$viewloginl = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Logged out',NOW())";
	
	#$result1 = $config->query($viewloginl);
	session_destroy();
	unset($_SESSION['Acc_ID']);
	header('Location:../../Index.php');

}
?>
