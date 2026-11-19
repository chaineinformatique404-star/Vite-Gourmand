<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos menus - Vite & Gourmand</title>

<link rel="stylesheet" href="../.Composants/style commun.css">    
<link rel="stylesheet" href="Liste menu.css">

<style>.menu-button:hover {
    background: linear-gradient(90deg,#c07d12,#dd970f) !important;
    color: #fff !important;
    border-color: #dd970f !important;
}

</style>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">

</head>

<body>

<!-- HEADER -->

<?php $page = 'menus'; require_once __DIR__ . '/../.Composants/header.php'; ?>


<!-- HERO -->
<section class="hero">

    <div class="hero-overlay"></div>

    <div class="hero-container">

        <div class="hero-content">

            <span class="hero-subtitle">
                NOS CRÉATIONS GOURMANDES
            </span>

            <h1>Nos menus</h1>

            <div class="hero-decoration">
                <span></span>
            </div>

            <p>
                Des menus gourmands et raffinés, conçus pour sublimer tous vos événements.
            </p>

        </div>

    </div>

</section>


<!-- RECHERCHE -->
<section class="search-box">

    <div class="search-title">
        <strong>TROUVEZ CE QUE VOUS CHERCHEZ</strong>
        <span>De délicieux repas, selon vos envies</span>
    </div>

    <div class="search-fields">

        <div class="field">
            <label>Type d'événement</label>

            <select>
                <option>Tous les événements</option>
                <option>Mariage</option>
                <option>Anniversaire</option>
                <option>Entreprise</option>
                <option>Cocktail</option>
                <option>Réception</option>
            </select>
        </div>

        <div class="field">
            <label>Nombre de personnes</label>

            <select>
                <option>Toutes les tailles</option>
                <option>10 - 20 personnes</option>
                <option>20 - 50 personnes</option>
                <option>50 - 100 personnes</option>
                <option>100+ personnes</option>
            </select>
        </div>

        <div class="field">
            <label>Budget par personne</label>

            <select>
                <option>Tous les budgets</option>
                <option>Moins de 20 €</option>
                <option>20 € - 30 €</option>
                <option>30 € - 50 €</option>
                <option>50 € et +</option>
            </select>
        </div>

        <button class="search-button">
            Rechercher <span>⌕</span>
        </button>

    </div>

    <div class="active-filters">

        <strong>FILTRES ACTIFS :</strong>

        <span>Mariage <button>×</button></span>
        <span>20 - 50 pers. <button>×</button></span>
        <span>20€ - 50€ <button>×</button></span>

        <button class="reset">Réinitialiser ↻</button>

    </div>

</section>

<!-- MENUS -->
<main class="menus-section">

    <div class="section-heading">

        <div>
            <span>TOUS NOS MENUS</span>
            <h2>Découvrez tous nos menus</h2>
            <p>Des créations gourmandes pour toutes vos occasions</p>
        </div>

        <div class="sort">

            <label>Trier par :</label>

            <select>
                <option>Popularité</option>
                <option>Prix croissant</option>
                <option>Prix décroissant</option>
                <option>Nouveautés</option>
            </select>

            <button class="view-button active">▦</button>
            <button class="view-button">☷</button>

        </div>

    </div>


    <div class="menus-grid">


    

    <!-- MENU 1 -->
        
        <article class="menu-card">

            <div class="menu-image">

                <a href="../Détail Menu/Détail menu.php"><img src="Images/agneau 2.jpg" alt="Menu Gourmand"></a>

                <span class="tag">Anniversaire</span>

                <button class="favorite">♡</button>

            </div>

            <div class="menu-content">

                <h3>Menu Gourmand <span class="menu-star" aria-hidden="true">★</span></h3>

                <p>Une cuisine généreuse et savoureuse, pensée pour ravir tous vos convives.</p>

                <div class="price">
                    À partir de <strong>15€</strong> / pers.
                </div>

                <div class="menu-info">
                    <span>♧ &nbsp; 10 - 20 pers.</span>
                    <span>◇ &nbsp; 3 services</span>
                </div>

                <a href="../Détail Menu/Détail menu.php" class="menu-button">
                    Voir le menu
                    <span>→</span>
                </a>

            </div>

        </article>

    <!-- MENU 2 -->

        <article class="menu-card">

            <div class="menu-image">

                <img src="Images/algue.jpg">

                <span class="tag">Anniversaire</span>

                <button class="favorite">♡</button>

            </div>

            <div class="menu-content">

                <h3>Menu Végétarien</h3>
                <p>Des créations végétales fraîches et colorées, riches en saveurs et en créativité</p>

                <div class="price">
                    À partir de <strong>16.99€</strong> / pers.
                </div>

                <div class="menu-info">
                    <span>♧ &nbsp; 10 - 35 pers.</span>
                    <span>◇ &nbsp; 3 services</span>
                </div>

                <span class="menu-button">
                    Voir le menu
                    <span>→</span>
                </span>

            </div>

        </article>

         <!-- MENU 3 -->

        <article class="menu-card">

            <div class="menu-image">

                <img src="images/prestige.jpg">

                <button class="favorite">♡</button>

            </div>

            <div class="menu-content">

                <h3>Menu Prestige</h3>
                <p>Une expérience gastronomique raffinée, idéale pour vos événements d’exception.</p>

                <div class="price">
                    À partir de <strong>20€</strong> / pers.
                </div>

                <div class="menu-info">
                    <span>♧ &nbsp; 10 - 40 pers.</span>
                    <span>◇ &nbsp; 3 services</span>
                </div>

                <span class="menu-button">
                    Voir le menu
                    <span>→</span>
                </span>

            </div>

        </article>

    <!-- MENU 4 -->
    
    <article class="menu-card">

            <div class="menu-image">

                <img src="images/burgers.jpg">

                <span class="tag">Anniversaire</span>

                <button class="favorite">♡</button>

            </div>

            <div class="menu-content">

                <h3>Menu Plaisir</h3>

                <p>
                    Des plats savoureux et conviviaux pour faire
                    de vos anniversaires un succès.
                </p>

                <div class="price">
                    À partir de <strong>12€</strong> / pers.
                </div>

                <div class="menu-info">
                    <span>♧ &nbsp; 10 - 20 pers.</span>
                    <span>◇ &nbsp; 3 services</span>
                </div>

                <span class="menu-button">
                    Voir le menu
                    <span>→</span>
                </span>

            </div>

        </article>


    <!-- MENU 5 -->
    
    <article class="menu-card">

            <div class="menu-image">

                <img src="images/poiscaille.jpg">

                <span class="tag">Réception</span>

                <button class="favorite">♡</button>

            </div>

            <div class="menu-content">

                <h3>Menu Délice</h3>

                <p>
                    Un voyage de saveurs pour impressionner
                    tous vos invités.
                </p>

                <div class="price">
                    À partir de <strong>14.50€</strong> / pers.
                </div>

                <div class="menu-info">
                    <span>♧ &nbsp; 20 - 80 pers.</span>
                    <span>◇ &nbsp; 4 services</span>
                </div>

                <span class="menu-button">
                    Voir le menu
                    <span>→</span>
                </span>

            </div>

        </article>


    <!-- MENU 6 -->
        
    <article class="menu-card">

            <div class="menu-image">

                <img src="images/cocktail.jpg" alt="Menu Cocktail">

                <span class="tag">Cocktail</span>

                <button class="favorite">♡</button>

            </div>

            <div class="menu-content">

                <h3>Menu Cocktail</h3>

                <p>
                    Des bouchées raffinées et créatives pour vos
                    cocktails et apéritifs.
                </p>

                <div class="price">
                    À partir de <strong>8€</strong> / pers.
                </div>

                <div class="menu-info">
                    <span>♧ &nbsp; 20 - 100 pers.</span>
                    <span>◇ &nbsp; Cocktail</span>
                </div>

                <span class="menu-button">
                    Voir le menu
                    <span>→</span>
                </span>

            </div>

        </article>

    </div>


    <div class="all-menus">
        <a href="#" class="gold-button">
            Voir tous les menus →
        </a>
    </div>

</main>


<!-- FOOTER -->

<?php require_once __DIR__ . '/../.Composants/footer.html'; ?>

<script src="Liste menu.js"></script>

</body>
</html>