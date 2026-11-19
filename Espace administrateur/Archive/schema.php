<?php
declare(strict_types=1);

/*
 * Adaptez ces noms à la structure réelle de votre base MySQL.
 * Les noms ci-dessous correspondent au modèle de travail connu pour le projet.
 */
return [
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

    'menus_table' => 'menus',
    'menu_id' => 'id_menu',
    'menu_name' => 'nom',
    'menu_price' => 'prix',

    'orders_table' => 'commandes',
    'order_id' => 'id_commande',
    'order_menu_id' => 'id_menu',
    'order_date' => 'date_commande',
    'order_total' => 'prix_total',
    'order_status' => 'statut',
];