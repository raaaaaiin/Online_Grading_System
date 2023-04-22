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
                    $subject = $rowedit['SUBJECT'];
				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing Input General Weighted Averagee',NOW())";
			$result1 = $config->query($sql1);

?>
<?php
include "../../sepi_connect.php";
if(!$config->connect_error){
	echo "Connected";
}
if(isset($_POST['entgrade'])){

$ASID = $_POST['ASID'];

$FILO = $_POST['FILO'];
$FILT = $_POST['FILT'];
$FILTH = $_POST['FILTH'];
$FILF = $_POST['FILF'];

$JATOT = $FILO + $FILT + $FILTH + $FILF;
$AVE = $JATOT / 4.0;
$PER = sprintf('%f',$JATOT/ 400.0) * 100;
$grade="NULL";
$remarks="NULL";

if ($AVE >= 89 && $AVE < 100)
    $grade = "Outstanding";
else if ($AVE >= 85 && $AVE < 89)
    $grade = "Very Satisfactory";
else if ($AVE >= 80 && $AVE < 85)
    $grade = "Satisfactory";
else if ($AVE >= 75 && $AVE < 80)
    $grade = "Fairly Satisfactory";
else if ($AVE >= 0 && $AVE < 70)
    $grade = "Unavailable";
else
    $grade = "Did Not Meet Expectations";

if ($AVE >= 75 && $AVE < 100)
	$remarks = "Promoted";
else if ($AVE >= 60 && $AVE < 70)
$remarks = "Failed";
else if ($AVE >= 0 && $AVE < 59)
$remarks = "Unavailable";


$sql = "Update tbl_student SET Stud_SID='$ASID', FILT ='$PER',STAT='$grade', REM='$remarks' where Stud_SID='$ASID'";

$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Insert Grade")
</script>
<?php
header("refresh:0;url=filallgrade.php");
}else{
	echo $config->error;
}
}
?>