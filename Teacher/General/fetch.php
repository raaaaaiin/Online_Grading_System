<?php
// Include the database connection file
include "../../sepi_connect.php";

// Get the query parameter from the client-side JavaScript code
$selectedGrade = $_GET['query'];
// Construct the SQL query to retrieve the subjects for the selected grade
$query = $selectedGrade;

// Execute the query and retrieve the result set
$result = mysqli_query($config, $query);

// Create an array to hold the result set
$subjects = array();

// Loop through the result set and add each subject to the array
while ($row = mysqli_fetch_assoc($result)) {
    $subjects[] = $row;
}

// Close the result set and database connection
mysqli_free_result($result);
mysqli_close($config);

// Return the array of subjects as JSON
header('Content-Type: application/json');
echo json_encode($subjects);
?>
