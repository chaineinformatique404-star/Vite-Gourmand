<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Page unique de l'espace personnel : chaque onglet de la colonne de gauche
// affiche sa section ici, via le paramètre ?onglet=
$onglets = ['tableau', 'commandes', 'detail', 'avis', 'profil'];
$onglet = $_GET['onglet'] ?? 'tableau';
if (!in_array($onglet, $onglets, true)) {
    $onglet = 'tableau';
}
$menuActif = $onglet === 'detail' ? 'commandes' : $onglet;

$commandes = [
    ['id' => '000124', 'date' => '12/08/2026 à 18:45', 'statut' => 'preparing', 'libelle' => 'En attente', 'menu' => 'Menu Gourmand', 'image' => 'images/photo menu 2.png', 'prix' => '25 €', 'quantite' => '1 personne', 'livraison' => 'À domicile'],
    ['id' => '000123', 'date' => '10/08/2026 à 12:30', 'statut' => 'finished', 'libelle' => 'Terminée', 'menu' => 'Menu Équilibre', 'image' => 'images/quiche.jpg', 'prix' => '44 €', 'quantite' => '2 personnes', 'livraison' => 'À domicile'],
    ['id' => '000122', 'date' => '07/08/2026 à 19:10', 'statut' => 'finished', 'libelle' => 'Terminée', 'menu' => 'Menu Plaisir', 'image' => 'images/pates.jpg', 'prix' => '40 €', 'quantite' => '2 personnes', 'livraison' => 'À retirer'],
    ['id' => '000121', 'date' => '02/08/2026 à 14:20', 'statut' => 'finished', 'libelle' => 'Terminée', 'menu' => 'Menu Cocktail', 'image' => 'images/cocktail.jpg', 'prix' => '180 €', 'quantite' => '10 personnes', 'livraison' => 'À domicile'],
];

$titres = [
    'tableau' => 'Tableau de bord',
    'commandes' => 'Mes commandes',
    'avis' => 'Mes avis',
    'detail' => 'Détail de la commande',
    'profil' => 'Mon profil',
];

function lienOnglet(string $cible): string
{
    return 'espace%20perso.php?onglet=' . $cible;
}

