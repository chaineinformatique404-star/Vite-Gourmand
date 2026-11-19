
<?php
// Active le typage strict de PHP.
declare(strict_types=1);

// Charge la connexion à la base de données et les fonctions de sécurité.
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/security.php';


// ==================================================
// 1. VÉRIFICATION DE LA MÉTHODE HTTP
// ==================================================

// Autorise uniquement les requêtes POST pour modifier les comptes.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Méthode non autorisée.');
}

// Vérifie que l'utilisateur connecté est administrateur.
requireAdmin();

// Vérifie le jeton CSRF pour protéger le formulaire contre les requêtes frauduleuses.
verifyCsrf();


// ==================================================
// 2. RÉCUPÉRATION DE L'ACTION DEMANDÉE
// ==================================================

// Récupère l'action envoyée par le formulaire : création ou activation/désactivation.
$action = (string) ($_POST['action'] ?? '');

try {

    // ==============================================
    // 3. CRÉATION D'UN COMPTE EMPLOYÉ
    // ==============================================
    if ($action === 'create') {

        // Récupère l'adresse e-mail et vérifie son format.
        $email = filter_var(
            trim((string) ($_POST['email'] ?? '')),
            FILTER_VALIDATE_EMAIL
        );

        // Récupère le mot de passe fourni dans le formulaire.
        $password = (string) ($_POST['password'] ?? '');

        // Refuse les données invalides ou un mot de passe trop court.
        if (!$email || strlen($password) < 10) {
            throw new RuntimeException(
                'Adresse e-mail invalide ou mot de passe trop court.'
            );
        }

        // Vérifie si l'adresse e-mail est déjà utilisée.
        $check = $pdo->prepare(
            'SELECT COUNT(*) FROM utilisateurs WHERE email = ?'
        );
        $check->execute([$email]);

        // Empêche la création de plusieurs comptes avec la même adresse.
        if ((int) $check->fetchColumn() > 0) {
            throw new RuntimeException(
                'Cette adresse e-mail est déjà utilisée.'
            );
        }

        // Prépare l'insertion du nouvel employé dans la base de données.
        $insert = $pdo->prepare(
            'INSERT INTO utilisateurs
            (email, mot_de_passe, role, statut, date_creation)
            VALUES (?, ?, ?, 1, NOW())'
        );

        // Enregistre le compte avec un mot de passe haché et un statut actif.
        $insert->execute([
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            'Employé'
        ]);

        // Prépare le message qui sera affiché après la redirection.
        $_SESSION['flash'] = 'Compte employé créé.';
    }

    // ==============================================
    // 4. ACTIVATION OU DÉSACTIVATION D'UN EMPLOYÉ
    // ==============================================
    elseif ($action === 'toggle') {

        // Récupère et valide l'identifiant du compte.
        $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

        // Récupère le statut demandé : 1 pour actif, 0 pour inactif.
        $active = filter_input(INPUT_POST, 'active', FILTER_VALIDATE_INT);

        // Vérifie que l'identifiant et le statut sont valides.
        if (!$id || !in_array($active, [0, 1], true)) {
            throw new RuntimeException('Paramètres invalides.');
        }

        // Met à jour uniquement un compte dont le rôle correspond à un employé.
        $update = $pdo->prepare(
            'UPDATE utilisateurs
             SET statut = ?
             WHERE id_utilisateur = ?
             AND LOWER(role) IN ("employé", "employe", "employee")'
        );

        // Exécute la modification en base de données.
        $update->execute([$active, $id]);

        // Prépare un message adapté à l'action effectuée.
        $_SESSION['flash'] = $active === 1
            ? 'Compte employé activé.'
            : 'Compte employé désactivé.';
    }

    // ==============================================
    // 5. GESTION DES ACTIONS INCONNUES
    // ==============================================
    else {

        // Refuse toute action qui n'est pas explicitement prévue.
        throw new RuntimeException('Action inconnue.');
    }
}

// Capture les erreurs de validation et affiche leur message.
catch (RuntimeException $exception) {
    $_SESSION['flash'] = $exception->getMessage();
}

// Capture les erreurs liées à la base de données.
catch (PDOException $exception) {

    // Enregistre les détails techniques dans les journaux du serveur.
    error_log('Action employé : ' . $exception->getMessage());

    // Affiche un message général sans révéler les détails techniques.
    $_SESSION['flash'] = 'Impossible de modifier le compte.';
}


// ==================================================
// 6. REDIRECTION VERS LA GESTION DES EMPLOYÉS
// ==================================================

// Retourne à la page d'administration, dans la section des employés.
header('Location: index.php#employees');
exit;
