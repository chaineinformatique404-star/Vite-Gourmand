/* ===========================
 EN CE MOMENT
=========================== */

const track = document.querySelector(".now-track");
const cards = document.querySelectorAll(".now-card");
const previous = document.querySelector(".previous");
const next = document.querySelector(".next");

let currentIndex = 0;

function restartDezoom() {
    const currentImage = cards[currentIndex].querySelector("img");

    currentImage.classList.remove("dezoom");
    void currentImage.offsetWidth;
    currentImage.classList.add("dezoom");
}

next.addEventListener("click", () => {
    currentIndex++;

    if (currentIndex >= cards.length) {
        currentIndex = 0;
    }

    track.style.transform = `translateX(-${currentIndex * 100}%)`;
});

previous.addEventListener("click", () => {
    currentIndex--;

    if (currentIndex < 0) {
        currentIndex = cards.length - 1;
    }

    track.style.transform = `translateX(-${currentIndex * 100}%)`;
});

