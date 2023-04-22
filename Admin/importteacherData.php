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
                $Employee_ID   = $line[0];
                $FNAMES   = $line[1];
                $MNAMES  = $line[2];
                $LNAMES  = $line[3];
                $UNAME   = $line[4];
                $ADDRESS   = $line[5];
                $EMAIL   = $line[6];
                $PASS   = $line[7];
                $BDAYS   = $line[8];
                $AGES   = $line[9];
                $GENDERS   = $line[10];
                $SUBJECTS   = $line[11];
                $Role   = $line[12];

                
                // Check whether member already exists in the database with the same email
                $prevQuery = "SELECT TID FROM tbl_teacher WHERE Employee_ID = '".$line[0]."'";
                $prevResult = $config->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $config->query("UPDATE tbl_teacher SET Employee_ID = '".$Employee_ID. "', FNAMES = '".$FNAMES."', MNAMES = '". $MNAMES."',LNAMES = '". $LNAMES."',
                    USERNAME = '". $UNAME."', ADDRESS = '". $ADDRESS."', EMAIL = '". $EMAIL."', PASS = '". $PASS."', BDAYS = '". $BDAYS."', AGES = '". $AGES."', 
                     GENDERS = '". $GENDERS."', SUBJECTS = '". $SUBJECTS."',  Role = '". $Role."' WHERE TID = '".$ID."'");
                }else{
                    // Insert member data in the database
                    $config->query("INSERT INTO tbl_teacher (Employee_ID, FNAMES, MNAMES, LNAMES, USERNAME, ADDRESS, EMAIL, PASS, BDAYS, AGES, GENDERS, SUBJECTS, Role)
                     VALUES ('".$Employee_ID. "', '".$FNAMES."', '".$MNAMES."', '".$LNAMES."' , '".$UNAME."', '". $ADDRESS."', '". $EMAIL."', '". $PASS."', '". $BDAYS."', '". $AGES."', '".$GENDERS."', '". $SUBJECTS."', '". $Role."')");
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
header("Location: teacher.php".$qstring);