/* ============================================================
   FICHIER 1 : config/schema.php

   Rôle :
   Centraliser les noms des tables et des colonnes MySQL.
   À adapter à la structure réelle de ta base de données.
   ============================================================ */

<?php
declare(strict_types=1);

return [
    // Comptes utilisateurs
    'users_table' => 'utilisateurs',
    'user_id' => 'utilisateur_id',
    'user_email' => 'email',
    'user_password' => 'password',
    'user_role_id' => 'role_id',
    'user_active' => 'actif',

    // Rôles : administrateur, employé, etc.
    'roles_table' => 'roles',
    'role_id' => 'role_id',
    'role_label' => 'libelle',

    // Menus proposés par le restaurant
    'menus_table' => 'menus',
    'menu_id' => 'menu_id',
    'menu_name' => 'nom',
    'menu_price' => 'prix',

    // Commandes des clients
    'orders_table' => 'commandes',
    'order_id' => 'commande_id',
    'order_menu_id' => 'menu_id',
    'order_date' => 'date_commande',
    'order_total' => 'prix_total',
    'order_status' => 'statut',
];


/* ============================================================
   FICHIER 2 : config/database.php

   Rôle :
   Établir la connexion à MySQL et préparer MongoDB.
   ============================================================ */

<?php
declare(strict_types=1);

// Charge les dépendances installées avec Composer.
// Ce fichier nécessite un dossier vendor correctement installé.
require_once __DIR__ . '/../vendor/autoload.php';

// Charge la configuration des tables et colonnes.
$schema = require __DIR__ . '/schema.php';

// Paramètres MySQL : à adapter à ton installation XAMPP.
$mysqlHost = '127.0.0.1';
$mysqlPort = '3307';
$mysqlDatabase = 'vite_gourmand';
$mysqlUser = 'root';
$mysqlPassword = '';

try {
    // Connexion sécurisée à MySQL avec PDO.
    $pdo = new PDO(
        "mysql:host={$mysqlHost};port={$mysqlPort};dbname={$mysqlDatabase};charset=utf8mb4",
        $mysqlUser,
        $mysqlPassword,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
}
catch (PDOException $exception) {
    // Conserve le détail technique dans les journaux du serveur.
    error_log('Connexion MySQL impossible : ' . $exception->getMessage());

    http_response_code(500);

    exit(
        'Connexion à la base de données impossible. '
        . 'Vérifie config/database.php.'
    );
}

// Paramètres MongoDB destinés aux statistiques.
$mongoUri = 'mongodb://127.0.0.1:27017';
$mongoDatabase = 'vite_gourmand_stats';
$mongoCollection = 'statistiques_commandes';

$mongoCollectionHandle = null;

try {
    // MongoDB est facultatif tant que le serveur n'est pas configuré.
    if (class_exists(\MongoDB\Client::class)) {
        $mongoClient = new \MongoDB\Client($mongoUri);

        $mongoCollectionHandle = $mongoClient
            ->selectCollection($mongoDatabase, $mongoCollection);
    }
}
catch (Throwable $exception) {
    error_log(
        'Connexion MongoDB indisponible : '
        . $exception->getMessage()
    );
}


/* ============================================================
   FICHIER 3 : includes/security.php

   Rôle :
   Protéger l'espace administrateur et les formulaires.
   ============================================================ */

<?php
declare(strict_types=1);

// Démarre la session si elle n'est pas déjà active.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

/**
 * Vérifie que l'utilisateur connecté est administrateur.
 *
 * La session doit être créée par le système de connexion
 * existant, après vérification du compte en base de données.
 */
function requireAdmin(): void
{
    $userId = $_SESSION['utilisateur_id'] ?? null;

    $role = strtolower(
        (string) ($_SESSION['role'] ?? '')
    );

    if (
        empty($userId)
        || !in_array(
            $role,
            ['admin', 'administrateur'],
            true
        )
    ) {
        http_response_code(403);

        exit(
            'Accès réservé à l’administrateur. '
            . 'Connecte-toi avec un compte autorisé.'
        );
    }
}

/**
 * Génère un jeton CSRF pour sécuriser les formulaires.
 */
function csrfToken(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(
            random_bytes(32)
        );
    }

    return $_SESSION['csrf_token'];
}

