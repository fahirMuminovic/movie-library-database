<?php 

$serverName = "localhost";
$dBUserName = "root";
$dBPassword = "";
$dBName = "login_db";

$conn = mysqli_connect($serverName, $dBUserName, $dBPassword, $dBName);

if(!$conn){
    die("Konekcija neuspjesna: " . mysqli_connect_error());
}

?>