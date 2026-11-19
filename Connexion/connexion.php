<?php
session_start();

// Déconnexion : vide la session avant d'afficher la page de connexion.
if (isset($_GET['deconnexion'])) {
    $_SESSION = [];
    session_destroy();
    session_start();
}




$erreur = $_SESSION['erreur_connexion'] ?? '';
unset($_SESSION['erreur_connexion']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="connexion.css">
    <style>.mdp-message { margin-top:14px; color:#216e39; font-size:14px; } .mdp-message:empty { display:none; } .retour-accueil { display:inline-block; margin-bottom:14px; color:#b47a24; font-size:14px; font-weight:600; } .retour-accueil:hover { text-decoration:underline; }</style>
</head>
<body>



<main class="connexion-container">

 

    <section class="connexion-form">
        <a href="../Accueil/accueil.php" class="retour-accueil">← Retour à l'accueil</a>
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

                <a href="mot_de_passe_oublie.php" id="mdp-oublie">
                    Mot de passe oublié ?
                </a>
            </div>

            <button type="submit" class="bouton-connexion">
                Se connecter <span>→</span>
            </button>

        </form>

        <p class="mdp-message" id="mdp-message" role="status"></p>

        <div class="separateur"><span>ou</span></div>

        <p class="inscription">
            Pas encore de compte ?
            <a href="../Connexion/inscription.php" data-open-inscription>Créer un compte</a>
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

<?php require_once __DIR__ . '/../.Composants/inscription-popup.html'; ?>

<script>
    document.getElementById('mdp-oublie').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('mdp-message').textContent = 'Un message a été envoyé sur votre adresse e-mail.';
    });
</script>
</body>
</html>
