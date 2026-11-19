// ==================================================
// GALERIE PHOTOS ET VIDÉO
// ==================================================

const photos = document.querySelectorAll('.thumb');
const previewPhoto = document.querySelector('.preview-photo');
const previewVideo = document.querySelector('.preview-video');


// ==================================================
// SURVOL DES MINIATURES
// ==================================================

photos.forEach(photo => {

    photo.addEventListener('mouseenter', () => {

        // ------------------------------------------
        // MINIATURE VIDÉO
        // ------------------------------------------

        if (photo.classList.contains('video')) {

            previewPhoto.style.display = 'none';
            previewVideo.style.display = 'block';

            previewVideo.currentTime = 0;
            previewVideo.play();

        }


        // ------------------------------------------
        // MINIATURE PHOTO
        // ------------------------------------------

        else {

            const image = photo.querySelector('img');

            previewVideo.style.display = 'none';
            previewPhoto.style.display = 'block';

            previewPhoto.src = image.src;
            previewPhoto.alt = image.alt;

        }

    });

});

// ==================================================
// FLÈCHES DE LA GALERIE
// ==================================================

let indexMedia = 0;
const boutonGauche = document.querySelector('.gallery-arrow.left');
const boutonDroite = document.querySelector('.gallery-arrow.right');

function afficherMedia(index) {

    indexMedia = (index + photos.length) % photos.length;
    const miniature = photos[indexMedia];

    photos.forEach(p => p.classList.remove('active'));
    miniature.classList.add('active');

    if (miniature.classList.contains('video')) {

        previewPhoto.style.display = 'none';
        previewVideo.style.display = 'block';
        previewVideo.currentTime = 0;
        previewVideo.play();

    }
    else {

        const image = miniature.querySelector('img');

        previewVideo.pause();
        previewVideo.style.display = 'none';
        previewPhoto.style.display = 'block';
        previewPhoto.src = image.src;
        previewPhoto.alt = image.alt;

    }

}

// Garder l'index synchronisé avec le survol des miniatures
photos.forEach((photo, i) => {
    photo.addEventListener('mouseenter', () => {
        indexMedia = i;
        photos.forEach(p => p.classList.remove('active'));
        photo.classList.add('active');
    });
});

boutonGauche.addEventListener('click', () => afficherMedia(indexMedia - 1));
boutonDroite.addEventListener('click', () => afficherMedia(indexMedia + 1));


// ==================================================
// BOUTON FAVORI
// ==================================================

const boutonFavori = document.querySelector('.favorite');

boutonFavori.addEventListener('click', () => {

    const estActif = boutonFavori.classList.toggle('active');

    boutonFavori.textContent = estActif ? '♥' : '♡';
    boutonFavori.setAttribute('aria-pressed', estActif);

});


// ==================================================
// ÉLÉMENTS DE L'APERÇU D'UN PLAT
// ==================================================

const plats = document.querySelectorAll('.plat-card');
const previewImage = document.querySelector('#preview-image');
const previewName = document.querySelector('#preview-name');
const previewDescription = document.querySelector('#preview-description');
const previewAllergenes = document.querySelector('#preview-allergenes');
const previewRegime = document.querySelector('#preview-regime');
const previewValeurs = document.querySelector('#preview-valeurs');



// ==================================================
// ÉLÉMENTS DE LA SÉLECTION DU MENU
// ==================================================

const previewEntree = document.querySelector('#selection-entree');
const previewPlat = document.querySelector('#selection-plat');
const previewDessert = document.querySelector('#selection-dessert');


// ==================================================
// VALEURS PAR DÉFAUT DE L'APERÇU
// ==================================================

const descriptionParDefaut = previewDescription.textContent;
const nomParDefaut = previewName.textContent;
const allergenesParDefaut = previewAllergenes.textContent;
const regimeParDefaut = previewRegime.textContent;
const valeursParDefaut = previewValeurs.textContent;
const imageParDefaut = previewImage.src;
const altImageParDefaut = previewImage.alt;


// ==================================================
// IMAGES PAR DÉFAUT DE LA SÉLECTION
// ==================================================

const imageEntreeParDefaut = previewEntree.src;
const imagePlatParDefaut = previewPlat.src;
const imageDessertParDefaut = previewDessert.src;


// ==================================================
// PLATS SÉLECTIONNÉS
// ==================================================

const selections = {
    Entrée: null,
    Plat: null,
    Dessert: null
};


// ==================================================
// SURVOL ET CLIC SUR LES PLATS
// ==================================================

