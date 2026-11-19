<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mon compte - Vite & Gourmand</title>
<link rel="stylesheet" href="../.Composants/style commun.css">
<link rel="stylesheet" href="Espace perso.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
<?php require_once __DIR__ . '/../.Composants/header.php'; ?>
<div class="breadcrumb"><a href="accueil.php">Accueil</a><i class="fa-solid fa-chevron-right"></i><span>Mon compte</span></div>
<main class="account-container">
<aside class="account-sidebar">
<h2>MON ESPACE</h2>
<nav class="account-navigation"><button class="active" data-tab="dashboard" type="button"><i class="fa-solid fa-house"></i><span>Tableau de bord</span></button><button class="" data-tab="orders" type="button"><i class="fa-solid fa-bag-shopping"></i><span>Mes commandes</span></button><button class="" data-tab="reviews" type="button"><i class="fa-regular fa-star"></i><span>Mes avis</span></button><button class="" data-tab="profile" type="button"><i class="fa-regular fa-user"></i><span>Mon profil</span></button></nav>
<div class="logout">
<a href="connexion.php">
<i class="fa-solid fa-right-from-bracket"></i>
<span>Déconnexion</span>
</a>
</div>
</aside>
<div class="account-content">
<section class="account-panel active" id="dashboard-panel" data-panel="dashboard"><section class="dashboard">
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
<input id="allergens" placeholder="Ex : gluten, lait, arachides, fruits à coque..." type="text"/>
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
<a data-tab-link="orders" href="#orders">
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
<img alt="Menu Gourmand" src="images/photo menu 2.png"/>
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
<a class="details-button" href="#order-detail" data-open-order="000124">

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
<img alt="Menu Équilibre" src="images/quiche.jpg"/>
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
<a class="details-button" href="#order-detail" data-open-order="000124">

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
<img alt="Menu Plaisir" src="images/pates.jpg"/>
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
<a class="details-button" href="#order-detail" data-open-order="000124">

                            Détails

                            <i class="fa-solid fa-arrow-right"></i>
</a>
</article>
<a class="all-orders" data-tab-link="orders" href="#orders">
<i class="fa-solid fa-chevron-down"></i>
                        voir plus
                        <i class="fa-solid fa-chevron-down"></i>
</a>
</section>
<!-- DERNIERS AVIS -->
<section class="dashboard-card reviews">
<div class="card-header">
<h2>Derniers avis</h2>
<a data-tab-link="reviews" href="#reviews">
                            Voir tous mes avis
                        </a>
</div>
<!-- AVIS 1 -->
<article class="review">
<div class="review-image">
<img alt="Menu equilibre" src="images/quiche.jpg"/>
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
<img alt="Menu plaisir" src="images/pates.jpg"/>
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
<a class="review-button" data-tab-link="reviews" href="#reviews">

                            Donner mon avis

                        </a>
</div>
</section>
</div>
</section></section>
<section class="account-panel" id="orders-panel" data-panel="orders"><section class="dashboard"><div class="welcome"><h1>Mes commandes</h1><p>Consultez et suivez l’ensemble de vos commandes.</p></div><div id="orders-list"><section class="orders-list">
<!-- COMMANDE 1 -->
<article class="order-card" data-status="preparing">
<div class="order-card-header">
<div>
<h3>#000124</h3>
<p>12/08/2026 à 18:45</p>
</div>
<span class="status preparing">En attente</span>
</div>
<div class="order-card-body">
<div class="order-card-image">
<img alt="Menu Gourmand" src="images/photo menu 2.png"/>
</div>
<div class="order-card-info">
<h4>Menu Gourmand</h4>
<p><strong>Prix :</strong> 25 €</p>
<p><strong>Quantité :</strong> 1 personne</p>
<p><strong>Livraison :</strong> À domicile</p>
</div>
</div>
<div class="order-card-footer">
<a class="order-link" data-open-order="000124" href="#order-detail">
                    Détails <i class="fa-solid fa-arrow-right"></i>
