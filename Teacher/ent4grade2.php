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
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Inputting 4th Quarter Grade',NOW())";
			$result1 = $config->query($sql1);

?>
<?php
include "../../sepi_connect.php";
if(!$config->connect_error){
	echo "Connected";
}
if(isset($_POST['entgrade'])){

$ASID = $_POST['ASID'];

$LFIL = $_POST['LFIL'];
$LENG = $_POST['LENG'];
$LMATH = $_POST['LMATH'];
$LSCI = $_POST['LSCI'];
$LAP = $_POST['LAP'];
$LTLE = $_POST['LTLE'];
$LMAP = $_POST['LMAP'];
$LCE = $_POST['LCE'];
$LCOM = $_POST['LCOM'];
$JATOT = $LFIL + $LENG + $LMATH + $LSCI + $LAP + $LTLE + $LMAP + $LCE + $LCOM;
$AVE = $JATOT / 9.0;
$PER = sprintf('%f',$JATOT/ 900.0) * 100;
$grade="NULL";
$remarks="NULL";

if ($AVE >= 90 && $AVE < 100)
    $grade = "Outstanding";
else if ($AVE >= 85 && $AVE < 89)
    $grade = "Very Satisfactory";
else if ($AVE >= 80 && $AVE < 84)
    $grade = "Satisfactory";
else if ($AVE >= 75 && $AVE < 79)
    $grade = "Fairly Satisfactory";
else if ($AVE >= 0 && $AVE < 70)
    $grade = "Unavailable";
else
    $grade = "Did Not Meet Expectations";

if ($AVE >= 75 && $AVE < 100)
	$remarks = "Promoted";
else if ($AVE >= 0 && $AVE < 70)
$remarks = "Unavailable";
else
	$remarks = "Failed";

$sql = "Update tbl_studentinfo SET Stud_SID='$ASID', FILF='$LFIL', ENGF='$LENG', MATHF='$LMATH', SCIF='$LSCI', APF='$LAP', TLEF='$LTLE', MAPF='$LMAP', CEF='$LCE', COMF='$LCOM', TOTALSF='$PER', STATUSF='$grade', REMARKSF='$remarks' where Stud_SID='$ASID'";

$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Insert Grade")
</script>
<?php
header("refresh:0;url=grades.php");
}else{
	echo $config->error;
}
}
?>
