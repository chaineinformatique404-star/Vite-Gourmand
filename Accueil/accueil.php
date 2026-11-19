<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - V&G</title>
    <link rel="stylesheet" href="../.Composants/style commun.css">
    <link rel="stylesheet" href="accueil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">

</head>

<body>

    <!-- ===========================
         HEADER
    =========================== -->

<?php $page = 'accueil'; require_once __DIR__ . '/../.Composants/header.php'; ?>


    <!-- ===========================
         HERO
    =========================== -->

    <section class="hero">

    <video class="hero-video" autoplay muted loop playsinline>
    <source src="images/food slideshow.mp4" type="video/mp4">
    </video>

    <div class="hero-overlay"></div>

    <div class="hero-container">

        <div class="hero-content">

            <span class="hero-subtitle">
                25 ANS DE SAVOIR-FAIRE À BORDEAUX
            </span>

            <h1>Vite & Gourmand</h1>

            <div class="hero-slogan">
                Des menus créés avec passion<br>
                pour tous vos événements
            </div>

            <div class="hero-decoration">
                <span></span>
                ♨
                <span></span>
            </div>

            <p>
                Mariage, anniversaire, repas d'entreprise ou fêtes de fin d'année,
                nous régalons nos invités avec des produits frais et des recettes
                faites maison.
            </p>

            <div class="hero-buttons">
                <a href="pages/menus.html" class="btn-primary">Découvrir les menus →</a>
                <a href="pages/contact.html" class="btn-secondary">Nous contacter ✉</a>
            </div>

       
    </section>

    



    <!-- ===========================
         SEARCH
    =========================== -->

    <section class="search-section">

        <div class="search-container">

            <div class="search-filters">

                <div class="filter-group">
                    <label for="event">Type d'événement</label>
                    <select id="event">
                        <option value="">Sélectionner</option>
                        <option value="mariage">Mariage</option>
                        <option value="entreprise">Entreprise</option>
                        <option value="anniversaire">Anniversaire</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="people">Nombre de personnes</label>
                    <select id="people">
                        <option value="">Sélectionner</option>
                        <option value="10">1 à 10</option>
                        <option value="30">11 à 30</option>
                        <option value="50">31 à 50</option>
                        <option value="50+">Plus de 50</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="budget">Budget par personne</label>
                    <select id="budget">
                        <option value="">Sélectionner</option>
                        <option value="20">Moins de 20 €</option>
                        <option value="40">20 à 40 €</option>
                        <option value="60">40 à 60 €</option>
                        <option value="60+">Plus de 60 €</option>
                    </select>
                </div>

                <button type="button" class="search-button">
                    Rechercher
                </button>

            </div>

        </div>
        
    </section>

    <!-- ===========================
         MENUS POPULAIRES
    =========================== -->

    <section class="popular-menus">

        <div class="popular-container">

            <div class="section-title">
                <span>NOS MENUS POPULAIRES</span>

                <h2>Découvrez nos menus phares</h2>

                <p>
                    Des créations gourmandes pour toutes vos occasions
                </p>
            </div>

        <div class="carousel">

        <button class="carousel-arrow carousel-prev">←</button>


            <div class="menu-grid">

                <article class="menu-card">

                    <a href="../Détail Menu/Détail menu.php" class="menu-card-link" aria-label="Voir le Menu Gourmand"></a>

                    <div class="menu-image">
                        <img src="Images/agneau.jpg" alt="Menu Gourmand">
                    </div>

                    <div class="menu-content">

                        <h3><a href="../Détail Menu/Détail menu.php" class="menu-title-link">Menu Gourmand</a> <span class="menu-star" aria-hidden="true">★</span></h3>

                        <p>
                            À partir de <strong>15€</strong> / pers.
                        </p>

                    </div>

                </article>


                <article class="menu-card">

                    <div class="menu-image">
                        <img src="Images/poiscaille.jpg">
                    </div>

                    <div class="menu-content">

                        <h3>Menu Végétarien</h3>

                        <p>
                            À partir de <strong>16.99€</strong> / pers.
                        </p>

                    </div>

                </article>


                <article class="menu-card">

                    <div class="menu-image">
                        <img src="Images/prestige.jpg" >
                    </div>

                    <div class="menu-content">

                        <h3>Menu Prestige</h3>

                        <p>
                            À partir de <strong>20€</strong> / pers.
                        </p>

                    </div>

                </article>

                <article class="menu-card">

                    <div class="menu-image">
                        <img src="Images/canard.jpg">
                    </div>

                    <div class="menu-content">

                        <h3>Menu Délice</h3>

                        <p>
                            À partir de <strong>14€</strong> / pers.
                        </p>

                    </div>

                </article>

                <article class="menu-card">

                    <div class="menu-image">
                         <img src="Images/pates.jpg">
                    </div>

                    <div class="menu-content">

                        <h3>Menu Express</h3>

                        <p>
                            À partir de <strong>10€</strong> / pers.
                        </p>

                    </div>

                </article>

                <article class="menu-card">

                    <div class="menu-image">
                       <img src="Images/cloche.jpg">
                    </div>

                    <div class="menu-content">

                        <h3>Menu Mystère</h3>

                        <p>
                            À partir de <strong>7.77€</strong> / pers.
                        </p>

                    </div>

                </article>

            </div>

        <button class="carousel-arrow carousel-next">→</button> 

        </div>

    </section>

    <!-- ===========================
         NOTRE ENGAGEMENT
         + ÉQUIPE PASSIONNÉE
    =========================== -->

    <section class="engagement">

        <div class="engagement-container">

            <div class="engagement-content">

                <span>NOTRE ENGAGEMENT</span>

                <h2>Pourquoi nous choisir ?</h2>

                <ul>
                    <li>25 ans d'expérience dans la gastronomie événementielle</li>
                    <li>Des produits frais, locaux et de saison</li>
                    <li>Des menus personnalisés selon vos envies et besoins</li>
                    <li>Une équipe passionnée et à votre écoute</li>
                    <li>Respect des régimes alimentaires et des allergènes</li>
                    <li>Livraison et installation dans le lieu de votre choix</li>
                </ul>

                <br> <br> <br>

              <div class="engagement-présentation">
                <h3>Une cuisine pensée pour vos événements</h3>
              
            <i>Chez Vite & Gourmand, nous mettons notre savoir-faire et notre passion au service de vos événements. Chaque occasion est unique, c’est pourquoi nous proposons des menus pensés pour s’adapter à vos envies, au nombre de convives et à votre budget. Nous accordons une attention particulière à la qualité des produits, à la diversité des recettes et au respect des régimes alimentaires et des allergies. <br>De la préparation à l’installation sur le lieu de votre choix, notre équipe vous accompagne afin de vous permettre de profiter pleinement de votre événement, en toute sérénité..</i>

        </div>

            </div>

            


            <div class="team-content">

                <span>UNE ÉQUIPE PASSIONNÉE</span>

                <h2>Derrière Vite & Gourmand</h2>

                <div class="team-grid">

                    <article class="team-card">

                        <div class="team-image">
                         <img src="Images/julie.jpg">
                        </div>

                        <div class="team-info">
                            <h3>Julie</h3>
                            <strong>Organisation & Relation client</strong>

                              <span>
                                Julie est votre interlocutrice privilégiée.
                                Elle veille à la réussite de votre événement
                                de A à Z.
                            </p>
                        </div>

                    </article>


                    <article class="team-card">

                        <div class="team-image">
                          <img src="Images/josé.jpg">
                        </div>

                        <div class="team-info">
                            <h3>José</h3>
                            <strong>Chef cuisinier</strong>

                            <span>
                                José imagine et cuisine des menus savoureux
                                avec créativité et exigence depuis plus de 25 ans.
                            </span>
                        </div>

                    </article>

                </div>

            </div>

        </div>
    </section>