/**
 * Vérifie le jeton CSRF reçu lors d'une action.
 */
function verifyCsrf(): void
{
    $token = (string) ($_POST['csrf_token'] ?? '');

    if (
        empty($_SESSION['csrf_token'])
        || !hash_equals(
            $_SESSION['csrf_token'],
            $token
        )
    ) {
        http_response_code(419);

        exit(
            'Jeton de sécurité invalide. '
            . 'Recharge la page puis réessaie.'
        );
    }
}

/**
 * Protège l'affichage des textes contre les injections HTML.
 */
function h(?string $value): string
{
    return htmlspecialchars(
        $value ?? '',
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}


/* ============================================================
   FICHIER 4 : includes/statistics.php

   Rôle :
   Calculer les indicateurs et préparer les statistiques
   par menu pour les graphiques.
   ============================================================ */

<?php
declare(strict_types=1);

/**
 * Récupère les indicateurs généraux du tableau de bord.
 */
function getDashboardStats(
    PDO $pdo,
    array $schema
): array {
    $result = [
        'orders' => 0,
        'revenue' => 0.0,
        'menus' => 0,
        'activeEmployees' => 0,
    ];

    try {
        // Nombre total de commandes.
        $result['orders'] = (int) $pdo
            ->query(
                'SELECT COUNT(*) FROM `'
                . $schema['orders_table']
                . '`'
            )
            ->fetchColumn();

        // Chiffre d'affaires cumulé.
        $result['revenue'] = (float) $pdo
            ->query(
                'SELECT COALESCE(SUM(`'
                . $schema['order_total']
                . '`), 0) FROM `'
                . $schema['orders_table']
                . '`'
            )
            ->fetchColumn();

        // Nombre de menus enregistrés.
        $result['menus'] = (int) $pdo
            ->query(
                'SELECT COUNT(*) FROM `'
                . $schema['menus_table']
                . '`'
            )
            ->fetchColumn();

        // Nombre d'employés actifs.
        $result['activeEmployees'] = (int) $pdo
            ->query(
                'SELECT COUNT(*)
                 FROM `' . $schema['users_table'] . '` u
                 JOIN `' . $schema['roles_table'] . '` r
                   ON u.`' . $schema['user_role_id'] . '`
                    = r.`' . $schema['role_id'] . '`
                 WHERE u.`' . $schema['user_active'] . '` = 1
                   AND LOWER(r.`' . $schema['role_label'] . '`)
                   IN ("employe", "employé", "employee")'
            )
            ->fetchColumn();
    }
    catch (PDOException $exception) {
        error_log(
            'Statistiques du tableau de bord : '
            . $exception->getMessage()
        );
    }

    return $result;
}

/**
 * Calcule le nombre de commandes et le chiffre d'affaires
 * pour chaque menu, selon la période et le filtre choisis.
 *
 * Attention : cette requête suppose que chaque commande
 * correspond à un seul menu. Si une commande peut contenir
 * plusieurs menus, la requête devra utiliser une table
 * de détail des commandes.
 */
function getMenuStatistics(
    PDO $pdo,
    array $schema,
    string $period,
    string $menuFilter
): array {
    $dateColumn = '`c`.`'
        . $schema['order_date']
        . '`';

    $where = [];
    $params = [];

    // Filtre : mois en cours.
    if ($period === 'month') {
        $where[] = $dateColumn . ' >= :start_date';

        $params[':start_date'] = date(
            'Y-m-01 00:00:00'
        );
    }

    // Filtre : année en cours.
    elseif ($period === 'year') {
        $where[] = $dateColumn . ' >= :start_date';

        $params[':start_date'] = date(
            'Y-01-01 00:00:00'
        );
    }

    // Filtre : un menu précis.
    if (
        $menuFilter !== 'all'
        && ctype_digit($menuFilter)
    ) {
        $where[] = '`m`.`'
            . $schema['menu_id']
            . '` = :menu_id';

        $params[':menu_id'] = (int) $menuFilter;
    }

    // Construction de la requête statistique.
    $sql = '
        SELECT
            m.`' . $schema['menu_id'] . '` AS menu_id,
            m.`' . $schema['menu_name'] . '` AS menu_name,
            COUNT(c.`' . $schema['order_id'] . '`) AS order_count,
            COALESCE(
                SUM(c.`' . $schema['order_total'] . '`),
                0
            ) AS revenue

        FROM `' . $schema['menus_table'] . '` m

        LEFT JOIN `' . $schema['orders_table'] . '` c
            ON c.`' . $schema['order_menu_id'] . '`
             = m.`' . $schema['menu_id'] . '`'
        . (
            count($where) > 0
                ? ' WHERE ' . implode(' AND ', $where)
                : ''
        ) . '

        GROUP BY
            m.`' . $schema['menu_id'] . '`,
            m.`' . $schema['menu_name'] . '`

        ORDER BY revenue DESC
    ';

    try {
        $statement = $pdo->prepare($sql);

        $statement->execute($params);

        return $statement->fetchAll();
    }
    catch (PDOException $exception) {
        error_log(
            'Statistiques par menu : '
            . $exception->getMessage()
        );

        return [];
    }
}

/**
 * Synchronise les statistiques calculées avec MongoDB.
 *
 * Cette version remplace les documents d'une période
 * avant de les recréer. Elle devra être adaptée si plusieurs
 * filtres ou plusieurs types de statistiques sont conservés.
 */
function syncStatisticsToMongo(
    ?object $collection,
    array $rows,
    string $period
): bool {
    if ($collection === null) {
        return false;
    }

    try {
        // Supprime les anciens résultats de cette période.
        $collection->deleteMany([
            'period' => $period,
        ]);

        // Enregistre les nouveaux résultats.
        foreach ($rows as $row) {
            $collection->insertOne([
                'menu_id' => (int) $row['menu_id'],
                'menu_name' => (string) $row['menu_name'],
                'order_count' => (int) $row['order_count'],
                'revenue' => (float) $row['revenue'],
                'period' => $period,
                'generated_at' => new \MongoDB\BSON\UTCDateTime(),
            ]);
        }

        return true;
    }
    catch (Throwable $exception) {
        error_log(
            'Synchronisation MongoDB : '
            . $exception->getMessage()
        );

        return false;
    }
}


/* ============================================================
   FICHIER 5 : admin/employee-action.php

   Rôle :
   Traiter les demandes de création, d'activation
   et de désactivation des comptes employés.
   ============================================================ */

<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/security.php';

// Seul un administrateur connecté peut agir.
requireAdmin();

// Cette page accepte uniquement les formulaires POST.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);

    exit('Méthode non autorisée.');
}

