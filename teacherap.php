<html>
<head>
<link rel="icon" href="">
	<title> Login | SEPI  </title>
<link rel="icon" href="./Images/logo.png">
<link rel="stylesheet" href="./Css/sepi.css">
</head>

 <body background="background2.jpg"  style="background-size:cover">
<div class="container">
		
		<img src="./Images/logo.png" class="loginlogo">
		</div>
		<form method=POST action=teacherap.php>
			<div class="container1">
				<h4 id=fonttitle>TEACHER - LOG IN - A.P</h4>
				<input type="text" name="username" placeholder="Username" autocomplete="off" size="20" required class="namefield">
					<p>
						<input type="password" name="password" placeholder="Password" size="20" required class="passwordfield">
					</p>        
					</select>
					
					<p>
						<input type="submit" name="login" class="login" value="Login"> 
						<a href="Index.php" class="returnbtn">Return</a>
							<br>
							<br>
					</p>
				</div>
				<center><h3> <p class="logintitle">&nbsp SEPI ONLINE GRA</p><p class="logintitleconnect">DING SYSTEM</p></h3>	</center>
				<p class=rightslogin>
				© 2022 SEPI Login Form. All Rights Reserved | Design by Excel-erator
				</p>
</form>

</body>
</html> 

<?php
	include "sepi_connect.php";
	
	if (isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password  = $_POST['password'];
		$subject = $_POST['subject'];
		
		
		$viewlogin= "SELECT * FROM tbl_teacherinfo WHERE USERNAME = '$username'";
		$result = mysqli_query($config,$viewlogin);
		$number = mysqli_num_rows($result);
		
		if($number>0)
		{
			$row = mysqli_fetch_array($result);
			$type = $row['Role'];
			$userid = $row['TID'];
			$username = $row['EMAIL'];
			$dbpassword = $row['PASS'];
			$subject = $row['SUBJECTF'];

			session_start();
						
			$_SESSION['TID'] = $userid;
			$_SESSION['EMAIL'] = $username;
			$_SESSION['Role'] = $type;
			$_SESSION['SUBJECTF'] = $subject;
	
		

					if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
		 }else if(isset($_SESSION['TID']))
			{
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacherinfo WHERE TID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
				}
			}
	#				$viewloginl = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Logged In',NOW())";
	
	#$result1 = $config->query($viewloginl);
	
	
	
				$_SESSION['loggedin'] = true;	
	
			 if($type == "Teacher" && $subject == "Araling Panlipunan")
				{
					if($dbpassword == $password)
						{
							header("refresh:0;url=./Teacher/AP/apdashboard.php");
						}
						else
						{
							?>
							<script>
								alert("Hi User! Your Password is Incorrect!")
							</script>
							<?php
						}
				}		
				
			
		}else
		{
				?>
				<script>
					alert("Username is not Registered")
				</script>
				<?php
		}
	}

?>