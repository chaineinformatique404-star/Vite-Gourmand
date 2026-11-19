<?php
declare(strict_types=1);

require_once __DIR__ . '/database.php';

// Récupérer les comptes de test
$requete = $pdo->query(
    'SELECT id_utilisateur, email, mot_de_passe
     FROM utilisateurs'
);

$utilisateurs = $requete->fetchAll();

foreach ($utilisateurs as $utilisateur) {
    $motDePasse = $utilisateur['mot_de_passe'];

    // Ignorer les mots de passe déjà hachés
    if (password_get_info($motDePasse)['algo'] !== null && password_get_info($motDePasse)['algo'] !== 0) {
    continue;
}

    $hash = password_hash($motDePasse, PASSWORD_DEFAULT);

    $miseAJour = $pdo->prepare(
        'UPDATE utilisateurs
         SET mot_de_passe = :mot_de_passe
         WHERE id_utilisateur = :id_utilisateur'
    );

    $miseAJour->execute([
        'mot_de_passe' => $hash,
        'id_utilisateur' => $utilisateur['id_utilisateur']
    ]);

    echo 'Mot de passe sécurisé pour : '
        . htmlspecialchars($utilisateur['email'], ENT_QUOTES, 'UTF-8')
        . '<br>';
}

echo '<p>Opération terminée.</p>';