// Vérifie le jeton de sécurité.
verifyCsrf();

$action = (string) ($_POST['action'] ?? '');

try {
    /*
     * ACTION 1 : CRÉER UN COMPTE EMPLOYÉ
     */
    if ($action === 'create') {
        $email = filter_var(
            trim((string) ($_POST['email'] ?? '')),
            FILTER_VALIDATE_EMAIL
        );

        $password = (string) ($_POST['password'] ?? '');

        // Vérification des informations.
        if (!$email || strlen($password) < 10) {
            throw new RuntimeException(
                'Adresse e-mail invalide ou mot de passe trop court.'
            );
        }

        $s = $schema;

        // Vérifie que l'adresse e-mail n'existe pas déjà.
        $check = $pdo->prepare(
            'SELECT COUNT(*)
             FROM `' . $s['users_table'] . '`
             WHERE `' . $s['user_email'] . '` = ?'
        );

        $check->execute([$email]);

        if ((int) $check->fetchColumn() > 0) {
            throw new RuntimeException(
                'Un compte utilise déjà cette adresse e-mail.'
            );
        }

        // Récupère l'identifiant du rôle employé.
        $role = $pdo->prepare(
            'SELECT `' . $s['role_id'] . '`
             FROM `' . $s['roles_table'] . '`
             WHERE LOWER(`' . $s['role_label'] . '`)
             IN ("employe", "employé", "employee")
             LIMIT 1'
        );

        $role->execute();

        $roleId = $role->fetchColumn();

        if (!$roleId) {
            throw new RuntimeException(
                'Rôle employé introuvable dans la base de données.'
            );
        }

        // Hash du mot de passe avant stockage.
        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        // Insère le compte avec le statut actif.
        $insert = $pdo->prepare(
            'INSERT INTO `' . $s['users_table'] . '`
                (
                    `' . $s['user_email'] . '`,
                    `' . $s['user_password'] . '`,
                    `' . $s['user_role_id'] . '`,
                    `' . $s['user_active'] . '`
                )
             VALUES (?, ?, ?, 1)'
        );

        $insert->execute([
            $email,
            $passwordHash,
            $roleId,
        ]);

        /*
         * L'envoi réel de l'e-mail n'est pas encore configuré.
         * Le mot de passe ne doit jamais figurer dans le message.
         */
        $_SESSION['flash'] =
            'Compte employé créé. Configure SMTP pour activer '
            . 'l’envoi de la notification.';
    }

    /*
     * ACTION 2 : ACTIVER OU DÉSACTIVER UN COMPTE
     */
    elseif ($action === 'toggle') {
        $id = filter_input(
            INPUT_POST,
            'id',
            FILTER_VALIDATE_INT
        );

        $active = filter_input(
            INPUT_POST,
            'active',
            FILTER_VALIDATE_INT
        );

        // Seules les valeurs 0 et 1 sont autorisées.
        if (
            !$id
            || !in_array($active, [0, 1], true)
        ) {
            throw new RuntimeException(
                'Paramètres invalides.'
            );
        }

        $s = $schema;

        // La requête limite l'action aux comptes employés.
        $update = $pdo->prepare(
            'UPDATE `' . $s['users_table'] . '` u

             JOIN `' . $s['roles_table'] . '` r
               ON u.`' . $s['user_role_id'] . '`
                = r.`' . $s['role_id'] . '`

             SET u.`' . $s['user_active'] . '` = ?

             WHERE u.`' . $s['user_id'] . '` = ?

               AND LOWER(r.`' . $s['role_label'] . '`)
               IN ("employe", "employé", "employee")'
        );

        $update->execute([
            $active,
            $id,
        ]);

        $_SESSION['flash'] = $active === 1
            ? 'Compte employé activé.'
            : 'Compte employé désactivé.';
    }

    /*
     * ACTION INCONNUE
     */
    else {
        throw new RuntimeException(
            'Action inconnue.'
        );
    }
}
catch (RuntimeException $exception) {
    $_SESSION['flash'] = $exception->getMessage();
}
catch (PDOException $exception) {
    // Les détails techniques restent dans les journaux.
    error_log(
        'Action employé : '
        . $exception->getMessage()
    );

    $_SESSION['flash'] =
        'Impossible de modifier le compte. '
        . 'Vérifie les noms des colonnes et la structure de la base.';
}

