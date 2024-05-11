document.addEventListener("DOMContentLoaded", function () {
    const logoutBtn = document.getElementById("logout-btn");

    if (logoutBtn) {
        logoutBtn.addEventListener("click", function (event) {
            event.preventDefault();
            // Perform logout functionality here (e.g., redirect to logout page)
            console.log("Logout clicked!");
        });
    }
});