<?php
$dbusername = "root";
$dbhost = "localhost";
$dbpassword = "";
$dbname = "PalabaDB";

$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['usernameInput'];
    $user_fullname = $_POST['fullnameInput'];
    $email = $_POST['emailInput'];
    $password = $_POST['passwordInput'];
    $phonenumber = $_POST['phone'];

    $sql = "INSERT INTO users (username, user_fullname, email, password, phonenumber) 
            VALUES ('$username', '$user_fullname', '$email', '$password', '$phonenumber')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