// Retour vers la page administrateur.
header('Location: index.php#employees');

exit;


/* ============================================================
   FICHIER 6 : admin/index.php

   Rôle :
   Afficher le tableau de bord, les employés et les graphiques.
   Ce fichier contient à la fois du PHP et du HTML.
   ============================================================ */

<?php
declare(strict_types=1);

// Chargement des fichiers nécessaires.
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/statistics.php';

// Protection de l'espace administrateur.
requireAdmin();

// Récupération des indicateurs du tableau de bord.
$stats = getDashboardStats(
    $pdo,
    $schema
);

// Vérification du filtre de période.
$period = $_GET['period'] ?? 'month';

if (!in_array($period, ['month', 'year', 'all'], true)) {
    $period = 'month';
}

// Récupération du filtre menu.
$menuFilter = (string) ($_GET['menu'] ?? 'all');

// Calcul des statistiques.
$menuStats = getMenuStatistics(
    $pdo,
    $schema,
    $period,
    $menuFilter
);

// Préparation des données pour MongoDB.
$mongoSynced = syncStatisticsToMongo(
    $mongoCollectionHandle,
    $menuStats,
    $period
);

// Récupération des menus pour le filtre.
$menus = $pdo->query(
    'SELECT
        `' . $schema['menu_id'] . '` AS id,
        `' . $schema['menu_name'] . '` AS name

     FROM `' . $schema['menus_table'] . '`

     ORDER BY `' . $schema['menu_name'] . '`'
)->fetchAll();

