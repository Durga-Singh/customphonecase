// Function to handle the uploaded file
function handleFile(file, callback) {
    if (!file) {
        console.error('No file provided!');
        return;
    }

    showUploadingMessage(); // Show loading message

    const reader = new FileReader();
    reader.onload = (event) => {
        localStorage.setItem('uploadedImage', event.target.result); // Store image in localStorage

        setTimeout(() => { // Delay for animation effect
            if (callback) {
                callback();
            }
        }, 1500); // 1.5 seconds delay
    };

    reader.readAsDataURL(file);
}

// Function to show "Uploading Photo..." animation
function showUploadingMessage() {
    const uploadContainer = document.querySelector('.upload-area');
    if (uploadContainer) {
        uploadContainer.innerHTML = `
            <div class="uploading-message">
                <div class="spinner"></div>
                <p>Uploading Photo...</p>
            </div>
        `;
    }
}

// Selectors for Uploading
const createCaseUploadArea = document.querySelector('.upload-area');
const createCaseImageUpload = document.getElementById('upload');

if (createCaseUploadArea && createCaseImageUpload) {
    createCaseUploadArea.addEventListener('click', () => {
        createCaseImageUpload.click();
    });

    createCaseImageUpload.addEventListener('change', (event) => {
        const file = event.target.files[0]; // Fix: Select only first file
        if (file) {
            handleFile(file, () => {
                window.location.href = 'customize.php'; // Redirect after storing image
            });
        }
    });

    createCaseUploadArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        createCaseUploadArea.classList.add('highlight');
    });

    createCaseUploadArea.addEventListener('dragleave', () => {
        createCaseUploadArea.classList.remove('highlight');
    });

    createCaseUploadArea.addEventListener('drop', (event) => {
        event.preventDefault();
        createCaseUploadArea.classList.remove('highlight');
        const file = event.dataTransfer.files[0]; // Fix: Ensure file is selected
        if (file) {
            handleFile(file, () => {
                window.location.href = 'customize.php';
            });
        }
    });
}

// For customize.php: Load uploaded image
const customizeUploadImage = document.querySelector('.uploaded-image');

if (customizeUploadImage) {
    const uploadedImageData = localStorage.getItem('uploadedImage');
    if (uploadedImageData) {
        customizeUploadImage.innerHTML = `<img src="${uploadedImageData}" alt="Uploaded Image">`;
    }
}

// Phone case customization with Fabric.js
window.onload = function () {
    const canvas = new fabric.Canvas('canvas', {
        width: 200,
        height: 400,
        selection: true,
        backgroundColor: 'transparent',
        transparentCorners: false,
    });

    var uploadedImageData = localStorage.getItem('uploadedImage');
    if (uploadedImageData) {
        fabric.Image.fromURL(uploadedImageData, function (img) {
            img.scaleToWidth(canvas.width);
            img.scaleToHeight(canvas.height);
            img.set({
                left: 0,
                top: 0,
                selectable: false,
                evented: false,
            });
            canvas.add(img);
            canvas.sendToBack(img);
            canvas.renderAll();
        });
    }
};

const modelSelect = document.getElementById('model');
const phoneCaseImage = document.getElementById('phoneCaseImage');

// Add an event listener to the model dropdown
modelSelect.addEventListener('change', () => {
    // Check if iPhone 11 is selected
    if (modelSelect.value === 'iphone11') {
        // Change the image source to image2.png
        phoneCaseImage.src = 'image2.png';
    } else {
        // Reset to the original image if needed
        phoneCaseImage.src = 'image.png';
    }
});


// Select the canvas and the parent card container
const canvas = document.getElementById('canvas');
const card = document.getElementById('card');
const colorOptions = document.querySelectorAll('.color-option');

// Loop through each color option
colorOptions.forEach(option => {
    option.addEventListener('click', () => {
        // Change the card background color
        card.style.backgroundColor = option.dataset.color;

        // Hide the canvas
        if (canvas) {
            canvas.style.display = 'none';
        }
    });
});


// Define base price
const basePrice = 500; // Example base price for the phone case

// Define additional prices for materials and finishes
const materialPrices = {
    silicone: 100,
    polycarbonate: 120,
};

const finishPrices = {
    glossy: 150,
    matte: 200,
};

// Select elements
const materialSelect = document.getElementById('material');
const finishSelect = document.getElementById('finish');
const priceDisplay = document.querySelector('.price');

// Function to calculate and update the total price
function updateTotalPrice() {
    const selectedMaterial = materialSelect.value;
    const selectedFinish = finishSelect.value;

    const materialPrice = materialPrices[selectedMaterial] || 0;
    const finishPrice = finishPrices[selectedFinish] || 0;

    const totalPrice = basePrice + materialPrice + finishPrice;

    priceDisplay.textContent = `₹${totalPrice.toFixed(2)}`; // Update the displayed price
}

// Attach event listeners to dropdowns
materialSelect.addEventListener('change', updateTotalPrice);
finishSelect.addEventListener('change', updateTotalPrice);

// Initialize the price on page load
updateTotalPrice();


const continueButton = document.querySelector('.continue-button');

continueButton.addEventListener('click', () => {
    // Disable the button to prevent multiple clicks
    continueButton.disabled = true;

    // Start the animation with "Saving"
    continueButton.innerHTML = 'Saving<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span>';

    // Add animation class
    continueButton.classList.add('saving-animation');

    // Simulate a save process (e.g., redirect after 2 seconds)
    setTimeout(() => {
        // Example: Redirect to summary page (optional)
        window.location.href = 'summary.php';
    }, 2000); // Adjust the time as needed
});

//summary


