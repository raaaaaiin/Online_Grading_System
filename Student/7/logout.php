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
					$subject = $rowedit['SUBJECT'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Log Out',NOW())";
			$result1 = $config->query($sql1);
if(isset($_POST['logout']))
{
	#$viewloginl = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Logged out',NOW())";
	
	#$result1 = $config->query($viewloginl);
	session_destroy();
	unset($_SESSION['TID']);
	header('Location:../../Index.php');

}
?>