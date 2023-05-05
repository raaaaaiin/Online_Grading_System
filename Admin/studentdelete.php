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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Student Archive Information',NOW())";
		$result1 = $config->query($sql1);
        ?>
<?php
	include "../sepi_connect.php";
error_reporting(0);

$ID=$_GET['ID'];
$sql = "INSERT INTO tbl_archive_student SELECT * FROM tbl_studentinfo WHERE Stud_SID = '$ID'";
	
$result = $config->query($sql);
if($result == True)
{
	$query = "DELETE FROM tbl_studentinfo WHERE Stud_SID = '$ID'";
	if ($config->query($query) == TRUE) 
	{
		?>
		<script>
		alert("Successfully Deleted")
		</script>
		<?php
		header("refresh:0;url=student.php");
	}
}
else
{
echo "";
}

?>