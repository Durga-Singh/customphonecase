<?php
include 'config.php'; // Include database connection

// Fetch all images from the database
$sql = "SELECT image FROM payment";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        .image-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .image-container img {
            width: 200px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <h1>Uploaded Images</h1>
    <div class="image-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<img src="' . htmlspecialchars($row['image']) . '" alt="Uploaded Image">';
            }
        } else {
            echo "<p>No images uploaded yet.</p>";
        }
        ?>
    </div>
</body>
</html>

<?php
$con->close();
?>
