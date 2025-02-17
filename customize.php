<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Your Case</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.0/fabric.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body id="customize">
    <nav class="nav">
        <div class="logo">
            <p><a href="home.php"><span class="case">Case</span> <span class="cobra">Cobra</span></a></p>
        </div>
        <div class="navtwo">
            <div class="left-links">
                <a href="create_case.php">Create Case <i class="fas fa-arrow-right"></i></a>
            </div>
            <div class="right-links">
                <?php
                session_start();
                include("config.php");
                if (!isset($_SESSION['valid'])) {
                    header("Location: index.php");
                }
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");
                while ($result = mysqli_fetch_assoc($query)) {
                    $res_id = $result['Id'];
                }
                echo "<a href='edit.php?Id=$res_id'><i class='fas fa-user-circle profile-icon-logo'></i></a>";
                ?>
            </div>
        </div>
    </nav>

    <div class="steps-container">
        <div class="step-box">
            <div class="step active" id="step_active_id2">Step 1: Add Image</div>
            <div class="step-description">Choose an image for your case</div>
        </div>
        <svg class="step-separator" viewBox="0 0 12 82" fill="none" preserveAspectRatio="none">
            <path d="M0.5 0V31L10.5 41L0.5 51V82" stroke="currentcolor" vector-effect="non-scaling-stroke"></path>
        </svg>
        <div class="step-box">
            <div class="step" id="step_id2">Step 2: Customize design</div>
            <div class="step-description">Make the case yours</div>
        </div>
        <svg class="step-separator" viewBox="0 0 12 82" fill="none" preserveAspectRatio="none">
            <path d="M0.5 0V31L10.5 41L0.5 51V82" stroke="currentcolor" vector-effect="non-scaling-stroke"></path>
        </svg>
        <div class="step-box">
            <div class="step">Step 3: Summary</div>
            <div class="step-description">Review your final design</div>
        </div>
    </div>

    <div class="parent-container">
        <div class="section1">
            <div class="container">
                <div class="card" id="card">
                    <img src="image.png" alt="Phone Case" class="phone-case" id="phoneCaseImage">
                    <canvas id="canvas"></canvas>
                </div>
            </div>
        </div>

        <div class="section2">
            <h2>Customize your case</h2>
            <div class="option">
                <label for="color">Color:</label>
                <div class="color-option black" id="black" data-color="black"></div>
                <div class="color-option navy" id="navy" data-color="navy"></div>
                <div class="color-option maroon" id="maroon" data-color="maroon"></div>
            </div>
            <div class="option">
                <label for="model">Model:</label>
                <select id="model">
                    <option value="iphoneX">iPhone X</option>
                    <option value="iphone11">iPhone 11</option>
                </select>
            </div>
            <div class="option">
                <label for="material">Material:</label>
                <select id="material">
                    <option value="silicone">Silicone - ₹0.00</option>
                    <option value="polycarbonate">Soft Polycarbonate - ₹0.00</option>
                </select>
            </div>
            <div class="option">
                <label for="finish">Finish:</label>
                <select id="finish">
                    <option value="glossy">Glossy - ₹0.00</option>
                    <option value="matte">Matte - ₹0.00</option>
                </select>
            </div>
            <div class="price">
                ₹0.00
            </div>
            <button class="continue-button">Continue <i class="fas fa-arrow-right"></i></button>
        </div>
    </div>

    <script>
       
    </script>

    <script src="script.js"></script>
</body>

</html>