</a>
</div>
</article>
<!-- COMMANDE 2 -->
<article class="order-card" data-status="finished">
<div class="order-card-header">
<div>
<h3>#000123</h3>
<p>10/08/2026 à 12:30</p>
</div>
<span class="status finished">Terminée</span>
</div>
<div class="order-card-body">
<div class="order-card-image">
<img alt="Menu Équilibre" src="images/quiche.jpg"/>
</div>
<div class="order-card-info">
<h4>Menu Équilibre</h4>
<p><strong>Prix :</strong> 44 €</p>
<p><strong>Quantité :</strong> 2 personnes</p>
<p><strong>Livraison :</strong> À domicile</p>
</div>
</div>
<div class="order-card-footer">
<a class="order-link" data-open-order="000124" href="#order-detail">Détails <i class="fa-solid fa-arrow-right"></i></a>
</div>
</article>
<!-- COMMANDE 3 -->
<article class="order-card" data-status="finished">
<div class="order-card-header">
<div>
<h3>#000122</h3>
<p>07/08/2026 à 19:10</p>
</div>
<span class="status finished">Terminée</span>
</div>
<div class="order-card-body">
<div class="order-card-image">
<img alt="Menu Plaisir" src="images/pates.jpg"/>
</div>
<div class="order-card-info">
<h4>Menu Plaisir</h4>
<p><strong>Prix :</strong> 40 €</p>
<p><strong>Quantité :</strong> 2 personnes</p>
<p><strong>Livraison :</strong> À retirer</p>
</div>
</div>
<div class="order-card-footer">
<a class="order-link" data-open-order="000124" href="#order-detail">Détails <i class="fa-solid fa-arrow-right"></i></a>
</div>
</article>
<!-- COMMANDE 4 -->
<article class="order-card" data-status="finished">
<div class="order-card-header">
<div>
<h3>#000121</h3>
<p>02/08/2026 à 14:20</p>
</div>
<span class="status finished">Terminée</span>
</div>
<div class="order-card-body">
<div class="order-card-image">
<img alt="Menu Gourmand" src="images/cocktail.jpg"/>
</div>
<div class="order-card-info">
<h4>Menu Cocktail</h4>
<p><strong>Prix :</strong> 180 €</p>
<p><strong>Quantité :</strong> 10 personne</p>
<p><strong>Livraison :</strong> À domicile</p>
</div>
</div>
<div class="order-card-footer">
<a class="order-link" data-open-order="000124" href="#order-detail">
                     Détails <i class="fa-solid fa-arrow-right"></i>
</a>
</div>
</article>
</section></div><div id="order-detail" hidden><section class="dashboard order-detail">
<div class="detail-heading">
<div>
<a class="back-link" href="#orders-list" id="backToOrders">
<i class="fa-solid fa-arrow-left"></i>
                        Retour à mes commandes
                    </a>
<h1>Détail de la commande <span id="orderNumber">#000124</span></h1>
<p class="detail-date" id="orderDateLabel">Commandée le 12 août 2026 à 18:45</p>
</div>
<span class="status waiting" data-status="pending" id="orderStatus">
                  En attente d'acceptation
                </span>
