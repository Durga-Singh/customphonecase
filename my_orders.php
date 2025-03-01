<?php
session_start();
include 'config.php'; // Include database connection

if (!isset($_SESSION['username'])) {
    echo "Please log in to view your orders.";
    exit;
}

$username = $_SESSION['username']; // Get logged-in user's username

// Ensure the database connection is defined
if (!isset($con)) {
    die("Database connection error.");
}

// Fetch all payment details along with the image
$query = "SELECT username, amount, payment_status, payment_id, added_on, model, material, finish, image 
          FROM payment 
          WHERE username = ?";

$stmt = $con->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .orders-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .order-card {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: left;
        }
        .order-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .order-details {
            font-size: 14px;
            line-height: 1.6;
        }
        .highlight {
            font-weight: bold;
            color: #27ae60;
        }
    </style>
</head>
<body>
    <h1>My Orders</h1>
    <div class="orders-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="order-card">';
                echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Uploaded Image">';
                echo '<div class="order-details">';
                echo '<p><span class="highlight">Username:</span> ' . htmlspecialchars($row['username']) . '</p>';
                echo '<p><span class="highlight">Amount Paid:</span> ₹' . htmlspecialchars($row['amount']) . '</p>';
                echo '<p><span class="highlight">Payment ID:</span> ' . htmlspecialchars($row['payment_id']) . '</p>';
                echo '<p><span class="highlight">Payment Status:</span> ' . htmlspecialchars($row['payment_status']) . '</p>';
                echo '<p><span class="highlight">Date:</span> ' . htmlspecialchars($row['added_on']) . '</p>';
                echo '<p><span class="highlight">Model:</span> ' . htmlspecialchars($row['model']) . '</p>';
                echo '<p><span class="highlight">Material:</span> ' . htmlspecialchars($row['material']) . '</p>';
                echo '<p><span class="highlight">Finish:</span> ' . htmlspecialchars($row['finish']) . '</p>';
                echo '</div></div>';
            }
        } else {
            echo "<p>No paid orders found.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$stmt->close();
$con->close();
?>
