
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des plats | Vite & Gourmand</title>
    <link rel="stylesheet" href="espace-employe.css">
    <script src="espace-employe.js?v=3" defer></script>
</head>
<body>
    <header class="header">
        <a href="../index.html" class="logo"><span>Vite &</span> Gourmand<small>TRAITEUR ÉVÉNEMENTIEL</small></a>
        <nav class="navigation">
            <a href="../index.html">Accueil</a>
            <a href="../menus.html">Nos menus</a>
            <a href="../apropos.html">À propos</a>
            <a href="../contact.html">Contact</a>
        </nav>
        <div class="header-actions"><span class="avatar-header">JD</span><span>Julien D.<small>Employé</small></span></div>
    </header>

    <div class="layout">
        <aside class="sidebar">
            <h2>Espace Employé</h2>
            <nav class="sidebar-nav">
                <a href="espace%20employe.php" class="side-link"><span>⌂</span> Tableau de bord</a>
                <a href="commandes.php" class="side-link"><span>▤</span> Commandes</a>
                <a href="menus.php" class="side-link"><span>♜</span> Menus</a>
                <a href="plats.php" class="side-link active"><span>♨</span> Plats</a>
                <a href="horaires.php" class="side-link"><span>▦</span> Horaires</a>
                <a href="avis.php" class="side-link"><span>☆</span> Avis clients</a>
                <a href="../Connexion/connexion.php?deconnexion=1" class="side-link logout"><span>⇥</span> Déconnexion</a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="breadcrumb"><a href="espace%20employe.php">Tableau de bord</a> › Plats</div>

            <section class="welcome">
                <div>
                    <h1>Gestion des plats</h1>
                    <p>Gérez les plats et leurs informations alimentaires.</p>
                </div>
                <button class="primary-button" type="button" data-message="Formulaire de création à réaliser">+ Nouveau plat</button>
            </section>

            <section class="panel">
                <div class="filters">
                    <input type="search" id="search-dish" placeholder="Rechercher un plat...">
                    <select id="filter-dish-type">
                        <option value="">Tous les types</option>
                        <option>Entrée</option>
                        <option>Plat</option>
                        <option>Dessert</option>
                    </select>
                    <select id="filter-dish-diet">
                        <option value="">Tous les régimes</option>
                        <option>Normal</option>
                        <option>Végétarien</option>
                        <option>Végétalien</option>
                    </select>
                    <button type="button" id="reset-dish-filters">Réinitialiser</button>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom du plat</th>
                                <th>Type</th>
                                <th>Régime</th>
                                <th>Allergènes</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="dishes-body">
                            <tr data-name="saumon fumé et agrumes" data-type="Entrée" data-diet="Normal">
                                <td>Saumon fumé et agrumes</td><td>Entrée</td><td>Normal</td><td>Poisson</td>
                                <td><button class="action-button" data-message="Modification du plat à réaliser">Modifier</button> <button class="action-button" data-message="Suppression à confirmer">Supprimer</button></td>
                            </tr>
                            <tr data-name="filet de boeuf sauce truffe" data-type="Plat" data-diet="Normal">
                                <td>Filet de bœuf sauce truffe</td><td>Plat</td><td>Normal</td><td>Lait</td>
                                <td><button class="action-button" data-message="Modification du plat à réaliser">Modifier</button> <button class="action-button" data-message="Suppression à confirmer">Supprimer</button></td>
                            </tr>
                            <tr data-name="tartare de légumes de saison" data-type="Entrée" data-diet="Végétarien">
                                <td>Tartare de légumes de saison</td><td>Entrée</td><td>Végétarien</td><td>Aucun renseigné</td>
                                <td><button class="action-button" data-message="Modification du plat à réaliser">Modifier</button> <button class="action-button" data-message="Suppression à confirmer">Supprimer</button></td>
                            </tr>
                            <tr data-name="tarte au citron meringuée" data-type="Dessert" data-diet="Végétarien">
                                <td>Tarte au citron meringuée</td><td>Dessert</td><td>Végétarien</td><td>Gluten, œufs, lait</td>
                                <td><button class="action-button" data-message="Modification du plat à réaliser">Modifier</button> <button class="action-button" data-message="Suppression à confirmer">Supprimer</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="muted-text">Les plats et allergènes sont des exemples à remplacer par les données réelles.</p>
            </section>
        </main>
    </div>
    <div class="modal" id="modal" hidden>
        <div class="modal-dialog" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <div class="modal-header">
                <h2 id="modal-title"></h2>
                <button type="button" class="modal-close" id="modal-close" aria-label="Fermer">×</button>
            </div>
            <div class="modal-body" id="modal-body"></div>
        </div>
    </div>
    <div id="toast" class="toast" role="status"></div>
</body>
</html>