plats.forEach(plat => {

    // Afficher les informations du plat au survol
    plat.addEventListener('mouseenter', () => {

        const image = plat.dataset.image;
        const nom = plat.dataset.nom;
        const description = plat.dataset.description;
        const allergenes = plat.dataset.allergenes;
        const regime = plat.dataset.regime;
        const valeurs = plat.dataset.valeurs;


        // Afficher l'image du plat
        if (image) {

            previewImage.src = image;
            previewImage.alt = nom;
            previewImage.style.display = 'block';

        }

        else {

            previewImage.style.display = 'none';

        }


        // Afficher les informations du plat
        previewName.textContent = nom;
        previewDescription.textContent = description;
        previewAllergenes.textContent = allergenes;
        previewRegime.textContent = regime;
        previewValeurs.textContent = valeurs;

    });


    // Remettre les informations par défaut lorsque la souris quitte le plat
    plat.addEventListener('mouseleave', () => {

        previewImage.src = imageParDefaut;
        previewImage.alt = altImageParDefaut;

        previewName.textContent = nomParDefaut;
        previewDescription.textContent = descriptionParDefaut;
        previewAllergenes.textContent = allergenesParDefaut;
        previewRegime.textContent = regimeParDefaut;
        previewValeurs.textContent = valeursParDefaut;

    });


    // Sélectionner ou désélectionner un plat au clic
    plat.addEventListener('click', () => {

        const categorie = plat.dataset.categorie;


        // Si le plat est déjà sélectionné, on le désélectionne
        if (selections[categorie] === plat) {

            selections[categorie] = null;
            plat.classList.remove('selectionne');

        }
        else {

            // Retirer la sélection précédente de la même catégorie
            if (selections[categorie]) {

                selections[categorie].classList.remove('selectionne');

            }


            // Enregistrer le nouveau plat sélectionné
            selections[categorie] = plat;
            plat.classList.add('selectionne');

        }


        // Mettre à jour le menu
        mettreAJourMenu();

    });

});


// ==================================================
// METTRE À JOUR LE MENU SÉLECTIONNÉ
// ==================================================

function mettreAJourMenu() {

    // ----------------------------------------------
    // ENTRÉE
    // ----------------------------------------------

    if (selections.Entrée) {

        previewEntree.src = selections.Entrée.dataset.image;
        previewEntree.alt = selections.Entrée.dataset.nom;
        document.querySelector('#nom-entree').textContent = selections.Entrée.dataset.nom;

    }
    else {

        previewEntree.src = imageEntreeParDefaut;
        previewEntree.alt = '';
        document.querySelector('#nom-entree').textContent = '';

    }


    // ----------------------------------------------
    // PLAT
    // ----------------------------------------------

    if (selections.Plat) {

        previewPlat.src = selections.Plat.dataset.image;
        previewPlat.alt = selections.Plat.dataset.nom;
        document.querySelector('#nom-plat').textContent = selections.Plat.dataset.nom;

    }
    else {

        previewPlat.src = imagePlatParDefaut;
        previewPlat.alt = '';
        document.querySelector('#nom-plat').textContent = '';

    }


    // ----------------------------------------------
    // DESSERT
    // ----------------------------------------------

    if (selections.Dessert) {

        previewDessert.src = selections.Dessert.dataset.image;
        previewDessert.alt = selections.Dessert.dataset.nom;
        document.querySelector('#nom-dessert').textContent = selections.Dessert.dataset.nom;

    }
    else {

        previewDessert.src = imageDessertParDefaut;
        previewDessert.alt = '';
        document.querySelector('#nom-dessert').textContent = '';

    }


    // Mettre à jour les informations complémentaires
    mettreAJourNutrition();
    mettreAJourAllergenes();
    mettreAJourRegimes();

}


// ==================================================
// RÉCUPÉRER LES PLATS SÉLECTIONNÉS
// ==================================================

function obtenirPlatsSelectionnes() {

    return Object.values(selections).filter(plat => plat !== null);

}


// ==================================================
// METTRE À JOUR LES VALEURS NUTRITIONNELLES
// ==================================================

function mettreAJourNutrition() {

    // Valeurs nutritionnelles initiales
    const valeurs = {
        calories: 0,
        fat: 0,
        saturated: 0,
        carbs: 0,
        sugars: 0,
        fiber: 0,
        protein: 0,
        salt: 0
    };


    // Additionner les valeurs de chaque plat sélectionné
    obtenirPlatsSelectionnes().forEach(plat => {

        valeurs.calories += Number(plat.dataset.calories || 0);
        valeurs.fat += Number(plat.dataset.fat || 0);
        valeurs.saturated += Number(plat.dataset.saturated || 0);
        valeurs.carbs += Number(plat.dataset.carbs || 0);
        valeurs.sugars += Number(plat.dataset.sugars || 0);
        valeurs.fiber += Number(plat.dataset.fiber || 0);
        valeurs.protein += Number(plat.dataset.protein || 0);
        valeurs.salt += Number(plat.dataset.salt || 0);

    });


    // Afficher les valeurs calculées
    document.querySelector('#nutrition-calories').textContent = valeurs.calories + ' kcal';
    document.querySelector('#nutrition-lipides').textContent = valeurs.fat + ' g';
    document.querySelector('#nutrition-satures').textContent = valeurs.saturated + ' g';
    document.querySelector('#nutrition-glucides').textContent = valeurs.carbs + ' g';
    document.querySelector('#nutrition-sucres').textContent = valeurs.sugars + ' g';
    document.querySelector('#nutrition-fibres').textContent = valeurs.fiber + ' g';
    document.querySelector('#nutrition-proteines').textContent = valeurs.protein + ' g';
    document.querySelector('#nutrition-sel').textContent = valeurs.salt.toFixed(1) + ' g';

}


