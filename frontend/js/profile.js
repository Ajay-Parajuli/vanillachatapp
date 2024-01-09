const form = document.querySelector('.edit form');
const continueBtn = form.querySelector('.button input');
const errorText = form.querySelector('.error-txt');

form.onsubmit = (e) => {
    e.preventDefault();
};

continueBtn.onclick = async () => {
    try {
        const formData = new FormData(form);

        const response = await fetch('../backend/PHP/edit-profile.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            const data = await response.text();
            if (data === 'success') {
               location.href = 'users.php';
            } else {
                errorText.textContent = data;
                errorText.style.display = 'block';
            }
        } else {
            throw new Error('Network response was not ok.');
        }
    } catch (error) {
        console.error('Error:', error);
    }
};


function displaySelectedImage() {
    const fileInput = document.getElementById('image');
    const currentImageContainer = document.getElementById('currentImageContainer');

    // Remove the current image if it exists
    if (currentImageContainer) {
        currentImageContainer.remove();
    }

    // Display the selected image
    if (fileInput.files.length > 0) {
        const selectedImage = fileInput.files[0];
        const selectedImageUrl = URL.createObjectURL(selectedImage);

        const newImageContainer = document.createElement('div');
        newImageContainer.id = 'currentImageContainer';

        const newImage = document.createElement('img');
        newImage.src = selectedImageUrl;
        newImage.alt = 'Selected Image';
        newImage.style = 'width: 45px; height: 45px; border-radius: 100px;';

        newImageContainer.appendChild(newImage);
        fileInput.parentNode.insertBefore(newImageContainer, fileInput.nextSibling);
    }
}
