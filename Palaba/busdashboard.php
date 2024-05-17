<?php
$dbusername = "root";
$dbhost = "localhost";
$dbpassword = "";
$dbname = "PalabaDB";

// Establish connection
$conn = new mysqli($dbhost, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle create transaction
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['createTransaction'])) {
    $username = $_POST['crudUsernameInput'];
    $status = $_POST['crudOrderStatus'];

    // Fetch user ID by username
    $getUserIDQuery = "SELECT user_id FROM users WHERE username = '$username'";
    $result = $conn->query($getUserIDQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];

        // Insert transaction
        $insertTransactionQuery = "INSERT INTO transactions (store_id, user_id, date_started, status) 
                                   VALUES (1, '$user_id', CURRENT_DATE(), '$status')"; // Assuming store ID is 1

        if ($conn->query($insertTransactionQuery) === TRUE) {
            echo "<script>alert('Transaction created successfully.');</script>";
        } else {
            echo "Error: " . $insertTransactionQuery . "<br>" . $conn->error;
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }
}

// Handle delete transaction
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteTransaction'])) {
    $transaction_id = $_POST['crudUserIdInput'];
    $deleteTransactionQuery = "DELETE FROM transactions WHERE transaction_id = '$transaction_id'";

    if ($conn->query($deleteTransactionQuery) === TRUE) {
        echo "<script>alert('Transaction deleted successfully.');</script>";
    } else {
        echo "Error: " . $deleteTransactionQuery . "<br>" . $conn->error;
    }
}

// Handle update transaction
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateTransaction'])) {
    $transaction_id = $_POST['crudUserIdInput'];
    $status = $_POST['crudOrderStatus'];
    $updateTransactionQuery = "UPDATE transactions SET status = '$status' WHERE transaction_id = '$transaction_id'";

    if ($conn->query($updateTransactionQuery) === TRUE) {
        echo "<script>alert('Transaction updated successfully.');</script>";
    } else {
        echo "Error: " . $updateTransactionQuery . "<br>" . $conn->error;
    }
}

// Fetch data from the transactions table
$sql = "SELECT * FROM transactions";
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
                <div class="transactiontable-container">
                    <table>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Store ID</th>
                            <th>User ID</th>
                            <th>Date Started</th>
                            <th>Status</th>
                        </tr>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["transaction_id"] . "</td>";
                                echo "<td>" . $row["store_id"] . "</td>";
                                echo "<td>" . $row["user_id"] . "</td>";
                                echo "<td>" . $row["date_started"] . "</td>";
                                echo "<td>" . $row["status"] . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No transactions found</td></tr>";
                        }
                        ?>
                    </table>
                </div>
            </div>

            <div class="crudContainer">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" id="crudForm">
                    <div class="input-group">
                        <input type="text" name="crudUserIdInput" placeholder="Transaction ID" class="input-field">
                        <input type="text" name="crudUsernameInput" placeholder="Username" class="input-field">
                        <input type="text" name="crudOrderStatus" placeholder="Status" class="input-field">
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

</body>

</html>

<?php
$conn->close();
?>