 <!-- STRUCTURE HTML -->

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Mon Menu - V&G</title>

  <link rel="stylesheet" href="../.Composants/style commun.css"> 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&family=Parisienne&family=Alex+Brush&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

  <link rel="stylesheet" href="Détail menu.css">

   <script src="Détail menu.js" defer></script>
 
</head>

<body>

 
<!-- HEADER -->

<?php $page = 'detail-menu'; require_once __DIR__ . '/../.Composants/header.php'; ?>


<main>

  <!-- HERO MENU -->

  <section class="product container">

    <!-- GALERIE -->

<div class="gallery">

      <div class="main-image">

        <button class="gallery-arrow left" aria-label="Image précédente">
          ‹
        </button>

        <video class="preview-video" autoplay muted loop playsinline>
        <source src="images/Découpage.mp4" type="video/mp4">
        </video>

        <img id="preview-photo" class="preview-photo" src="" alt="">

        <button class="gallery-arrow right" aria-label="Image suivante">
          ›
        </button>

      </div>


 <div class="thumbnails">

    <div class="thumb-list">

        <button class="thumb video">
            <img src="images/aperçu découpage.png" alt="Menu Gourmand">
            <span class="play-button">▶</span>
        </button>

        <button class="thumb">
            <img src="images/photo menu 1.png" alt="Plat du menu">
        </button>

        <button class="thumb">
            <img src="images/photo menu 2.png" alt="Entrée du menu">
        </button>

        <button class="thumb">
            <img src="images/photo menu 3.png" alt="Dessert du menu">
        </button>

        <button class="thumb">
            <img src="images/photo menu 4.png" alt="Dessert du menu">
        </button>

        <button class="thumb">
            <img src="images/photo menu 5.png" alt="Dessert du menu">
        </button>

    </div>


 </div>    

</div>


    <!-- INFORMATIONS -->

    <div class="product-info">

      <span class="category">
        CATÉGORIE
      </span>

      <h1>
        Menu Gourmand
      </h1>

      <p class="intro">
        Une sélection raffinée de plats préparés avec des ingrédients frais
        et de saison, pour une expérience gourmande et équilibrée. Chaque
        assiette est pensée avec soin, des entrées jusqu'aux desserts, afin
        de ravir vos convives et de faire de chaque événement un moment
        mémorable, savoureux et plein de convivialité.
      </p>


      <div class="key-info">

        <div>
          <span class="icon">♙</span>

          <p>
            <strong>Min. 10</strong><br>
            personnes
          </p>
        </div>


        <div>
          <span class="icon">❧</span>

          <p>
            <strong>Régime</strong><br>
            Tous régimes
          </p>
        </div>


        <div>
          <span class="icon">◷</span>

          <p>
            <strong>Disponibilité</strong><br>
            Toute l'année
          </p>
        </div>

      </div>


      <!-- PRIX -->

      <div class="price-box">

        <span>À partir de</span>

        <strong>16 €</strong>

        <small>/ pers.</small>

      </div>


      <!-- COMMANDE -->

      <div class="order-row">

        <a href="../Commande/commande.php?menu=menu-gourmand" class="order-btn">
          🛒 Commander ce menu
        </a>

        <button
          class="favorite"
          aria-label="Ajouter aux favoris"
        >
          ♡
        </button>

      </div>


  </section>


  

<!-- COMPOSITION -->

<section class="menu-composition">

   <!-- COMPOSITION DU MENU -->