// ==================================================
// METTRE À JOUR LES ALLERGÈNES
// ==================================================

function mettreAJourAllergenes() {

    // Utiliser un Set pour éviter les doublons
    const allergenes = new Set();


    // Récupérer les allergènes de chaque plat sélectionné
    obtenirPlatsSelectionnes().forEach(plat => {

        const liste = plat.dataset.allergenes
            .split(',')
            .map(allergene => allergene.trim())
            .filter(allergene => allergene !== '');


        // Ajouter les allergènes au Set
        liste.forEach(allergene => {

            allergenes.add(allergene);

        });

    });


    // Zone où les allergènes sont affichés
    const zone = document.querySelector('#allergenes-list');


    // Aucun plat sélectionné
    if (allergenes.size === 0) {

        zone.textContent = 'Aucun allergène';
        return;

    }


    // Afficher les allergènes sans doublons
    zone.textContent = Array.from(allergenes).join(' • ');

}


// ==================================================
// METTRE À JOUR LES RÉGIMES ALIMENTAIRES
// ==================================================

function mettreAJourRegimes() {

    // Utiliser un Set pour éviter les doublons
    const regimes = new Set();


    // Récupérer les régimes de chaque plat sélectionné
    obtenirPlatsSelectionnes().forEach(plat => {

        const liste = plat.dataset.regime
            .split(',')
            .map(regime => regime.trim())
            .filter(regime => regime !== '');


        // Ajouter les régimes au Set
        liste.forEach(regime => {

            regimes.add(regime);

        });

    });


    // Zone où les régimes sont affichés
    const zone = document.querySelector('#regimes-list');


    // Aucun plat sélectionné
    if (regimes.size === 0) {

        zone.textContent = 'Aucun régime sélectionné';
        return;

    }


    // Afficher les régimes sans doublons
    zone.textContent = Array.from(regimes).join(' • ');

}


// ==================================================
// CARROUSEL DES MENUS
// ==================================================

const menuGrid = document.querySelector('.menu-grid');
const menus = Array.from(document.querySelectorAll('.menu-card'));
const boutonPrecedent = document.querySelector('.carousel-prev');
const boutonSuivant = document.querySelector('.carousel-next');


// ==================================================
// DUPLICATION DES MENUS POUR LA BOUCLE
// ==================================================

menus.forEach(menu => {

    const copie = menu.cloneNode(true);
    menuGrid.appendChild(copie);

});


// Récupérer toutes les cartes, originales et copiées
const tousLesMenus = document.querySelectorAll('.menu-card');


// Position actuelle du carrousel
let position = 0;


// ==================================================
// FAIRE DÉFILER LE CARROUSEL
// ==================================================

function faireDefiler() {

    const largeurMenu = tousLesMenus[0].offsetWidth;
    const espace = 38;


    // Déplacer le carrousel jusqu'au menu demandé
    menuGrid.scrollTo({
        left: position * (largeurMenu + espace),
        behavior: 'smooth'
    });

}



// BOUTON SUIVANT


boutonSuivant.addEventListener('click', () => {

    position++;

    faireDefiler();


    // Revenir au premier menu après le dernier
    if (position >= menus.length) {

        setTimeout(() => {

            position = 0;

            menuGrid.scrollTo({
                left: 0,
                behavior: 'instant'
            });

        }, 300);

    }

});



// BOUTON PRÉCÉDENT


boutonPrecedent.addEventListener('click', () => {

    // Si on n'est pas au premier menu
    if (position > 0) {

        position--;

        faireDefiler();

    }
    else {

        // Aller temporairement sur la copie du dernier menu
        position = menus.length;

        const largeurMenu = tousLesMenus[0].offsetWidth;
        const espace = 38;


        menuGrid.scrollTo({
            left: position * (largeurMenu + espace),
            behavior: 'instant'
        });


        // Revenir au menu précédent
        position--;

        faireDefiler();

    }

});