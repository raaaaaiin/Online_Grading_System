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
					$sql1 = "Insert into tbl_audithistory (e_name,e_action,e_date) values ('$name','Promotion',NOW())";
					$result1 = $config->query($sql1);
			
?>
<!DOCTYPE html>

<html>

<head>
    <title>Promotion</title>
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
    <form method=POST action="promotion.php" enctype="multipart/form-data">
        <!--<div class="dashboard">
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
        </div>-->
        <?php
		include_once('SideNav.php');
		?>
        <div class="announceadddiv">
            <h1 id="announceaddfont">ADD Restriction</h1>
            <hr class="announceaddline">
            <select name="from" class="addannouncemntfield">
    <?php
    $toSy;
    $fromSy;
    // Get the current date and month
    $current_date = new DateTime();
    $current_year = $current_date->format('Y');
    $current_month = $current_date->format('m');

    // Determine the current school year
    $sy_start_year = $current_month >= 6 ? $current_year : $current_year - 1;
    $sy_end_year = $sy_start_year + 1;
    $current_sy = $sy_start_year . ' - ' . $sy_end_year;
    $fromSy = $current_sy;
    // Modify the query to filter by the current school year
    $query = "SELECT Section as teacher_Code, CONCAT(Section,' ',SY) AS name, SY FROM tbl_section WHERE SY = '$current_sy'";
    $result = mysqli_query($config, $query);
    $next_sy = "";

    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate the next school year
        $sy_parts = explode('-', $row["SY"]);
        $next_sy = ($sy_parts[0] + 1) . ' - ' . ($sy_parts[1] + 1);

        echo "<option value='" . $row["teacher_Code"] . "'>" . $row["name"] . "</option>";
    }

    mysqli_free_result($result);
    mysqli_close($config);
    ?>
</select>
<input type="text" name="fromSy" value="<?php echo $fromSy ?>" hidden>
<br>

<select name="to" class="adddatfield">
    <?php
    include "../sepi_connect.php";

    $query2 = "SELECT Section as teacher_Code, CONCAT(Section,' ',SY) AS name FROM tbl_section WHERE SY = '$next_sy'";
    $toSy = $next_sy;
    $result2 = mysqli_query($config, $query2);
    $num_rows = mysqli_num_rows($result2);

    if ($num_rows > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo "<option value='" . $row2["teacher_Code"] . "'>" . $row2["name"] . "</option>";
        }
    } else {
        echo "<option>Please add section first on next School year</option>";
    }

    mysqli_free_result($result2);
    mysqli_close($config);
    ?>
</select>
<input type="text" name="toSy" value="<?php echo $toSy ?>" hidden>

            <br>
            
            <br>

            <input type=submit name=sub value="Add" class="addannouncebtn">
            <a href="restriction.php" class="addannounceback">Back</a>

    </form>
</body>

</html>
<?php
include "../sepi_connect.php";


if (isset($_POST['sub'])) {
    // Get the from and to section codes and school years
    $from_section_code = $_POST['from'];
    $to_section_code = $_POST['to'];
    $from_sy = $_POST['fromSy'];
    $to_sy = $_POST['toSy'];

    // Get the students from the current section
    $students_query = "SELECT * FROM tbl_studentinfo WHERE LEVEL = '$from_section_code' AND YEAR = '$from_sy'";
    $students_result = mysqli_query($config, $students_query);

    $success = true;

    // Loop through the students and update their section and status
    while ($student = mysqli_fetch_assoc($students_result)) {
        // Update the student's section, year, and set their status to 0 (inactive)
        $update_student_query = "UPDATE tbl_studentinfo SET ACTIVE = 0 WHERE Stud_SID = {$student['Stud_SID']}";
        $update_result = mysqli_query($config, $update_student_query);

        // Insert a new record for the student with the new section, year, and set their status to 1 (active)
        $insert_student_query = "INSERT INTO tbl_studentinfo (Stud_ID, FNAME, MNAME, LNAME, USERNAME, ADDRESS, EMAIL, PASS, BDAY, AGE, GENDER, LEVEL, YEAR, LRN, Role, STATUS, ACTIVE) VALUES ('{$student['Stud_ID']}', '{$student['FNAME']}', '{$student['MNAME']}', '{$student['LNAME']}', '{$student['USERNAME']}', '{$student['ADDRESS']}', '{$student['EMAIL']}', '{$student['PASS']}', '{$student['BDAY']}', '{$student['AGE']}', '{$student['GENDER']}', '$to_section_code', '$to_sy', '{$student['LRN']}', '{$student['Role']}', '{$student['STATUS']}', 1)";
        $insert_result = mysqli_query($config, $insert_student_query);

        if (!$update_result || !$insert_result) {
            $success = false;
        }
    }

    if ($success) {
        echo "<script>alert('All students have been successfully transferred.');</script>";
    } else {
        echo "<script>alert('An error occurred during the transfer. Please try again.');</script>";
    }
}

?>