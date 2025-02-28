<?php
session_start();
include('config.php');

if (isset($_POST['amt']) && isset($_POST['name'])) {
    $amt = $_POST['amt'];
    $name = $_POST['name'];
    $model = $_POST['model']; // Get the selected model
    $material = $_POST['material']; // Get the selected material
    $finish = $_POST['finish']; // Get the selected finish
    $image = $_POST['image']; // Get the image data (consider encoding)

    $payment_status = "pending";
    $added_on = date('Y-m-d h:i:s');
    
    // Sanitize inputs to prevent SQL injection
    $name = mysqli_real_escape_string($con, $name);
    $model = mysqli_real_escape_string($con, $model);
    $material = mysqli_real_escape_string($con, $material);
    $finish = mysqli_real_escape_string($con, $finish);
    $image = mysqli_real_escape_string($con, $image);

    mysqli_query($con, "INSERT INTO payment(name, amount, payment_status, added_on, model, material, finish, image) 
                        VALUES('$name', '$amt', '$payment_status', '$added_on', '$model', '$material', '$finish', '$image')");
    
    $_SESSION['OID'] = mysqli_insert_id($con);
    $user_id = $_SESSION['id'];
    mysqli_query($con, "UPDATE payment SET Username = $user_id WHERE id = {$_SESSION['OID']}");
}

if (isset($_POST['payment_id']) && isset($_SESSION['OID'])) {
    $payment_id = $_POST['payment_id'];
    mysqli_query($con, "UPDATE payment SET payment_status='complete', payment_id='$payment_id' WHERE id='" . $_SESSION['OID'] . "'");
}
?>