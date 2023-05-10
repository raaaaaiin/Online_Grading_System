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
                $ID   = $line[0];
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
                $prevQuery = "SELECT Stud_SID FROM tbl_studentinfo WHERE Stud_SID = '".$Stud_ID."'";
                $prevResult = $config->query($prevQuery);
                
                if($prevResult->num_rows > 0){
                    // Update member data in the database
                    $config->query("UPDATE tbl_studentinfo SET Stud_SID = '".$Stud_ID. "', FNAME = '".$FNAME."', MNAME = '". $MNAME."',LNAME = '". $LNAME."',
                     USERNAME = '". $UNAME."',ADDRESS = '". $ADDRESS."', EMAIL = '". $EMAIL."', PASS = '". $PASS."', BDAY = '". $BDAY."', AGE = '". $AGE."', 
                     GENDER = '". $GENDER."', LEVEL = '". $LEVEL."', YEAR = '". $YEAR."', LRN = '". $LRN."', Role = '". $Role."' WHERE Stud_SID = '".$ID."'");
                   }else{
                    // Insert member data in the database
                    $config->query("INSERT INTO tbl_studentinfo (Stud_SID, FNAME, MNAME, LNAME, USERNAME, ADDRESS, EMAIL, PASS, BDAY, AGE, GENDER, LEVEL, YEAR, LRN, Role)
                     VALUES ('".$Stud_ID. "', '".$FNAME."', '".$MNAME."', '".$LNAME."', '".$UNAME."', '". $ADDRESS."', '". $EMAIL."', '". $PASS."', '". $BDAY."', '". $AGE."', '".$GENDER."', '". $LEVEL."', '". $YEAR."', '". $LRN."', '". $Role."')");
              }
            }
            
            // Close opened CSV file
            fclose($csvFile);
            
            echo '<div id="custom-dialog" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
            <div style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            text-align: center; width: 300px; max-width: 90%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#32CD32" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <h2 style="margin-top: 0;">Success</h2>
                <p>Data imported succesfully</p>
                <button id="ok-button" style="background: #3085d6; color: #fff; border: none; padding: 10px 20px; border-radius: 3px; cursor: pointer; font-size: 14px; margin-top: 10px;">OK</button>
            </div>
        </div>';
    
        echo '<script>
            document.getElementById("ok-button").addEventListener("click", function () {
                window.location.href = "student.php";
            });
        </script>';
        }else{
            $qstring = '?status=err';
            
        echo '<div id="custom-dialog" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
        <div style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); text-align: center; width: 300px; max-width: 90%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#FF0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <h2 style="margin-top: 0;">Error</h2>
            <p>Failed to import data</p>
            <button id="ok-button" style="background: #3085d6; color: #fff; border: none; padding: 10px 20px; border-radius: 3px; cursor: pointer; font-size: 14px; margin-top: 10px;">OK</button>
        </div>
    </div>';
    
        echo '<script>
            document.getElementById("ok-button").addEventListener("click", function () {
                window.location.href = "student.php";
            });
        </script>';
        }
    }else{
        echo '<div id="custom-dialog" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 1000;">
        <div style="background: #fff; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); text-align: center; width: 300px; max-width: 90%;">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#FFA500" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12" y2="16"></line>
            </svg>
            <h2 style="margin-top: 0;">Oops!</h2>
            <p>File is invalid format</p>
            <button id="ok-button" style="background: red; color: #fff; border: none; padding: 10px 20px; border-radius: 3px; cursor: pointer; font-size: 14px; margin-top: 10px;">OK</button>
        </div>
    </div>';
    
        echo '<script>
            document.getElementById("ok-button").addEventListener("click", function () {
                window.location.href = "student.php";
            });
        </script>';
    }
}