<?php
include "../sepi_connect.php";

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true)
{
    // When Not Login Return to this Page
    header("refresh:0; ../Index.php");
    exit;
}
else if(isset($_SESSION['Acc_ID']))
{
    $userid = $_SESSION['Acc_ID'];

    $getrecord = mysqli_query($config,"SELECT * FROM tbl_sepi_account WHERE Acc_ID ='$userid'");
    while($rowedit = mysqli_fetch_assoc($getrecord))
    {
        $type = $rowedit['Role'];
        $name = $rowedit['Fname']." ".$rowedit['Lname'];
    }
}

if(isset($_POST['sub'])){
    $date_from = $_POST['date_from'];
    $date_to = $_POST['date_to'];
    
    $query = "UPDATE tbl_gradingsched SET date_from = '$date_from', date_to = '$date_to'";
    $result = mysqli_query($config, $query);
    echo "<script>alert('Schedule updated successfully.')</script>";
}

$query = "SELECT * FROM tbl_gradingsched";
$result = mysqli_query($config, $query);
$row = mysqli_fetch_assoc($result);
$date_from = $row['date_from'];
$date_to = $row['date_to'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Announcement</title>
    <link rel="icon" href="../Images/logo.png">
    <link rel="stylesheet" href="../Css/sepi.css">
</head>
<body style="background-color:#E5E4E2">
    <div class="header">
        <p class="displayname"><?php echo "$type" ?> | <?php echo "$name" ?></p>
        <form method="POST" action="logout.php">
            <button type="submit" name="logout" class="logout">Log Out</button>
        </form>
    </div>
    <div class="footer">
        <h6 id="footer">© 2022 SEPI Login Form. All Rights Reserved | Designed by Excel-erator</h6>
    </div>
    <form method="POST" action="gradingsched.php" enctype="multipart/form-data">
        <?php include_once('SideNav.php'); ?>
        <div class="announceadddiv">
            <h1 id="announceaddfont">Set Schedule</h1>
            <hr class="announceaddline">
            <input type="date" name="date_from" placeholder="Date" autocomplete="off" size="50" class="addannouncemntfield" value="<?php echo $date_from; ?>"><br><br><br>
            <input type="date" name="date_to" placeholder="Date" autocomplete="off" size="50" class="addannouncemntfield" value="<?php echo $date_to; ?>">
            <input type="submit" name="sub" value="Update" class="addannouncebtn">
            <a href="subject.php" class="addannounceback">Back</a>
        </div>
    </form>
</body>
</html>
