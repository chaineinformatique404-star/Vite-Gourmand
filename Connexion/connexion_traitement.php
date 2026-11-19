
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: connexion.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$mot_de_passe = $_POST['mot_de_passe'] ?? '';

if ($email === '' || $mot_de_passe === '') {
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

// Comptes de test codés en dur (sans base de données).
$comptes = [
    'andouilette@hotmail.fin' => ['id_utilisateur' => 1, 'prenom' => 'Julie', 'nom' => 'Andrieu', 'role' => 'administrat'],
    'josé.fernando@assitant.miam' => ['id_utilisateur' => 2, 'prenom' => 'José', 'nom' => 'Fernando', 'role' => 'employee'],
    'jeanmiche@hotmail.zut' => ['id_utilisateur' => 5, 'prenom' => 'Kévin', 'nom' => 'Dupont', 'role' => 'client'],
];

// Mots de passe attendus pour chaque compte de test.
$motsDePasse = [
    'andouilette@hotmail.fin' => 'Admin123!',
    'josé.fernando@assitant.miam' => 'Employe123!',
    'jeanmiche@hotmail.zut' => 'Client123!',
];

$cle = mb_strtolower($email);
$utilisateur = $comptes[$cle] ?? null;

if ($utilisateur !== null && !hash_equals($motsDePasse[$cle], $mot_de_passe)) {
    $utilisateur = null;
}

if ($utilisateur !== null) {
    session_regenerate_id(true);

    $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
    $_SESSION['prenom'] = $utilisateur['prenom'];
    $_SESSION['nom'] = $utilisateur['nom'];
    $_SESSION['email'] = $cle;
    $_SESSION['role'] = $utilisateur['role'];
    $_SESSION['utilisateur_id'] = $utilisateur['id_utilisateur'];

    $role = strtolower(trim((string) $utilisateur['role']));

    if (in_array($role, ['admin', 'administrateur', 'administrat'], true)) {
        header('Location: ../Espace administrateur/admin.php');
    }
    elseif (in_array($role, ['employee', 'employe', 'employé'], true)) {
        header('Location: ../Espace employé/espace employe.php');
    }
    else {
        header('Location: ../Espace personnel/espace perso.php');
    }
    exit;
}
else {
    $_SESSION['erreur_connexion'] = 'Adresse e-mail ou mot de passe incorrect.';
    header('Location: connexion.php');
    exit;
}
