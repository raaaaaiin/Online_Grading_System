
<?php
		include "../../sepi_connect.php";
			session_start();
	
		if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
		 {
			 header("refresh:0;../login.php");
			 exit;
		 }else if(isset($_SESSION['Stud_SID']))
			{
				$userid = $_SESSION['Stud_SID'];
	
				$getrecord = mysqli_query($config,"SELECT * FROM tbl_studentinfo WHERE Stud_SID ='$userid'");
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

            $sql="Select * from tbl_studentinfo where Stud_SID = '$userid'";
            $result = $config->query($sql);
            
           
                $result = $config->query($sql);
                
                $row = $result->fetch_assoc();
                $FNAME = $row['FNAME'];
                $MNAME = $row['MNAME'];
                $LNAME = $row['LNAME'];
                $FULLNAME = $FNAME." ".$MNAME." ".$LNAME;
                $LEVEL = $row['LEVEL'];
                
              /*  
    
                //DEPORTMENT 1ST QUARTER
                    $DEP = 0;
                    if(((!is_null($FIL) && !is_null($MATH) && !is_null($SCI) &&  !is_null($ENG) &&  !is_null($AP) &&  !is_null($MAP) && !is_null($CE))))     
                    $DEP = (int)$FIL + (int)$MATH + (int)$SCI + (int)$ENG + (int)$AP + (int)$MAP + (int)$CE;
                    $DEP1 = $DEP / 7;
                    $DEPO = number_format($DEP1,0);
                    if ($DEPO >= 75)
                    $depograde = "";
                    else if($DEPO = "--")
                        $depograde = "--";
    
                //DEPORTMENT 2ND QUARTER
                    $DEP5 = 0;
                    if(((!is_null($FILS) && !is_null($MATHS) && !is_null($SCIS) &&  !is_null($ENGS) &&  !is_null($APS) &&  !is_null($MAPS) && !is_null($CES))))     
                    $DEP5 = (int)$FIL + (int)$MATH + (int)$SCI + (int)$ENG + (int)$AP + (int)$MAP + (int)$CE;
                    $DEP2 = $DEP5 / 7;
                    $DEPO1 = number_format($DEP2,0);
                    if ($DEPO1 >= 75)
                    $depograde = "";
                    else if($DEPO1 = "--")
                        $depograde = "--";
    
                //DEPORTMENT 3RD QUARTER                
                    $DEP6 = 0;
                    if(((!is_null($FILSS) && !is_null($MATHSS) && !is_null($SCISS) &&  !is_null($ENGSS) &&  !is_null($APSS) &&  !is_null($MAPSS) && !is_null($CESS))))     
                    $DEP6 = (int)$FIL + (int)$MATH + (int)$SCI + (int)$ENG + (int)$AP + (int)$MAP + (int)$CE;
                    $DEP3 = $DEP6 / 7;
                    $DEPO2 = number_format($DEP3,0);
                    if ($DEPO2 >= 75)
                    $depograde = "";
                    else if($DEPO2 = "--")
                        $depograde = "--";
    
                //DEPORTMENT 4TH QUARTER
                    $DEP7 = 0;
                    if(((!is_null($FILF) && !is_null($MATHF) && !is_null($SCIF) &&  !is_null($ENGF) &&  !is_null($APF) &&  !is_null($MAPF) && !is_null($CEF))))     
                    $DEP7 = (int)$FIL + (int)$MATH + (int)$SCI + (int)$ENG + (int)$AP + (int)$MAP + (int)$CE;
                    $DEP4 = $DEP7 / 7;
                    $DEPO3 = number_format($DEP4,0);
                    
                    if ($DEPO3 >= 75)
                        $depograde = "Passed";
                    else if ($DEPO3 <= 75 && $DEPO3 >= 1)
                        $depograde = "Failed";
                    else if($DEPO3 = "--")
                        $depograde = "--";
                    else
                        $DEPO3 = "--";
    
                //CONDUCT 1ST QUARTER
                    $CONDUCT1 = 0;
                    if(((!is_null($FIL) && !is_null($MATH) && !is_null($SCI) &&  !is_null($ENG) &&  !is_null($AP) &&  !is_null($MAP) && !is_null($CE))))     
                    $CONDUCT1 = (int)$FIL + (int)$MATH + (int)$SCI + (int)$ENG + (int)$AP + (int)$MAP + (int)$CE;
                    $CONDIVIDE = $CONDUCT1 / 7;
                    $CONRESULT = number_format($CONDIVIDE,0);
                    if ($CONRESULT >= 79)
                        $CONMARKING = "NO";
                    else if($CONRESULT >= 84)
                        $CONMARKING = "RO";
                    else if($CONRESULT >= 89)
                        $CONMARKING = "SO";
                    else if($CONRESULT >= 94)
                        $CONMARKING = "AO";
                    else if($CONRESULT = "--")
                        $CONMARKING = "--";
    
                //CONDUCT 2ND QUARTER
                    $CONDUCT2 = 0;
                    if(((!is_null($FILS) && !is_null($MATHS) && !is_null($SCIS) &&  !is_null($ENGS) &&  !is_null($APS) &&  !is_null($MAPS) && !is_null($CES))))     
                    $CONDUCT2 = (int)$FIL + (int)$MATH + (int)$SCI + (int)$ENG + (int)$AP + (int)$MAP + (int)$CE;
                    $CONDIVIDE1 = $CONDUCT2 / 7;
                    $CONRESULT1 = number_format($CONDIVIDE1,0);
                    if ($CONRESULT1 >= 79)
                        $CONMARKING = "NO";
                    else if($CONRESULT1 >= 84)
                        $CONMARKING = "RO";
                    else if($CONRESULT1 >= 89)
                        $CONMARKING = "SO";
                    else if($CONRESULT1 >= 94)
                        $CONMARKING = "AO";
                    else if($CONRESULT1 = "--")
                        $CONMARKING = "--";
    
                //CONDUCT 3RD QUARTER                
                    $CONDUCT3 = 0;
                    if(((!is_null($FILSS) && !is_null($MATHSS) && !is_null($SCISS) &&  !is_null($ENGSS) &&  !is_null($APSS) &&  !is_null($MAPSS) && !is_null($CESS))))     
                    $CONDUCT3 = (int)$FIL + (int)$MATH + (int)$SCI + (int)$ENG + (int)$AP + (int)$MAP + (int)$CE;
                    $CONDIVIDE2 = $CONDUCT3 / 7;
                    $CONRESULT2 = number_format($CONDIVIDE2,0);
                    if ($CONRESULT2 >= 79)
                        $CONMARKING = "NO";
                    else if($CONRESULT2 >= 84)
                        $CONMARKING = "RO";
                    else if($CONRESULT2 >= 89)
                        $CONMARKING = "SO";
                    else if($CONRESULT2 >= 94)
                        $CONMARKING = "AO";
                    else if($CONRESULT2 = "--")
                        $CONMARKING = "--";
    
                //DEPORTMENT 4TH QUARTER
                    $CONDUCT4 = 0;
                    if(((!is_null($FILF) && !is_null($MATHF) && !is_null($SCIF) &&  !is_null($ENGF) &&  !is_null($APF) &&  !is_null($MAPF) && !is_null($CEF))))     
                    $CONDUCT4 = (int)$FIL + (int)$MATH + (int)$SCI + (int)$ENG + (int)$AP + (int)$MAP + (int)$CE;
                    $CONDIVIDE3 = $CONDUCT4 / 7;
                    $CONRESULT3 = number_format($CONDIVIDE3,0);
                    if ($CONRESULT3 >= 79)
                        $CONMARKING = "NO";
                    else if($CONRESULT3 >= 84)
                        $CONMARKING = "RO";
                    else if($CONRESULT3 >= 89)
                        $CONMARKING = "SO";
                    else if($CONRESULT3 >= 94)
                        $CONMARKING = "AO";
                    else if($CONRESULT3 = "--")
                        $CONMARKING = "--";
    
                //COMPUTER SUBJECT GRADES
                if(((!is_null($TOTALFIL2) && !is_null($TOTALENG2) && !is_null($TOTALMATH2) &&  !is_null($SCIFINAL) &&  
                !is_null($APFINAL) &&  !is_null($MAPFINAL) && !is_null($CEFINAL))))   
                $AVERA = 0;  
                    $AVERA = (int)$CEFINAL + (int)$MAPFINAL + (int)$APFINAL + (int)$SCIFINAL + (int)$TOTALMATH2 + (int)$TOTALENG2 + (int)$TOTALFIL2;
                    $AVERAG = $AVERA / 7;
                    $AVERAGE = number_format($AVERAG,2);
                    
                    if ($AVERAGE >= 75)
                        $depograde = "";
                    else if($AVERAGE = "--")
                        $depograde = "--";
                    else
                        $AVERAGE = "--";
    */
    
    ?>
    
    <html>
    <head> 
        <title> Student List View</title>
    </head>
    <link rel="icon" href="../Images/logo.png">
    
<link rel="stylesheet" href="../../Css/sepi.css">
    <body style="background-color:#E5E4E2">
        <div class="header">
        <p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>
            <form method="POST"action="logout.php" >
                <button type=submit name="logout" class="logout">Log Out</a>
            </form>
        </div>
        <form method=POST action="viewstudgrades.php">
    
        <!--<div class="dashboard">
                <img src="../Images/logo.png" class="dashboardlogocvgs">
                <a href="dashboard.php" class="Dashboardhome"><img src="../Images/homeicon.png" class="homeicon">Dashboard</a>
                <a href="announceview.php" class="Announcement"><img src="../Images/announcement.png" class="announcementicon">Announcement</a>
                <a href="student.php" class="Student"><img src="../Images/studrecord.png" class="studenticon">Student</a>
                <a href="teacher.php" class="Teacher"><img src="../Images/studrecord.png" class="teachericon">Teacher</a>
                <a href="accounts.php" class="Accounts"><img src="../Images/account.png" class="accounticon">Admin</a>
                <a href="adchangepass.php" class="Changepassadmin"><img src="../Images/pass.png" class="archiveicon">Account</a>
                <a href="audit.php" class="Audit"><img src="../Images/mag.png" class="auditicon">Audit Trail</a>
                <a href="../Archive/archive.php" class="Archive"><img src="../Images/arc.png" class="archiveicon">Archive</a>
            </div>-->
    
            <div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboardstudent.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcementstudent.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="viewacc.php" class="Accountstudent"><img src="../../Images/pass.png" class="accounticon">Account</a>
			<a href="finalgrade.php" class="Gradesstudent"><img src="../../Images/studgrade.png" class="teachericon">Grades</a>
</div>	
            <div class=finalgradediv>
            <?php echo "<a href='printgrade.php?ID=".$row['Stud_SID']."' class=printgrade>Print</a>"?>
    
              <table  class=tablefinalgrade border="0">
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
    
                <!--<tr>
                    <th class=headerfinalgrade>Mathematics</th>
                    <td class=datafinalgrade><input type=text name=studmathfirst class=datafinalgrade1 value="<?php echo $MATH; ?>" readonly></td>
                    <td class=datafinalgrade><input type=text name=studmathsecond class=datafinalgrade1 value="<?php echo $MATHS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studmaththird class=datafinalgrade1 value="<?php echo $MATHSS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studmathfourth class=datafinalgrade1 value="<?php echo $MATHF; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studmathfourth class=datafinalgrade1 value="<?php echo $TOTALMATH2; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studmathfourth class=datafinalgrade1 value="<?php echo $grademath; ?>"readonly></td>
                </tr>
                <tr>
                    <th class=headerfinalgrade>Science</th>
                    <td class=datafinalgrade><input type=text name=studscifirst class=datafinalgrade1 value="<?php echo $SCI; ?>" readonly></td>
                    <td class=datafinalgrade><input type=text name=studscisecond class=datafinalgrade1 value="<?php echo $SCIS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studscithird class=datafinalgrade1 value="<?php echo $SCISS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studscifourth class=datafinalgrade1 value="<?php echo $SCIF; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studscifourth class=datafinalgrade1 value="<?php echo $SCIFINAL; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studscifourth class=datafinalgrade1 value="<?php echo $gradesci; ?>"readonly></td>
    
                </tr>
                <tr>
                    <th class=headerfinalgrade>English</th>
                    <td class=datafinalgrade><input type=text name=studengfirst class=datafinalgrade1 value="<?php echo $ENG; ?>" readonly></td>
                    <td class=datafinalgrade><input type=text name=studengsecond class=datafinalgrade1 value="<?php echo $ENGS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studengthird class=datafinalgrade1 value="<?php echo $ENGSS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studengfourth class=datafinalgrade1 value="<?php echo $ENGF; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studengfourth class=datafinalgrade1 value="<?php echo $TOTALENG2; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studengfourth class=datafinalgrade1 value="<?php echo $gradeeng; ?>"readonly></td>
                </tr>
                <tr>
                    <th class=headerfinalgrade>Filipino</th>
                    <td class=datafinalgrade><input type=text name=studfilfirst class=datafinalgrade1 value="<?php echo $FIL; ?>" readonly></td>
                    <td class=datafinalgrade><input type=text name=studfilsecond class=datafinalgrade1 value="<?php echo $FILS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studfilthird class=datafinalgrade1 value="<?php echo $FILSS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studfilfourth class=datafinalgrade1 value="<?php echo $FILF; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studfilfourth class=datafinalgrade1 value="<?php echo $TOTALFIL2;?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studfilfourth class=datafinalgrade1 value="<?php echo $gradefil;?>"readonly></td>
                </tr>
                <tr>
                    <th class=headerfinalgrade>Araling Panlipunan</th>
                    <td class=datafinalgrade><input type=text name=studapfirst class=datafinalgrade1 value="<?php echo $AP; ?>" readonly></td>
                    <td class=datafinalgrade><input type=text name=studapsecond class=datafinalgrade1 value="<?php echo $APS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studapthird class=datafinalgrade1 value="<?php echo $APSS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studapfourth class=datafinalgrade1 value="<?php echo $APF; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studapfourth class=datafinalgrade1 value="<?php echo $APFINAL; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studapfourth class=datafinalgrade1 value="<?php echo $gradeap; ?>"readonly></td>
    
                </tr>
                
                <tr>
                    <th class=headerfinalgrade>MAPEH</th>
                    <td class=datafinalgrade><input type=text name=studmapehfirst class=datafinalgrade1 value="<?php echo $MAP; ?>" readonly></td>
                    <td class=datafinalgrade><input type=text name=studmapehsecond class=datafinalgrade1 value="<?php echo $MAPS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studmapehthird class=datafinalgrade1 value="<?php echo $MAPSS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studmapehfourth class=datafinalgrade1 value="<?php echo $MAPF; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studmapehfourth class=datafinalgrade1 value="<?php echo $MAPFINAL; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studmapehfourth class=datafinalgrade1 value="<?php echo $grademap; ?>"readonly></td>
    
                </tr>
                <tr>
                    <th class=headerfinalgrade>Edukasyon sa Pagpapakatao</th>
                    <td class=datafinalgrade><input type=text name=studcefirst class=datafinalgrade1 value="<?php echo $CE; ?>" readonly></td>
                    <td class=datafinalgrade><input type=text name=studcesecond class=datafinalgrade1 value="<?php echo $CES; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studcethird class=datafinalgrade1 value="<?php echo $CESS; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value="<?php echo $CEF; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value="<?php echo $CEFINAL; ?>"readonly></td>
                    <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value="<?php echo $gradece; ?>"readonly></td>
                </tr>-->
    
                <?php
                
    $conduct_prelim  = 0;
    $conduct_midterm = 0;
    $conduct_prefinal = 0;
    $conduct_final = 0;
    
    $deportment_prelim = 0;
    $deportment_midterm = 0;
    $deportment_prefinal = 0;
    $deportment_final = 0;
    // Fetch the data from the query
    $query = "SELECT tbl_subject.Grade_level, tbl_subject.ID, tbl_subject.Subject_code, tbl_subject.Subject_name, tbl_grades.Prelim, tbl_grades.Midterm, tbl_grades.Prefinal, tbl_grades.Final
     FROM
     tbl_studentinfo
     LEFT JOIN tbl_section ON tbl_studentinfo.`LEVEL` = tbl_section.Section
     LEFT JOIN tbl_subject ON tbl_section.Grade_Level = tbl_subject.Grade_level
     LEFT JOIN tbl_grades ON tbl_subject.Subject_code = tbl_grades.Subject_Code AND tbl_studentinfo.Stud_SID = tbl_grades.Student_Code
     where tbl_studentinfo.Stud_SID = ".$_SESSION['Stud_SID'].";";
    
    $result = mysqli_query($config, $query);
    $subjectcount =0;
    $average = 0;
    $finalPrelim = array();
    $finalMidterm = array();
    $finalPrefinal = array();
    $finalFinal = array();
    // Loop through the results and create a table row for each subject
    while ($row = mysqli_fetch_assoc($result)) {
        $subject_name = $row['Subject_name'];
        $prelim = $row['Prelim'];
        $midterm = $row['Midterm'];
        $prefinal = $row['Prefinal'];
        $final = $row['Final'];
    $isPrelim = isset($prelim) && $prelim >= 1 ? true : false;
    $isMidterm = isset($midterm) && $midterm >= 1 ? true : false;
    $isPrefi = isset($prefinal) && $prefinal >= 1 ? true : false;
    $isFinal = isset($final) && $final >= 1 ? true : false;
        
    array_push($finalPrelim,$prelim);
    array_push($finalMidterm,$midterm);
    array_push($finalPrefinal,$prefinal);
    array_push($finalFinal,$final);
    
        $conduct_prelim += $row['Prelim'];;
        $conduct_midterm += $row['Midterm'];
        $conduct_prefinal +=$row['Prefinal'] ;
        $conduct_final += $row['Final'];
    
        $deportment_prelim += $row['Prelim'];;
        $deportment_midterm += $row['Midterm'];
        $deportment_prefinal += $row['Prefinal'];
        $deportment_final += $row['Final'];
        $subjectcount += 1;
        // Calculate the total grade or any other calculations needed
       
    
        $total_grade = ($prelim + $midterm + $prefinal + $final)/4 == 0 ? "--" : ($prelim + $midterm + $prefinal + $final)/4;
       
        if (is_int($total_grade)) {
            // If it's an integer, round it
            $grade = round($total_grade);
            $average += $grade;
        } else {
            // If it's not an integer, use the original value
            $grade = $total_grade;
            
        }
    
        
        if ($grade >= 75)
            $remarks = "Passed";
        else if ($grade <= 75 && $grade >= 1)
            $remarks = "Failed";
        else if($grade = "--")
            $remarks = "--";
        else
            $remarks = "--";
    
    
    
    
    
        echo "<tr>";
        echo "<th class='headerfinalgrade'>$subject_name</th>";
        echo "<td class='datafinalgrade'><input type='text' name='stud{$subject_name}first' class='datafinalgrade1' value='$prelim' readonly></td>";
        echo "<td class='datafinalgrade'><input type='text' name='stud{$subject_name}second' class='datafinalgrade1' value='$midterm' readonly></td>";
        echo "<td class='datafinalgrade'><input type='text' name='stud{$subject_name}third' class='datafinalgrade1' value='$prefinal' readonly></td>";
        echo "<td class='datafinalgrade'><input type='text' name='stud{$subject_name}fourth' class='datafinalgrade1' value='$final' readonly></td>";
        if($isPrefi == true && $isMidterm == true && $isPrefi == true && $isFinal == true){
            echo "<td class='datafinalgrade'><input type='text' name='stud{$subject_name}fourth' class='datafinalgrade1' value='$total_grade' readonly></td>";
            echo "<td class='datafinalgrade'><input type='text' name='stud{$subject_name}fourth' class='datafinalgrade1' value='$remarks' readonly></td>";
            
        }else{
            echo "<td class='datafinalgrade'><input type='text' name='stud{$subject_name}fourth' class='datafinalgrade1' value='' readonly></td>";
            echo "<td class='datafinalgrade'><input type='text' name='stud{$subject_name}fourth' class='datafinalgrade1' value='' readonly></td>";
            
        }
       echo "</tr>";
    }
    ?>
                <tr>
                    <th class=headerfinalgrade></th>
                    <td class=datafinalgrade><input type=text name=studcefirst class=datafinalgrade1 value="" readonly></td>
                    <td class=datafinalgrade><input type=text name=studcesecond class=datafinalgrade1 value=""readonly></td>
                    <td class=datafinalgrade><input type=text name=studcethird class=datafinalgrade1 value=""readonly></td>
                    <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value=""readonly></td>
                    <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value=""readonly></td>
                    <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value=""readonly></td>
                </tr>
                <tr>
        <th class="headerfinalgrade">Conduct</th>
        <?php
        $prelimAverage = in_array('', $finalPrelim) || in_array(null, $finalPrelim) || array_sum($finalPrelim) < $subjectcount ? '' : round(array_sum($finalPrelim) / $subjectcount);
        $midtermAverage = in_array('', $finalMidterm) || in_array(null, $finalMidterm) || array_sum($finalMidterm) < $subjectcount ? '' : round(array_sum($finalMidterm) / $subjectcount);
        $prefinalAverage = in_array('', $finalPrefinal) || in_array(null, $finalPrefinal) || array_sum($finalPrefinal) < $subjectcount ? '' : round(array_sum($finalPrefinal) / $subjectcount);
        $finalAverage = in_array('', $finalFinal) || in_array(null, $finalFinal) || array_sum($finalFinal) < $subjectcount ? '' : round(array_sum($finalFinal) / $subjectcount);
        
        echo '<td class="datafinalgrade"><input type="text" name="studcefirst" class="datafinalgrade1" value="' . $prelimAverage . '" readonly></td>';
        echo '<td class="datafinalgrade"><input type="text" name="studcesecond" class="datafinalgrade1" value="' . $midtermAverage . '" readonly></td>';
        echo '<td class="datafinalgrade"><input type="text" name="studcethird" class="datafinalgrade1" value="' . $prefinalAverage . '" readonly></td>';
        echo '<td class="datafinalgrade"><input type="text" name="studcefourth" class="datafinalgrade1" value="' . $finalAverage . '" readonly></td>';
        
        $conductsum = array_sum($finalPrelim) + array_sum($finalMidterm) + array_sum($finalPrefinal) + array_sum($finalFinal);
        $conductcount = count(array_filter($finalPrelim)) + count(array_filter($finalMidterm)) + count(array_filter($finalPrefinal)) + count(array_filter($finalFinal));
        $conductAverage = in_array('', $finalPrelim) || in_array(null, $finalPrelim) || in_array('', $finalMidterm) || in_array(null, $finalMidterm) || in_array('', $finalPrefinal) || in_array(null, $finalPrefinal) || in_array('', $finalFinal) || in_array(null, $finalFinal) || $conductsum < $subjectcount * 4 ? '' : $conductsum / $conductcount;
        
        echo '<td class="datafinalgrade"><input type="text" name="studceaverage" class="datafinalgrade1" value="' . round($conductAverage) . '" readonly></td>';
        
        $remarks = $conductAverage !== '' ? ($conductAverage >= 75 ? 'Passed' : 'Failed') : '';
        echo '<td class="datafinalgrade"><input type="text" name="studceaverage" class="datafinalgrade1" value="' . $remarks . '" readonly></td>';
        
        
        ?>
        
    
    </tr>
                <tr>
                    <th class=headerfinalgrade>Club</th>
                    <td class=datafinalgrade><input type=text name=studcefirst class=datafinalgrade1 value="" readonly></td>
                    <td class=datafinalgrade><input type=text name=studcesecond class=datafinalgrade1 value=""readonly></td>
                    <td class=datafinalgrade><input type=text name=studcethird class=datafinalgrade1 value=""readonly></td>
                    <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value=""readonly></td>
                    <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value=""readonly></td>
                    <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value=""readonly></td>
                </tr>
                <tr>
      <th class=headerfinalgrade>Deportment</th>
      <?php
      $prelimAverage = in_array('', $finalPrelim) || in_array(null, $finalPrelim) || array_sum($finalPrelim) < $subjectcount ? '' : round(array_sum($finalPrelim) / $subjectcount);
      $midtermAverage = in_array('', $finalMidterm) || in_array(null, $finalMidterm) || array_sum($finalMidterm) < $subjectcount ? '' : round(array_sum($finalMidterm) / $subjectcount);
      $prefinalAverage = in_array('', $finalPrefinal) || in_array(null, $finalPrefinal) || array_sum($finalPrefinal) < $subjectcount ? '' : round(array_sum($finalPrefinal) / $subjectcount);
      $finalAverage = in_array('', $finalFinal) || in_array(null, $finalFinal) || array_sum($finalFinal) < $subjectcount ? '' : round(array_sum($finalFinal) / $subjectcount);
      
      echo '<td class="datafinalgrade"><input type="text" name="studcefirst" class="datafinalgrade1" value="' . $prelimAverage . '" readonly></td>';
      echo '<td class="datafinalgrade"><input type="text" name="studcesecond" class="datafinalgrade1" value="' . $midtermAverage . '" readonly></td>';
      echo '<td class="datafinalgrade"><input type="text" name="studcethird" class="datafinalgrade1" value="' . $prefinalAverage . '" readonly></td>';
      echo '<td class="datafinalgrade"><input type="text" name="studcefourth" class="datafinalgrade1" value="' . $finalAverage . '" readonly></td>';
      
      $conductsum = array_sum($finalPrelim) + array_sum($finalMidterm) + array_sum($finalPrefinal) + array_sum($finalFinal);
      $conductcount = count(array_filter($finalPrelim)) + count(array_filter($finalMidterm)) + count(array_filter($finalPrefinal)) + count(array_filter($finalFinal));
      $DeportmentAverage = in_array('', $finalPrelim) || in_array(null, $finalPrelim) || in_array('', $finalMidterm) || in_array(null, $finalMidterm) || in_array('', $finalPrefinal) || in_array(null, $finalPrefinal) || in_array('', $finalFinal) || in_array(null, $finalFinal) || $conductsum < $subjectcount * 4 ? '' : $conductsum / $conductcount;
      
      echo '<td class="datafinalgrade"><input type="text" name="studceaverage" class="datafinalgrade1" value="' . round($DeportmentAverage) . '" readonly></td>';
      
      $remarks = $conductAverage !== '' ? ($conductAverage >= 75 ? 'Passed' : 'Failed') : '';
      echo '<td class="datafinalgrade"><input type="text" name="studceremarks" class="datafinalgrade1" value="' . $remarks . '" readonly></td>';
      ?>
    </tr>
    </tr>
                <tr>
                    <th colspan=5 class=headerfinalgrade>General Average</th>
                    <?php
    $prelimAverage = in_array('', $finalPrelim) || in_array(null, $finalPrelim) || array_sum($finalPrelim) < $subjectcount ? '' : round(array_sum($finalPrelim) / $subjectcount);
    $midtermAverage = in_array('', $finalMidterm) || in_array(null, $finalMidterm) || array_sum($finalMidterm) < $subjectcount ? '' : round(array_sum($finalMidterm) / $subjectcount);
    $prefinalAverage = in_array('', $finalPrefinal) || in_array(null, $finalPrefinal) || array_sum($finalPrefinal) < $subjectcount ? '' : round(array_sum($finalPrefinal) / $subjectcount);
    $finalAverage = in_array('', $finalFinal) || in_array(null, $finalFinal) || array_sum($finalFinal) < $subjectcount ? '' : round(array_sum($finalFinal) / $subjectcount);
    
    if ($prelimAverage !== '' && $midtermAverage !== '' && $prefinalAverage !== '' && $finalAverage !== '') {
        $average = ($prelimAverage + $midtermAverage + $prefinalAverage + $finalAverage) / 4;
    } else {
        $average = '';
    }
    
    if ($average !== '') {
        $DeportmentAverage = in_array('', $finalPrelim) || in_array(null, $finalPrelim) || in_array('', $finalMidterm) || in_array(null, $finalMidterm) || in_array('', $finalPrefinal) || in_array(null, $finalPrefinal) || in_array('', $finalFinal) || in_array(null, $finalFinal) || $conductsum < $subjectcount * 4 ? '' : $conductsum / $conductcount;
        $conductsum = array_sum($finalPrelim) + array_sum($finalMidterm) + array_sum($finalPrefinal) + array_sum($finalFinal);
        $conductcount = count(array_filter($finalPrelim)) + count(array_filter($finalMidterm)) + count(array_filter($finalPrefinal)) + count(array_filter($finalFinal));
        $conductAverage = in_array('', $finalPrelim) || in_array(null, $finalPrelim) || in_array('', $finalMidterm) || in_array(null, $finalMidterm) || in_array('', $finalPrefinal) || in_array(null, $finalPrefinal) || in_array('', $finalFinal) || in_array(null, $finalFinal) || $conductsum < $subjectcount * 4 ? '' : $conductsum / $conductcount;
    
        $final = ($average + $DeportmentAverage + $conductAverage)  /3;
        $finalAverage = $final < 1 ? '--' : round($final);
    
        if (!empty($finalAverage)) {
            echo '<th colspan=2 class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value="' . $finalAverage . '" readonly></th>';
        }else{
            echo '<th colspan=2 class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value="" readonly></th>';
           
        }
    }
    
                    ?>
                      </tr>
            </table>
            </div>	
    
    </body>
    </html>
    
    </script>