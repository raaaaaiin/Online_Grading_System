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
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_teacherinfo WHERE TID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))

					
				{
					
					$type = $rowedit['Role'];
					
					$name = $rowedit['FNAMES']." ".$rowedit['LNAMES'];

				}
			}
			$sql1 = "Insert into tbl_auditteacher (e_name,e_action,e_date) values ('$name','Viewing 1st Quarter Grades',NOW())";
			$result1 = $config->query($sql1);
?>
<html>
<head> 
<title> Quarter</title>
</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../../Css/sepi.css">
<body style="background-color:#E5E4E2">
<div class="header">


<form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
</form>
</div>
			<div class="footer">
				<h6 id="footer">� 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
			</div>
<form method=POST action="first.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboard.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announce.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="first.php" class="BGradestudent"><img src="../../Images/studrecord.png" class="teachericon">Grades</a>
			<a href="list.php" class="BStudentlist"><img src="../../Images/account.png" class="accounticon">Student List</a>
			<a href="changepass.php"  class="Accounts"><img src="../../Images/account.png" class="accounticon">Accounts</a>
		</div>
<div class="announcementdiv">
				<h1 id="announcemetfont">QUARTERLY GRADES</h1>
				<input type="button" onclick="printDiv('printableArea')" value="PRINT" />
				<hr id=line>
				<p class="searchannouncement">Search:</p>
				<input type=text name=search class="gradetxt">

				<select name="grade" class="cat" style="
    width: 85px;
">
<option value="">Grade Level & Section</option>
<?php
include "../../sepi_connect.php";

?>

</select>
<select name="section" class="cat" style="
    margin-left: 25%;
">
<option value="">Subject</option>
<?php


?>

</select>
<select name="subject" class="cat" style="
    margin-left: 39%;
">
<option value="">Section</option>
<?php


?>

</select>
<select name="sy" class="cat" style="
    margin-left: 53%;
	width:100px
">
<option value="">Sy</option>
<?php


?>

</select>
<input type='submit' name='sub' class="gradebtn" style="
    margin-left: 62.5%;
"> 
				

</body>
</html>
<div id=printableArea>
<?php
			include "../../sepi_connect.php";

			if(isset($_POST['sub'])){
				$search = $_POST['search'];
				$category = $_POST['category'];
				if($category != NULL){
				$sql = "SELECT * FROM tbl_student where LEVEL = '$category'";
				
				}
				else{
					$sql = "SELECT * FROM tbl_student ORDER BY Stud_SID DESC LIMIT 0";
					
					}
				if($search !=NULL){
				$sql = "SELECT * FROM tbl_student where Stud_SID LIKE '%$search%' or 
														FNAME LIKE '%$search%' or
														LNAME LIKE '%$search%' or
														USERNAME LIKE '%$search%' or
														EMAIL LIKE '%$search%'";
				}
				}else{
				$sql = "SELECT * FROM tbl_student ORDER BY Stud_SID DESC LIMIT 0";
				
				}

$result = $config -> query($sql);
if($result -> num_rows > 0){
	echo"<div class=announcementtbl style=overflow:auto;>";
	echo"<table class=announcementtbl1>";
	echo "<tr>";
	echo "<th Class=gradeheader>STUDENT ID ";
	echo "<th Class=gradeheader>NAME";
	echo "<th Class=gradeheader>GRADE LEVEL AND SECTION ";
	echo "<th Class=gradeheader>GRADE ";
	echo "<th Class=gradeheader>EMAIL: ";
	echo "<th Class=gradeheader>ENTER GRADE";
	echo "<th Class=gradeheader>SEND EMAIL ";
while($row = $result -> fetch_assoc()){
	$zero = 0;
$zero1 = 0;
$zero2 = 0;
$date=date_create("2023");
$dateformat=date_format($date,"y");
echo "<tr>";
echo "<td class=gradeinfo>".$dateformat."-".$zero."".$zero1."".$zero2."-".$row['Stud_SID'];
echo "<td class=gradeinfo>".$row['FNAME']."".$row['MNAME']."".$row['LNAME'];
echo "<td class=gradeinfo>".$row['LEVEL'];
echo "<td class=gradeinfo>".$row['AP'];
echo "<td class=gradeinfo>".$row['EMAIL'];
echo "<td class=gradeinfo> <a href='apfirstquarter.php?ID=".$row['Stud_SID']."'> INPUT GRADE </a>";
echo "<td class=gradeinfo> <a href='index.php?ID=".$row['Stud_SID']."'> SEND EMAIL </a>";




	

}	
}else{
	echo "<p class=empty>SELECT GRADE LEVEL AND SECTION</p>";
}
?>

</div>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
// Define the select dropdowns
const gradeDropdown = document.querySelector('select[name="grade"]');
const sectionDropdown = document.querySelector('select[name="section"]');
const subjectDropdown = document.querySelector('select[name="subject"]');
const syDropdown = document.querySelector('select[name="sy"]');

// Define the SQL queries to retrieve the dropdown options
const gradeQuery = 'SELECT DISTINCT Grade_Level FROM tbl_restriction WHERE Teacher_Code = 1';
const sectionQuery = 'SELECT * FROM sections WHERE grade_level = ...';
const subjectQuery = 'SELECT * FROM subjects WHERE section = ...';
const syQuery = 'SELECT DISTINCT Sy FROM ...';

