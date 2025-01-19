<?php
session_start();
include("php/config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
    <div class="nav">
    <div class="logo">
        <p><a href="home.php"><span class="case">Case</span> <span class="cobra">Cobra</span></a></p>
    </div>
    <div class="right-links">
    <?php
    $id = $_SESSION['id'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");
    while ($result = mysqli_fetch_assoc($query)) {
        $res_Uname = $result['Username'];
        $res_Email = $result['Email'];
        $res_Age = $result['Age'];
        $res_id = $result['Id'];
    }
    echo "<a href='edit.php?Id=$res_id'><i class='fas fa-user-circle profile-icon-logo'></i></a>";
    ?>
</div>

</div>
</body>
</html>
