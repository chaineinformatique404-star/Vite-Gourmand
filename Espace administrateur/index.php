<?php
declare(strict_types=1);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/security.php';
require_once __DIR__ . '/statistics.php';

requireAdmin();


// ==================================================
// 1. RÉCUPÉRATION DES STATISTIQUES
// ==================================================

$stats = getDashboardStats($pdo, $schema);

$period = $_GET['period'] ?? 'month';

if (!in_array($period, ['month', 'year', 'all'], true)) {
    $period = 'month';
}

$menuFilter = (string) ($_GET['menu'] ?? 'all');

$menuStats = getMenuStatistics(
    $pdo,
    $schema,
    $period,
    $menuFilter
);


// ==================================================
// 2. RÉCUPÉRATION DES MENUS
// ==================================================

$menus = [];

try {
    $menus = $pdo->query(
        'SELECT
            `' . $schema['menu_id'] . '` AS id,
            `' . $schema['menu_name'] . '` AS name
         FROM `' . $schema['menus_table'] . '`
         ORDER BY `' . $schema['menu_name'] . '`'
    )->fetchAll();
}
catch (PDOException $exception) {
    error_log('Récupération des menus : ' . $exception->getMessage());
}


// ==================================================
// 3. RÉCUPÉRATION DES EMPLOYÉS
// ==================================================

$employees = [];

try {
    $employeeSql = '
        SELECT
            `' . $schema['user_id'] . '` AS id,
            `' . $schema['user_email'] . '` AS email,
            `' . $schema['user_active'] . '` AS active
        FROM `' . $schema['users_table'] . '`
        WHERE LOWER(`' . $schema['user_role'] . '`)
            IN ("employé", "employe", "employee")
        ORDER BY `' . $schema['user_email'] . '`';

    $employees = $pdo->query($employeeSql)->fetchAll();
}
catch (PDOException $exception) {
    error_log('Récupération des employés : ' . $exception->getMessage());
}


// ==================================================
// 4. PRÉPARATION DES GRAPHIQUES
// ==================================================

$chartLabels = array_column($menuStats, 'menu_name');

$orderData = array_map(
    'intval',
    array_column($menuStats, 'order_count')
);

$revenueData = array_map(
    'floatval',
    array_column($menuStats, 'revenue')
);


// ==================================================
// 5. MESSAGES DE CONFIRMATION
// ==================================================

$flash = $_SESSION['flash'] ?? '';

