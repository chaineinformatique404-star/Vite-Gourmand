
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des menus | Vite & Gourmand</title>
    <link rel="stylesheet" href="espace-employe.css">
    <script src="espace-employe.js" defer></script>
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
                <a href="espace-employe.html" class="side-link"><span>⌂</span> Tableau de bord</a>
                <a href="commandes.html" class="side-link"><span>▤</span> Commandes</a>
                <a href="menus.html" class="side-link active"><span>♜</span> Menus</a>
                <a href="plats.html" class="side-link"><span>♨</span> Plats</a>
                <a href="horaires.html" class="side-link"><span>▦</span> Horaires</a>
                <a href="avis.html" class="side-link"><span>☆</span> Avis clients</a>
                <a href="../connexion.html" class="side-link logout"><span>⇥</span> Déconnexion</a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="breadcrumb"><a href="espace-employe.html">Tableau de bord</a> › Menus</div>

            <section class="welcome">
                <div>
                    <h1>Gestion des menus</h1>
                    <p>Ajoutez, modifiez ou supprimez les menus proposés aux clients.</p>
                </div>
                <button class="primary-button" type="button" data-message="Formulaire de création à réaliser">+ Nouveau menu</button>
            </section>

            <section class="panel">
                <div class="filters">
                    <input type="search" id="search-menu" placeholder="Rechercher un menu...">
                    <select id="filter-menu-theme">
                        <option value="">Tous les thèmes</option>
                        <option>Classique</option>
                        <option>Gastronomique</option>
                        <option>Végétarien</option>
                    </select>
                    <button type="button" id="reset-menu-filters">Réinitialiser</button>
                </div>

                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nom du menu</th>
                                <th>Thème</th>
                                <th>Personnes min.</th>
                                <th>Prix / personne</th>
                                <th>Disponibilité</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="menus-body">
                            <tr data-name="menu élégance" data-theme="Classique">
                                <td>Menu Élégance</td><td>Classique</td><td>30</td><td>26,00 €</td>
                                <td><span class="status accepted">Disponible</span></td>
                                <td><button class="action-button" data-message="Modification du Menu Élégance à réaliser">Modifier</button> <button class="action-button" data-message="Suppression à confirmer">Supprimer</button></td>
                            </tr>
                            <tr data-name="menu saveurs" data-theme="Gastronomique">
                                <td>Menu Saveurs</td><td>Gastronomique</td><td>20</td><td>24,00 €</td>
                                <td><span class="status accepted">Disponible</span></td>
                                <td><button class="action-button" data-message="Modification du Menu Saveurs à réaliser">Modifier</button> <button class="action-button" data-message="Suppression à confirmer">Supprimer</button></td>
                            </tr>
                            <tr data-name="menu gourmand" data-theme="Classique">
                                <td>Menu Gourmand</td><td>Classique</td><td>15</td><td>30,00 €</td>
                                <td><span class="status accepted">Disponible</span></td>
                                <td><button class="action-button" data-message="Modification du Menu Gourmand à réaliser">Modifier</button> <button class="action-button" data-message="Suppression à confirmer">Supprimer</button></td>
                            </tr>
                            <tr data-name="menu végétarien" data-theme="Végétarien">
                                <td>Menu Végétarien</td><td>Végétarien</td><td>10</td><td>22,00 €</td>
                                <td><span class="status accepted">Disponible</span></td>
                                <td><button class="action-button" data-message="Modification du Menu Végétarien à réaliser">Modifier</button> <button class="action-button" data-message="Suppression à confirmer">Supprimer</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="muted-text">Les menus présentés sont des exemples statiques.</p>
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
