<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../login.php");
			 exit;
		 }else if(isset($_SESSION['TID']))
			{
				$userid = $_SESSION['TID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacher WHERE TID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))

					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];
					$subject = $rowedit['SUBJECTTH'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Grades Inputted',NOW())";
			$result1 = $config->query($sql1);


if(isset($_POST['entgrade'])){

$ASID = $_POST['ASID'];


$LSCI = $_POST['LSCI'];




$sql = "Update tbl_studentinfo SET Stud_SID='$ASID', SCIF='$LSCI' where Stud_SID='$ASID'";

$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Insert Grade")
</script>
<?php
header("refresh:0;url=scifourthquarter.php");
}else{
	echo $config->error;
}
}
?>