<?php
session_start();

require_once __DIR__ . '/../.Base de données/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    $motDePasseValide = strlen($mot_de_passe) >= 8
        && preg_match('/[A-Z]/', $mot_de_passe)
        && preg_match('/[0-9]/', $mot_de_passe)
        && preg_match('/[^A-Za-z0-9]/', $mot_de_passe);

    if (!$motDePasseValide) {
        $erreur = 'Mot de passe non conforme.';
    }
    else {
        // Suite du traitement de l'inscription
        // Vérification de l'adresse e-mail
        // Enregistrement du compte dans la BDD
    }
}
?>