</div>
<!-- MESSAGE SUR LES ACTIONS DISPONIBLES -->
<div class="order-notice">
<i class="fa-solid fa-circle-info"></i>
<p>Vous pouvez modifier ou annuler cette commande tant qu'un employé ne l'a pas acceptée.</p>
</div>
<!-- RESUME -->
<section class="detail-card">
<div class="detail-card-heading">
<h2><i class="fa-solid fa-receipt"></i> Résumé de la commande</h2>
</div>
<div class="summary-layout">
<div class="summary-image">
<img alt="Photo du menu commandé" id="summaryImage" src="images/photo menu 2.png"/>
</div>
<div class="summary-main">
<span class="eyebrow">MENU COMMANDÉ</span>
<h3 id="summaryTitle">Menu Gourmand</h3>
<p id="summaryDescription">Un menu généreux pour profiter d'un repas convivial.</p>
<div class="summary-tags">
<span><i class="fa-solid fa-user-group"></i> <span id="summaryQuantity">1 personne</span></span>
<span><i class="fa-solid fa-truck"></i> <span id="summaryDelivery">Livraison à domicile</span></span>
</div>
</div>
<div class="summary-price">
<span>Total de la commande</span>
<strong id="summaryTotal">25,00 €</strong>
</div>
</div>
</section>
<!-- INFORMATIONS DE LA COMMANDE -->
<div class="detail-columns">
<section class="detail-card">
<div class="detail-card-heading">
<h2><i class="fa-solid fa-calendar-days"></i> Date et livraison</h2>
</div>
<div class="detail-information">
<div class="information-row">
<span>Date souhaitée</span>
<strong data-editable="date">15 août 2026</strong>
</div>
<div class="information-row">
<span>Créneau de livraison</span>
<strong data-editable="creneau">Entre 12 h et 13 h</strong>
</div>
<div class="information-row">
<span>Mode de réception</span>
<strong data-editable="mode">Livraison à domicile</strong>
</div>
<div class="information-row">
<span>Adresse</span>
<strong data-editable="adresse">12 rue des Érables, 69000 Lyon</strong>
</div>
</div>
</section>
<section class="detail-card">
<div class="detail-card-heading">
<h2><i class="fa-solid fa-user"></i> Contact</h2>
</div>
<div class="detail-information">
<div class="information-row">
<span>Nom</span>
<strong data-editable="nom">Kévin Dupont</strong>
</div>
<div class="information-row">
<span>E-mail</span>
<strong data-editable="email">kevin.dupont@email.com</strong>
</div>
<div class="information-row">
<span>Téléphone</span>
<strong data-editable="telephone">06 12 34 56 79</strong>
</div>
</div>
</section>
</div>
<!-- INSTRUCTIONS -->
<section class="detail-card">
<div class="detail-card-heading">
<h2><i class="fa-regular fa-comment-dots"></i> Instructions complémentaires</h2>
<button class="detail-edit-btn" id="editInstructionsBtn" type="button">
<i class="fa-solid fa-pen"></i>
</button>
</div>
<p class="customer-note" id="customerInstructions">Merci de sonner à l'interphone à votre arrivée.</p>
<div class="instruction-actions"></div>
</section>
<!-- SUIVI -->
<section class="detail-card tracking-card">
<div class="detail-card-heading">
<h2><i class="fa-solid fa-route"></i> Suivi de la commande</h2>
<span class="tracking-locked"><i class="fa-solid fa-lock"></i> Disponible après acceptation</span>
</div>
<p class="tracking-intro">L'historique détaillé des statuts sera disponible dès que votre commande aura été acceptée par un employé.</p>
<ol class="tracking-timeline">
<li class="timeline-step completed">
<span class="timeline-icon"><i class="fa-solid fa-check"></i></span>
<div>
<strong>Commande reçue</strong>
<p>12 août 2026 à 18:45</p>
</div>
</li>
<li class="timeline-step pending">
<span class="timeline-icon"><i class="fa-regular fa-clock"></i></span>
<div>
<strong>En attente d'acceptation</strong>
<p>En attente de validation par l'équipe</p>
</div>
</li>
<li class="timeline-step upcoming">
<span class="timeline-icon"><i class="fa-solid fa-utensils"></i></span>
<div>
<strong>Préparation</strong>
<p>À venir</p>
</div>
</li>
<li class="timeline-step upcoming">
<span class="timeline-icon"><i class="fa-solid fa-flag-checkered"></i></span>
<div>
<strong>Commande terminée</strong>
<p>À venir</p>
</div>
</li>
</ol>
</section>
<!-- TOTAL -->
<section class="detail-card total-card">
<div class="detail-card-heading">
<h2><i class="fa-solid fa-calculator"></i> Récapitulatif du prix</h2>
</div>
<div class="total-line">
<span id="totalMenuLabel">Menu Gourmand × 1 personne</span>
<strong id="totalMenuPrice">25,00 €</strong>
</div>
<div class="total-line">
<span>Livraison</span>
<strong>Offerte</strong>
</div>
<div class="total-line total-final">
<span>Total à payer</span>
<strong id="totalFinalPrice">25,00 €</strong>
</div>
</section>
<section class="detail-card" hidden="" id="finishedReviewSection">
<div class="detail-card-heading">
<h2><i class="fa-regular fa-star"></i> Donner votre avis</h2>
</div>
<p class="tracking-intro">Votre commande est terminée. Partagez votre expérience sur ce menu.</p>
<fieldset class="rating-field">
<legend>Votre note</legend>
<div class="rating-stars" id="finishedRatingStars">
<button aria-label="1 étoile" data-rating="1" type="button"><i class="fa-regular fa-star"></i></button>
<button aria-label="2 étoiles" data-rating="2" type="button"><i class="fa-regular fa-star"></i></button>
<button aria-label="3 étoiles" data-rating="3" type="button"><i class="fa-regular fa-star"></i></button>
<button aria-label="4 étoiles" data-rating="4" type="button"><i class="fa-regular fa-star"></i></button>
<button aria-label="5 étoiles" data-rating="5" type="button"><i class="fa-regular fa-star"></i></button>
</div>
<p id="ratingLabel">Aucune note sélectionnée</p>
</fieldset>
<div class="form-group">
<label for="finishedReviewComment">Votre commentaire</label>
<textarea id="finishedReviewComment" placeholder="Ex: excellent repas, très bon service..." rows="4"></textarea>
</div>
<div class="review-form-actions">
<button class="submit-review" id="submitFinishedReview" type="button">Publier mon avis</button>
</div>
<p id="reviewMessage"></p>
</section>
<!-- ACTIONS -->
<div class="order-actions">
<button class="button-primary" id="editOrderBtn" type="button">
<i class="fa-solid fa-pen"></i>
                    Modifier la commande
                </button>
<button class="button-danger" type="button">
<i class="fa-regular fa-trash-can"></i>
                    Annuler la commande
                </button>
</div>
<p class="detail-footnote">
                Les informations présentées sont des exemples statiques. Les actions de modification et d'annulation seront reliées au fonctionnement du site ultérieurement.
            </p>
</section></div></section></section>
<section class="account-panel" id="reviews-panel" data-panel="reviews"><section class="dashboard">
<!-- TITRE -->
<div class="welcome">
<h1>
                    Mes avis
                </h1>
