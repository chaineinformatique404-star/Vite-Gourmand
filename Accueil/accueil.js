const menus = document.querySelectorAll('.menu-card');
const prevButton = document.querySelector('.carousel-prev');
const nextButton = document.querySelector('.carousel-next');

let currentIndex = 0;
const menusVisible = 3;

function afficherMenus(direction = '') {

    const menuGrid = document.querySelector('.menu-grid');

    menuGrid.classList.remove('carousel-next-animation', 'carousel-prev-animation');

    void menuGrid.offsetWidth;

    if (direction === 'next') {
        menuGrid.classList.add('carousel-next-animation');
    }

    if (direction === 'prev') {
        menuGrid.classList.add('carousel-prev-animation');
    }

    menus.forEach((menu, index) => {
        menu.style.display =
            index >= currentIndex && index < currentIndex + menusVisible
                ? 'block'
                : 'none';
    });
}

nextButton.addEventListener('click', () => {

    if (currentIndex + menusVisible < menus.length) {
        currentIndex++;
    } else {
        currentIndex = 0;
    }

    afficherMenus('next');
});

prevButton.addEventListener('click', () => {

    if (currentIndex > 0) {
        currentIndex--;
    } else {
        currentIndex = menus.length - menusVisible;
    }

    afficherMenus('prev');
});

afficherMenus();