<div class="composition-menu">

    <h2>Composition du menu</h2>
    <br>


    <!-- ENTRÉES -->

    <div class="categorie-menu">

        <h3>Entrées</h3>

        <div class="plats-grid">

            <!-- SALADE CÉSAR -->

            <div class="plat-card"
                data-nom="Salade César"
                data-categorie="Entrée"
                data-image="images/salade.jpg"
                data-description="Salade fraîche composée de laitue, poulet grillé, parmesan et sauce César."
                data-regime="Classique"
                data-allergenes="Lait, oeufs, gluten"
                data-valeurs="kcal 320, matières grasses 18g, glucides 12g, fibres 4g, protéines 25g, sel 1g"
                data-calories="320"
                data-fat="18"
                data-saturated="5"
                data-carbs="12"
                data-sugars="3"
                data-fiber="4"
                data-protein="25"
                data-salt="1">

                <div class="plat-image">
                    <img src="images/salade.jpg" alt="Salade César">
                </div>

                <div class="plat-info">
                    <p class="plat-nom">Salade César</p>
                </div>

            </div>


            <!-- SOUPE DE LÉGUMES -->

            <div class="plat-card"
                data-nom="Soupe de légumes"
                data-categorie="Entrée"
                data-image=images/soupe.jpg
                data-description="Soupe maison préparée avec des légumes frais de saison."
                data-regime="Végétarien"
                data-allergenes="Gluten, lait, oeufs, poisson"
                data-valeurs="kcal 180, matières grasses 6g, glucides 24g, fibres 5g, protéines 6g, sel 1.1g"
                data-calories="180"
                data-fat="6"
                data-saturated="2"
                data-carbs="24"
                data-sugars="7"
                data-fiber="5"
                data-protein="6"
                data-salt="1.1">

                <div class="plat-image">
                    <img src=images/soupe.jpg alt="Soupe de légumes">
                </div>

                <div class="plat-info">
                    <p class="plat-nom">Soupe de légumes</p>
                </div>

            </div>


            <!-- CARPACCIO DE BŒUF -->

            <div class="plat-card"
                data-nom="Carpaccio de bœuf"
                data-categorie="Entrée"
                data-image=images/carpaccio.jpg
                data-description="Fines tranches de bœuf accompagnées de parmesan et d'huile d'olive."
                data-regime="Classique"
                data-allergenes="Lait"
                data-valeurs="kcal 220, matières grasses 12g, glucides 2g, fibres 1g, protéines 26g, sel 1.2g"
                data-calories="220"
                data-fat="12"
                data-saturated="4"
                data-carbs="2"
                data-sugars="1"
                data-fiber="1"
                data-protein="26"
                data-salt="1.2">

                <div class="plat-image">
                    <img src=images/carpaccio.jpg alt="Carpaccio de bœuf">
                </div>

                <div class="plat-info">
                    <p class="plat-nom">Carpaccio de bœuf</p>
                </div>

            </div>

        </div>

    </div>


    <!-- PLATS -->

    <div class="categorie-menu">

        <h3>Plats</h3>

        <div class="plats-grid">

            <!-- BURGER MAISON -->

            <div class="plat-card"
                data-nom="Burger maison"
                data-categorie="Plat"
                data-image=images/burger.jpg
                data-description="Burger maison composé d'un steak haché, de fromage, de salade et de sauce."
                data-regime="Classique"
                data-allergenes="Gluten, lait, oeufs, moutarde"
                data-valeurs="kcal 650, matières grasses 32g, glucides 55g, fibres 4g, protéines 32g, sel 2g"
                data-calories="650"
                data-fat="32"
                data-saturated="12"
                data-carbs="55"
                data-sugars="8"
                data-fiber="4"
                data-protein="32"
                data-salt="2">

                <div class="plat-image">
                    <img src=images/burger.jpg alt="Burger maison">
                </div>

                <div class="plat-info">
                    <p class="plat-nom">Burger maison</p>
                </div>

            </div>


            <!-- POULET RÔTI -->

            <div class="plat-card"
                data-nom="Poulet rôti et pommes de terre"
                data-categorie="Plat"
                data-image=images/poulet.jpg
                data-description="Poulet rôti accompagné de pommes de terre et d'une sauce maison."
                data-regime="Classique"
                data-allergenes="Lait"
                data-valeurs="kcal 580, matières grasses 25g, glucides 42g, fibres 5g, protéines 42g, sel 1.5g"
                data-calories="580"
                data-fat="25"
                data-saturated="7"
                data-carbs="42"
                data-sugars="3"
                data-fiber="5"
                data-protein="42"
                data-salt="1.5">

                <div class="plat-image">
                    <img src=images/poulet.jpg alt="Poulet rôti et pommes de terre">
                </div>

                <div class="plat-info">
                    <p class="plat-nom">Poulet rôti et pommes de terre</p>
                </div>

            </div>


            <!-- SAUMON GRILLÉ -->

            <div class="plat-card"
                data-nom="Saumon grillé et légumes"
                data-categorie="Plat"
                data-image=images/saumon.jpg
                data-description="Pavé de saumon grillé accompagné de légumes frais de saison."
                data-regime="Classique"
                data-allergenes="Poisson"
                data-valeurs="kcal 480, matières grasses 24g, glucides 18g, fibres 6g, protéines 38g, sel 1.3g"
                data-calories="480"
                data-fat="24"
                data-saturated="5"
                data-carbs="18"
                data-sugars="6"
                data-fiber="6"
                data-protein="38"
                data-salt="1.3">

                <div class="plat-image">
                    <img src=images/saumon.jpg alt="Saumon grillé et légumes">
                </div>

                <div class="plat-info">
                    <p class="plat-nom">Saumon grillé et légumes</p>
                </div>

            </div>

        </div>

    </div>


    <!-- DESSERTS -->

    <div class="categorie-menu">

        <h3>Desserts</h3>

        <div class="plats-grid">

            <!-- TARTE AUX POMMES -->

            <div class="plat-card"
                data-nom="Tarte aux pommes"
                data-categorie="Dessert"
                data-image=images/tarte.jpg
                data-description="Tarte aux pommes maison préparée avec des pommes fraîches."
                data-regime="Végétarien"
                data-allergenes="Gluten, lait, oeufs"
                data-valeurs="kcal 320, matières grasses 14g, glucides 44g, fibres 3g, protéines 4g, sel 0.5g"
                data-calories="320"
                data-fat="14"
                data-saturated="7"
                data-carbs="44"
                data-sugars="25"
                data-fiber="3"
                data-protein="4"
                data-salt="0.5">

                <div class="plat-image">
                    <img src=images/tarte.jpg alt="Tarte aux pommes">
                </div>

                <div class="plat-info">
                    <p class="plat-nom">Tarte aux pommes</p>
                </div>

            </div>


            <!-- TIRAMISU -->

            <div class="plat-card"
                data-nom="Tiramisu"
                data-categorie="Dessert"
                data-image=images/tiramisu.jpg
                data-description="Tiramisu traditionnel composé de mascarpone, café et biscuits."
                data-regime="Végétarien"
                data-allergenes="Gluten, lait, oeufs"
                data-valeurs="kcal 410, matières grasses 25g, glucides 38g, fibres 1g, protéines 6g, sel 0.4g"
                data-calories="410"
                data-fat="25"
                data-saturated="14"
                data-carbs="38"
                data-sugars="25"
                data-fiber="1"
                data-protein="6"
                data-salt="0.4">

                <div class="plat-image">
                    <img src=images/tiramisu.jpg alt="Tiramisu">
                </div>

                <div class="plat-info">
                    <p class="plat-nom">Tiramisu</p>
                </div>

            </div>


            <!-- FONDANT AU CHOCOLAT -->

            <div class="plat-card"
                data-nom="Fondant au chocolat"
                data-categorie="Dessert"
                data-image=images/fondant.jpg
                data-description="Fondant au chocolat avec un cœur tendre et chocolaté."
                data-regime="Végétarien"
                data-allergenes="Gluten, lait, oeufs"
                data-valeurs="kcal 390, matières grasses 22g, glucides 42g, fibres 3g, protéines 6g, sel 0.3g"
                data-calories="390"
                data-fat="22"
                data-saturated="13"
                data-carbs="42"
                data-sugars="29"
                data-fiber="3"
                data-protein="6"
                data-salt="0.3">

                <div class="plat-image">
                    <img src=images/fondant.jpg alt="Fondant au chocolat">
                </div>

                <div class="plat-info">
                    <p class="plat-nom">Fondant au chocolat</p>
                </div>

            </div>

        </div>

    </div>

