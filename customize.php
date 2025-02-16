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

    <div class="container">
        <div class="card">
            <img src="image.png" alt="Phone Case" class="phone-case">
            <canvas id="canvas"></canvas>
        </div>
    </div>

    <script>
        window.onload = function() {
            var canvas = new fabric.Canvas('canvas', {
                width: 200,
                height: 400,
                selection: true,
                backgroundColor: 'transparent',
                transparentCorners: false
            });

            var uploadedImageData = localStorage.getItem('uploadedImage');
            if (uploadedImageData) {
                fabric.Image.fromURL(uploadedImageData, function(img) {
                    img.scaleToWidth(canvas.width);
                    img.scaleToHeight(canvas.height);
                    img.set({
                        left: 0,
                        top: 0,
                        selectable: false,
                        evented: false
                    });
                    canvas.add(img);
                    canvas.sendToBack(img);
                    canvas.renderAll();
                });
            }
        };
    </script>
   
    <script src="script.js"></script>
</body>

</html>