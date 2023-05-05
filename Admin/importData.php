<?php
// Load the database configuration file
include "../sepi_connect.php";

if(isset($_POST['importSubmit'])){
    
    // Allowed mime types
    $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
    
    // Validate whether selected file is a CSV file
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){
        
        // If the file is uploaded
        if(is_uploaded_file($_FILES['file']['tmp_name'])){
            
            // Open uploaded CSV file with read-only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');
            
            // Skip the first line
            fgetcsv($csvFile);
            
            // Parse data from CSV file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
                // Get row data
                $Stud_ID   = $line[0];
                $FNAME   = $line[1];
                $MNAME  = $line[2];
                $LNAME  = $line[3];
                $UNAME = $line[4];
                $ADDRESS   = $line[5];
                $EMAIL   = $line[6];
                $PASS   = $line[7];
                $BDAY   = $line[8];
                $AGE   = $line[9];
                $GENDER   = $line[10];
                $LEVEL   = $line[11];
                $YEAR   = $line[12];
                $LRN   = $line[13];
                $Role   = $line[14];

                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT Stud_SID FROM tbl_studentinfo WHERE Stud_ID = '".$line[0]."'";
                $prevResult = $config->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $config->query("UPDATE tbl_studentinfo SET Stud_ID = '".$Stud_ID. "', FNAME = '".$FNAME."', MNAME = '". $MNAME."',LNAME = '". $LNAME."',
                     USERNAME = '". $UNAME."',ADDRESS = '". $ADDRESS."', EMAIL = '". $EMAIL."', PASS = '". $PASS."', BDAY = '". $BDAY."', AGE = '". $AGE."', 
                     GENDER = '". $GENDER."', LEVEL = '". $LEVEL."', YEAR = '". $YEAR."', LRN = '". $LRN."', Role = '". $Role."' WHERE Stud_SID = '".$ID."'");
                }else{
                    // Insert member data in the database
                    $config->query("INSERT INTO tbl_studentinfo (Stud_ID, FNAME, MNAME, LNAME, USERNAME, ADDRESS, EMAIL, PASS, BDAY, AGE, GENDER, LEVEL, YEAR, LRN, Role)
                     VALUES ('".$Stud_ID. "', '".$FNAME."', '".$MNAME."', '".$LNAME."', '".$UNAME."', '". $ADDRESS."', '". $EMAIL."', '". $PASS."', '". $BDAY."', '". $AGE."', '".$GENDER."', '". $LEVEL."', '". $YEAR."', '". $LRN."', '". $Role."')");
                }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            $qstring = '?status=succ';
        }else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

// Redirect to the listing page
header("Location: student.php".$qstring);