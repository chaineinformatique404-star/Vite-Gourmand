<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Mon compte - Vite & Gourmand</title>

    <link rel="stylesheet" href="../.Composants/style commun.css"> 
    <link rel="stylesheet" href="Espace perso.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">        
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&family=Parisienne&family=Alex+Brush&display=swap" rel="stylesheet">

</head>

<body>


    <!-- HEADER -->

<?php require_once __DIR__ . '/../.Composants/header.php'; ?>



    <!-- FIL D'ARIANE -->

    <div class="breadcrumb">

        <a href="accueil.php">Accueil</a>

        <i class="fa-solid fa-chevron-right"></i>

        <span>Mon compte</span>

    </div>



    <!-- MENU ESPACE UTILISATEUR -->

    <main class="account-container">

        <aside class="account-sidebar">

            <h2>MON ESPACE</h2>


            <nav class="account-navigation">

                <a href="mon-compte.php" class="active">

                    <i class="fa-solid fa-house"></i>

                    <span>Tableau de bord</span>

                </a>


                <a href="mes-commandes.php">

                    <i class="fa-solid fa-bag-shopping"></i>

                    <span>Mes commandes</span>

                </a>


                <a href="mes-avis.php">

                    <i class="fa-regular fa-star"></i>

                    <span>Mes avis</span>

                </a>


                <a href="mon-profil.php">

                    <i class="fa-regular fa-user"></i>

                    <span>Mon profil</span>

                </a>

            </nav>


            <div class="logout">

                <a href="connexion.php">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    <span>Déconnexion</span>

                </a>

            </div>

        </aside>



        <!-- TABLEAU DE BORD -->

        <section class="dashboard">


            <!-- BIENVENUE -->

            <div class="welcome">

                <h1>
                    Bonjour, Kévin ! <span>👋</span>
                </h1>

                <p>
                    Bienvenue dans votre espace personnel.
                </p>

            </div>



            <!-- PREFERENCES -->

            <section class="preferences">


                <!-- REGIME ALIMENTAIRE -->

                <div class="diet">

                    <div class="section-title">

                        <i class="fa-solid fa-bowl-food"></i>

                        <h2>Régime alimentaire</h2>

                    </div>


                    <select>

                        <option>Type de régime</option>
                        <option>Sans restriction</option>
                        <option>Végétarien</option>
                        <option>Vegan</option>
                        <option>Sans gluten</option>

                    </select>

                    <div class="allergens-box">

                        <div class="allergens-title">

                            <i class="fa-solid fa-carrot"></i>

                            <h3>Allergènes</h3>

                        </div>

                        <input id="allergens" type="text" placeholder="Ex : gluten, lait, arachides, fruits à coque...">

                    </div>

                </div>



                <!-- FOYER -->

                <div class="household">

                    <div class="section-title">

                        <i class="fa-solid fa-people-group"></i>

                        <h2>Foyer</h2>

                    </div>


                    <div class="counter-row">

                        <span>Adultes</span>


                        <div class="counter">

                            <button type="button">−</button>

                            <strong>2</strong>

                            <button type="button">+</button>

                        </div>

                    </div>


                    <div class="counter-row">

                        <span>Enfants (moins de 12 ans)</span>


                        <div class="counter">

                            <button type="button">−</button>

                            <strong>1</strong>

                            <button type="button">+</button>

                        </div>

                    </div>

                </div>

            </section>



            <!-- COMMANDES + AVIS -->

            <div class="dashboard-grid">


                <!-- DERNIERES COMMANDES -->

                <section class="dashboard-card orders">


                    <div class="card-header">

                        <h2>Vos dernières commandes</h2>

                        <a href="mes-commandes.html">
                            Voir toutes mes commandes
                        </a>

                    </div>



                    <!-- COMMANDE 1 -->

                    <article class="order">

                        <div class="order-number">

                            <strong>#000124</strong>

                            <span>12/08/2026</span>

                            <span>18:45</span>

                        </div>


                        <div class="order-image">

                            <img
                                src="images/photo menu 2.png"
                                alt="Menu Gourmand"
                            >

                        </div>


                        <div class="order-info">

                            <strong>Menu Gourmand</strong>

                            <span>1 personne</span>

                            <span>Livraison à domicile</span>

                        </div>


                        <strong class="order-price">
                            25 €
                        </strong>


                        <span class="status preparing">
                            En attente
                        </span>


                        <a href="detail-commande.html"
                           class="details-button">

                            Détails

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </article>



                    <!-- COMMANDE 2 -->

                    <article class="order">

                        <div class="order-number">

                            <strong>#000123</strong>

                            <span>10/08/2026</span>

                            <span>12:30</span>

                        </div>


                        <div class="order-image">

                            <img
                                src="images/quiche.jpg"
                                alt="Menu Équilibre"
                            >

                        </div>


                        <div class="order-info">

                            <strong>Menu Équilibre</strong>

                            <span>2 personnes</span>

                            <span>Livraison à domicile</span>

                        </div>


                        <strong class="order-price">
                            44€
                        </strong>


                        <span class="status finished">
                            Terminée
                        </span>


                        <a href="detail-commande.html"
                           class="details-button">

                            Détails

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </article>



                    <!-- COMMANDE 3 -->

                    <article class="order">

                        <div class="order-number">

                            <strong>#000122</strong>

                            <span>07/08/2026</span>

                            <span>19:10</span>

                        </div>


                        <div class="order-image">

                            <img
                                src="images/pates.jpg"
                                alt="Menu Plaisir"
                            >

                        </div>


                        <div class="order-info">

                            <strong>Menu Plaisir</strong>

                            <span>2 personnes</span>

                            <span>Livraison à domicile</span>

                        </div>


                        <strong class="order-price">
                            40 €
                        </strong>


                        <span class="status finished">
                            Terminée
                        </span>


                        <a href="detail-commande.html"
                           class="details-button">

                            Détails

                            <i class="fa-solid fa-arrow-right"></i>

                        </a>

                    </article>


                    <a href="mes-commandes.html"
                       class="all-orders">

                        <i class="fa-solid fa-chevron-down"></i>
                        voir plus
                        <i class="fa-solid fa-chevron-down"></i>

                    </a>

                </section>



                <!-- DERNIERS AVIS -->

                <section class="dashboard-card reviews">


                    <div class="card-header">

                        <h2>Derniers avis</h2>

                        <a href="mes-avis.html">
                            Voir tous mes avis
                        </a>

                    </div>



                    <!-- AVIS 1 -->

                    <article class="review">

                        <div class="review-image">

                            <img
                                src="images/quiche.jpg"
                                alt="Menu equilibre"
                            >

                        </div>


                        <div class="review-content">

                            <strong>Menu Équilibre</strong>

                            <small>12/08/2026</small>


                            <div class="stars">

                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>

                            </div>


                            <p>
                                Excellent ! Produits frais et savoureux.
                            </p>

                        </div>


                        <div class="review-actions">

                            <button type="button">

                                <i class="fa-solid fa-pen"></i>

                            </button>


                            <button type="button">

                                <i class="fa-regular fa-trash-can"></i>

                            </button>

                        </div>

                    </article>



                    <!-- AVIS 2 -->

                    <article class="review">

                        <div class="review-image">

                            <img
                                src="images/pates.jpg"
                                alt="Menu plaisir"
                            >

                        </div>


                        <div class="review-content">

                            <strong>Menu Plaisir</strong>

                            <small>07/08/2026</small>


                            <div class="stars">

                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>

                            </div>


                            <p>
                                Très bon menu, je recommande !
                            </p>

                        </div>


                        <div class="review-actions">

                            <button type="button">

                                <i class="fa-solid fa-pen"></i>

                            </button>


                            <button type="button">

                                <i class="fa-regular fa-trash-can"></i>

                            </button>

                        </div>

                    </article>



                    <!-- INVITATION AVIS -->

                    <div class="review-cta">

                        <div class="review-icon">

                            <i class="fa-regular fa-comment-dots"></i>

                        </div>


                        <div class="review-message">

                            <strong>
                                Vous avez commandé un menu récemment ?
                            </strong>

                            <span>
                                Partagez votre expérience avec la communauté.
                            </span>

                        </div>


                        <a href="mes-avis.html"
                           class="review-button">

                            Donner mon avis

                        </a>

                    </div>

                </section>

            </div>

        </section>

    </main>



    <!-- FOOTER -->

  <?php require_once __DIR__ . '/../.Composants/footer.html'; ?>



    <script src="Espace perso.js"></script>

</body>

</html>