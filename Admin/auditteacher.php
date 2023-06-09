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
		$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Audit Teacher Records',NOW())";
		$result1 = $config->query($sql1);
		if (isset($_POST['search'])) {

			if (!empty($_POST['dpa']) && !empty($_POST['dpb'])) {
				
				$search = $_POST['search'];
				$dpa = $_POST['dpa'];
				$dpb = $_POST['dpb'];
				if ($search != NULL) {
		
		
					$query = "SELECT * FROM tbl_auditteacher 
				  WHERE (e_userID LIKE '%$search%' OR
						 e_name LIKE '%$search%' OR
						 e_action LIKE '%$search%') AND
						e_date >= '$dpa' AND
						e_date <= '$dpb'";
				} else {
					$sql = "SELECT * FROM tbl_auditteacher 
				WHERE e_date >= '$dpa' AND
					  e_date <= '$dpb'
				ORDER BY e_userID DESC
				LIMIT 500";
				}
				
			}else {
				
		
				$search = $_POST['search'];
		
				if ($search != NULL) {
					$sql = "Select * from tbl_auditteacher where e_userID like '%$search%' or 
						e_name like '%$search%' or 
						e_action like '%$search%' or 
						e_date like '%$search%'";
				} else {
					$sql = "Select * from tbl_auditteacher ORDER BY e_userID DESC LIMIT 100";
				}
		
		
		
			}
		
		} else {
			$sql = "Select * from tbl_auditteacher ORDER BY e_userID DESC LIMIT 100";
		}
		
		?>
		<!DOCTYPE html>
		<html>
		
		<head>
			<title>Teacher Audit</title>
		</head>
		<link rel="icon" href="../Images/logo.png">
		<link rel="stylesheet" href="../Css/sepi.css">
		
		<body style="background-color:#E5E4E2">
			<div class="header">
		
				<p class="displayname">
					<?php echo "$type" ?> |
					<?php echo "$name" ?>
				</p>
				<form method="POST" action="logout.php">
					<button type=submit name="logout" class="logout">Log Out</a>
				</form>
			</div>
			<div class="footer">
				<h6 id="footer">© 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
			<form method=POST action="audit.php">
				<?php
				include_once('SideNav.php');
				?>
				<div class="auditdiv">
					<h1 id="auditfont">AUDIT TRAIL ADMIN</h1>
					<a href="audit.php" class="adminauditlink">Admin</a>
					<a href="auditteacher.php" class="teacherauditlink">Teacher</a>
					<a href="auditstudent.php" class="studentauditlink">Student</a>
					<hr class="">
					<p class="searchaudit">Search:</p>
					<input type=text name=search class="audittxt">
					<input type=text name=search class="audittxt">
					<input type="date" id="date-picker" name="dpa" class="audittxt" style="    margin-left: 21% !important">
					<input type="date" id="date-picker" name="dpb" class="audittxt" style="    margin-left: 36% !important">
					<input type=submit name=sub class="auditbtn" style="
			margin-left: 51%;
		">
		
					<?php
					include "../sepi_connect.php";
		
		
		
					$result = $config->query($sql);
		
					if ($result->num_rows > 0) {
						echo "<div class=audittbl style=overflow:auto;>";
						echo "<table class=audittbl1>";
						echo "<th class=auditheader1> User";
						echo "<th class=auditheader> Action";
						echo "<th class=auditheader1> Date";
						while ($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td class=auditinfo>" . $row['e_name'];
							echo "<td class=auditinfo>" . $row['e_action'];
							echo "<td class=auditinfo>" . $row['e_date'];
						}
					}
					?>
				</div>
			</form>
		</body>
		
		</html>