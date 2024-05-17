<?php
// Check if the form is submitted for insertion or deletion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
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

    // Handle deletion
    if (isset($_POST['deleteTransaction'])) {
        $transaction_id = $_POST['crudTransactionID'];
        $deleteTransactionQuery = "DELETE FROM transactions WHERE transaction_id = '$transaction_id'";

        if ($conn->query($deleteTransactionQuery) === TRUE) {
            echo "<script>alert('Transaction deleted successfully.');</script>";
        } else {
            echo "Error: " . $deleteTransactionQuery . "<br>" . $conn->error;
        }
    }

    // Handle insertion
    if (isset($_POST['createTransaction'])) {
        $username = $_POST['crudUsernameInput'];
        $status = $_POST['crudOrderStatus'];
        $getUserIDQuery = "SELECT user_id FROM users WHERE username = '$username'";
        $result = $conn->query($getUserIDQuery);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row["user_id"];
            $insertTransactionQuery = "INSERT INTO transactions (store_id, user_id, date_started, status) 
                                       VALUES (1, '$user_id', CURRENT_DATE(), '$status')"; // Assuming store ID is 1

            if ($conn->query($insertTransactionQuery) === TRUE) {
                echo "<script>alert('Transaction inserted successfully.');</script>";
            } else {
                echo "Error: " . $insertTransactionQuery . "<br>" . $conn->error;
            }
        } else {
            echo "<script>alert('User not found.');</script>";
        }
    }

    // Close connection
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
    <link rel="stylesheet" href="businessdashboard.css">
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
            </div>
            <div class="table">
                <?php
                // Database credentials
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

                // SQL query to select transactions for store ID 1
                $sql = "SELECT * FROM transactions WHERE store_id = 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table border='1'>
                    <tr>
                    <th>Transaction ID</th>
                    <th>Store ID</th>
                    <th>User ID</th>
                    <th>Date Started</th>
                    <th>Status</th>
                    </tr>";

                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['transaction_id'] . "</td>";
                        echo "<td>" . $row['store_id'] . "</td>";
                        echo "<td>" . $row['user_id'] . "</td>";
                        echo "<td>" . $row['date_started'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }

                $conn->close();
                ?>
            </div>

            <div class="crudContainer">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="crudForm">
                    <div class="input-group">
                        <input type="text" name="crudUsernameInput" placeholder="Username" class="input-field">
                        <input type="text" name="crudOrderStatus" placeholder="Status" class="input-field">
                        <input type="text" name="crudTransactionID" placeholder="Transaction ID"> 
                    </div>
                    <div class="button-group">
                        <button type="submit" class="btn create-btn" name="createTransaction">Create</button>
                        <button type="submit" class="btn delete-btn" name="deleteTransaction">Delete</button>
                        <button type="submit" class="btn update-btn" name="updateTransaction">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        document.querySelector('#crudForm').addEventListener('submit', function(event) {
            var table = document.querySelector('.table table');
            if (event
