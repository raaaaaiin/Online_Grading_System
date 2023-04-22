<?php 
// Load the database configuration file 
include "../sepi_connect.php";
 
$filename = "Students" . date('Y-m-d') . ".csv"; 
$delimiter = ","; 
 
// Create a file pointer 
$f = fopen('php://memory', 'w'); 
 
// Set column headers 
$fields = array('Stud_ID', 'FNAME', 'MNAME' ,'LNAME' ,'USERNAME', 'ADDRESS',
 'EMAIL', 'PASS', 'BDAY', 'AGE', 'GENDER' , 'LEVEL' , 'YEAR' , 'LRN' , 'Role'); 
fputcsv($f, $fields, $delimiter); 
 
// Get records from the database 
$result = $config->query("SELECT * FROM tbl_student ORDER BY Stud_SID DESC"); 
if($result->num_rows > 0){ 
    // Output each row of the data, format line as csv and write to file pointer 
    while($row = $result->fetch_assoc()){ 
        $lineData = array($row['Stud_ID'], $row['FNAME'], $row['MNAME'], $row['LNAME'], $row['USERNAME'], $row['ADDRESS'], $row['EMAIL'], $row['PASS'], $row['BDAY'],$row['AGE'],
         $row['GENDER'] ,$row['LEVEL'],$row['YEAR'],$row['LRN'],$row['Role']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
} 
 
// Move back to beginning of file 
fseek($f, 0); 
 
// Set headers to download file rather than displayed 
header('Content-Type: text/csv'); 
header('Content-Disposition: attachment; filename="' . $filename . '";'); 
 
// Output all remaining data on a file pointer 
fpassthru($f); 
 
// Exit from file 
exit();