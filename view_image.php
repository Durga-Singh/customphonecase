<?php
include('config.php');

if (isset($_GET['payment_id'])) {
    $payment_id = mysqli_real_escape_string($con, $_GET['payment_id']); // Sanitize input

    $query = mysqli_query($con, "SELECT image FROM payment WHERE id = '$payment_id'");
    if ($query) {
        $result = mysqli_fetch_assoc($query);
        if ($result) {
            $imageData = $result['image'];
            ?>

            <!DOCTYPE html>
            <html>
            <head>
                <title>View Image</title>
            </head>
            <body>
                <h1>Custom Phone Case Image</h1>
                <img src="<?php echo $imageData; ?>" alt="Custom Case">
            </body>
            </html>

            <?php
        } else {
            echo "Error: No image found for payment ID: " . $payment_id;
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Error: Payment ID not provided.";
}
?>