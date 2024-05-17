<?php
$dbusername = "user2";
$dbhost = "localhost";
$dbpassword = "password123";
$dbname = "PalabaDB";

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $storename = $_POST['BusinessNameInput'];
    $ownername = $_POST['BusinessOwnerNameInput'];
    $email = $_POST['BusinessEmailInput'];
    $address = $_POST['BusinessLocationBoxInput'];
    $password = $_POST['BusinessPasswordUnhashed'];
    $phonenumber = $_POST['BusinessPhoneInput'];
    $permitno = $_POST['BusinessPermitNumInput'];
    
    $sql = "INSERT INTO stores (storename, ownername, email, address, password, phonenumber, permitno) 
            VALUES ('$storename', '$ownername', '$email', '$address', '$password', '$phonenumber', '$permitno')";

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Just Me Again Down Here' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">


    <?php require 'businessregister.php'; ?>

    <title>Palaba</title>
</head>
<body style="background-image: url('images/Rectangle 27.png');">

    <div class="header" id="myHeader"></div>
    <div class="navbar" id="navbar">
        <center>
        <a href="home.html"><strong>Home</strong></a>
        <a href="#news">About us</a>
        <a href="#contact">Contact us</a>
        </center>
    </div>
    <div class="regbox">
        <div class="log1">
           <span class="titles">Palaba</span> 
        </div>
        <div class="row">
            <div class="column">
                <form class="sform" method="POST">
                    <input type="text" name="BusinessOwnerNameInput" placeholder="Name Of Owner"><br>
                    <input type="text" name="BusinessEmailInput" placeholder="Email address"><br>
                    <input type="text" name="BusinessPhoneInput" placeholder="Contact no."><br>
                    <input type="password" name="BusinessPasswordUnhashed" placeholder="Password"><br>
                    <input type="password" name="BusinessPasswordConfirm" placeholder="Confirm Password"><br>
                    <input type="text" name="BusinessNameInput" placeholder="Business Name"><br>
                    <input type="text" name="BusinessLocationBoxInput" placeholder="Location"><br>
                    <input type="text" name="BusinessPermitNumInput" placeholder="Business Permit No."><br>
                    <button type="submit" class="businessregisterbutton" href="busdashboard.php">Register</button>
                </form>
            </div>
        </div>
    
   
    </div>
   
</body> 
</html>

