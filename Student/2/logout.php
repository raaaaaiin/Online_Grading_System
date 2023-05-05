<?php
	include "../../sepi_connect.php";

session_start();
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../Index.php");
			 exit;
		 }else if(isset($_SESSION['Stud_SID']))
			{
				$userid = $_SESSION['Stud_SID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_studentinfo WHERE Stud_SID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					$type = $rowedit['FNAME']." ".$rowedit['LNAME'];
					$types = $rowedit['Role'];
					
					$name = $rowedit['FNAME']." ".$rowedit['LNAME'];
				}
			}
			$sql1 = "Insert into tbl_auditstudent (e_name,e_action,e_date) values ('$name','Logging Out',NOW())";
			$result1 = $config->query($sql1);
if(isset($_POST['logout']))
{
	#$viewloginl = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Logged out',NOW())";
	
	#$result1 = $config->query($viewloginl);
	session_destroy();
	unset($_SESSION['Stud_SID']);
	header('Location:../../Index.php');

}
?>
