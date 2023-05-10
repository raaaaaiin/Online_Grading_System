
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
            $row = $result->fetch_assoc();
            $FNAME = $row['FNAME'];
            $MNAME = $row['MNAME'];
            $LNAME = $row['LNAME'];
            $FULLNAME = $FNAME." ".$MNAME." ".$LNAME;
            $LEVEL = $row['LEVEL'];
		            $YEAR = $row['YEAR'];
            
           

?>

<html>
<head> 
    <title> Student List View</title>
</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../../Css/sepi.css">
<body onload="window.print()">
<?php
				header("refresh:0;url=finalgrade.php");

?>
<br>
<center>
<h1>SCHOOL OF EVERLASTING PEARL, INC.</h1>
<p>#066 Phase 3, Siruna Village, Mambugan, Antipolo City 1870</p></center>
<br>
<img src="../../Images/logo.png" class=logoprint>
<p class=infoprint>Student Name: <?php echo $FULLNAME; ?></p>
<p class=infoprint>Level: <?php echo $LEVEL; ?></p>
<p class=infoprint>School Year: <?php echo $YEAR; ?></p>
<center><h2>REPORT CARD</h2>
</center>
<div class=finalgradediv1>

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
    </div>
</body>
</html>
