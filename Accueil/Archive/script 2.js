/* ===========================
   RECHERCHE DES MENUS
=========================== */

const searchButton = document.querySelector(".search-button");

searchButton.addEventListener("click", function () {
    const event = document.querySelector("#event").value;
    const people = document.querySelector("#people").value;
    const budget = document.querySelector("#budget").value;

    if (!event && !people && !budget) {
        alert("Veuillez sélectionner au moins un critère.");
        return;
    }

    window.location.href = "pages/menus.html";
});


