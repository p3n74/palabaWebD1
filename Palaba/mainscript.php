<?php


$dbusername = "user2";
$dbhost = "localhost";
$dbpassword = "password123";
$dbname = "PalabaDB";

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

include "businessregister.php";


?>