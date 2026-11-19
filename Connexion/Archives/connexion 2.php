<?php
session_start();

if (isset($_SESSION['id_utilisateur'])) {
    header('Location: espace_utilisateur.php');
    exit;
}


$erreur = $_SESSION['erreur_connexion'] ?? '';
unset($_SESSION['erreur_connexion']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Vite & Gourmand</title>
    <link rel="stylesheet" href="connexion.css">
</head>
<body>

<header class="header">
    <a href="index.php" class="logo">
        <span class="logo-icon">♨</span>
        <span>
            Vite & Gourmand
            <small>TRAITEUR ÉVÉNEMENTIEL</small>
        </span>
    </a>

    <nav>
        <a href="index.php">Accueil</a>
        <a href="liste_menus.php">Nos menus</a>
        <a href="apropos.php">À propos</a>
        <a href="contact.php">Contact</a>
    </nav>

    <a href="connexion.php" class="header-button">Connexion</a>
</header>

<main class="connexion-container">

 

    <section class="connexion-form">
        <h1>Connexion</h1>
        <p class="intro">
            Accédez à votre espace client et profitez
            de nos menus et services.
        </p>

        <?php if ($erreur !== ''): ?>
            <p class="erreur"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>

        <form action="connexion_traitement.php" method="POST">

            <label class="champ">
                <span class="champ-icon">✉</span>
                <input
                    type="email"
                    name="email"
                    placeholder="Adresse e-mail"
                    autocomplete="email"
                    required
                >
            </label>

            <label class="champ">
                <span class="champ-icon">⚿</span>
                <input
                    type="password"
                    name="mot_de_passe"
                    placeholder="Mot de passe"
                    autocomplete="current-password"
                    required
                >
            </label>

            <div class="options">
                <label class="souvenir">
                    <input type="checkbox" name="souvenir">
                    Se souvenir de moi
                </label>

                <a href="mot_de_passe_oublie.php">
                    Mot de passe oublié ?
                </a>
            </div>

            <button type="submit" class="bouton-connexion">
                Se connecter <span>→</span>
            </button>

        </form>

        <div class="separateur"><span>ou</span></div>

        <p class="inscription">
            Pas encore de compte ?
            <a href="inscription.php">Créer un compte</a>
        </p>
    </section>

    <section class="connexion-image">
        <img src="images/buffet.png" class="connexion-fond" alt="Image de connexion">
        <div class="image-texte">
            <p>Le goût</p>
            <p>des bons moments.</p>
        </div>
    </section>

  
</main>

</body>
</html>

// Ces lignes de code me provoquaient une redirection infinie, je les ai donc supprimées

if (isset($_SESSION['id_utilisateur'])) {
    $roleSession = strtolower(trim((string) ($_SESSION['role'] ?? '')));

    if (in_array($roleSession, ['admin', 'administrateur', 'administrat'], true)) {
        header('Location: ../Espace administrateur/admin.php');
    }
    elseif (in_array($roleSession, ['employee', 'employe', 'employé'], true)) {
        header('Location: ../Espace employé/espace-employe.html');
    }
    else {
        header('Location: ../Espace personnel/espace-personnel.php');
    }
    exit;
}