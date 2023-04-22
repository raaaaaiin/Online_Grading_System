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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Retrieve Teacher Records',NOW())";
		$result1 = $config->query($sql1);
$ID=$_GET['ID'];
$sql = "INSERT INTO tbl_teacher SELECT * FROM tbl_archive_teacher WHERE TID = '$ID'";
$result = $config->query($sql);
if($result == True)
{
	$query = "DELETE FROM tbl_archive_teacher WHERE TID = '$ID'";
	if ($config->query($query) == TRUE) {
?>
<script>
alert("Successfully Retrieve")
</script>
<?php
header("refresh:0;url=teacherarchive.php");
}
}
else
{
echo "";
}

?>