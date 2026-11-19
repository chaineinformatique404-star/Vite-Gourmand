<?php
declare(strict_types=1);


// ==========================================
// 1. CONNEXION À LA BASE DE DONNÉES
// ==========================================

require_once __DIR__ . '/../.Base de données/Database.php';

// ==========================================
// 2. CONFIGURATION DU SCHÉMA
// ==========================================

$schema = [

    // Utilisateurs

    'users_table' => 'utilisateurs',
    'user_id' => 'id_utilisateur',
    'user_name' => 'nom',
    'user_firstname' => 'prénom',
    'user_email' => 'email',
    'user_password' => 'mot_de_passe',
    'user_phone' => 'telephone',
    'user_role' => 'role',
    'user_active' => 'statut',
    'user_created_at' => 'date_creation',

    // Menus

    'menus_table' => 'menus',
    'menu_id' => 'id_menu',
    'menu_name' => 'nom',
    'menu_price' => 'prix',

    // Commandes

    'orders_table' => 'commandes',
    'order_id' => 'id_commande',
    'order_user_id' => 'id_utilisateur',
    'order_menu_id' => 'id_menu',
    'order_date' => 'date',
    'order_total' => 'prix_total',
    'order_status' => 'statut',

];
