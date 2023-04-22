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
					$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Adding Admin Announcement',NOW())";
					$result1 = $config->query($sql1);
			
?>
<!DOCTYPE html>

<html>

<head>
    <title>Add Announcement</title>
</head>
<link rel="icon" href="../Images/logo.png">
<link rel="stylesheet" href="../Css/sepi.css">

<body style="background-color:#E5E4E2">
    <div class="header">


        <p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>
        <form method="POST" action="logout.php">
            <button type=submit name="logout" class="logout">Log Out</a>
        </form>
    </div>
    <div class="footer">
        <h6 id="footer">© 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
    </div>
    <form method=POST action="subjectadd.php" enctype="multipart/form-data">
        <div class="dashboard">
            <img src="../Images/logo.png" class="dashboardlogocvgs">
            <a href="dashboard.php" class="Dashboardhome"><img src="../Images/homeicon.png"
                    class="homeicon">Dashboard</a>
            <a href="announceview.php" class="Announcement"><img src="../Images/announcement.png"
                    class="announcementicon">Announcement</a>
            <a href="student.php" class="Student"><img src="../Images/studrecord.png" class="studenticon">Student</a>
            <a href="teacher.php" class="Teacher"><img src="../Images/studrecord.png" class="teachericon">Teacher</a>
            <a href="accounts.php" class="Accounts"><img src="../Images/account.png" class="accounticon">Admin</a>
            <a href="adchangepass.php" class="Changepassadmin"><img src="../Images/pass.png"
                    class="archiveicon">Account</a>
            <a href="audit.php" class="Audit"><img src="../Images/mag.png" class="auditicon">Audit Trail</a>
            <a href="../Archive/archive.php" class="Archive"><img src="../Images/arc.png"
                    class="archiveicon">Archive</a>
            <a href="grade.php" class=""><img src="" class="">Grades</a>
            <a href="grading.php" class=""><img src="" class="">Grading Policy</a>
        </div>

        <div class="announceadddiv">
            <h1 id="announceaddfont">ADD Subject</h1>
            <hr class="announceaddline">
            <input type="text" name="subject" placeholder="Subject Name" autocomplete="off" size="50"
                class="addannouncemntfield"><br>

            <select name="grade" class="adddatfield">
                <option value="Grade 1">Grade 1</option>
				<option value="Grade 2">Grade 2</option>
				<option value="Grade 3">Grade 3</option>
				<option value="Grade 4">Grade 4</option>
				<option value="Grade 5">Grade 5</option>
				<option value="Grade 6">Grade 6</option>
				<option value="Grade 7">Grade 7</option>
				<option value="Grade 8">Grade 8</option>
				<option value="Grade 9">Grade 9</option>
				<option value="Grade 10">Grade 10</option>
            </select>
            <br>

            <br>

            <input type=submit name=sub value="Add" class="addannouncebtn">
            <a href="subject.php" class="addannounceback">Back</a>

    </form>

</body>

</html>
<?php
include "../sepi_connect.php";



if(isset($_POST['sub'])){
	
$subjectName = $_POST['subject'];
$gradeLevel = $_POST['grade'];
$subject_code = substr($subjectName, 0, 3) . substr($gradeLevel, 6);
	$sql = "Insert into tbl_subject (Subject_name,Grade_Level,Subject_code) values  
			('$subjectName','$gradeLevel','$subject_code')";
			if ($config->query($sql)) {
				// query successful
				echo '<script>alert("Subject added successfully."); window.location.href = "subject.php";</script>';
			  } else {
				// query failed
				echo '<script>alert("'.var_dump($sql).'Failed to add new subject. Please check the inputs and provide the correct details.");</script>';
			  }
}

?>