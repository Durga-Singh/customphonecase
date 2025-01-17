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
    <link rel="stylesheet" href="style\style.css">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Case Cobra</a> </p>
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

            echo "<a href='edit.php?Id=$res_id'><i class='fas fa-user-circle'></i></a>";
            ?>

        </div>

    </div>
      <!-- Hero Section -->
      <section class="hero">
        <div class="hero-text">
            <h1>Design Your Own Custom Phone Case</h1>
            <p>Choose your favorite design or create your own. Stand out with a unique case tailored just for you!</p>
            <a href="order.php" class="btn">Start Customizing</a>
        </div>
        <div class="hero-image">
            <img src="https://printbebo.in/wp-content/uploads/2022/03/1324-Rainbow-Style-Custom-Name-Phone-Case.jpg" alt="Custom Phone Case">
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Custom Cases. All rights reserved.</p>
    </footer>
</body>

</html>