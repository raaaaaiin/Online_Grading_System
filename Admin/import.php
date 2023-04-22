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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Mass Upload Page',NOW())";
		$result1 = $config->query($sql1);


?>


<!DOCTYPE html>
<html>
	<head> 
		<title>Mass Upload</title>
	</head>
<link rel="icon" href="../Images/logo.png">
<link rel="stylesheet" href="../Css/sepi.css">
<body style="background-color:#E5E4E2">
	<div class="header">
	<p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>


		<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
		</form>
	</div>
	<div class="footer">
		<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
	</div>

		<?php
		include_once('SideNav.php');
		?>
	<div class="massuploaddiv">
		<h1 id="massuploadfont">MASS UPLOAD</h1>
		<hr ID=line>






		


<?php
// Load the database configuration file
include "../sepi_connect.php";

// Get status message
if(!empty($_GET['status'])){
    switch($_GET['status']){
        case 'succ':
            $statusType = 'alert-success';
            $statusMsg = 'Members data has been imported successfully.';
            break;
        case 'err':
            $statusType = 'alert-danger';
            $statusMsg = 'Some problem occurred, please try again.';
            break;
        case 'invalid_file':
            $statusType = 'alert-danger';
            $statusMsg = 'Please upload a valid CSV file.';
            break;
        default:
            $statusType = '';
            $statusMsg = '';
    }
}
?>

<!-- Display status message -->
<?php if(!empty($statusMsg)){ ?>
<div class="col-xs-12">
    <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
</div>
<?php } ?>

<div class="row">
    <!-- Import & Export link -->
    <div class="col-md-12 head">
        <div class="float-right">
            <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Import</a>
            <a href="exportData.php" class="btn btn-primary"><i class="exp"></i> Export</a>
        </div>
    </div>
    <!-- CSV file upload form -->
    <div class="col-md-12" id="importFrm" style="display: none;">
        <form action="importData.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
        </form>
    </div>

    <!-- Data list table --> 
    

<!-- Show/hide CSV upload form -->
<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
</script>
	</div>
