<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../login.php");
			 exit;
		 }else if(isset($_SESSION['Employee_ID']))
			{
				$userid = $_SESSION['Employee_ID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacherinfo WHERE Employee_ID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Updating Account',NOW())";
			$result1 = $config->query($sql1);

?>
<?php
include "../../sepi_connect.php";
if(!$config->connect_error){
	echo "Connected";
}
if(isset($_POST['upacc'])){
$ACIDIC = $_POST['ACIDIC'];
$UNAMES = $_POST ['UNAMES'];
$PWORDS = $_POST ['PWORDS'];



$sql = "Update tbl_teacherinfo SET TID='$ACIDIC', EMAIL='$UNAMES', PASS='$PWORDS' where TID='$ACIDIC'";

$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Update")
</script>
<?php
header("refresh:0;url=viewaccsup.php");
}else{
	echo $conn->error;
}
}
?>
