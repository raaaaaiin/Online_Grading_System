<?php
			include "../../sepi_connect.php";

$my_input = $_POST["input_field"];

// insert the input data into the database
$sql = "INSERT INTO tbl_student (FIL) VALUES ('$my_input')";
$result = $config->query($sql);

if($result == True){
?>
<script>
alert("Successfully Insert Grade")
</script>
<?php
header("refresh:0;url=filfirst.php");
}else{
}
?>