// Récupération des comptes employés.
$employees = [];

try {
    $employeeSql = '
        SELECT
            u.`' . $schema['user_id'] . '` AS id,
            u.`' . $schema['user_email'] . '` AS email,
            u.`' . $schema['user_active'] . '` AS active

        FROM `' . $schema['users_table'] . '` u

        JOIN `' . $schema['roles_table'] . '` r
          ON u.`' . $schema['user_role_id'] . '`
           = r.`' . $schema['role_id'] . '`

        WHERE LOWER(r.`' . $schema['role_label'] . '`)
        IN ("employe", "employé", "employee")

        ORDER BY u.`' . $schema['user_email'] . '`
    ';

    $employees = $pdo->query($employeeSql)->fetchAll();
}
catch (PDOException $exception) {
    error_log(
        'Récupération des employés : '
        . $exception->getMessage()
    );
}

// Préparation des tableaux destinés aux graphiques.
$chartLabels = array_column(
    $menuStats,
    'menu_name'
);

$orderData = array_map(
    'intval',
    array_column($menuStats, 'order_count')
);

$revenueData = array_map(
    'floatval',
    array_column($menuStats, 'revenue')
);

// Message temporaire après une action.
$flash = $_SESSION['flash'] ?? '';

unset($_SESSION['flash']);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>
        Espace administrateur | Vite & Gourmand
    </title>

    <link
        rel="stylesheet"
        href="../assets/css/admin.css"
    >

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="admin-layout">

    <!-- MENU LATÉRAL -->
    <aside class="sidebar">

        <a class="brand" href="index.php">
            <span class="brand-name">
                Vite & Gourmand
            </span>

            <span class="brand-subtitle">
                TRAITEUR ÉVÉNEMENTIEL
            </span>
        </a>

        <nav class="navigation">

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

            <a class="nav-link" href="../connexion.php">
                <span>↪</span>
                Déconnexion
            </a>

        </nav>

        <p class="sidebar-footer">
            Espace sécurisé<br>
            Vite & Gourmand
        </p>

    </aside>


    <!-- CONTENU PRINCIPAL -->
    <main class="main-content">

        <header class="topbar">

            <div>
                <p class="eyebrow">
                    ESPACE ADMINISTRATEUR
                </p>

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


        <!-- MESSAGE APRÈS UNE ACTION -->
        <?php if ($flash !== ''): ?>

            <div class="notice">
                <?= h($flash) ?>
            </div>

        <?php endif; ?>


        <!-- SECTION : TABLEAU DE BORD -->
        <section
            id="dashboard"
            class="admin-section"
        >

            <div class="welcome">

                <div>
                    <h2>Vue d'ensemble</h2>

                    <p>
                        Les indicateurs proviennent de MySQL.
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
                        <?= number_format(
                            $stats['orders'],
                            0,
                            ',',
                            ' '
                        ) ?>
                    </strong>

                    <small>Depuis le début</small>
                </article>


                <article class="kpi-card">
                    <span class="kpi-icon">🍽</span>

                    <p>Menus proposés</p>

                    <strong>
                        <?= number_format(
                            $stats['menus'],
                            0,
                            ',',
                            ' '
                        ) ?>
                    </strong>

                    <small>Menus en base</small>
                </article>


                <article class="kpi-card">
                    <span class="kpi-icon">♟</span>

                    <p>Employés actifs</p>

                    <strong>
                        <?= number_format(
                            $stats['activeEmployees'],
                            0,
                            ',',
                            ' '
                        ) ?>
                    </strong>

                    <small>Comptes actifs</small>
                </article>


                <article class="kpi-card">
                    <span class="kpi-icon">€</span>

                    <p>Chiffre d'affaires total</p>

                    <strong>
                        <?= number_format(
                            $stats['revenue'],
                            2,
                            ',',
                            ' '
                        ) ?> €
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


        <!-- SECTION : GESTION DES EMPLOYÉS -->
        <section
            id="employees"
            class="admin-section"
        >

            <div class="section-intro">

                <div>
                    <h2>Gestion des employés</h2>

                    <p>
                        Créer, activer ou désactiver les comptes.
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
                        Le mot de passe sera hashé en base.
                        Il ne doit jamais être envoyé par e-mail.
                    </p>


                    <button
                        class="btn btn-primary"
                        type="submit"
                    >
                        Créer l'employé
                    </button>

                </form>

            </article>


            <!-- TABLEAU DES EMPLOYÉS -->
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

                                        <span class="status <?= (int) $employee['active'] === 1
                                            ? 'active-status'
                                            : 'inactive-status' ?>">

                                            <?= (int) $employee['active'] === 1
                                                ? 'Actif'
                                                : 'Inactif' ?>

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
                                                value="<?= (int) $employee['active'] === 1
                                                    ? 0
                                                    : 1 ?>"
                                            >

                                            <button
                                                class="btn-small"
                                                type="submit"
                                            >
                                                <?= (int) $employee['active'] === 1
                                                    ? 'Désactiver'
                                                    : 'Activer' ?>
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            <?php endforeach; ?>


                            <?php if (!$employees): ?>

                                <tr>
                                    <td colspan="3">
                                        Aucun employé trouvé.
                                        Vérifie les rôles et les colonnes.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </article>

        </section>


        <!-- SECTION : STATISTIQUES -->
        <section
            id="statistics"
            class="admin-section"
        >

            <div class="section-intro">

                <div>
                    <h2>Statistiques et chiffre d'affaires</h2>

                    <p>
                        Filtre les résultats par période et par menu.
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
                                    <?= $menuFilter === (string) $menu['id']
                                        ? 'selected'
                                        : '' ?>
                                >
                                    <?= h($menu['name']) ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </label>


                    <button
                        class="btn btn-primary"
                        type="submit"
                    >
                        Appliquer
                    </button>

                </form>


                <!-- GRAPHIQUE COMBINÉ -->
                <div class="chart-wrap large-chart">
                    <canvas id="combinedChart"></canvas>
                </div>


                <p class="demo-note">

                    Synchronisation MongoDB :

                    <?= $mongoSynced
                        ? 'effectuée pour cette période.'
                        : 'non disponible. Vérifie MongoDB et Composer.' ?>

                </p>

            </article>

        </section>

    </main>