function classeActive(string $cible, string $actif): string
{
    return $cible === $actif ? ' class="active"' : '';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($titres[$onglet]) ?> Espace Personnel</title>

    <link rel="stylesheet" href="../.Composants/style commun.css">
    <link rel="stylesheet" href="Espace perso.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&family=Parisienne&family=Alex+Brush&display=swap" rel="stylesheet">

</head>

<body>

    <!-- HEADER -->
 
    <header class="header">
        <a href="../index.php" class="logo">
            <span>Vite &</span> Gourmand
            <small>TRAITEUR ÉVÉNEMENTIEL</small>
        </a>

        <div class="header-search">
            <label class="search-box">
                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                <input type="search" placeholder="Rechercher une commande, un menu, une table...">
            </label>
        </div>

        <div class="header-actions">
            <select class="outlet-select" aria-label="Lieu de travail">
                <option>Mes commandes</option>
                <option>Mes favoris</option>
                <option>Mes avis</option>
                <option>Réclamation</option>
            </select>

            <button class="notification" type="button" aria-label="Notifications">
                <i class="fa-regular fa-bell" aria-hidden="true"></i>
                <span class="notification-badge">3</span>
            </button>

            <button class="account" type="button">
                <span class="avatar-header">JD</span>
                <span class="account-info">Kévin D.<small>Employé</small></span>
            </button>
        </div>
    </header>


    <!-- FIL D'ARIANE -->
    <div class="breadcrumb">
        <a href="accueil.php">Accueil</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span><?= htmlspecialchars($titres[$onglet]) ?></span>
    </div>


    <main class="account-container">

        <!-- MENU ESPACE UTILISATEUR -->
        <aside class="account-sidebar">

            <h2>MON ESPACE</h2>

            <nav class="account-navigation">

                <a href="<?= lienOnglet('tableau') ?>"<?= classeActive('tableau', $menuActif) ?>>
                    <i class="fa-solid fa-house"></i>
                    <span>Tableau de bord</span>
                </a>

                <a href="<?= lienOnglet('commandes') ?>"<?= classeActive('commandes', $menuActif) ?>>
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Mes commandes</span>
                </a>

                <a href="<?= lienOnglet('avis') ?>"<?= classeActive('avis', $menuActif) ?>>
                    <i class="fa-regular fa-star"></i>
                    <span>Mes avis</span>
                </a>

                <a href="<?= lienOnglet('profil') ?>"<?= classeActive('profil', $menuActif) ?>>
                    <i class="fa-regular fa-user"></i>
                    <span>Mon profil</span>
                </a>

            </nav>

            <div class="logout">
                <a href="../Connexion/connexion.php?deconnexion=1">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Déconnexion</span>
                </a>
            </div>

        </aside>


        <section class="dashboard">

            <?php if ($onglet === 'tableau'): ?>

                <!-- TABLEAU DE BORD -->
                <div class="welcome">
                    <h1>Bonjour, Kévin ! <span>👋</span></h1>
                    <p>Bienvenue dans votre espace personnel.</p>
                </div>

                <!-- PREFERENCES -->
                <section class="preferences">

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

                    <section class="dashboard-card orders">
                        <div class="card-header">
                            <h2>Vos dernières commandes</h2>
                            <a href="<?= lienOnglet('commandes') ?>">Voir toutes mes commandes</a>
                        </div>

                        <?php foreach (array_slice($commandes, 0, 3) as $c): ?>
                            <article class="order">
                                <div class="order-number">
                                    <strong>#<?= $c['id'] ?></strong>
                                    <span><?= explode(' à ', $c['date'])[0] ?></span>
                                    <span><?= explode(' à ', $c['date'])[1] ?? '' ?></span>
                                </div>

                                <div class="order-image">
                                    <img src="<?= htmlspecialchars($c['image']) ?>" alt="<?= htmlspecialchars($c['menu']) ?>">
                                </div>

                                <div class="order-info">
                                    <strong><?= $c['menu'] ?></strong>
                                    <span><?= $c['quantite'] ?></span>
                                    <span>Livraison : <?= $c['livraison'] ?></span>
                                </div>

                                <strong class="order-price"><?= $c['prix'] ?></strong>

                                <span class="status <?= $c['statut'] ?>"><?= $c['libelle'] ?></span>

                                <a href="<?= lienOnglet('detail') ?>&id=<?= $c['id'] ?>" class="details-button">
                                    Détails <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </article>
                        <?php endforeach; ?>

                        <a href="<?= lienOnglet('commandes') ?>" class="all-orders">
                            <i class="fa-solid fa-chevron-down"></i>
                            voir plus
                            <i class="fa-solid fa-chevron-down"></i>
                        </a>
                    </section>

                    <section class="dashboard-card reviews">
                        <div class="card-header">
                            <h2>Derniers avis</h2>
                            <a href="<?= lienOnglet('avis') ?>">Voir tous mes avis</a>
                        </div>

                        <article class="review">
                            <div class="review-image">
                                <img src="images/quiche.jpg" alt="Menu Équilibre">
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
                                <p>Excellent ! Produits frais et savoureux.</p>
                            </div>
                            <div class="review-actions">
                                <button type="button"><i class="fa-solid fa-pen"></i></button>
                                <button type="button"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        </article>

                        <article class="review">
                            <div class="review-image">
                                <img src="images/pates.jpg" alt="Menu Plaisir">
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
                                <p>Très bon menu, je recommande !</p>
                            </div>
                            <div class="review-actions">
                                <button type="button"><i class="fa-solid fa-pen"></i></button>
                                <button type="button"><i class="fa-regular fa-trash-can"></i></button>
                            </div>
                        </article>

                        <div class="review-cta">
                            <div class="review-icon">
                                <i class="fa-regular fa-comment-dots"></i>
                            </div>
                            <div class="review-message">
                                <strong>Vous avez commandé un menu récemment ?</strong>
                                <span>Partagez votre expérience avec la communauté.</span>
                            </div>
                            <a href="<?= lienOnglet('avis') ?>" class="review-button">Donner mon avis</a>
                        </div>
                    </section>

                </div>

            <?php elseif ($onglet === 'commandes'): ?>

                <!-- MES COMMANDES -->
                <div class="welcome">
                    <h1>Mes commandes</h1>
                </div>

                <section class="orders-list">
                    <?php foreach ($commandes as $c): ?>
                        <article class="order-card" data-status="<?= $c['statut'] ?>">

                            <div class="order-card-header">
                                <div>
                                    <h3>#<?= $c['id'] ?></h3>
                                    <p><?= $c['date'] ?></p>
                                </div>
                                <span class="status <?= $c['statut'] ?>"><?= $c['libelle'] ?></span>
                            </div>

                            <div class="order-card-body">
                                <div class="order-card-image">
                                    <img src="<?= htmlspecialchars($c['image']) ?>" alt="<?= htmlspecialchars($c['menu']) ?>">
                                </div>
                                <div class="order-card-info">
                                    <h4><?= $c['menu'] ?></h4>
                                    <p><strong>Prix :</strong> <?= $c['prix'] ?></p>
                                    <p><strong>Quantité :</strong> <?= $c['quantite'] ?></p>
                                    <p><strong>Livraison :</strong> <?= $c['livraison'] ?></p>
                                </div>
                            </div>

                            <div class="order-card-footer">
                                <a href="<?= lienOnglet('detail') ?>&id=<?= $c['id'] ?>" class="order-link">
                                    Détails <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>

                        </article>
                    <?php endforeach; ?>
                </section>

            <?php elseif ($onglet === 'detail'): ?>

                <?php
                $numeroBrut = $_GET['id'] ?? '';
                $commande = $commandes[0];
                foreach ($commandes as $item) {
                    if ($item['id'] === $numeroBrut) {
                        $commande = $item;
                    }
                }
                $numero = htmlspecialchars($commande['id']);
                $estTerminee = $commande['statut'] === 'finished';
                ?>

                <!-- DETAIL DE LA COMMANDE -->
                <section class="dashboard order-detail">

                    <div class="detail-heading">
                        <div>
                            <a href="<?= lienOnglet('commandes') ?>" class="back-link">
                                <i class="fa-solid fa-arrow-left"></i>
                                Retour à mes commandes
                            </a>
                            <h1>Détail de la commande <span id="orderNumber">#<?= $numero ?></span></h1>
                            <p class="detail-date" id="orderDateLabel">Commandée le <?= $commande['date'] ?></p>
                        </div>
                        <span class="status <?= $commande['statut'] ?>" id="orderStatus" data-status="<?= $commande['statut'] ?>">
                            <?= $commande['libelle'] ?>
                        </span>
                    </div>

                    <?php if (!$estTerminee): ?>
                    <div class="order-notice">
                        <i class="fa-solid fa-circle-info"></i>
                        <p>Vous pouvez modifier ou annuler cette commande tant qu'un employé ne l'a pas acceptée.</p>
                    </div>
                    <?php endif; ?>

                    <section class="detail-card">
                        <div class="detail-card-heading">
                            <h2><i class="fa-solid fa-receipt"></i> Résumé de la commande</h2>
                        </div>
                        <div class="summary-layout">
                            <div class="summary-image">
                                <img src="<?= htmlspecialchars($commande['image']) ?>" alt="<?= htmlspecialchars($commande['menu']) ?>" id="summaryImage">
                            </div>
                            <div class="summary-main">
                                <span class="eyebrow">MENU COMMANDÉ</span>
                                <h3 id="summaryTitle"><?= $commande['menu'] ?></h3>
                                <p id="summaryDescription"><?= $estTerminee ? 'Repas livré, merci pour votre commande.' : 'Commande en cours de traitement.' ?></p>
                                <div class="summary-tags">
                                    <span><i class="fa-solid fa-user-group"></i> <span id="summaryQuantity"><?= $commande['quantite'] ?></span></span>
                                    <span><i class="fa-solid fa-truck"></i> <span id="summaryDelivery"><?= $commande['livraison'] ?></span></span>
                                </div>
                            </div>
                            <div class="summary-price">
                                <span>Total de la commande</span>
                                <strong id="summaryTotal"><?= $commande['prix'] ?></strong>
                            </div>
                        </div>
                    </section>

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

                    <section class="detail-card">
                        <div class="detail-card-heading">
                            <h2><i class="fa-regular fa-comment-dots"></i> Instructions complémentaires</h2>
                            <button type="button" id="editInstructionsBtn" class="detail-edit-btn">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                        </div>
                        <p id="customerInstructions" class="customer-note">Merci de sonner à l'interphone à votre arrivée.</p>
                    </section>

                    <section class="detail-card tracking-card">
                        <div class="detail-card-heading">
                            <h2><i class="fa-solid fa-route"></i> Suivi de la commande</h2>
                            <?php if ($estTerminee): ?>
                            <span class="tracking-locked"><i class="fa-solid fa-circle-check"></i> Commande livrée</span>
                        <?php else: ?>
                            <span class="tracking-locked"><i class="fa-solid fa-lock"></i> Disponible après acceptation</span>
                        <?php endif; ?>
                        </div>
                        <p class="tracking-intro">
                            <?= $estTerminee ? 'Cette commande a été préparée et livrée.' : "L'historique détaillé des statuts sera disponible dès que votre commande aura été acceptée par un employé." ?>
                        </p>
                        <ol class="tracking-timeline">
                            <li class="timeline-step completed">
                                <span class="timeline-icon"><i class="fa-solid fa-check"></i></span>
                                <div>
                                    <strong>Commande reçue</strong>
                                    <p>12 août 2026 à 18:45</p>
                                </div>
                            </li>
                            <li class="timeline-step <?= $estTerminee ? 'completed' : 'pending' ?>">
                                <span class="timeline-icon"><i class="fa-solid fa-check"></i></span>
                                <div>
                                    <strong>Commande acceptée</strong>
                                    <p><?= $estTerminee ? 'Acceptée par l\'équipe' : "En attente de validation par l'équipe" ?></p>
                                </div>
                            </li>
                            <li class="timeline-step <?= $estTerminee ? 'completed' : 'upcoming' ?>">
                                <span class="timeline-icon"><i class="fa-solid fa-utensils"></i></span>
                                <div>
                                    <strong>Préparation</strong>
                                    <p><?= $estTerminee ? 'Terminée' : 'À venir' ?></p>
                                </div>
                            </li>
                            <li class="timeline-step <?= $estTerminee ? 'completed' : 'upcoming' ?>">
                                <span class="timeline-icon"><i class="fa-solid fa-flag-checkered"></i></span>
                                <div>
                                    <strong>Commande terminée</strong>
                                    <p><?= $estTerminee ? 'Livrée' : 'À venir' ?></p>
                                </div>
                            </li>
                        </ol>
                    </section>

                    <section class="detail-card total-card">
                        <div class="detail-card-heading">
                            <h2><i class="fa-solid fa-calculator"></i> Récapitulatif du prix</h2>
                        </div>
                        <div class="total-line">
                            <span id="totalMenuLabel"><?= $commande['menu'] ?> × <?= $commande['quantite'] ?></span>
                            <strong id="totalMenuPrice"><?= $commande['prix'] ?></strong>
                        </div>
                        <div class="total-line">
                            <span>Livraison</span>
                            <strong>Offerte</strong>
                        </div>
                        <div class="total-line total-final">
                            <span>Total à payer</span>
                            <strong id="totalFinalPrice"><?= $commande['prix'] ?></strong>
                        </div>
                    </section>

                    <?php if ($estTerminee): ?>
                    <div class="order-actions">
                        <a href="<?= lienOnglet('avis') ?>" class="button-primary">
                            <i class="fa-regular fa-star"></i>
                            Donner mon avis
                        </a>
                    </div>
                    <?php else: ?>
                    <div class="order-actions">
                        <button type="button" id="editOrderBtn" class="button-primary">
                            <i class="fa-solid fa-pen"></i>
                            Modifier la commande
                        </button>
                        <button type="button" class="button-danger">
                            <i class="fa-regular fa-trash-can"></i>
                            Annuler la commande
                        </button>
                    </div>
                    <?php endif; ?>

                </section>

            <?php elseif ($onglet === 'avis'): ?>

                <!-- MES AVIS -->
                <div class="welcome">
                    <h1>Mes avis</h1>
                    <p>Partagez votre expérience sur les menus que vous avez commandés.</p>
                </div>

                <section class="reviews-list">

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
                                <img src="images/quiche.jpg" alt="Menu Équilibre">
                            </div>
                            <div class="review-card-text">
                                <p>Excellent ! Produits frais et savoureux. Je recommande vivement ce menu pour tous ceux qui cherchent un repas équilibré et délicieux.</p>
                            </div>
                        </div>
                        <div class="review-card-actions">
                            <button class="review-edit-btn" type="button"><i class="fa-solid fa-pen"></i> Modifier</button>
                            <button class="review-delete-btn" type="button"><i class="fa-regular fa-trash-can"></i> Supprimer</button>
                        </div>
                    </article>

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
                                <img src="images/pates.jpg" alt="Menu Plaisir">
                            </div>
                            <div class="review-card-text">
                                <p>Très bon menu, je recommande ! Les saveurs sont bien équilibrées et la qualité des ingrédients est évidente.</p>
                            </div>
                        </div>
                        <div class="review-card-actions">
                            <button class="review-edit-btn" type="button"><i class="fa-solid fa-pen"></i> Modifier</button>
                            <button class="review-delete-btn" type="button"><i class="fa-regular fa-trash-can"></i> Supprimer</button>
                        </div>
                    </article>

                </section>

            <?php else: ?>

                <!-- MON PROFIL -->
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

                        <form class="profile-form" method="post" action="#">

                            <div class="form-grid">

                                <div class="form-field">
                                    <label for="prenom">Prénom</label>
                                    <input id="prenom" name="prenom" type="text" value="Kévin">
                                </div>

                                <div class="form-field">
                                    <label for="nom">Nom</label>
                                    <input id="nom" name="nom" type="text" value="Dupont">
                                </div>

                                <div class="form-field full-width">
                                    <label for="email">E-mail</label>
                                    <input id="email" name="email" type="email" value="kevin.dupont@email.com">
                                </div>

                                <div class="form-field">
                                    <label for="telephone">Téléphone</label>
                                    <input id="telephone" name="telephone" type="tel" value="06 12 34 56 78">
                                </div>

                                <div class="form-field">
                                    <label for="ville">Ville</label>
                                    <input id="ville" name="ville" type="text" value="Lyon">
                                </div>

                                <div class="form-field full-width">
                                    <label for="adresse">Adresse</label>
                                    <input id="adresse" name="adresse" type="text" value="12 rue des Érables, 69000 Lyon">
                                </div>

                            </div>

                            <div class="profile-actions">
                                <span class="save-status" aria-live="polite"></span>
                                <button type="submit" class="save-button">Enregistrer</button>
                            </div>

                        </form>

                    </div>

                </section>

            <?php endif; ?>

        </section>

    </main>


    <!-- FOOTER -->
    
    <?php require_once __DIR__ . '/../.Composants/footer.html'; ?>

    <script src="Espace perso.js"></script>
    

</body>

</html>
