const form = document.querySelector('.login form');
const continueBtn = form.querySelector('.button input');
const errorText = form.querySelector('.error-txt');

form.onsubmit = (e) => {
    e.preventDefault();
}

continueBtn.onclick = async () => {
    try {
        const formData = new FormData(form);
        const response = await fetch("../backend/PHP/login.php", {
            method: "POST",
            body: formData
        });

        if (response.ok) {
            const data = await response.text();
            if (data === "success") {
                location.href = "users.php";
            } else {
                errorText.textContent = data;
                errorText.style.display = "block";
            }
        } else {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
    } catch (error) {
        console.error("Error:", error);
    }
};
