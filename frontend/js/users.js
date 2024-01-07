const searchBar = document.querySelector(".users .search input");
const searchBtn = document.querySelector(".users .search button");
const usersList = document.querySelector(".users .users-list");

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = "";
}

searchBar.onkeyup = async () => {
    let searchTerm = searchBar.value;
    if (searchTerm !== "") {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }

    try {
        const response = await fetch("../backend/PHP/search.php", {
            method: "POST",
            headers: {
                "Content-type": "application/x-www-form-urlencoded"
            },
            body: "searchTerm=" + searchTerm
        });

        if (response.ok) {
            const data = await response.text();
            usersList.innerHTML = data;
        } else {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}

window.onload = async () => {
    try {
        const response = await fetch("../backend/PHP/users.php");

        if (response.ok) {
            const data = await response.text();
            if (!searchBar.classList.contains("active")) {
                usersList.innerHTML = data;
            }
        } else {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
    } catch (error) {
        console.error("Error:", error);
    }
};
