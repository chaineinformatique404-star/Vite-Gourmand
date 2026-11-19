<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos menus - Vite & Gourmand</title>

<link rel="stylesheet" href="Composants/style commun.css">    
<link rel="stylesheet" href="Liste menu.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">

</head>

<body>

<!-- HEADER -->

<?php $page = 'menus'; require_once __DIR__ . '/../Composants/header.php'; ?>


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

<!-- EN CE MOMENT -->

<section class="featured-menus">

    <div class="featured-now">

    <div class="featured-heading">
        <span>À NE PAS MANQUER</span>
        <h2>En ce moment</h2>
    </div>

   <div class="now-carousel">

    <div class="now-track">

        <!-- IMAGE 1 -->
        <article class="now-card">

            <div class="now-image">

                <img src="Images/agneau.jpg" alt="Gourmandise">

                <div class="now-overlay"></div>

                <div class="now-content">
                    <h3>Menu Gourmand <p>★★★★★ 4.8/5</p></h3>  
                    <p>Qui a dit que la gourmandise était un vilain défaut ?</p>
                </div>

            </div>

        </article>


        <!-- IMAGE 2 -->
        <article class="now-card">

            <div class="now-image">

                <img src="Images/mariage.jpg" alt="Événement">

                <div class="now-overlay"></div>

                <div class="now-content">
                    <h3>Vos événements</h3>
                    <p>Une prestation adaptée à vos occasions.</p>
                </div>

            </div>

        </article>


        <!-- IMAGE 3 -->
        <article class="now-card">

            <div class="now-image">

                <img src="Images/chef de cuisine.jpg" alt="Notre savoir-faire">

                <div class="now-overlay"></div>

                <div class="now-content">
                    <h3>Notre savoir-faire</h3>
                    <p>Découvrez notre passion pour la cuisine.</p>
                </div>

            </div>

        </article>


        <!-- IMAGE 4 -->
        <article class="now-card">

            <div class="now-image">

                <img src="Images/saute legume.jpg" alt="Recettes">

                <div class="now-overlay"></div>

                <div class="now-content">
                    <span class="menu-tag">Recettes</span>
                    <h3>Recettes de saison</h3>
                    <p>Des recettes élaborées avec des produits frais de saison, pour une cuisine savoureuse qui évolue au fil de l’année.</p>
                </div>

            </div>

        </article>

    </div>

    <button class="carousel-arrow previous">←</button>
    <button class="carousel-arrow next">→</button>

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

                <img src="Images/agneau 2.jpg" alt="Menu Plaisir">

                <span class="tag">Anniversaire</span>

                <button class="favorite">♡</button>

            </div>

            <div class="menu-content">

                <h3>Menu Gourmand</h3>

                <p>Une cuisine généreuse et savoureuse, pensée pour ravir tous vos convives.</p>

                <div class="price">
                    À partir de <strong>15€</strong> / pers.
                </div>

                <div class="menu-info">
                    <span>♧ &nbsp; 1 - 10 pers.</span>
                    <span>◇ &nbsp; 3 services</span>
                </div>

                <a href="#" class="menu-button">
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

                <a href="#" class="menu-button">
                    Voir le menu
                    <span>→</span>
                </a>

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

                <a href="#" class="menu-button">
                    Voir le menu
                    <span>→</span>
                </a>

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

                <a href="#" class="menu-button">
                    Voir le menu
                    <span>→</span>
                </a>

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

                <a href="#" class="menu-button">
                    Voir le menu
                    <span>→</span>
                </a>

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

                <a href="#" class="menu-button">
                    Voir le menu
                    <span>→</span>
                </a>

            </div>

        </article>

    </div>


    <div class="all-menus">
        <a href="#" class="gold-button">
            Voir tous les menus →
        </a>
    </div>

</main>


<!-- CONTACT -->

<section class="contact-banner">

    <div class="contact-question">

        <div class="question-icon">?</div>

        <div>
            <h3>Une question, un projet ?</h3>

            <p>
                Notre équipe est à votre écoute pour répondre
                à toutes vos demandes.
            </p>

            <a href="contact.html">Nous contacter →</a>
        </div>

    </div>

    <div class="contact-info">

        <p><strong>Téléphone</strong> 01 23 45 67 89</p>
        <p><strong>E-mail</strong> contact@vitegourmand.fr</p>
        <p><strong>Adresse</strong> 123 Rue des Saveurs, 75000 Paris</p>
        <p><strong>Horaires</strong> Lun - Ven : 9h00 - 18h00</p>

    </div>

    <div class="contact-photo">
        <span>IMAGE</span>
    </div>

</section>


<!-- FOOTER -->

<?php require_once __DIR__ . '/../Composants/footer.html'; ?>

<script src="Liste menu.js"></script>

</body>
</html>