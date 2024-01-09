const form = document.querySelector('.typing-area');
const inputField = form.querySelector('.input-field');
const sendBtn = form.querySelector('button');
const chatBox = document.querySelector('.chat-box');

form.onsubmit = (e) => {
    e.preventDefault();
}

sendBtn.onclick = async () => { 
    try {
        const formData = new FormData(form);
        const response = await fetch("../backend/PHP/insert-chat.php", { 
            method: "POST",
            body: formData
        });

        if (response.ok) {
            inputField.value = ""; // Once message inserted into the database, leave blank
        } else {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

chatBox.addEventListener("mouseenter", () => { // this is created so when this is active setinterval will stop 
    chatBox.classList.add("active");
});

chatBox.addEventListener("mouseleave", () => {
    chatBox.classList.remove("active");
});

setInterval(async () => {
    try {
        const formData = new FormData(form);
        const response = await fetch("../backend/PHP/get-chat.php", {
            method: "POST",
            body: formData
        });

        if (response.ok) {
            const data = await response.text();
            chatBox.innerHTML = data;
            if (!chatBox.classList.contains("active")) { // If chat box is not active, then scroll to bottom
                scrollToBottom();
            }
        } else {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}, 2000); // this function will run frequently after 500ms

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}
