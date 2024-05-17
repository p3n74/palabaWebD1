<?php
$dbusername = "user2";
$dbhost = "localhost";
$dbpassword = "password123";
$dbname = "PalabaDB";

// Create connection
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch transactions of user_id = 1
$sql = "SELECT transaction_id, storename, user_fullname FROM transactions 
        INNER JOIN stores ON transactions.store_id = stores.store_id
        INNER JOIN users ON transactions.user_id = users.user_id
        WHERE transactions.user_id = 1";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Just Me Again Down Here' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="userdashboard.css">
    <style>
        /* Add CSS styles for the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
    <title>Palaba</title>
</head>

<body>
    <img src="images/Vector (1).png" class="des1">
    <div class="header" id="myHeader"></div>
    <div class="navbar" id="navbar">
        <center>
            <a href="businesshome.html">Home</a>
            <a href="busprofile.html">Profile</a>
            <a href="bustrack.html"><strong>Dashboard</strong></a>
        </center>

    </div>
    <div class="wrapper">
        <div class="dashboardcontainer">
            <div class="dashboardbox">
                <div class="log1">
                    <span class="title">Palaba</span>
                </div>
                <div class="table1">
                    <table>
                        <tr>
                            <th>Transaction number</th>
                            <th>Store</th>
                            <th>User</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["transaction_id"] . "</td><td>" . $row["storename"] . "</td><td>" . $row["user_fullname"] . "</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>No transactions found</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>


<?php
// Close connection
$conn->close();
?>
