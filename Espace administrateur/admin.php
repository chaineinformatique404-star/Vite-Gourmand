<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('DB_OPTIONAL', true);

require_once __DIR__ . '/../.Base de données/Database.php';

$employes = [];
$erreurBdd = false;

if ($pdo instanceof PDO) {
    try {
        $sql = "
            SELECT id_utilisateur, email, statut, date_creation
            FROM utilisateurs
            WHERE LOWER(role) IN ('employé', 'employe', 'employee')
            ORDER BY date_creation DESC
        ";

        $statement = $pdo->query($sql);
        $employes = $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    catch (PDOException $exception) {
        $erreurBdd = true;
        error_log('Récupération des employés : ' . $exception->getMessage());
    }
}
else {
    $erreurBdd = true;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Configuration de la page et encodage des caractères -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Titre affiché dans l'onglet du navigateur -->
    <title>Espace administrateur | Vite & Gourmand</title>

    <!-- Chargement des styles CSS de l'espace administrateur -->
    <link rel="stylesheet" href="admin.css">

    <!-- Chargement de la bibliothèque permettant de créer les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Chargement du JavaScript de l'espace administrateur après l'analyse du HTML -->
    <script src="admin.js?v=2" defer></script>
</head>

<body>
    <!-- Conteneur général de l'espace administrateur -->
    <div class="admin-layout">

        <!-- ==========================================
             MENU LATÉRAL ET NAVIGATION
        =========================================== -->
        <aside class="sidebar">

            <!-- Identité du site -->
            <a class="brand" href="admin.php">
                <span class="brand-name">Vite & Gourmand</span>
                <span class="brand-subtitle">TRAITEUR ÉVÉNEMENTIEL</span>
            </a>

            <!-- Liens permettant de naviguer entre les sections -->
            <nav class="navigation" aria-label="Navigation administrateur">

                <!-- Accès au tableau de bord -->
                <button class="nav-link active" data-page="dashboard">
                    <span>▦</span> Tableau de bord
                </button>

                <!-- Accès à la gestion des employés -->
                <button class="nav-link" data-page="employees">
                    <span>♟</span> Gestion des employés
                </button>

                <!-- Accès aux commandes -->
                <button class="nav-link" data-page="orders">
                    <span>🛒</span> Commandes
                </button>

                <!-- Accès aux statistiques -->
                <button class="nav-link" data-page="statistics">
                    <span>▥</span> Statistiques
                </button>

                <!-- Séparation visuelle dans le menu -->
                <div class="nav-separator"></div>

                <!-- Retour vers le site public -->
                <a class="nav-link" href="../Accueil/accueil.php">
                    <span>⌂</span> Retour au site
                </a>

                <!-- Lien vers la page de connexion pour se déconnecter -->
                <a class="nav-link" href="../Connexion/connexion.php?deconnexion=1">
                    <span>↪</span> Déconnexion
                </a>
            </nav>

            <!-- Mention affichée en bas du menu latéral -->
            <p class="sidebar-footer">
                Espace sécurisé<br>
                Vite & Gourmand
            </p>
        </aside>


        <!-- ==========================================
             CONTENU PRINCIPAL
        =========================================== -->
        <main class="main-content">

            <!-- En-tête affichant le titre et le profil administrateur -->
            <header class="topbar">
                <div>
                    <p class="eyebrow">ESPACE ADMINISTRATEUR</p>
                    <h1 id="page-title">Tableau de bord</h1>
                </div>

                <!-- Informations du profil connecté -->
                <div class="profile">
                    <span class="avatar"><?= htmlspecialchars(mb_strtoupper(mb_substr($_SESSION['nom'] ?? 'A', 0, 1))) ?></span>
                    <span>
                        <strong><?= htmlspecialchars(($_SESSION['prenom'] ?? 'Administrateur') . (!empty($_SESSION['nom']) ? ' ' . mb_strtoupper(mb_substr($_SESSION['nom'], 0, 1)) . '.' : '')) ?></strong>
                        <small>Gestion du site</small>
                    </span>
                </div>
            </header>


            <!-- ======================================
                 SECTION 1 : TABLEAU DE BORD
            ======================================= -->
            <section class="page-section active" id="dashboard">

                <!-- Message de bienvenue et date du jour -->
                <div class="welcome">
                    <div>
                        <h2>Bienvenue dans votre espace</h2>
                        <p>Retrouvez ici les indicateurs essentiels de votre activité.</p>
                    </div>

                    <!-- La date est ajoutée par JavaScript -->
                    <span class="date-pill" id="current-date"></span>
                </div>

                <!-- Cartes présentant les principaux indicateurs -->
                <div class="kpi-grid">

                    <!-- Nombre total de commandes -->
                    <article class="kpi-card">
                        <span class="kpi-icon">🛒</span>
                        <p>Commandes totales</p>
                        <strong>372</strong>
                        <small class="positive">+12 % ce mois-ci</small>
                    </article>

                    <!-- Nombre de menus proposés -->
                    <article class="kpi-card">
                        <span class="kpi-icon">🍽</span>
                        <p>Menus proposés</p>
                        <strong>8</strong>
                        <small>Menus disponibles</small>
                    </article>

                    <!-- Nombre d'employés actifs -->
                    <article class="kpi-card">
                        <span class="kpi-icon">♟</span>
                        <p>Employés actifs</p>
                        <strong id="active-count">3</strong>
                        <small>Comptes actifs</small>
                    </article>

                    <!-- Chiffre d'affaires réalisé -->
                    <article class="kpi-card">
                        <span class="kpi-icon">€</span>
                        <p>Chiffre d'affaires</p>
                        <strong>15 160 €</strong>
                        <small class="positive">+18 % ce mois-ci</small>
                    </article>
                </div>

                <!-- Graphiques récapitulatifs du tableau de bord -->
                <div class="charts-grid">

                    <!-- Graphique du nombre de commandes par menu -->
                    <article class="panel">
                        <div class="panel-heading">
                            <div>
                                <h2>Commandes par menu</h2>
                                <p>Comparaison du nombre de commandes</p>
                            </div>
                        </div>

                        <!-- Canvas utilisé par Chart.js -->
                        <div class="chart-wrap">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </article>

                    <!-- Graphique circulaire du chiffre d'affaires -->
                    <article class="panel">
                        <div class="panel-heading">
                            <div>
                                <h2>Répartition du chiffre d'affaires</h2>
                                <p>Exemple de répartition</p>
                            </div>
                        </div>

                        <div class="chart-wrap doughnut-wrap">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </article>
                </div>

                <!-- Indique que les chiffres affichés sont fictifs -->
                <p class="demo-note">
                    Maquette avec données fictives : les chiffres devront être remplacés par les données de la base de données.
                </p>
            </section>


            <!-- ======================================
                 SECTION 2 : GESTION DES EMPLOYÉS
            ======================================= -->
            <section class="page-section" id="employees">

                <!-- Présentation de la section et bouton de création -->
                <div class="section-intro">
                    <div>
                        <h2>Gestion des employés</h2>
                        <p>Créer des comptes et désactiver les accès si nécessaire.</p>
                    </div>

                    <!-- Ouvre la fenêtre de création d'un employé -->
                    <button class="btn btn-primary" id="open-create">
                        ＋ Créer un employé
                    </button>
                </div>

                <!-- Tableau répertoriant les comptes employés -->
                <article class="panel">

                    <!-- Titre du tableau et champ de recherche -->
                    <div class="panel-heading">
                        <div>
                            <h2>Liste des employés</h2>
                            <p>Le courriel sert d'identifiant de connexion.</p>
                        </div>

                        <!-- Permet de rechercher un employé par son e-mail -->
                        <input
                            class="search-input"
                            id="employee-search"
                            type="search"
                            placeholder="Rechercher un e-mail…"
                        >
                    </div>

                    <!-- Conteneur permettant le défilement horizontal du tableau -->
                    <div class="table-scroll">
                        <table>

                            <!-- En-têtes des colonnes -->
                            <thead>
                                <tr>
                                    <th>Email (username)</th>
                                    <th>Statut</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

<?php if ($erreurBdd): ?>
    <p class="error-message">
        La base de données est momentanément indisponible.
        La liste des employés ne peut pas être affichée.
    </p>
<?php endif; ?>

                            
<tbody id="employee-table">

    <!-- Parcourt les employés récupérés depuis MySQL -->
    <?php foreach ($employees as $employee): ?>

        <tr>
            <!-- Adresse e-mail de l'employé -->
            <td><?= htmlspecialchars($employee['email'], ENT_QUOTES, 'UTF-8') ?></td>

            <!-- Affiche le statut du compte -->
            <td>
                <?php if ((int) $employee['statut'] === 1): ?>
                    <span class="status active-status">Actif</span>
                <?php else: ?>
                    <span class="status inactive-status">Inactif</span>
                <?php endif; ?>
            </td>

            <!-- Date de création du compte -->
            <td>
                <?php
                if (!empty($employee['date_creation'])) {
                    echo htmlspecialchars(
                        date('d/m/Y', strtotime($employee['date_creation'])),
                        ENT_QUOTES,
                        'UTF-8'
                    );
                }
                else {
                    echo 'Non renseignée';
                }
                ?>
            </td>

            <!-- Bouton d'action à relier au traitement PHP -->
            <td>
                <button class="btn-small" type="button">
                    <?= (int) $employee['statut'] === 1 ? 'Désactiver' : 'Activer' ?>
                </button>
            </td>
        </tr>

    <?php endforeach; ?>

    <!-- Message affiché si aucun employé n'existe dans la BDD -->
    <?php if (empty($employees)): ?>
        <tr>
            <td colspan="4">Aucun employé trouvé dans la base de données.</td>
        </tr>
    <?php endif; ?>

</tbody>


                           
                        </table>
                    </div>

                    <!-- Rappel concernant les notifications et les mots de passe -->
                    <div class="notice">
                        <strong>ⓘ À retenir</strong>
                        <p>
                            Un e-mail de notification doit être envoyé lors de la création.
                            Le mot de passe ne doit jamais être inclus dans cet e-mail :
                            il sera communiqué séparément par l'administrateur.
                        </p>
                    </div>
                </article>
            </section>


            <!-- ======================================
                 SECTION 3 : COMMANDES
            ======================================= -->
            <section class="page-section" id="orders">

                <!-- Présentation de la section -->
                <div class="section-intro">
                    <div>
                        <h2>Commandes</h2>
                        <p>Vue de synthèse des commandes enregistrées.</p>
                    </div>
                </div>

                <article class="panel">

                    <!-- Filtres permettant de choisir la période et le menu -->
                    <div class="filters">

                        <!-- Filtrage par période -->
                        <label>
                            Période
                            <select id="orders-period">
                                <option value="month">Ce mois-ci</option>
                                <option value="year">Cette année</option>
                                <option value="all">Depuis le début</option>
                            </select>
                        </label>

                        <!-- Filtrage par type de menu -->
                        <label>
                            Menu
                            <select id="orders-menu">
                                <option value="all">Tous les menus</option>
                                <option>Menu Tradition</option>
                                <option>Menu Végétarien</option>
                                <option>Menu Gourmand</option>
                                <option>Menu Prestige</option>
                                <option>Menu Enfant</option>
                            </select>
                        </label>
                    </div>

                    <!-- Graphique détaillé des commandes -->
                    <div class="chart-wrap large-chart">
                        <canvas id="ordersDetailChart"></canvas>
                    </div>

                    <!-- Liste fictive des dernières commandes -->
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Commandes</th>
                                    <th>Montant total</th>
                                    <th>Dernière commande</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Menu Tradition</td><td>124</td><td>3 850 €</td><td>08/11/2026</td></tr>
                                <tr><td>Menu Végétarien</td><td>67</td><td>2 140 €</td><td>08/11/2026</td></tr>
                                <tr><td>Menu Gourmand</td><td>98</td><td>3 620 €</td><td>08/11/2026</td></tr>
                                <tr><td>Menu Prestige</td><td>52</td><td>4 180 €</td><td>07/11/2026</td></tr>
                                <tr><td>Menu Enfant</td><td>31</td><td>1 370 €</td><td>07/11/2026</td></tr>
                                <tr><td><strong>Total</strong></td><td><strong>372</strong></td><td><strong>15 160 €</strong></td><td></td></tr>
                            </tbody>
                        </table>
                    </div>
                </article>
            </section>


            <!-- ======================================
                 SECTION 4 : STATISTIQUES
            ======================================= -->
            <section class="page-section" id="statistics">

                <!-- Présentation de la section -->
                <div class="section-intro">
                    <div>
                        <h2>Statistiques et chiffre d'affaires</h2>
                        <p>Comparer les commandes et le chiffre d'affaires par menu.</p>
                    </div>
                </div>

                <article class="panel">

                    <!-- Filtres pour analyser les résultats -->
                    <div class="filters">

                        <!-- Choix de la période statistique -->
                        <label>
                            Période
                            <select id="revenue-period">
                                <option value="month">Ce mois-ci</option>
                                <option value="year">Cette année</option>
                                <option value="all">Depuis le début</option>
                            </select>
                        </label>

                        <!-- Choix du menu à analyser -->
                        <label>
                            Menu
                            <select id="revenue-menu">
                                <option value="all">Tous les menus</option>
                                <option>Menu Tradition</option>
                                <option>Menu Végétarien</option>
                                <option>Menu Gourmand</option>
                                <option>Menu Prestige</option>
                                <option>Menu Enfant</option>
                            </select>
                        </label>
                    </div>

                    <!-- Graphique combinant les données statistiques -->
                    <div class="chart-wrap large-chart">
                        <canvas id="combinedChart"></canvas>
                    </div>

                    <!-- Synthèse fictive par menu -->
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th>Menu</th>
                                    <th>Commandes</th>
                                    <th>Chiffre d'affaires</th>
                                    <th>Part du CA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td>Menu Tradition</td><td>124</td><td>3 850 €</td><td>25,4 %</td></tr>
                                <tr><td>Menu Végétarien</td><td>67</td><td>2 140 €</td><td>14,1 %</td></tr>
                                <tr><td>Menu Gourmand</td><td>98</td><td>3 620 €</td><td>23,9 %</td></tr>
                                <tr><td>Menu Prestige</td><td>52</td><td>4 180 €</td><td>27,6 %</td></tr>
                                <tr><td>Menu Enfant</td><td>31</td><td>1 370 €</td><td>9,0 %</td></tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Note sur la future connexion à la base de données -->
                    <div class="notice">
                        <strong>Base de données</strong>
                        <p>
                            Selon l'énoncé, les statistiques doivent être alimentées
                            par une base de données non relationnelle. Cette maquette
                            utilise des données de démonstration : la connexion à MongoDB
                            et les requêtes réelles restent à intégrer.
                        </p>
                    </div>
                </article>
            </section>
        </main>
    </div>


    <!-- ==========================================
         FENÊTRE MODALE : CRÉATION D'UN EMPLOYÉ
    =========================================== -->
    <dialog id="employee-dialog" class="modal">

        <!-- Formulaire de création d'un compte employé -->
        <form id="employee-form">

            <!-- En-tête de la fenêtre avec son bouton de fermeture -->
            <div class="modal-heading">
                <div>
                    <p class="eyebrow">GESTION DES ACCÈS</p>
                    <h2>Créer un compte employé</h2>
                </div>

                <button
                    class="close-modal"
                    type="button"
                    id="close-create"
                    aria-label="Fermer"
                >
                    ×
                </button>
            </div>

            <!-- Présentation du fonctionnement des notifications -->
            <p class="modal-description">
                Un e-mail de notification sera envoyé automatiquement dans la version connectée au serveur.
            </p>

            <!-- Champ de saisie de l'adresse e-mail -->
            <label for="employee-email">
                Adresse e-mail (identifiant) <span>*</span>
            </label>
            <input
                id="employee-email"
                type="email"
                placeholder="employe@vite-gourmand.fr"
                required
            >

            <!-- Champ de saisie du mot de passe provisoire -->
            <label for="employee-password">
                Mot de passe provisoire <span>*</span>
            </label>
            <input
                id="employee-password"
                type="password"
                minlength="10"
                placeholder="10 caractères minimum"
                required
            >

            <!-- Rappel des règles de sécurité des mots de passe -->
            <div class="notice">
                <strong>ⓘ Sécurité</strong>
                <p>
                    Le mot de passe ne sera pas envoyé par e-mail.
                    En production, il devra être hashé côté serveur
                    et communiqué séparément.
                </p>
            </div>

            <!-- Boutons permettant d'annuler ou de valider la création -->
            <div class="modal-actions">
                <button class="btn btn-secondary" type="button" id="cancel-create">
                    Annuler
                </button>

                <button class="btn btn-primary" type="submit">
                    Créer l'employé
                </button>
            </div>

            <!-- Zone destinée aux messages de validation du formulaire -->
            <p class="form-message" id="form-message" role="status"></p>
        </form>
    </dialog>
</body>
</html>
