<?php

$host = '127.0.0.1';
$port = '3307';
$dbname = 'vite & gourmand';
$username = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
}

catch (PDOException $e) {
    error_log('Erreur de connexion MySQL : ' . $e->getMessage());

    $pdo = null;

    if (!defined('DB_OPTIONAL')) {
        http_response_code(500);
        exit('Connexion à la base de données impossible.');
    }
}