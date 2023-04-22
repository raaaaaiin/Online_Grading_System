<html>
<head>
<link rel="icon" href="">
	<title> Login | SEPI  </title>
<link rel="icon" href="./Images/logo.png">
<link rel="stylesheet" href="./Css/sepi.css">
</head>

 <body background="background4.jpg"  style="background-size:cover">
<div class="container">
		
		<img src="./Images/logo.png" class="loginlogo">
		</div>
		<form method=POST action=studentlogin.php>
			<div class="container1">
				<h4 id=fonttitle>STUDENT - LOG IN</h4>
				<input type="text" name="username" placeholder="Username" autocomplete="off" size="20" required class="namefield">
					<p>
						<input type="password" name="password" placeholder="Password" size="20" required class="passwordfield">
					</p>        
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
		
		$viewlogin= "SELECT * FROM tbl_student WHERE USERNAME = '$username'";
		
		$result = mysqli_query($config,$viewlogin);
		$number = mysqli_num_rows($result);
		
		if($number>0)
		{
			$row = mysqli_fetch_array($result);
			$type = $row['Role'];
			$userid = $row['Stud_SID'];
			$username = $row['USERNAME'];
			$dbpassword = $row['PASS'];
			$section = $row['LEVEL'];
			$fname = $row['FNAME'];
			$lname = $row['LNAME'];

			session_start();
						
			$_SESSION['Stud_SID'] = $userid;
			$_SESSION['USERNAME'] = $username;
			$_SESSION['Role'] = $type;
			$_SESSION['LEVEL'] = $section;
			$SESSION['FNAME'] = $fname;
			$SESSION['LNAME'] = $lname;


					if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
		 }else if(isset($_SESSION['Stud_SID']))
			{
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_student WHERE Stud_SID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
				}
			}
	//$viewloginl = "Insert into tbl_auditstudent (e_name,e_level,e_action,e_date) values ('$name','','Logged In',NOW())";
	//$result1 = $config->query($viewloginl);
	
	
	
	$_SESSION['loggedin'] = true;	
	if($type == "Student" && $section == "Grade 1 - Faith")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/1/dashboardstudent.php");
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
	if($type == "Student" && $section == "Grade 2 - Hope")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/2/dashboardstudent.php");
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
	if($type == "Student" && $section == "Grade 3 - Humility")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/3/dashboardstudent.php");
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
	if($type == "Student" && $section == "Grade 4 - Meekness")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/4/dashboardstudent.php");
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
	if($type == "Student" && $section == "Grade 5 - Gentleness")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/5/dashboardstudent.php");
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
	if($type == "Student" && $section == "Grade 6 - Patience")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/6/dashboardstudent.php");
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
	if($type == "Student" && $section == "Grade 7 - Perseverance")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/7/dashboardstudent.php");
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
	if($type == "Student" && $section == "Grade 8 - Generosity")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/8/dashboardstudent.php");
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
	if($type == "Student" && $section == "Grade 9 - Industriousness")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/9/dashboardstudent.php");
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
	if($type == "Student" && $section == "Grade 10 - Prosperity")
		{
			if($dbpassword == $password)
				{
					header("refresh:0;url=./Student/10/dashboardstudent.php");
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
		}
		else
		{
				?>
				<script>
					alert("Username is not Registered")
				</script>
				<?php
		}
	}
?>