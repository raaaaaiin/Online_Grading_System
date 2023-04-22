<?php	include "../sepi_connect.php";
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
			$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Viewing Admin Announcement',NOW())";
			$result1 = $config->query($sql1);
			if(isset($_POST['search']) || isset($_POST['grade']) ){
				@$search = $_POST['search'];
				@$grade = $_POST['grade'];
				@$subject = $_POST['subject'];
				
				if ($search != NULL || $grade != "" || $subject != ""){
					$sql = "SELECT
						tbl_restriction.ID,
						tbl_restriction.Teacher_Code,
						tbl_restriction.Grade_Level,
						GROUP_CONCAT(tbl_restriction.Subject_Code SEPARATOR ', ') AS Subject_Codes,
						tbl_restriction.Sy,
						CONCAT(tbl_teacherinfo.FNAMES, ' ', tbl_teacherinfo.MNAMES, ' ', tbl_teacherinfo.LNAMES) AS Teacher_Name
					FROM
						tbl_restriction
						INNER JOIN tbl_teacherinfo ON tbl_restriction.Teacher_Code = tbl_teacherinfo.ID
					WHERE 
						(tbl_restriction.ID LIKE '%$search%' OR 
						tbl_restriction.Subject_Code LIKE '%$search%' OR  
						tbl_restriction.Grade_Level LIKE '%$search%' OR 
						CONCAT(tbl_teacherinfo.FNAMES, ' ', tbl_teacherinfo.MNAMES, ' ', tbl_teacherinfo.LNAMES) LIKE '%$search%')";
					
					if ($grade != "") {
						$sql .= " AND tbl_restriction.Grade_Level = '$grade'";
					}
					
					if ($subject != "") {
						$sql .= " AND tbl_restriction.Subject_Code = '$subject'";
					}
					
					$sql .= " GROUP BY Teacher_Code, Grade_Level;";
				} else {
					$sql = "SELECT
						tbl_restriction.ID,
						tbl_restriction.Teacher_Code,
						tbl_restriction.Grade_Level,
						GROUP_CONCAT(tbl_restriction.Subject_Code SEPARATOR ', ') AS Subject_Codes,
						tbl_restriction.Sy,
						CONCAT(tbl_teacherinfo.FNAMES, ' ', tbl_teacherinfo.MNAMES, ' ', tbl_teacherinfo.LNAMES) AS Teacher_Name
					FROM
						tbl_restriction
						INNER JOIN tbl_teacherinfo ON tbl_restriction.Teacher_Code = tbl_teacherinfo.ID
					GROUP BY Teacher_Code, Grade_Level;";
				}
			}else{

$sql = "SELECT
tbl_restriction.ID,
tbl_restriction.Teacher_Code,
tbl_restriction.Grade_Level,
GROUP_CONCAT(tbl_restriction.Subject_Code SEPARATOR ', ') AS Subject_Codes,
tbl_restriction.Sy,
CONCAT(tbl_teacherinfo.FNAMES, ' ', tbl_teacherinfo.MNAMES, ' ', tbl_teacherinfo.LNAMES) AS Teacher_Name
FROM
tbl_restriction
INNER JOIN tbl_teacherinfo ON tbl_restriction.Teacher_Code = tbl_teacherinfo.ID
GROUP BY Teacher_Code, Grade_Level;
";
}


?>



<html>
<head> 
<title> Add Restriction</title>
</head>
<link rel="icon" href="../Images/logo.png">
<link rel="stylesheet" href="../Css/sepi.css">
<body style="background-color:#E5E4E2">
<div class="header">


<form method="POST"action="logout.php" >
<p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">© 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
<form method=POST action="restriction.php">
		<div class="dashboard">
			<img src="../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboard.php" class="Dashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announceview.php" class="Announcement"><img src="../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="student.php" class="Student"><img src="../Images/studrecord.png" class="studenticon">Student</a>
			<a href="teacher.php" class="Teacher"><img src="../Images/studrecord.png" class="teachericon">Teacher</a>
			<a href="accounts.php" class="Accounts"><img src="../Images/account.png" class="accounticon">Admin</a>
			<a href="adchangepass.php" class="Changepassadmin"><img src="../Images/pass.png" class="archiveicon">Account</a>
			<a href="audit.php" class="Audit"><img src="../Images/mag.png" class="auditicon">Audit Trail</a>
			<a href="../Archive/archive.php" class="Archive"><img src="../Images/arc.png" class="archiveicon">Archive</a>
			<a href="grade.php" class="grade"><img src="../Images/mag.png" class="gradeicon">Grades</a>
			<a href="grading.php" class="grading"><img src="../Images/mag.png" class="gradingicon">GradingPolicy</a>
			<a href="subject.php" class="subject"><img src="../Images/mag.png" class="subjecticon">Subject</a>
			<a href="section.php" class="section"><img src="../Images/mag.png" class="sectionicon">Section</a>
			<a href="restriction.php" class="restriction"><img src="../Images/mag.png" class="restrictionicon">Restriction</a>
		</div>
<div class="announcementdiv">
				<h1 id="announcemetfont">Restriction</h1>
				<a href="restrictionadd.php" name="addannouncement"><img src="../Images/add_icon.png" class="addannouncementbtn"></a>
				<hr>
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="announcementtxt">
				<select name=grade class="announcementtxt" style="margin-left: 21%;    width: 100;">
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
			
				<input type=submit name=sub class="announcementbtn" style="margin-left: 31%;"> 




<?php
include "../sepi_connect.php";


$result = $config -> query($sql);
if(@$result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";
	
echo "<th Class=announcementheader1>Teacher Code";
echo "<th Class=announcementheader>Teacher Name";
echo "<th Class=announcementheader1>Subjects";
echo "<th Class=announcementheader2>Grade_level";
echo "<th Class=announcementheader1>ACTION";


while($row = $result -> fetch_assoc()){
echo "<tr>";
echo "<td class=announcementinfo rowspan=2>".$row['Teacher_Code'];
echo "<td class=announcementinfo rowspan=2>".$row['Teacher_Name'];
echo "<td class=announcementinfo rowspan=2>".$row['Subject_Codes'];
echo "<td class=announcementinfo rowspan=2>".$row['Grade_Level'];
echo "<td class=announcementinfo> <a href='announceupdate.php?ID=".$row['ID']."'> Update </a>";
echo "<tr>";
echo "<td class=announcementinfo> <a href='deleteannounce.php?ID=".$row['ID']."'> Archive </a>";
echo"<tr>";
echo "<td class=announcementinfo1 colspan=4>";

	

}	
}else{
echo "No Announcement Display";
}
?>
</div>
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