<p>
                    Partagez votre expérience sur les menus que vous avez commandés.
                </p>
</div>
<!-- LISTE DES AVIS -->
<section class="reviews-list">
<!-- AVIS 1 -->
<article class="review-card">
<div class="review-card-header">
<div class="review-card-title">
<h4>Menu Équilibre</h4>
<small>12/08/2026</small>
</div>
<div class="review-card-stars">
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
</div>
</div>
<div class="review-card-body">
<div class="review-card-image">
<img alt="Menu Équilibre" src="images/quiche.jpg"/>
</div>
<div class="review-card-text">
<p>
                                Excellent ! Produits frais et savoureux. Je recommande vivement ce menu pour tous ceux qui cherchent un repas équilibré et délicieux.
                            </p>
</div>
</div>
<div class="review-card-actions">
<button class="review-edit-btn" type="button">
<i class="fa-solid fa-pen"></i> Modifier

                        </button>
<button class="review-delete-btn" type="button">
<i class="fa-regular fa-trash-can"></i> Supprimer

                        </button>
</div>
</article>
<!-- AVIS 2 -->
<article class="review-card">
<div class="review-card-header">
<div class="review-card-title">
<h4>Menu Plaisir</h4>
<small>07/08/2026</small>
</div>
<div class="review-card-stars">
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-solid fa-star"></i>
<i class="fa-regular fa-star"></i>
</div>
</div>
<div class="review-card-body">
<div class="review-card-image">
<img alt="Menu Plaisir" src="images/pates.jpg"/>
</div>
<div class="review-card-text">
<p>
                                Très bon menu, je recommande ! Les saveurs sont bien équilibrées et la qualité des ingrédients est évidente.
                            </p>
</div>
</div>
<div class="review-card-actions">
<button class="review-edit-btn" type="button">
<i class="fa-solid fa-pen"></i> Modifier

                        </button>
<button class="review-delete-btn" type="button">
<i class="fa-regular fa-trash-can"></i> Supprimer

                        </button>
</div>
</article>
</section>
</section></section>
<section class="account-panel" id="profile-panel" data-panel="profile"><section class="dashboard">
<div class="welcome">
<h1>Mon profil</h1>
<p>Gérez vos informations personnelles.</p>
</div>
<section class="profile-page">
<div class="profile-card">
<div class="profile-header">
<div class="profile-avatar">
<i class="fa-regular fa-user"></i>
</div>
<div class="profile-identity">
<h2>Kévin Dupont</h2>
</div>
</div>
<form class="profile-form">
<div class="form-grid">
<div class="form-field">
<label for="prenom">Prénom</label>
<input id="prenom" type="text" value="Kévin"/>
</div>
<div class="form-field">
<label for="nom">Nom</label>
<input id="nom" type="text" value="Dupont"/>
</div>
<div class="form-field full-width">
<label for="email">E-mail</label>
<input id="email" type="email" value="kevin.dupont@email.com"/>
</div>
<div class="form-field">
<label for="telephone">Téléphone</label>
<input id="telephone" type="tel" value="06 12 34 56 78"/>
</div>
<div class="form-field">
<label for="ville">Ville</label>
<input id="ville" type="text" value="Lyon"/>
</div>
<div class="form-field full-width">
<label for="adresse">Adresse</label>
<input id="adresse" type="text" value="12 rue des Érables, 69000 Lyon"/>
</div>
</div>
<div class="profile-actions">
<span aria-live="polite" class="save-status"></span>
<button class="save-button" type="submit">Enregistrer</button>
</div>
</form>
</div>
</section>
</section></section>
</div>
</main>
<?php require_once __DIR__ . '/../.Composants/footer.html'; ?>
<script src="Espace perso.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.account-navigation [data-tab]');
    const panels = document.querySelectorAll('.account-panel');

    function showTab(name) {
        tabs.forEach(tab => tab.classList.toggle('active', tab.dataset.tab === name));
        panels.forEach(panel => panel.classList.toggle('active', panel.dataset.panel === name));
    }

    tabs.forEach(tab => tab.addEventListener('click', () => showTab(tab.dataset.tab)));
    document.querySelectorAll('[data-tab-link]').forEach(link => link.addEventListener('click', event => {
        event.preventDefault();
        showTab(link.dataset.tabLink);
    }));

    const ordersList = document.getElementById('orders-list');
    const orderDetail = document.getElementById('order-detail');
    document.querySelectorAll('[data-open-order]').forEach(link => link.addEventListener('click', event => {
        event.preventDefault();
        ordersList.hidden = true;
        orderDetail.hidden = false;
    }));
    document.getElementById('backToOrders')?.addEventListener('click', event => {
        event.preventDefault();
        orderDetail.hidden = true;
        ordersList.hidden = false;
    });
});
</script>
</body>
</html>