unset($_SESSION['flash']);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Espace administrateur | Vite & Gourmand</title>

    <link rel="stylesheet" href="assets/css/admin.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="admin-layout">

    <!-- ==========================================
         MENU LATÉRAL
    =========================================== -->

    <aside class="sidebar">

        <a class="brand" href="index.php">
            <span class="brand-name">Vite & Gourmand</span>
            <span class="brand-subtitle">TRAITEUR ÉVÉNEMENTIEL</span>
        </a>

        <nav class="navigation" aria-label="Navigation administrateur">

            <a class="nav-link active" href="#dashboard">
                <span>▦</span>
                Tableau de bord
            </a>

            <a class="nav-link" href="#employees">
                <span>♟</span>
                Gestion des employés
            </a>

            <a class="nav-link" href="#statistics">
                <span>▥</span>
                Statistiques
            </a>

            <div class="nav-separator"></div>

            <a class="nav-link" href="../index.php">
                <span>⌂</span>
                Retour au site
            </a>

            <a class="nav-link" href="../Connexion/connexion.php?deconnexion=1">
                <span>↪</span>
                Déconnexion
            </a>

        </nav>

        <p class="sidebar-footer">
            Espace sécurisé<br>
            Vite & Gourmand
        </p>

    </aside>


    <!-- ==========================================
         CONTENU PRINCIPAL
    =========================================== -->

    <main class="main-content">

        <!-- EN-TÊTE -->

        <header class="topbar">

            <div>
                <p class="eyebrow">ESPACE ADMINISTRATEUR</p>
                <h1>Tableau de bord</h1>
            </div>

            <div class="profile">

                <span class="avatar">A</span>

                <span>
                    <strong>
                        <?= h($_SESSION['email'] ?? 'Administrateur') ?>
                    </strong>

                    <small>Administrateur</small>
                </span>

            </div>

        </header>


        <!-- MESSAGE DE CONFIRMATION -->

        <?php if ($flash !== ''): ?>

            <div class="notice">
                <?= h($flash) ?>
            </div>

        <?php endif; ?>


        <!-- ======================================
             SECTION 1 : TABLEAU DE BORD
        ======================================= -->

        <section id="dashboard" class="admin-section">

            <div class="welcome">

                <div>
                    <h2>Vue d'ensemble</h2>

                    <p>
                        Retrouvez les indicateurs essentiels de votre activité.
                    </p>
                </div>

                <span class="date-pill">
                    <?= h(date('d/m/Y')) ?>
                </span>

            </div>


            <!-- INDICATEURS -->

            <div class="kpi-grid">

                <article class="kpi-card">

                    <span class="kpi-icon">🛒</span>

                    <p>Commandes totales</p>

                    <strong>
                        <?= number_format($stats['orders'], 0, ',', ' ') ?>
                    </strong>

                    <small>Depuis le début</small>

                </article>


                <article class="kpi-card">

                    <span class="kpi-icon">🍽</span>

                    <p>Menus proposés</p>

                    <strong>
                        <?= number_format($stats['menus'], 0, ',', ' ') ?>
                    </strong>

                    <small>Menus en base</small>

                </article>


                <article class="kpi-card">

                    <span class="kpi-icon">♟</span>

                    <p>Employés actifs</p>

                    <strong>
                        <?= number_format($stats['activeEmployees'], 0, ',', ' ') ?>
                    </strong>

                    <small>Comptes employés actifs</small>

                </article>


                <article class="kpi-card">

                    <span class="kpi-icon">€</span>

                    <p>Chiffre d'affaires total</p>

                    <strong>
                        <?= number_format($stats['revenue'], 2, ',', ' ') ?> €
                    </strong>

                    <small>Total des commandes</small>

                </article>

            </div>


            <!-- GRAPHIQUES DU TABLEAU DE BORD -->

            <div class="charts-grid">

                <article class="panel">

                    <h2>Commandes par menu</h2>

                    <div class="chart-wrap">
                        <canvas id="ordersChart"></canvas>
                    </div>

                </article>


                <article class="panel">

                    <h2>Chiffre d'affaires par menu</h2>

                    <div class="chart-wrap">
                        <canvas id="revenueChart"></canvas>
                    </div>

                </article>

            </div>

        </section>


        <!-- ======================================
             SECTION 2 : GESTION DES EMPLOYÉS
        ======================================= -->

        <section id="employees" class="admin-section">

            <div class="section-intro">

                <div>
                    <h2>Gestion des employés</h2>

                    <p>
                        Créer, activer ou désactiver les comptes employés.
                    </p>
                </div>

            </div>


            <!-- FORMULAIRE DE CRÉATION -->

            <article class="panel">

                <h2>Créer un compte employé</h2>

                <form
                    class="employee-form"
                    action="employee-action.php"
                    method="post"
                >

                    <input
                        type="hidden"
                        name="csrf_token"
                        value="<?= h(csrfToken()) ?>"
                    >

                    <input
                        type="hidden"
                        name="action"
                        value="create"
                    >


                    <label>
                        Adresse e-mail (identifiant)

                        <input
                            type="email"
                            name="email"
                            required
                            autocomplete="email"
                        >
                    </label>


                    <label>
                        Mot de passe provisoire

                        <input
                            type="password"
                            name="password"
                            minlength="10"
                            required
                            autocomplete="new-password"
                        >
                    </label>


                    <p class="notice">
                        Le mot de passe est haché avant son enregistrement.
                        Ne l'envoyez jamais par e-mail.
                    </p>


                    <button class="btn btn-primary" type="submit">
                        Créer l'employé
                    </button>

                </form>

            </article>


            <!-- LISTE DES EMPLOYÉS -->

            <article class="panel">

                <h2>Comptes employés</h2>

                <div class="table-scroll">

                    <table>

                        <thead>
                            <tr>
                                <th>E-mail</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($employees as $employee): ?>

                                <tr>

                                    <td>
                                        <?= h($employee['email']) ?>
                                    </td>

                                    <td>

                                        <span class="status <?= (int) $employee['active'] === 1 ? 'active-status' : 'inactive-status' ?>">

                                            <?= (int) $employee['active'] === 1 ? 'Actif' : 'Inactif' ?>

                                        </span>

                                    </td>

                                    <td>

                                        <form
                                            action="employee-action.php"
                                            method="post"
                                        >

                                            <input
                                                type="hidden"
                                                name="csrf_token"
                                                value="<?= h(csrfToken()) ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="action"
                                                value="toggle"
                                            >

                                            <input
                                                type="hidden"
                                                name="id"
                                                value="<?= (int) $employee['id'] ?>"
                                            >

                                            <input
                                                type="hidden"
                                                name="active"
                                                value="<?= (int) $employee['active'] === 1 ? 0 : 1 ?>"
                                            >

                                            <button
                                                class="btn-small"
                                                type="submit"
                                            >
                                                <?= (int) $employee['active'] === 1 ? 'Désactiver' : 'Activer' ?>
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            <?php endforeach; ?>


                            <?php if (!$employees): ?>

                                <tr>
                                    <td colspan="3">
                                        Aucun employé trouvé.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </article>

        </section>


        <!-- ======================================
             SECTION 3 : STATISTIQUES
        ======================================= -->

        <section id="statistics" class="admin-section">

            <div class="section-intro">

                <div>
                    <h2>Statistiques et chiffre d'affaires</h2>

                    <p>
                        Filtrez les résultats par période et par menu.
                    </p>
                </div>

            </div>


            <article class="panel">

                <!-- FILTRES -->

                <form
                    class="filters"
                    method="get"
                    action="index.php#statistics"
                >

                    <label>
                        Période

                        <select name="period">

                            <option
                                value="month"
                                <?= $period === 'month' ? 'selected' : '' ?>
                            >
                                Ce mois-ci
                            </option>

                            <option
                                value="year"
                                <?= $period === 'year' ? 'selected' : '' ?>
                            >
                                Cette année
                            </option>

                            <option
                                value="all"
                                <?= $period === 'all' ? 'selected' : '' ?>
                            >
                                Depuis le début
                            </option>

                        </select>
                    </label>


                    <label>
                        Menu

                        <select name="menu">

                            <option value="all">
                                Tous les menus
                            </option>

                            <?php foreach ($menus as $menu): ?>

                                <option
                                    value="<?= (int) $menu['id'] ?>"
                                    <?= $menuFilter === (string) $menu['id'] ? 'selected' : '' ?>
                                >
                                    <?= h($menu['name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>
                    </label>


                    <button class="btn btn-primary" type="submit">
                        Appliquer
                    </button>

                </form>


                <!-- GRAPHIQUE DES STATISTIQUES -->

                <div class="chart-wrap large-chart">
                    <canvas id="combinedChart"></canvas>
                </div>

                <p class="demo-note">
                    Les statistiques utilisent les données disponibles
                    dans la base de données.
                </p>

            </article>

        </section>

    </main>

</div>

<script>
    // Transmet les données calculées par PHP au fichier JavaScript externe.
    window.adminChartData = {
        labels: <?= json_encode($chartLabels, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>,
        orders: <?= json_encode($orderData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>,
        revenue: <?= json_encode($revenueData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>
    };
</script>


<script src="assets/js/admin.js" defer></script> 


</body>
</html>
