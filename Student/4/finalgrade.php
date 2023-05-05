
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
            
            $FIL = $row['FIL'];
            $FILS = $row['FILS'];
            $FILSS = $row['FILSS'];
            $FILF = $row['FILF'];
            $FILFINAL = 0;
            if((!is_null($FILF)))
                
                $FILFINAL = $FIL + $FILS + $FILSS + $FILF;
                $TOTALFIL1 = $FILFINAL / 4;
                $TOTALFIL2 = (round($TOTALFIL1));
                if ($TOTALFIL2 >= 75)
                    $gradefil = "Passed";
                else if ($TOTALFIL2 <= 75 && $TOTALFIL2 >= 1)
                    $gradefil = "Failed";
                else if($TOTALFIL2 = "--")
                    $gradefil = "--";
                else
                    $TOTALFIL2 = "--";

            //ENGLISH SUBJECT GRADES           
            $ENG = $row['ENG'];
            $ENGS = $row['ENGS'];
            $ENGSS = $row['ENGSS'];
            $ENGF = $row['ENGF'];
            $ENGFINAL = 0;
            if((!is_null($ENGF)))
            $ENGFINAL = $ENG + $ENGS + $ENGSS + $ENGF;
            $TOTALENG1 = $ENGFINAL / 4;
            $TOTALENG2 = (round($TOTALENG1));
            if ($TOTALENG2 >= 75)
                $gradeeng = "Passed";
            else if ($TOTALENG2 <= 75 && $TOTALENG2 >= 1)
                $gradeeng = "Failed";
            else if($TOTALENG2 = "--")
                $gradeeng = "--";
            else
                $TOTALENG2 = "--";

 
            //MATHEMATICS SUBJECT GRADES                           
            $MATH = $row['MATH'];
            $MATHS = $row['MATHS'];
            $MATHSS = $row['MATHSS'];
            $MATHF = $row['MATHF'];
            $TOTALMATH = 0;
            if((!is_null($MATHF)))
            $TOTALMATH = $MATH + $MATHS + $MATHSS + $MATHF;
            $TOTALMATH1 = $TOTALMATH / 4;
            $TOTALMATH2 = (round($TOTALMATH1));
            if ($TOTALMATH2 >= 75)
                $grademath = "Passed";
            else if ($TOTALMATH2 <= 75 && $TOTALMATH2 >= 1)
                $grademath = "Failed";
            else if($TOTALMATH2 = "--")
                $grademath = "--";
            else
                $TOTALMATH2 = "--"; 
                
            //SCIENCE SUBJECT GRADES
            $SCI = $row['SCI'];
            $SCIS = $row['SCIS'];
            $SCISS = $row['SCISS'];
            $SCIF = $row['SCIF'];
            $TOTALSCI = 0;
            if((!is_null($SCIF)))
                
                $TOTALSCI = $SCI + $SCIS + $SCISS + $SCIF;
                $TOTALSCI1 = $TOTALSCI / 4;
                $SCIFINAL = (round($TOTALSCI1));
                if ($SCIFINAL >= 75)
                    $gradesci = "Passed";
                else if ($SCIFINAL <= 75 && $SCIFINAL >= 1)
                    $gradesci = "Failed";
                else if($SCIFINAL = "--")
                    $gradesci = "--";
                else
                    $SCIFINAL = "--";
           

            //AP SUBJECT GRADES           
            $AP = $row['AP'];
            $APS = $row['APS'];
            $APSS = $row['APSS'];
            $APF = $row['APF'];
            $TOTALAP = 0;
            if((!is_null($APF)))
                
                $TOTALAP = $AP + $APS + $APSS + $APF;
                $TOTALAP1 = $TOTALSCI / 4;
                $APFINAL = (round($TOTALAP1));
                if ($APFINAL >= 75)
                    $gradeap = "Passed";
                else if ($APFINAL <= 75 && $APFINAL >= 1)
                    $gradeap = "Failed";
                else if($APFINAL = "--")
                    $gradeap = "--";
                else
                    $APFINAL = "--";

            //TLE SUBJECT GRADES           
            $TLE = $row['TLE'];
            $TLES = $row['TLES'];
            $TLESS = $row['TLESS'];
            $TLEF = $row['TLEF'];
            $TOTALTLE = 0;
            if((!is_null($TLEF)))
                
            $TOTALTLE = $TLE + $TLES + $TLESS + $TLEF;
                $TOTALTLE1 = $TOTALTLE / 4;
                $TOTALTLE2 = (round($TOTALTLE1));
                if ($TOTALTLE2 >= 75)
                    $gradetle = "Passed";
                else if ($TOTALTLE2 <= 75 && $TOTALTLE2 >= 1)
                    $gradetle = "Failed";
                else if($TOTALTLE2 = "--")
                    $gradetle = "--";
                else
                    $TOTALTLE2 = "--";

            //MAPEH SUBJECT GRADES           
            $MAP = $row['MAP'];
            $MAPS = $row['MAPS'];
            $MAPSS = $row['MAPSS'];
            $MAPF = $row['MAPF'];
            $TOTALMAP = 0;
            if((!is_null($MAPF)))
                
                $TOTALMAP = $MAP + $MAPS + $MAPSS + $MAPF;
                $TOTALMAP1 = $TOTALSCI / 4;
                $MAPFINAL = (round($TOTALMAP1));
                if ($MAPFINAL >= 75)
                    $grademap = "Passed";
                else if ($MAPFINAL <= 75 && $MAPFINAL >= 1)
                    $grademap = "Failed";
                else if($MAPFINAL = "--")
                    $grademap = "--";
                else
                    $MAPFINAL = "--";

            //Edukasyon sa Pagpapakatao	 SUBJECT GRADES           
            $CE = $row['CE'];
            $CES = $row['CES'];
            $CESS = $row['CESS'];
            $CEF = $row['CEF'];
            $TOTALCE = 0;
            if((!is_null($MAPF)))
                
                $TOTALCE = $CE + $CE + $CE + $CE;
                $TOTALCE1 = $TOTALCE / 4;
                $CEFINAL = (round($TOTALCE1));
                
                if ($CEFINAL >= 75)
                    $gradece = "Passed";
                else if ($CEFINAL <= 75 && $CEFINAL >= 1)
                    $gradece = "Failed";
                else if($CEFINAL = "--")
                    $gradece = "--";
                else
                    $CEFINAL = "--";

                    $DEP = 0;
                    if(((!is_null($FIL) && !is_null($MATH) && !is_null($SCI) &&  !is_null($ENG) &&  !is_null($AP) && !is_null($TLE) &&  !is_null($MAP) && !is_null($CE))))     
                    $DEP = (int)$FIL + (int)$MATH + (int)$SCI + (int)$ENG + (int)$AP + (int)$TLE + (int)$MAP + (int)$CE;
                    $DEP1 = $DEP / 8;
                    $DEPO = number_format($DEP1,0);
                    if ($DEPO >= 75)
                    $depograde1 = "";
                    else if($DEPO = "--")
                        $depograde1 = "--";
    
                    $DEP5 = 0;
                    if(((!is_null($FILS) && !is_null($MATHS) && !is_null($SCIS) &&  !is_null($ENGS) &&  !is_null($APS) && !is_null($TLES) &&  !is_null($MAPS) && !is_null($CES))))     
                    $DEP5 = (int)$FILS + (int)$MATHS + (int)$SCIS + (int)$ENGS + (int)$APS + (int)$TLES + (int)$MAPS  + (int)$CES;
                    $DEP2 = $DEP5 / 8;
                    $DEPO1 = number_format($DEP2,0);
                    if ($DEPO1 >= 75)
                    $depograde1 = "";
                    else if($DEPO1 = "--")
                        $depograde1 = "--";
                    
                    $DEP6 = 0;
                    if(((!is_null($FILSS) && !is_null($MATHSS) && !is_null($SCISS) &&  !is_null($ENGSS) &&  !is_null($APSS) && !is_null($TLESS) &&  !is_null($MAPSS) && !is_null($CESS))))     
                    $DEP6 = (int)$FILSS + (int)$MATHSS + (int)$SCISS + (int)$ENGSS + (int)$APSS + (int)$TLESS + (int)$MAPSS + (int)$CESS;
                    $DEP3 = $DEP6 / 8;
                    $DEPO2 = number_format($DEP3,0);
                    if ($DEPO2 >= 75)
                    $depograde1 = "";
                    else if($DEPO2 = "--")
                        $depograde1 = "--";
    
                    $DEP7 = 0;
                    if(((!is_null($FILF) && !is_null($MATHF) && !is_null($SCIF) &&  !is_null($ENGF) &&  !is_null($APF) && !is_null($TLEF) &&  !is_null($MAPF) && !is_null($CEF))))     
                    $DEP7 = (int)$FILF + (int)$MATHF + (int)$SCIF + (int)$ENGF + (int)$APF + (int)$TLEF + (int)$MAPF + (int)$CEF;
                    $DEP4 = $DEP7 / 8;
                    $DEPO3 = number_format($DEP4,0);

                    if ($DEPO3 >= 75)
                        $depograde = "Passed";
                    else if ($DEPO3 <= 75 && $DEPO3 >= 1)
                        $depograde = "Failed";
                    else if($DEPO3 = "--")
                        $depograde = "--";
                    else
                        $DEPO3 = "--";
                    
                        
                if(((!is_null($TOTALFIL2) && !is_null($TOTALENG2) && !is_null($TOTALMATH2) &&  !is_null($SCIFINAL) &&  
                !is_null($APFINAL) &&  !is_null($TOTALTLE2) &&  !is_null($MAPFINAL) && !is_null($CEFINAL))))   
                $AVERA = 0;  
                    $AVERA = (int)$CEFINAL + (int)$MAPFINAL + (int)$APFINAL + (int)$SCIFINAL + (int)$TOTALMATH2 + (int)$TOTALENG2 + (int)$TOTALFIL2 + (int)$TOTALTLE2;
                    $AVERAG = $AVERA / 8;
                    $AVERAGE = number_format($AVERAG,2);
                    
                    if ($AVERAGE >= 75)
                        $depograde = "";
                    else if($AVERAGE = "--")
                        $depograde = "--";
                    else
                        $AVERAGE = "--";