// Define the function to populate the "Section" dropdown based on the selected grade level
function populateSectionDropdown(selectedGrade) {
	
    // Define the SQL query to retrieve the sections based on the selected grade level
    const query = `SELECT
 tbl_restriction.Subject_Code,
 tbl_subject.Subject_name
 FROM
 tbl_restriction
 INNER JOIN tbl_subject ON tbl_restriction.Subject_Code = tbl_subject.Subject_code
 WHERE Teacher_Code = 1  and tbl_restriction.Grade_Level = '${selectedGrade}'
`;

    // Fetch the sections from the server using the SQL query
    fetch('fetch.php?query=' + query)
        .then(response => response.json())
        .then(sections => {
            // Delete all existing options in the "Section" dropdown menu
			
            while (sectionDropdown.firstChild) {
                sectionDropdown.removeChild(sectionDropdown.firstChild);
            }
            // Add the retrieved sections to the "Section" dropdown menu
			sectionDropdown.innerHTML += '<option disabled selected>Select an option</option>';
            sections.forEach(section => {
                sectionDropdown.innerHTML += '<option value="' + section.Subject_Code + '">' + section.Subject_Code +  ' :' + section.Subject_name + '</option>';
            });
        });
}

// Define the function to populate the "Subject" dropdown based on the selected section
function populateSubjectDropdown(selectedSection) {
    // Define the SQL query to retrieve the subjects based on the selected section
    const query = `SELECT
 tbl_restriction_subject.ID,
 tbl_restriction_subject.Section_Code,
 tbl_restriction_subject.Subject_Code,
 tbl_section.Section_Name as ASection_Name,
 Concat(tbl_section.Grade_Level,' - ',tbl_section.Section_Name) as Section_Name
 FROM
 tbl_restriction_subject
 INNER JOIN tbl_section ON tbl_restriction_subject.Section_Code = tbl_section.ID
 where Subject_Code = '${selectedSection}'
`;

    // Fetch the subjects from the server using the SQL query
    fetch('fetch.php?query=' + query)
        .then(response => response.json())
        .then(subjects => {
            // Delete all existing options in the "Subject" dropdown menu
            while (subjectDropdown.firstChild) {
                subjectDropdown.removeChild(subjectDropdown.firstChild);
            }
            // Add the retrieved subjects to the "Subject" dropdown menu
			subjectDropdown.innerHTML+= '<option disabled selected>Select an option</option>';
            subjects.forEach(subject => {
                subjectDropdown.innerHTML += '<option value="' + subject.ASection_Name + '">' + subject.Section_Name + '</option>';
            });
        });
}

// Define the function to populate the "Sy" dropdown based on the selected grade level and section
function populateSyDropdown(selectedSubject) {
    // Define the SQL query to retrieve the Sy values based on the selected subject
    const query = `SELECT DISTINCT SY FROM tbl_section where Section_Name = '${selectedSubject}'`;

    // Fetch the Sy values from the server using the SQL query
    fetch('fetch.php?query=' + query)
        .then(response => response.json())
        .then(sys => {
            // Delete all existing options in the "Sy" dropdown menu
            while (syDropdown.firstChild) {
                syDropdown.removeChild(syDropdown.firstChild);
            }
			syDropdown.innerHTML +=  '<option disabled selected>Select an option</option>';
            // Add the retrieved Sy values to the "Sy" dropdown menu
            sys.forEach(sy => {
                syDropdown.innerHTML += '<option value="' + sy.SY + '">' + sy.SY + '</option>';
            });
        });
}

// Define the event listener for the "Grade Level" dropdown
gradeDropdown.addEventListener('change', event => {
    const selectedGrade = event.target.value;
    // Populate the "Section" dropdown based on the selected grade level
    populateSectionDropdown(selectedGrade);
    // Reset the "Subject" and "Sy" dropdowns
    subjectDropdown.innerHTML = '<option value="">Section</option>';
	syDropdown.innerHTML = '<option value="">Sy</option>';
});

// Define the event listener for the "Section" dropdown
sectionDropdown.addEventListener('change', event => {
const selectedSection = event.target.value;
// Populate the "Subject" dropdown based on the selected section
populateSubjectDropdown(selectedSection);
// Reset the "Sy" dropdown
syDropdown.innerHTML = '<option value="">Sy</option>';
});

// Define the event listener for the "Grade Level" and "Section" dropdowns (together)
// This is used to populate the "Sy" dropdown based on both the selected grade level and section
[gradeDropdown, sectionDropdown].forEach(dropdown => {
dropdown.addEventListener('change', event => {
const selectedGrade = gradeDropdown.value;
const selectedSection = sectionDropdown.value;
// Populate the "Sy" dropdown based on the selected grade level and section

});
});
subjectDropdown.addEventListener('change', event => {
    const selectedSubject = event.target.value;
    // Populate the "Sy" dropdown based on the selected subject
    populateSyDropdown(selectedSubject);
});
// Populate the "Grade Level" dropdown initially
fetch('fetch.php?query=' + gradeQuery)
.then(response => response.json())
.then(grades => {
// Add the retrieved grades to the "Grade Level" dropdown menu
grades.forEach(grade => {
gradeDropdown.innerHTML += '<option value="' + grade.Grade_Level + '">' + grade.Grade_Level + '</option>';
});
});
</script>