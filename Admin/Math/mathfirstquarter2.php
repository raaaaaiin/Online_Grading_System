<?php
	include "../../sepi_connect.php";
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
			$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Grades Inputted',NOW())";
			$result1 = $config->query($sql1);


if(isset($_POST['entgrade'])){

$ASID = $_POST['ASID'];


$LMATH = $_POST['LMATH'];




$sql = "Update tbl_studentinfo SET Stud_SID='$ASID', MATH='$LMATH' where Stud_SID='$ASID'";

$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Insert Grade")
</script>
<?php
header("refresh:0;url=mathfirst.php");
}else{
	echo $config->error;
}
}
?>