<!-- ===========================
         AVANTAGES
    =========================== -->

    <section class="features">
        <div class="features-container">

            <div class="feature">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-leaf-icon lucide-leaf"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10Z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
                </div>

                <div>
                    <h3>Produits frais</h3>
                    <p>Sélectionnés avec soin</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utensils-icon lucide-utensils"><path d="M3 2v7c0 1.1.9 2 2 2h4a2 2 0 0 0 2-2V2"/><path d="M7 2v20"/><path d="M21 15V2a5 5 0 0 0-5 5v6c0 1.1.9 2 2 2h3Zm0 0v7"/></svg>
                </div>

                <div>
                    <h3>Faits maison</h3>
                    <p>Préparés par nos chefs</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-van-icon lucide-van"><path d="M13 6v5a1 1 0 0 0 1 1h6.102a1 1 0 0 1 .712.298l.898.91a1 1 0 0 1 .288.702V17a1 1 0 0 1-1 1h-3"/><path d="M5 18H3a1 1 0 0 1-1-1V8a2 2 0 0 1 2-2h12c1.1 0 2.1.8 2.4 1.8l1.176 4.2"/><path d="M9 18h5"/><circle cx="16" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                </div>

                <div>
                    <h3>Livraison rapide</h3>
                    <p>À l'heure, à votre porte</p>
                </div>
            </div>

            <div class="feature">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-icon lucide-lock"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                </div>

                <div>
                    <h3>Paiement sécurisé</h3>
                    <p>100% sécurisé</p>
                </div>
            </div>

        </div>
    </section>

    <!-- ===========================
         AVIS
    =========================== -->

    <section class="avis">
        <div class="avis-container">

            <div class="section-title">
                <span>AVIS CLIENTS</span>
                <h2>Ce que disent nos clients</h2>
            </div>

            <div class="avis-grid">

                <article class="avis-card">
                    <div class="avis-etoiles">★★★★★</div>
                    <p>"Buffet impeccable pour notre mariage, tous nos invités ont adoré. Équipe très à l'écoute."</p>
                    <div class="avis-auteur">
                        <div class="avis-portrait">CM</div>
                        <strong>Claire M.</strong>
                    </div>
                </article>

                <article class="avis-card">
                    <div class="avis-etoiles">★★★★★</div>
                    <p>"Repas d'entreprise livré à l'heure, produits frais et présentation soignée."</p>
                    <div class="avis-auteur">
                        <div class="avis-portrait">AD</div>
                        <strong>Antoine D.</strong>
                    </div>
                </article>

                <article class="avis-card">
                    <div class="avis-etoiles">★★★★☆</div>
                    <p>"Menu végétarien très savoureux pour l'anniversaire de ma fille. Je recommande."</p>
                    <div class="avis-auteur">
                        <div class="avis-portrait">LR</div>
                        <strong>Lucie R.</strong>
                    </div>
                </article>

            </div>

        </div>
    </section>
    
    <!-- ===========================
         FOOTER
    =========================== -->

    <?php require_once __DIR__ . '/../.Composants/footer.html'; ?>
 

    <script src="accueil.js"></script>

</body>

</html>