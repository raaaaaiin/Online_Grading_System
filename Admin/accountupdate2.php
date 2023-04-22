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
	$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Updating Admin Account',NOW())";
	$result1 = $config->query($sql1);

if(isset($_POST['subs'])){
$TID = $_POST['ID'];
$FNAME = $_POST['FNAME'];
$MNAME = $_POST['MNAME'];
$LNAME = $_POST['LNAME'];
$USERNAME = $FNAME."".$LNAME;
$GENDER = $_POST['GENDER'];
$ADDRESS = $_POST['ADDRESS'];


$sql = "Update tbl_sepi_account SET Fname='$FNAME', 
								mname='$MNAME',
								Lname='$LNAME',
								Username = '$USERNAME',
								Gender='$GENDER',
								Address='$ADDRESS' where Acc_ID='$TID'";

$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Update")

</script>
<?php
header("refresh:0;url=accounts.php");

}else{
	echo $conn->error;
}
}
?>