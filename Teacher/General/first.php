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
<select name="Quarter" class="cat" style="
    margin-left: 62.5%;
	width:100px
">
<option disabled selected>Select an option</option>
<option value="Prelim">Prelim</option>

<option value="Midterm">Midterm</option>

<option value="Prefinal">Prefinal</option>

<option value="Final">Final</option>
<?php



?>

</select>
<input type='submit' name='sub' class="gradebtn" style="
    margin-left: 72.5%;
"> 
				

			 
</body>
</html>
<form action="first.php" method="post">
<input type='text' name='quarter' class="" style="
    margin-left: 90.5%;
" value="<?php echo @$_POST['Quarter']?>" hidden>
<input type='submit' name='save' class="gradebtn" style="
    margin-left: 82.5%;
" value="Save">
<div id=printableArea>

<?php
			include "../../sepi_connect.php";

			if(isset($_POST['sub'])){

				@$search = $_POST['search'];
				@$grade = $_POST['grade'];
				@$subject = $_POST['section'];
				@$schoolyear = $_POST['sy'];
				@$section = $_POST['subject'];
				@$Level = $grade . ' - '. $section;
				@$Year = $schoolyear;
				@$Quarter = $_POST['Quarter'];
				@$category = $_POST['category'];
				if($Level != NULL){
				$sql = "SELECT Distinct tbl_studentinfo.Stud_SID, tbl_studentinfo.Stud_ID, tbl_studentinfo.FNAME, tbl_studentinfo.MNAME, tbl_studentinfo.LNAME, tbl_studentinfo.USERNAME, tbl_studentinfo.ADDRESS, tbl_studentinfo.EMAIL, tbl_studentinfo.PASS, tbl_studentinfo.BDAY, tbl_studentinfo.AGE, tbl_studentinfo.GENDER, tbl_studentinfo.`LEVEL`, tbl_studentinfo.`YEAR`, tbl_studentinfo.LRN, tbl_studentinfo.Role, tbl_studentinfo.`STATUS`, tbl_grades.".$Quarter." FROM tbl_studentinfo Left JOIN tbl_grades ON tbl_studentinfo.Stud_SID = tbl_grades.Student_Code AND tbl_studentinfo.`YEAR` = tbl_grades.SY where LEVEL = '$Level' and YEAR = '$Year' AND (tbl_grades.Subject_Code = '$subject' OR tbl_grades.Subject_Code IS NULL)"; 	
				
				}
				else{
					$sql = "SELECT * FROM tbl_studentinfo ORDER BY Stud_SID";
					
					}
				if($search !=NULL){
				$sql = "SELECT * FROM tbl_studentinfo where Stud_SID LIKE '%$search%' or 
														FNAME LIKE '%$search%' or
														LNAME LIKE '%$search%' or
														USERNAME LIKE '%$search%' or
														EMAIL LIKE '%$search%' and
														LEVEL = '$Level' and YEAR = '$Year'";
				}
				}else{
				$sql = "SELECT * FROM tbl_studentinfo ORDER BY Stud_SID DESC LIMIT 0";
				
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
	echo "<th Class=gradeheader>SEND EMAIL ";
	$i = 0;
while($row = $result -> fetch_assoc()){
	$zero = 0;
$zero1 = 0;
$zero2 = 0;
$date=date_create("2023");
$dateformat=date_format($date,"y");
@$grade = $row[$Quarter] >= 0 ? $row[$Quarter]  : 0;

echo "<tr>";
echo "<td class='gradeinfo'><input type='hidden' name='row_data[".$i."][0]' value='".$row['Stud_SID']."'>".$dateformat."-".$zero."".$zero1."".$zero2."-".$row['Stud_SID']."</td>";
echo "<td class='gradeinfo'><input type='hidden' name='row_data[".$i."][1]' value='".$row['FNAME']."'>".$row['FNAME']." ".$row['MNAME']." ".$row['LNAME']."</td>";
echo "<td class='gradeinfo'><input type='hidden' name='row_data[".$i."][2]' value='".$row['LEVEL']."'>".$row['LEVEL']."</td>";
echo "<td class='gradeinfo'><input type='text' name='row_data[".$i."][3]' value='".$grade."'></td>";
echo "<td class='gradeinfo'><input type='hidden' name='row_data[".$i."][4]' value='".$row['EMAIL']."'>".$row['EMAIL']."</td>";
echo "<input type='text' name='row_data[".$i."][5]' value='".$row['YEAR']."' hidden>";
echo "<input type='text' name='row_data[".$i."][6]' value='".$_POST['section']."' hidden>";
echo "<td class='gradeinfo'><a href='index.php?ID=".$row['Stud_SID']."'>SEND EMAIL</a></td>";
echo "</tr>";


$i++;
	

}	
}else{
	echo "<p class=empty>SELECT GRADE LEVEL AND SECTION</p>";
}

