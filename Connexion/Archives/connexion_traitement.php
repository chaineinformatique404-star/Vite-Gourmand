
<?php
session_start();
require_once __DIR__ . '/../.Base de données/Database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: connexion.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$mot_de_passe = $_POST['mot_de_passe'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $mot_de_passe === '') {
    $_SESSION['erreur_connexion'] = 'Veuillez vérifier vos identifiants.';
    header('Location: connexion.php');
    exit;
}

// Vérifie la complexité du mot de passe : 8 caractères, une majuscule, un chiffre et un caractère spécial.
$motDePasseValide = strlen($mot_de_passe) >= 8
    && preg_match('/[A-Z]/', $mot_de_passe)
    && preg_match('/[0-9]/', $mot_de_passe)
    && preg_match('/[^A-Za-z0-9]/', $mot_de_passe);

if (!$motDePasseValide) {
    $_SESSION['erreur_connexion'] = 'Mot de passe non conforme : 8 caractères minimum, avec une majuscule, un chiffre et un caractère spécial.';
    header('Location: connexion.php');
    exit;
}

$sql = "SELECT id_utilisateur, `prénom` AS prenom, nom, email, mot_de_passe, role
        FROM utilisateurs
        WHERE email = :email
        LIMIT 1";

$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);

$utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
    session_regenerate_id(true);

    $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
    $_SESSION['prenom'] = $utilisateur['prenom'];
    $_SESSION['nom'] = $utilisateur['nom'];
    $_SESSION['email'] = $utilisateur['email'];
    $_SESSION['role'] = $utilisateur['role'];
    $_SESSION['utilisateur_id'] = $utilisateur['id_utilisateur'];

    $role = strtolower(trim((string) $utilisateur['role']));

    if (in_array($role, ['admin', 'administrateur', 'administrat'], true)) {
        header('Location: ../Espace administrateur/index.php');
    }
    elseif (in_array($role, ['employee', 'employe', 'employé'], true)) {
        header('Location: ../Espace employé/espace-employe.html');
    }
    else {
        header('Location: ../Espace personnel/espace-personnel.php');
    }
    exit;
}
else {
    $_SESSION['erreur_connexion'] = 'Adresse e-mail ou mot de passe incorrect.';
    header('Location: connexion.php');
    exit;
}
