<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../login.php");
			 exit;
		 }else if(isset($_SESSION['Stud_ID']))
			{
				$userid = $_SESSION['Stud_ID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_studentinfo WHERE Stud_ID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAME']." ".$rowedit['LNAME'];
				}
			}
			$sql1 = "Insert into tbl_auditstudent (e_name,e_action,e_date) values ('$name','Updating Account',NOW())";
			$result1 = $config->query($sql1);
if(isset($_POST['upacc'])){
$ACIDIC = $_POST['ACIDIC'];
$UNAMES = $_POST ['UNAMES'];
$PWORDS = $_POST ['PWORDS'];
$currentPassword = $_POST ['currentPassword'];
$confirmPassword = $_POST ['confirmPassword'];

if(count($_POST)>0) {
$result = mysqli_query($config,"SELECT *from tbl_studentinfo WHERE Stud_ID='" . $userid . "'");

$row=mysqli_fetch_array($result);
if($_POST["currentPassword"] == $row["PASS"] && $_POST["PWORDS"] == $row["confirmPassword"] ) {
	mysqli_query($config,"UPDATE tbl_studentinfo set PASS='" . $_POST["PWORDS"] . "' WHERE Stud_ID='" . $userid . "'");
	$message = "Password Changed Sucessfully";
	} else{
	 $message = "Password is not correct";
	}
}

if($result == True){
?>
<script>
alert("Successfully Update")
</script>
<?php
header("refresh:0;url=updateacc.php");
}else{
	echo $conn->error;
}
}
?>