?>

</div>
</form>
<?php
// Include the file that contains your database connection code
include("../../sepi_connect.php");
if(isset($_POST['save'])){
		$row_data = $_POST['row_data'];
	
    $quarter = $_POST['quarter'];

    // Determine which quarter to update
    switch ($quarter) {
      case 'Prelim':
        $grade_column = 'Prelim';
        break;
      case 'Midterm':
        $grade_column = 'Midterm';
        break;
      case 'Prefinal':
        $grade_column = 'Prefinal';
        break;
      case 'Final':
        $grade_column = 'Final';
        break;
      default:
        die("Invalid quarter value");
    }
    
    // Get the teacher's ID from the session
    $Teacher_Code = $_SESSION['TID'];
    
    // Loop through the submitted data and execute the upsert query
    foreach ($row_data as $row) {
      $Subject_Code = $row[6];
      $Student_Code = $row[0];
      $Grade = $row[3];
      $SY = $row[5];

      // Check if the record exists
      $check_query = "SELECT ID FROM tbl_grades WHERE Student_Code = '$Student_Code' AND SY = '$SY' AND Subject_Code ='$Subject_Code'";
	 
      @$check_result = $config->query($check_query);
      
      if (@$check_result->num_rows > 0) {
          // Update the existing record
          $update_query = "UPDATE tbl_grades SET Subject_Code = '$Subject_Code', Teacher_Code = '$Teacher_Code', $grade_column = '$Grade' WHERE Student_Code = '$Student_Code' AND SY = '$SY'";
          $result = $config->query($update_query);
      } else {
          // Insert a new record
          $insert_query = "INSERT INTO tbl_grades (Subject_Code, Teacher_Code, Student_Code, $grade_column, SY) VALUES ('$Subject_Code', '$Teacher_Code', '$Student_Code', '$Grade', '$SY')";
          $result = $config->query($insert_query);
      }

      if (!$result) {
        die("Query failed: " . $config->error);
		
      }else{
        
      }
    }
    if (!$result) {
        die("Query failed: " . $config->error);
		
      }else{
        echo "<script>alert('Grade successfully saved');</script>";
      }
}
?>
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
const gradeQuery = 'SELECT DISTINCT Grade_Level FROM tbl_restriction WHERE Teacher_Code = <?php echo $_SESSION['TID']?>';
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
 WHERE Teacher_Code = <?php echo $_SESSION['TID']?> and tbl_restriction.Grade_Level = '${selectedGrade}'
`;
console.log(query);

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
 Concat(tbl_section.Grade_Level,' - ',tbl_section.Section_Name) AS Section_Name,
 tbl_restriction.ID,
 tbl_restriction.Subject_Code,
 tbl_restriction.Grade_Level,
 tbl_section.Section_Name as ASection_Name
 FROM
 tbl_section
 INNER JOIN tbl_restriction ON tbl_restriction.Grade_Level = tbl_section.Grade_Level where Subject_Code = '${selectedSection}'
 `;
console.log(query);
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
    console.log(query);
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