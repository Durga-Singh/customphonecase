const uploadArea = document.querySelector('.upload-area');
const dragDropArea = document.querySelector('.drag-drop-area');
const fileInput = document.createElement('input'); // Create a hidden file input
fileInput.type = 'file';
fileInput.accept = 'image/*'; // Accept only image files

// Drag and drop events
uploadArea.addEventListener('dragover', (event) => {
    event.preventDefault();
    dragDropArea.classList.add('highlight');
});

uploadArea.addEventListener('dragleave', () => {
    dragDropArea.classList.remove('highlight');
});

uploadArea.addEventListener('drop', (event) => {
    event.preventDefault();
    dragDropArea.classList.remove('highlight');
    const file = event.dataTransfer.files;
    handleFile(file);
});

// Click to upload
uploadArea.addEventListener('click', () => {
    fileInput.click(); // Trigger the hidden file input
});

fileInput.addEventListener('change', () => {
    const file = fileInput.files;
    handleFile(file);
});

// Function to handle the uploaded file
function handleFile(file) {
    const reader = new FileReader();

    reader.onload = (event) => {
        const img = document.createElement('img');
        img.src = event.target.result;
        img.style.maxWidth = '100%';
        img.style.maxHeight = '100%';
        uploadArea.innerHTML = ''; // Clear the drag-and-drop area
        uploadArea.appendChild(img); // Display the image
    }

    reader.readAsDataURL(file);
}