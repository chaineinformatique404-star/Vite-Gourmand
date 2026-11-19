
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nomAffiche = trim(($_SESSION['prenom'] ?? '') . ' ' . ($_SESSION['nom'] ?? ''));
?>

<!-- ===========================
     BIBLIOTHÈQUES IMAGES ET POLICES
=========================== -->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Alex+Brush&display=swap" rel="stylesheet">


<!-- ===========================
     HEADER
=========================== -->

<header class="header">
    <div class="header-container">

        <a href="../Accueil/accueil.php" class="logo">

            <div class="logo-image"></div>

            <div class="logo-text">
                <strong>Vite & <span>Gourmand</span></strong>
                <span>TRAITEUR ÉVÉNEMENTIEL</span>
            </div>
        </a>

        <nav class="navigation">
            <a href="../Accueil/accueil.php" class="<?= $page === 'accueil' ? 'active' : '' ?>">Accueil</a>
            <a href="../Liste Menu/liste menu.php" class="<?= $page === 'menus' ? 'active' : '' ?>">Nos prestations</a>
            <a href="../Détail Menu/détail menu.php" class="<?= $page === 'detail-menu' ? 'active' : '' ?>">Mon menu</a>
            <a href="../Contact/contact.php" class="<?= $page === 'contact' ? 'active' : '' ?>">Contact</a>
        </nav>

        <div class="header-actions">
            <?php if ($nomAffiche !== ''): ?>
                <a href="/Espace personnel/espace-personnel.php" class="btn-login"><?= htmlspecialchars($nomAffiche, ENT_QUOTES, 'UTF-8') ?></a>
            <?php else: ?>
                <a href="../Connexion/connexion.php" class="btn-login">Connexion</a>
            <?php endif; ?>
            <a href="../Connexion/inscription.php" class="btn-signup" id="open-inscription">S'inscrire</a>
        </div>

    </div>
</header>

<?php require_once __DIR__ . '/inscription-popup.html'; ?>
