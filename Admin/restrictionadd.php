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
    <title>Add Restriction</title>
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
    <form method=POST action="restrictionadd.php" enctype="multipart/form-data">
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
            <h1 id="announceaddfont">ADD Restriction</h1>
            <hr class="announceaddline">
            <select name="Teacher" class="addannouncemntfield">
               <?php
               $query = "SELECT ID as teacher_Code, CONCAT(FNAMES, ' ', MNAMES, ' ', LNAMES) AS name FROM tbl_teacherinfo";

               // Execute the query and retrieve the result set
               $result = mysqli_query($config, $query);
               
               // Create the options for the dropdown menu with the teacher names
               while ($row = mysqli_fetch_assoc($result)) {
                   echo "<option value='" . $row["teacher_Code"] . "'>" . $row["name"] . "</option>";
               }
               
               // Close the result set and database connection
               mysqli_free_result($result);
               mysqli_close($config);
               ?>
            
            </select>
                <br>

                <select name="grade" class="adddatfield">
    <option value="" disabled selected>Please select a grade level</option>
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
            <select name="Subject" class="adddatfield" style="margin-top: 5%;">
            <option value="Grade 1">Please Select Grade Level first</option>
            </select>
            <br>

            <input type=submit name=sub value="Add" class="addannouncebtn">
            <a href="restriction.php" class="addannounceback">Back</a>

    </form>

</body>
<script>
    // Get the "Grade" and "Subject" dropdown menus
    var gradeDropdown = document.querySelector('select[name="grade"]');
var subjectDropdown = document.querySelector('select[name="Subject"]');

// Listen for changes in the "Grade" dropdown menu
gradeDropdown.addEventListener('change', function() {
    // Get the selected value in the "Grade" dropdown menu
    var selectedGrade = this.value;
    
    // Construct the SQL query to retrieve the subjects for the selected grade
    var query = "SELECT subject_Name, Subject_code FROM tbl_subject WHERE Grade_level = '" + selectedGrade + "'";
    
    // Clear the options in the "Subject" dropdown menu
    subjectDropdown.innerHTML = '<option value="">Please Select Grade Level first</option>';
    
    // Fetch the subjects for the selected grade from the server
    fetch('fetch.php?query=' + query)
        .then(response => response.json())
        .then(subjects => {
            // Delete all existing options in the "Subject" dropdown menu
            while (subjectDropdown.firstChild) {
                subjectDropdown.removeChild(subjectDropdown.firstChild);
            }
            // Add the retrieved subjects to the "Subject" dropdown menu
            subjects.forEach(subject => {
                subjectDropdown.innerHTML += '<option value="' + subject.Subject_code + '">' + subject.subject_Name + '</option>';
            });
        });
});
</script>
</html>
<?php
include "../sepi_connect.php";



if(isset($_POST['sub'])){
	
$teacher = $_POST['Teacher'];
$grade = $_POST['grade'];
$subject = $_POST['Subject'];
	$sql = "Insert into tbl_restriction (Teacher_Code,Subject_Code,Grade_Level) values  
			('$teacher','$subject','$grade')";
			if ($config->query($sql)) {
				// query successful
				echo '<script>alert("Subject added successfully."); window.location.href = "restriction.php";</script>';
			  } else {
				// query failed
				echo '<script>alert("'.var_dump($sql).'Failed to add new subject. Please check the inputs and provide the correct details.");</script>';
			  }
}

?>