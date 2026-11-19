<?php
require_once '../Base de données/Database.php';

$id_menu = $_GET['id'] ?? null;

if (!$id_menu) {
    die("Menu introuvable.");
}

$sql = "SELECT * FROM menus WHERE id_menu = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_menu]);

$menu = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$menu) {
    die("Menu introuvable.");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Menu Gourmand | Vite & Gourmand</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&family=Parisienne&display=swap"
    rel="stylesheet"
  >

  <link rel="stylesheet" href="Détail menu.css">
</head>

<body>



<header class="header">

  <a href="index.html" class="brand">
    <span class="brand-icon">❦</span>

    <span>
      <strong>Vite & <em>Gourmand</em></strong>
      <small>TRAITEUR ÉVÉNEMENTIEL</small>
    </span>
  </a>

  <nav class="nav">
    <a href="index.html">Accueil</a>
    <a href="menus.html" class="active">Menus</a>
    <a href="apropos.html">À propos</a>
    <a href="contact.html">Contact</a>
  </nav>

  <div class="header-actions">
    <a href="#" class="btn btn-outline">
      ♙
      <span>Connexion</span>
    </a>

    <a href="#" class="btn btn-gold">
      S'inscrire
    </a>
  </div>

</header>


<main>

  <!-- HERO MENU -->

  <section class="product container">

    <!-- GALERIE -->

    <div class="gallery">

      <div class="main-image">

        <span class="badge">NOUVEAU</span>

        <button class="gallery-arrow left" aria-label="Image précédente">
          ‹
        </button>

        <img
          src="images/menu-gourmand.jpg"
          alt="Menu Gourmand"
        >

        <button class="gallery-arrow right" aria-label="Image suivante">
          ›
        </button>

      </div>


      <div class="thumbnails">

        <button class="thumb-arrow">
          ‹
        </button>

        <button class="thumb active">
          <img src="images/menu-gourmand.jpg" alt="Menu Gourmand">
        </button>

        <button class="thumb">
          <img src="images/menu-plat.jpg" alt="Plat du menu">
        </button>

        <button class="thumb">
          <img src="images/menu-entree.jpg" alt="Entrée du menu">
        </button>

        <button class="thumb">
          <img src="images/menu-dessert.jpg" alt="Dessert du menu">
        </button>

        <button class="thumb-arrow">
          ›
        </button>

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
        et de saison, pour une expérience gourmande et équilibrée.
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

        <a href="#" class="order-btn">
          🛒 Commander ce menu
        </a>

        <button
          class="favorite"
          aria-label="Ajouter aux favoris"
        >
          ♡
        </button>

      </div>


      <!-- LIVRAISON -->

      <div class="delivery-info">

        <div>
          <span>◷</span>

          <p>
            <strong>Préparation</strong><br>
            24h à l'avance
          </p>
        </div>


        <div>
          <span>▱</span>

          <p>
            <strong>Livraison</strong><br>
            Incluse
          </p>
        </div>


        <div>
          <span>⌖</span>

          <p>
            <strong>Zone de livraison</strong><br>
            Île-de-France
          </p>
        </div>

      </div>

    </div>

  </section>


  

    <!-- COMPOSITION -->

<div class="composition-menu">

    <h2>Composition du menu</h2>


    <!-- ENTRÉES -->

    <div class="categorie-menu">

        <h3>Entrées</h3>

        <div class="plats-grid">

            <div class="plat-card">
                <div class="plat-image">
                    <img src="" alt="Salade César">
                </div>
                <p class="plat-nom">Salade César</p>
                <p class="plat-description">Salade fraîche composée de laitue, poulet grillé, parmesan et sauce César.</p>
            </div>

            <div class="plat-card">
                <div class="plat-image">
                    <img src="" alt="Soupe de légumes">
                </div>
                <p class="plat-nom">Soupe de légumes</p>
                <p class="plat-description">Soupe maison préparée avec des légumes frais de saison.</p>
            </div>

            <div class="plat-card">
                <div class="plat-image">
                    <img src="" alt="Carpaccio de bœuf">
                </div>
                <p class="plat-nom">Carpaccio de bœuf</p>
                <p class="plat-description">Fines tranches de bœuf accompagnées de parmesan et d'huile d'olive.</p>
            </div>

                <div class="infos-plat">
            <p><strong>Allergènes :</strong></p>
            <p><strong>Régime alimentaire :</strong></p>
        </div>


        </div>

    

    </div>


    <!-- PLATS -->

    <div class="categorie-menu">

        <h3>Plats</h3>

        <div class="plats-grid">

            <div class="plat-card">
                <div class="plat-image">
                    <img src="" alt="Burger maison">
                </div>
                <p class="plat-nom">Burger maison</p>
                <p class="plat-description">Burger préparé avec un steak haché, du fromage, des légumes frais et une sauce maison.</p>
            </div>

            <div class="plat-card">
                <div class="plat-image">
                    <img src="" alt="Poulet rôti et pommes de terre">
                </div>
                <p class="plat-nom">Poulet rôti et pommes de terre</p>
                <p class="plat-description">Poulet rôti accompagné de pommes de terre dorées et d'herbes aromatiques.</p>
            </div>

            <div class="plat-card">
                <div class="plat-image">
                    <img src="" alt="Saumon grillé et légumes">
                </div>
                <p class="plat-nom">Saumon grillé et légumes</p>
                <p class="plat-description">Pavé de saumon grillé accompagné de légumes frais de saison.</p>
            </div>

        </div>

        <div class="infos-plat">
            <p><strong>Allergènes :</strong></p>
            <p><strong>Régime alimentaire :</strong></p>
        </div>

    </div>


    <!-- DESSERTS -->

    <div class="categorie-menu">

        <h3>Desserts</h3>

        <div class="plats-grid">

            <div class="plat-card">
                <div class="plat-image">
                    <img src="" alt="Tarte aux pommes">
                </div>
                <p class="plat-nom">Tarte aux pommes</p>
                <p class="plat-description">Tarte maison aux pommes fraîches avec une pâte légèrement croustillante.</p>
            </div>

            <div class="plat-card">
                <div class="plat-image">
                    <img src="" alt="Tiramisu">
                </div>
                <p class="plat-nom">Tiramisu</p>
                <p class="plat-description">Dessert italien composé de mascarpone, café, biscuits et cacao.</p>
            </div>

            <div class="plat-card">
                <div class="plat-image">
                    <img src="" alt="Fondant au chocolat">
                </div>
                <p class="plat-nom">Fondant au chocolat</p>
                <p class="plat-description">Gâteau au chocolat fondant au cœur accompagné d'une texture généreusement chocolatée.</p>
            </div>

        </div>

        <div class="infos-plat">
            <p><strong>Allergènes :</strong></p>
            <p><strong>Régime alimentaire :</strong></p>
        </div>

    </div>

</div>


<!-- INFORMATIONS DROITE -->

    <div class="right-details">


      <article class="practical card">

        <h2>Informations pratiques</h2>

        <ul>

          <li>Livraison incluse dans le prix.</li>
          <li>Matériel de service inclus.</li>
          <li>Installation possible sur demande.</li>
          <li>Service de personnel disponible en option.</li>
          <li>Modification du menu possible jusqu'à 7 jours avant l'événement.</li>

        </ul>

      </article>


      <article class="conditions card">

        <h2>Conditions</h2>

        <p>
          Toute commande est confirmée après validation d'un devis.
          Annulation gratuite jusqu'à 7 jours avant la date de livraison.
        </p>

      </article>


    </div>


  <!-- ALLERGÈNES / TAGS -->

  <section class="container quick-details">

    <article class="allergens card">

      <h2>Allergènes</h2>

      <p>
        Nos plats peuvent contenir des allergènes.<br>
        Merci de nous contacter pour toute demande spécifique.
      </p>

      <span class="leaf">
        ❦
      </span>

    </article>


    <article class="contains card">

      <h2>Ce menu contient</h2>

      <div class="tags">

        <span>Option végétarienne</span>
        <span>Sans lactose</span>
        <span>Sans gluten</span>
        <span>Halal</span>
        <span>Casher</span>

      </div>

    </article>

  </section>

  <!-- MENUS SIMILAIRES -->

  <section class="container related card">

    <h2>Vous aimerez aussi</h2>


    <div class="related-wrap">

      <button class="slider-arrow">
        ‹
      </button>


      <div class="menu-card">

        <div class="menu-image">

          <img
            src="images/menu-equilibre.jpg"
            alt="Menu Équilibre"
          >

          <button>♡</button>

        </div>

        <h3>Menu Équilibre</h3>

        <p>
          À partir de <strong>22€</strong> / pers.
        </p>

      </div>


      <div class="menu-card">

        <div class="menu-image">

          <img
            src="images/menu-prestige.jpg"
            alt="Menu Prestige"
          >

          <button>♡</button>

        </div>

        <h3>Menu Prestige</h3>

        <p>
          À partir de <strong>35€</strong> / pers.
        </p>

      </div>


      <div class="menu-card">

        <div class="menu-image">

          <img
            src="images/menu-vegetarien.jpg"
            alt="Menu Végétarien"
          >

          <button>♡</button>

        </div>

        <h3>Menu Végétarien</h3>

        <p>
          À partir de <strong>20€</strong> / pers.
        </p>

      </div>


      <div class="menu-card">

        <div class="menu-image">

          <img
            src="images/menu-saveurs.jpg"
            alt="Menu Saveurs"
          >

          <button>♡</button>

        </div>

        <h3>Menu Saveurs</h3>

        <p>
          À partir de <strong>28€</strong> / pers.
        </p>

      </div>


      <button class="slider-arrow">
        ›
      </button>

    </div>

  </section>


  <!-- RÉASSURANCE -->

  <section class="container reassurance">

    <article>

      <span>◉</span>

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

      <span>▣</span>

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

      <span>♢</span>

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

<footer class="footer">

  <div class="container footer-grid">


    <div>

      <a href="#" class="brand footer-brand">

        <span class="brand-icon">
          ❦
        </span>

        <span>

          <strong>
            Vite & <em>Gourmand</em>
          </strong>

          <small>
            TRAITEUR ÉVÉNEMENTIEL
          </small>

        </span>

      </a>


      <p>
        Des repas savoureux, préparés avec passion
        et livrés rapidement chez vous.
      </p>


      <div class="socials">

        <a href="#">f</a>
        <a href="#">◎</a>
        <a href="#">in</a>

      </div>

    </div>


    <div>

      <h3>LIENS RAPIDES</h3>

      <a href="#">Accueil</a>
      <a href="#">Menus</a>
      <a href="#">À propos</a>
      <a href="#">Contact</a>
      <a href="#">FAQ</a>

    </div>


    <div>

      <h3>NOS SERVICES</h3>

      <a href="#">Événements privés</a>
      <a href="#">Mariages</a>
      <a href="#">Entreprises</a>
      <a href="#">Cocktails & Réceptions</a>
      <a href="#">Livraison</a>

    </div>


    <div>

      <h3>INFORMATIONS</h3>

      <a href="#">Mentions légales</a>
      <a href="#">Conditions générales de vente</a>
      <a href="#">Politique de confidentialité</a>
      <a href="#">CGV</a>
      <a href="#">Plan du site</a>

    </div>


    <div class="newsletter">

      <h3>NEWSLETTER</h3>

      <p>
        Recevez nos nouveautés et offres exclusives.
      </p>


      <form>

        <input
          type="email"
          placeholder="Votre email"
        >

        <button>
          →
        </button>

      </form>

    </div>

  </div>


  <p class="copyright">
    © 2024 Vite & Gourmand – Tous droits réservés.
  </p>

</footer>

</body>
</html>