</div>

    <!-- APERÇU DU PLAT -->

    <div class="categorie-preview">

      <div class="plat-preview">

         <h2 id="preview-name">Nom à croquer</h2>

        <div class="preview-image">
            <img id="preview-image" src="images/logo fond noir.png" alt="">
        </div>

        <div class="preview-content">
          <i id="preview-description">Le prochain délicieux repas qui finira dans votre ventre</i>
        </div>

          <div class="preview-infos">

        <p><strong>Allergènes :</strong> <span id="preview-allergenes">-</span></p>

        <p><strong>Régime alimentaire :</strong> <span id="preview-regime">-</span></p>

        <p><strong>Valeurs nutri :</strong> <span id="preview-valeurs">-</span></p>

    </div>

      </div>

    </div>


  <!-- COLONNE DE DROITE -->

<section class="colonne-droite">

  

 <!-- VOTRE MENU -->  
    
<div class="votre-menu-card">
        <h2>Votre menu </h2>

  <div class="votre-menu-images">

     <div>
     <img id="selection-entree" src=images/bon.png alt="">
     <p id="nom-entree"></p>
     </div>
    
     <div>
     <img id="selection-plat" src="images/appétit.png" alt="">
     <p id="nom-plat"></p>
     </div>
     
     <div>
     <img id="selection-dessert" src="images/miam.png" alt="">
     <p id="nom-dessert"></p>
     </div>

  </div>

 
   



 
