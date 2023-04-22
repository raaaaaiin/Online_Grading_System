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
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacher WHERE Employee_ID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Updaitng Student List',NOW())";
			$result1 = $config->query($sql1);

?>
<?php
include "../../sepi_connect.php";

if(isset($_POST['subs'])){
$SID = $_POST['Stud_SID'];
$STUDID = $_POST['STUDID'];
$FNAME = $_POST['FNAME'];
$MNAME = $_POST['MNAME'];
$LNAME = $_POST['LNAME'];
$ADDRESS = $_POST['ADDRESS'];
$BDAY = $_POST['BDAY'];
$AGE = $_POST['AGE'];
$GENDER = $_POST['GENDER'];
$LEVEL = $_POST['LEVEL'];
$YEAR = $_POST['YEAR'];
$LRN = $_POST['LRN'];


$sql = "Update tbl_student SET FNAME='$FNAME', 
								MNAME='$MNAME',
								LNAME='$LNAME',
								ADDRESS='$ADDRESS',
								BDAY='$BDAY',
								AGE='$AGE',
								GENDER='$GENDER',
								LEVEL='$LEVEL',
								YEAR='$YEAR', 
								LRN='$LRN' where Stud_SID='$SID'";

$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Update")
</script>
<?php
header("refresh:0;url=list.php");
}else{
	echo $conn->error;
}
}
?>
