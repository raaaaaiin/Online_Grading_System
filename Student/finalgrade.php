
<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../../login.php");
			 exit;
		 }else if(isset($_SESSION['Stud_SID']))
			{
				$userid = $_SESSION['Stud_SID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_student WHERE Stud_SID ='$userid'");
				while($rowedit = mysqli_fetch_assoc($getrecord))
					
				{
					
					$type = $rowedit['Role'];
					$userid = $rowedit['Stud_SID'];
					$name = $rowedit['FNAME']." ".$rowedit['LNAME'];
					$section = $rowedit['LEVEL'];
				}
			}
			$sql1 = "Insert into tbl_auditstudent (e_name,e_level,e_action,e_date) values ('$name','$section','Viewing 1st Quarter Grades',NOW())";
			$result1 = $config->query($sql1);
            $sql="Select * from tbl_student where Stud_SID = '$userid'";
            $result = $config->query($sql);
            
            $row = $result->fetch_assoc();
            $FNAME = $row['FNAME'];
            $MNAME = $row['MNAME'];
            $LNAME = $row['LNAME'];
            $FULLNAME = $FNAME." ".$MNAME." ".$LNAME;
            $LEVEL = $row['LEVEL'];
            
            $FIL = $row['FIL'];
            $FILS = $row['FILS'];
            $FILSS = $row['FILSS'];
            $FILF = $row['FILF'];
           
            $ENG = $row['ENG'];
            $ENGS = $row['ENGS'];
            $ENGSS = $row['ENGSS'];
            $ENGF = $row['ENGF'];
            
            $MATH = $row['MATH'];
            $MATHS = $row['MATHS'];
            $MATHSS = $row['MATHSS'];
            $MATHF = $row['MATHF'];

            $SCI = $row['SCI'];
            $SCIS = $row['SCIS'];
            $SCISS = $row['SCISS'];
            $SCIF = $row['SCIF'];

            $AP = $row['AP'];
            $APS = $row['APS'];
            $APSS = $row['APSS'];
            $APF = $row['APF'];

            $TLE = $row['TLE'];
            $TLES = $row['TLES'];
            $TLESS = $row['TLESS'];
            $TLEF = $row['TLEF'];

            $MAP = $row['MAP'];
            $MAPS = $row['MAPS'];
            $MAPSS = $row['MAPSS'];
            $MAPF = $row['MAPF'];

            $CE = $row['CE'];
            $CES = $row['CES'];
            $CESS = $row['CESS'];
            $CEF = $row['CEF'];

            $COM = $row['COM'];
            $COMS = $row['COMS'];
            $COMSS = $row['COMSS'];
            $COMF = $row['COMF'];


?>

<html>
<head> 
    <title> Student List View</title>
</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../../Css/sepi.css">
<body style="background-color:#E5E4E2">
    <div class="header">
        <p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>
        <form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
        </form>
    </div>
    <form method=POST action="grades.php">
		<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboardstudent.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcestud.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="viewacc.php" class="Accountstudent"><img src="../../Images/pass.png" class="accounticon">Account</a>
			<a href="viewgrades.php" class="Gradesstudent"><img src="../../Images/studgrade.png" class="teachericon">Grades</a>
	</div>
    <div class="finalgradediv">

        <table border=1 class=tablefinalgrade>
            <tr>
                <th class=headerfinalgrade>Student Name:</th>
                <td colspan=3 class=datafinalgrade><input type=text name=studname class=datafnamefinalgrade value="<?php echo $FULLNAME; ?>"readonly></td>
                <th class=headerfinalgrade>GRADE:</th>
                <th colspan=2 class=datafinalgrade><input type=text name=studlevel class=datalvlfinalgrade value="<?php echo $LEVEL; ?>"readonly></th>
            </tr>
            <tr>
                <th rowspan=2 class=headerfinalgrade>Learning Areas</th>
                <th colspan=4 class=headerfinalgrade>QUARTER</th>
                <th rowspan=2 class=headerfinalgrade>Final Grade</th>
                <th rowspan=2 class=headerfinalgrade>Remarks</th>
            </tr>
            <tr>
                <th class=headerfinalgrade>1</th>
                <th class=headerfinalgrade>2</th>
                <th class=headerfinalgrade>3</th>
                <th class=headerfinalgrade>4</th>
            </tr>
            <tr>
                <th class=headerfinalgrade>Mother Tongue</th>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>Filipino</th>
                <td class=datafinalgrade><input type=text name=studfilfirst class=datafinalgrade value="<?php echo $FIL; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studfilsecond class=datafinalgrade value="<?php echo $FILS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studfilthird class=datafinalgrade value="<?php echo $FILSS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studfilfourth class=datafinalgrade value="<?php echo $FILF; ?>"readonly></td>
                <td class=datafinalgrade></td>
                <td class=datafinalgrade></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>English</th>
                <td class=datafinalgrade><input type=text name=studengfirst class=datafinalgrade value="<?php echo $ENG; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studengsecond class=datafinalgrade value="<?php echo $ENGS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studengthird class=datafinalgrade value="<?php echo $ENGSS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studengfourth class=datafinalgrade value="<?php echo $ENGF; ?>"readonly></td>
                <td class=datafinalgrade></td>
                <td class=datafinalgrade></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>Mathematics</th>
                <td class=datafinalgrade><input type=text name=studmathfirst class=datafinalgrade value="<?php echo $MATH; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studmathsecond class=datafinalgrade value="<?php echo $MATHS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studmaththird class=datafinalgrade value="<?php echo $MATHSS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studmathfourth class=datafinalgrade value="<?php echo $MATHF; ?>"readonly></td>
                <td class=datafinalgrade></td>
                <td class=datafinalgrade></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>Science & Tech.</th>
                <td class=datafinalgrade><input type=text name=studscifirst class=datafinalgrade value="<?php echo $SCI; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studscisecond class=datafinalgrade value="<?php echo $SCIS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studscithird class=datafinalgrade value="<?php echo $SCISS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studscifourth class=datafinalgrade value="<?php echo $SCIF; ?>"readonly></td>
                <td class=datafinalgrade></td>
                <td class=datafinalgrade></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>MAKABAYAN</th>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
                <td class=datafinalgradeblank></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>Araling Panlipunan</th>
                <td class=datafinalgrade><input type=text name=studapfirst class=datafinalgrade value="<?php echo $AP; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studapsecond class=datafinalgrade value="<?php echo $APS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studapthird class=datafinalgrade value="<?php echo $APSS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studapfourth class=datafinalgrade value="<?php echo $APF; ?>"readonly></td>
                <td class=datafinalgrade></td>
                <td class=datafinalgrade></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>T.L.E</th>
                <td class=datafinalgrade><input type=text name=studtlefirst class=datafinalgrade value="<?php echo $TLE; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studtlesecond class=datafinalgrade value="<?php echo $TLES; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studtlethird class=datafinalgrade value="<?php echo $TLESS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studtlefourth class=datafinalgrade value="<?php echo $TLEF; ?>"readonly></td>
                <td class=datafinalgrade></td>
                <td class=datafinalgrade></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>MAPEH</th>
                <td class=datafinalgrade><input type=text name=studmapehfirst class=datafinalgrade value="<?php echo $MAP; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studmapehsecond class=datafinalgrade value="<?php echo $MAPS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studmapehthird class=datafinalgrade value="<?php echo $MAPSS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studmapehfourth class=datafinalgrade value="<?php echo $MAPF; ?>"readonly></td>
                <td class=datafinalgrade></td>
                <td class=datafinalgrade></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>Christian Education</th>
                <td class=datafinalgrade><input type=text name=studcefirst class=datafinalgrade value="<?php echo $CE; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studcesecond class=datafinalgrade value="<?php echo $CES; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studcethird class=datafinalgrade value="<?php echo $CESS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade value="<?php echo $CEF; ?>"readonly></td>
                <td class=datafinalgrade></td>
                <td class=datafinalgrade></td>
            </tr>
            <tr>
                <th class=headerfinalgrade>COMPUTER</th>
                <td class=datafinalgrade><input type=text name=studcomfirst class=datafinalgrade value="<?php echo $COM; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studcomsecond class=datafinalgrade value="<?php echo $COMS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studcomthird class=datafinalgrade value="<?php echo $COMSS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studcomfourth class=datafinalgrade value="<?php echo $COMF; ?>"readonly></td>
                <td class=datafinalgrade></td>
                <td class=datafinalgrade></td>
            </tr>
            <tr>
                <th colspan=5 class=headerfinalgrade>General Average</th>
                <th colspan=2  class=datafinalgrade></th>
            </tr>
        </table>
    </div>

</body>
</html>
