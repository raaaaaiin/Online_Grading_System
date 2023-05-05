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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Updating Admin Announcement',NOW())";
		$result1 = $config->query($sql1);

		
if(isset($_POST['subs'])&& isset($_FILES['fileToUpload'])){
	
	echo "<pre>";
	print_r($_FILES['fileToUpload']);
	echo "</pre>";

$img_name = $_FILES['fileToUpload']['name'];
	$img_size = $_FILES['fileToUpload']['size'];
	$tmp_name = $_FILES['fileToUpload']['tmp_name'];
	$error = $_FILES['fileToUpload']['error'];

	if ($error === 0) {
		if ($img_size > 12500000) {
			$em = "Sorry, your file is too large.";
			header("Location: announceview.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);
	
			$allowed_exs = array("jpg", "jpeg", "png"); 
	
			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = '../uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);
	
				// Insert into Database
				$AIDS = $_POST['AIDS'];
				$ANN = $_POST['ANN'];
				$DATE = $_POST['DATE'];
				$sql = "Update tbl_announce SET ANNOUNCEMENT='$ANN', DATE='$DATE', image = '$new_img_name' where AID='$AIDS'";
				$result = $config->query($sql);
			
		

				if($result == True){
				?>
				<script>
				alert("Successfully Update")
				
				</script>
				<?php
				header("refresh:0;url=announceview.php");
				
				}else{
					echo $conn->error;
				}
				}
			}
		}
	}
		
				?>