</div>


<!-- TRANSMISSION DES DONNÉES PHP À JAVASCRIPT -->
<script>
    const labels = <?= json_encode(
        $chartLabels,
        JSON_HEX_TAG
        | JSON_HEX_APOS
        | JSON_HEX_QUOT
        | JSON_HEX_AMP
    ) ?>;

    const orders = <?= json_encode($orderData) ?>;

    const revenue = <?= json_encode($revenueData) ?>;

    const colors = [
        '#b96a3c',
        '#62ad7a',
        '#dc6262',
        '#f3c35b',
        '#5ba7dc',
        '#9b83c5'
    ];


    // Graphique des commandes par menu.
    new Chart(
        document.getElementById('ordersChart'),
        {
            type: 'bar',

            data: {
                labels: labels,

                datasets: [
                    {
                        label: 'Commandes',
                        data: orders,
                        backgroundColor: colors,
                        borderRadius: 4
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        }
    );


    // Graphique du chiffre d'affaires.
    new Chart(
        document.getElementById('revenueChart'),
        {
            type: 'doughnut',

            data: {
                labels: labels,

                datasets: [
                    {
                        data: revenue,
                        backgroundColor: colors
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    );


    // Comparaison des commandes et du chiffre d'affaires.
    new Chart(
        document.getElementById('combinedChart'),
        {
            type: 'bar',

            data: {
                labels: labels,

                datasets: [
                    {
                        label: 'Commandes',
                        data: orders,
                        backgroundColor: '#b96a3c'
                    },
                    {
                        label: 'Chiffre d’affaires (€)',
                        data: revenue,
                        backgroundColor: '#f0c9a8'
                    }
                ]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        }
    );


    // Mise en évidence du lien de navigation sélectionné.
    document
        .querySelectorAll('.navigation a[href^="#"]')
        .forEach(function (link) {

            link.addEventListener('click', function () {

                document
                    .querySelectorAll('.navigation .nav-link')
                    .forEach(function (item) {
                        item.classList.remove('active');
                    });

                link.classList.add('active');
            });
        });
</script>

</body>
</html>