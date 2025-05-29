<?php
$dbHost = 'localhost';
$dbName = 'moryacat_labindia';
$dbUsername = 'moryacat_labindia';
$dbPassword = 'Labindia@7896';
$db = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName); 

//check connection
if(!$db) // Use $db instead of $con
{
    header("Location: ../errors/db.php");
    die();
}
else{
    echo "database connected!";
}
?>