</div>



 <!-- VALEURS NUTRITIONNELS -->  

   <div class="nutrition-card">

    <h2>Valeurs nutritionnelles</h2>

    <p class="nutrition-subtitle">Pour l'ensemble du menu</p>

    <div class="nutrition-row">
        <span>Énergie</span>
        <strong id="nutrition-calories">XXX kcal</strong>
    </div>

    <div class="nutrition-row">
        <span>Matières grasses</span>
        <strong id="nutrition-lipides">X g</strong>
    </div>

    <div class="nutrition-row">
        <span class="nutrition-indent">dont acides gras saturés</span>
        <strong id="nutrition-satures">X g</strong>
    </div>

    <div class="nutrition-row">
        <span>Glucides</span>
        <strong id="nutrition-glucides">X g</strong>
    </div>

    <div class="nutrition-row">
        <span class="nutrition-indent">dont sucres</span>
        <strong id="nutrition-sucres">X g</strong>
    </div>

    <div class="nutrition-row">
        <span>Fibres alimentaires</span>
        <strong id="nutrition-fibres">X g</strong>
    </div>

    <div class="nutrition-row">
        <span>Protéines</span>
        <strong id="nutrition-proteines">X g</strong>
    </div>

    <div class="nutrition-row">
        <span>Sel</span>
        <strong id="nutrition-sel">X g</strong>
    </div>

</div>
    

    <div class="allergenes-card">
        <h2>Allergènes</h2>
        <p id="allergenes-list">Liste des allergènes</p>
     
    </div>

    <div class="regimes-card">
        <h2>Régimes alimentaires</h2>
        <p id="regimes-list">Liste des régimes alimentaires</p>
    </div>

<div class="informations-menu-card">

    <h2>Informations du menu</h2>

    <div class="information-menu-row">
        <span>Minimum de personnes</span>
        <strong>4 personnes</strong>
    </div>

    <div class="information-menu-row">
        <span>Type de menu</span>
        <strong>Menu complet</strong>
    </div>

    <div class="information-menu-row">
        <span>Temps de livraison</span>
        <strong>de 48 à 72h</strong>
    </div>

    <div class="information-menu-row">
        <span>Disponibilité</span>
        <strong>Disponible</strong>
    </div>