?>

<html>
<head> 
    <title> Grade</title>
</head>
<link rel="icon" href="../../Images/logo.png">
<link rel="stylesheet" href="../../Css/sepi.css">
<body style="background-color:#E5E4E2">
    <div class="header">
<p class="displayname"><?php echo "$name" ?> &nbsp&nbsp | &nbsp&nbsp <?php echo "$section" ?></p>
        <form method="POST"action="logout.php" >
			<button type=submit name="logout" class="logout">Log Out</a>
        </form>
    </div>
    <form method=POST action="finalgrade.php">

<div class="dashboard">
			<img src="../../Images/logo.png" class="dashboardlogocvgs">
			<a href="dashboardstudent.php" class="Dashboardhome"><img src="../../Images/homeicon.png" class="homeicon">Dashboard</a>
			<a href="announcementstudent.php" class="Announcement"><img src="../../Images/announcement.png" class="announcementicon">Announcement</a>
			<a href="viewacc.php" class="Accountstudent"><img src="../../Images/pass.png" class="accounticon">Account</a>
			<a href="finalgrade.php" class="Gradesstudent"><img src="../../Images/studgrade.png" class="teachericon">Grades</a>
</div>	
<div class=finalgradediv>
        <a href=printgrade.php class=printgrade>Print</a>

          <table  class=tablefinalgrade border="0">
            <tr>
                <th class=headerfinalgrade>Student Name:</th>
                <td colspan=3 class=datafinalgrade><input type=text name=studname class=datafnamefinalgrade value="<?php echo $FULLNAME; ?>"readonly></td>
                <th class=headerfinalgrade>LEVEL:</th>
                <th colspan=2 class=datafinalgrade><input type=text name=studlevel class=datalvlfinalgrade value="<?php echo $LEVEL; ?>"readonly></th>
            </tr>
            <tr>
                <th rowspan=2 class=headerfinalgrade>Subjects</th>
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
                <th class=headerfinalgrade>HELE</th>
                <td class=datafinalgrade><input type=text name=studmapehfirst class=datafinalgrade1 value="<?php echo $TLE; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studmapehsecond class=datafinalgrade1 value="<?php echo $TLES; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studmapehthird class=datafinalgrade1 value="<?php echo $TLESS; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studmapehfourth class=datafinalgrade1 value="<?php echo $TLEF; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studmapehfourth class=datafinalgrade1 value="<?php echo $TOTALTLE2; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studmapehfourth class=datafinalgrade1 value="<?php echo $gradetle; ?>"readonly></td>

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

            </tr>
            <tr>
                <th class=headerfinalgrade>Deportment</th>
                <td class=datafinalgrade><input type=text name=studcefirst class=datafinalgrade1 value="<?php echo $DEPO; ?>" readonly></td>
                <td class=datafinalgrade><input type=text name=studcesecond class=datafinalgrade1 value="<?php echo $DEPO1; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studcethird class=datafinalgrade1 value="<?php echo $DEPO2; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value="<?php echo $DEPO3; ?>"readonly></td>
                <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value=""readonly></td>
                <td class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value="<?php echo $depograde; ?>"readonly></td>
            </tr>
            <tr>
                <th colspan=5 class=headerfinalgrade>General Average</th>
                <th colspan=2  class=datafinalgrade><input type=text name=studcefourth class=datafinalgrade1 value="<?php echo $AVERAGE; ?>"readonly></th>
            </tr>
        </table>
    </div>
    </div>

</body>
</html>



