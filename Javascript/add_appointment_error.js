window.onload = function() {
    const span = document.getElementsByClassName("close")[0];
    span.onclick = function() {
        const modal = document.getElementById("loginModal");
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        const modal = document.getElementById("loginModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
};