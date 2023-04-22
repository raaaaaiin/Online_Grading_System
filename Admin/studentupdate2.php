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
		   $sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Updating Student Information',NOW())";
	$result1 = $config->query($sql1);


if(isset($_POST['subs'])){
$SID = $_POST['Stud_SID'];
$FNAME = $_POST['FNAME'];
$MNAME = $_POST['MNAME'];
$LNAME = $_POST['LNAME'];
$USERNAME = $FNAME."".$LNAME;
$EADDRESS = $_POST['EMAIL'];
$ADDRESS = $_POST['ADDRESS'];
$BDAY = $_POST['BDAY'];
$AGE = $_POST['AGE'];
$GENDER = $_POST['GENDER'];
$LEVEL = $_POST['LEVEL'];



$sql = "Update tbl_student SET FNAME='$FNAME', 
								MNAME='$MNAME',
								LNAME='$LNAME',
								USERNAME='$USERNAME',
								ADDRESS='$ADDRESS',
								EMAIL='$EADDRESS',
								BDAY='$BDAY',
								AGE='$AGE',
								GENDER='$GENDER',
								LEVEL='$LEVEL'
								where Stud_SID='$SID'";

$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Update")
</script>
<?php
header("refresh:0;url=student.php");

}else{
	echo $conn->error;
}
}
?>