VITE & GOURMAND — ESPACE ADMINISTRATEUR (base de travail)

IMPORTANT
Ce paquet est un socle d'intégration PHP/MySQL/MongoDB. Il ne peut pas être considéré comme connecté à votre site tant que les noms exacts de vos colonnes et votre système de session n'ont pas été vérifiés. Faites une copie de sauvegarde avant intégration.

1) Copiez le dossier dans votre projet XAMPP, par exemple :
   C:\xampp\htdocs\Vite & Gourmand\admin

2) Configurez config/database.php :
   - hôte MySQL : 127.0.0.1
   - port : 3307 (à confirmer dans votre XAMPP)
   - nom de base : mettez le nom exact de votre base. Évitez les espaces si vous pouvez la renommer.
   - identifiants MySQL : vos propres paramètres.

3) Vérifiez les colonnes de la table utilisateurs. Le code s'attend à :
   utilisateur_id, email, password, role_id, actif
   et à une table roles(role_id, libelle).
   Si votre schéma diffère, adaptez config/schema.php. Le mot de passe doit être stocké avec password_hash().

4) Créez l'administrateur initial manuellement, une seule fois, dans la base de données ou via un script de création protégé hors web. Ne créez pas de formulaire public de création d'administrateur.
   Le compte administrateur doit avoir le rôle dont le libellé est "administrateur" (ou "admin") et actif=1.

5) Connectez votre page de connexion existante :
   après vérification du mot de passe avec password_verify(), stockez en session :
   $_SESSION['utilisateur_id'], $_SESSION['email'], $_SESSION['role'].
   Puis redirigez les administrateurs vers admin/index.php.
   N'utilisez jamais uniquement une variable envoyée par le navigateur pour décider du rôle.

6) MongoDB :
   - Installez l'extension PHP MongoDB puis la bibliothèque Composer :
       composer require mongodb/mongodb
   - Démarrez MongoDB et configurez config/database.php.
   - La collection par défaut est "statistiques_commandes".
   - Le code enregistre/agrège des documents statistiques dans MongoDB. Les commandes source restent dans MySQL, sauf architecture différente déjà validée.
   - Si l'énoncé exige que les données statistiques soient stockées dans une base non relationnelle, documentez précisément quelles données y sont enregistrées et comment elles sont synchronisées.

7) E-mails :
   Configurez un serveur SMTP avec PHPMailer (composer require phpmailer/phpmailer) avant d'activer l'envoi réel.
   Sans SMTP, le code n'envoie aucun e-mail. Il ne met jamais le mot de passe dans le message.

8) Sécurité à compléter/tester avant production :
   - HTTPS, paramètres SMTP, secrets hors dépôt public.
   - Vérifier les rôles de votre base, les noms de colonnes et la politique de réinitialisation du mot de passe.
   - Tester les opérations avec un compte admin et un compte employé.
   - Ne pas publier les erreurs SQL ni les identifiants.

Fonctionnalités fournies : tableau de bord, gestion des employés, création/activation/désactivation, graphiques, filtres de période/menu, agrégats statistiques MongoDB et journalisation des événements.