</div>

 
  </section>

</section>

<!-- INFORMATIONS ET CONDITIONS -->

<div class="right-details">


      <article class="practical card">

        <h2>Informations pratiques</h2> 
        <br>

        <ul>

          <li>Livraison incluse dans le prix</li> 
          <li>Zone de livraison : Ile-de-France</li>
          <li>Matériel de service inclus</li>
          <li>Installation possible sur demande</li>
          <li>Service de personnel disponible en option</li>
          <li>Modification du menu possible jusqu'à 7 jours avant l'événement</li>
          <li>Préparation 24h à l'avance</li>
          <li>Produits frais et de saison</li>

        </ul>

      </article>


      <article class="conditions card">

        <h2>Conditions</h2>
        

  <ul>

    <li>Toute commande est confirmée après validation d’un devis.</li>
    <li>Annulation gratuite jusqu’à 7 jours avant la date de livraison.</li>
    <li>Toute modification du menu doit être demandée au moins 7 jours avant l’événement.</li>
    <li>La commande est soumise aux disponibilités des produits.</li>
    <li>Le nombre minimum de personnes indiqué pour le menu doit être respecté.</li>
    <li>Toute allergie ou intolérance doit être signalée lors de la commande.</li>
   
  </ul>

      </article>


</div>


 <!-- ===========================
         MENUS POPULAIRES
    =========================== -->

    <section class="popular-menus">

        <div class="popular-container">

            <div class="section-title">
                <span>NOS AUTRES MENUS</span>

                <h2>À Découvrir également</h2>

               
            </div>

        <div class="carousel">

        <button class="carousel-arrow carousel-prev">←</button>


            <div class="menu-grid">

                <article class="menu-card">

                    <div class="menu-image">
                        <img src="Images/agneau.jpg" alt="Menu Gourmand">
                    </div>

                    <div class="menu-content">

                        <h3>Menu Gourmand</h3>

                        <p>
                            À partir de <strong>15€</strong> / pers.
                        </p>

                        

                        <a href="pages/menu-detail.html" class="menu-button">
                            +
                        </a>

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

                        <a href="pages/menu-detail.html" class="menu-button">
                            +
                        </a>

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

                        <a href="pages/menu-detail.html" class="menu-button">
                            +
                        </a>

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

                        <a href="pages/menu-detail.html" class="menu-button">
                            +
                        </a>

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

                        <a href="pages/menu-detail.html" class="menu-button">
                            +
                        </a>

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

                        <a href="pages/menu-detail.html" class="menu-button">
                            +
                        </a>

                    </div>

                </article>

            </div>

        <button class="carousel-arrow carousel-next">→</button> 

        </div>

    </section>

  <!-- SERVICES -->

  <section class="container services">

    <article>

      <span>📞</span>

      <div>

        <h3>Besoin d'aide ?</h3>

        <p>
          Notre équipe est à votre écoute du lundi au vendredi de 9h à 18h.
        </p>

        <a href="#">
          Nous contacter →
        </a>

      </div>

    </article>


    <article>

      <span>🎉</span>

      <div>

        <h3>Événement sur mesure</h3>

        <p>
          Un besoin spécifique ?
          Nous créons le menu qui vous ressemble.
        </p>

        <a href="#">
          Demander un devis →
        </a>

      </div>

    </article>


    <article>

      <span>🔒</span>

      <div>

        <h3>Paiement sécurisé</h3>

        <p>
          Réglez votre commande en toute sécurité
          par carte bancaire ou virement.
        </p>

        <a href="#">
          En savoir plus →
        </a>

      </div>

    </article>

  </section>

</main>


<!-- FOOTER -->

<?php $page = 'menus'; require_once __DIR__ . '/../.Composants/footer.html'; ?>


</body>

</html>