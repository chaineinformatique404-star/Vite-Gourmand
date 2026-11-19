const favorites = document.querySelectorAll(".favorite");

favorites.forEach((favorite) => {
    favorite.addEventListener("click", () => {
        favorite.classList.toggle("active");

        if (favorite.classList.contains("active")) {favorite.textContent = "♥";} 
        else {favorite.textContent = "♡";}
    });
});

