<?php
$dbusername = "user2";
$dbhost = "localhost";
$dbpassword = "password123";
$dbname = "PalabaDB";

// Establish connection to the database
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $storename = $_POST['BusinessNameInput'];
    $ownername = $_POST['BusinessOwnerNameInput'];
    $email = $_POST['BusinessEmailInput'];
    $address = $_POST['BusinessLocationBoxInput'];
    $password = $_POST['BusinessPasswordUnhashed'];
    $phonenumber = $_POST['BusinessPhoneInput'];
    $permitno = $_POST['BusinessPermitNumInput'];

    // SQL query to insert data into stores table
    $sql = "INSERT INTO stores (storename, ownername, email, address, password, phonenumber, permitno) 
            VALUES ('$storename', '$ownername', '$email', '$address', '$password', '$phonenumber', '$permitno')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the connection
    $conn->close();
}
?>