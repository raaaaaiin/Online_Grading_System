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
$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Updating Teacher Information',NOW())";
$result1 = $config->query($sql1);

if(isset($_POST['subs'])){
$TID = $_POST['TID'];
$FNAME = $_POST['FNAME'];
$MNAME = $_POST['MNAME'];
$LNAME = $_POST['LNAME'];
$ADDRESS = $_POST['ADDRESS'];
$BDAY = $_POST['BDAY'];
$AGE = $_POST['AGE'];
$GENDER = $_POST['GENDER'];
$subject1 = !empty($_POST['subject'])?$_POST['subject']:" ";
$subject2 = !empty($_POST['subjecto'])?$_POST['subjecto']:" ";
$subject3 = !empty($_POST['subjectt'])?$_POST['subjectt']:" ";
$subject4 = !empty($_POST['subjectth'])?$_POST['subjectth']:" ";
$subject5= !empty($_POST['subjectf'])?$_POST['subjectf']:" ";
$subject6 = !empty($_POST['subjectfi'])?$_POST['subjectfi']:" ";
$subject7 = !empty($_POST['subjects'])?$_POST['subjects']:" ";
$subject8 = !empty($_POST['subjectse'])?$_POST['subjectse']:" ";
$subject9 = !empty($_POST['subjecte'])?$_POST['subjecte']:" ";


$sql = "Update tbl_teacher SET TID='$TID', 
								FNAMES='$FNAME', 
								MNAMES='$MNAME',
								LNAMES='$LNAME',
								ADDRESS='$ADDRESS',
								BDAYS='$BDAY',
								AGES='$AGE',
								GENDERS='$GENDER',
								SUBJECT='$subject1', 
								SUBJECTO='$subject2', 
								SUBJECTT='$subject3' ,
								SUBJECTTH='$subject4' ,
								SUBJECTF='$subject5' ,
								SUBJECTFI='$subject6' ,
								SUBJECTS='$subject7' ,
								SUBJECTSE='$subject8' ,
								SUBJECTE='$subject9' 
								
								
								
								where TID='$TID'";

$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Update")

</script>
<?php
header("refresh:0;url=teacher.php");

}else{
	echo $conn->error;
}
}
?>