
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Employé | Vite & Gourmand</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&family=Parisienne&family=Alex+Brush&display=swap" rel="stylesheet">
   
    <link rel="stylesheet" href="espace-employe.css">
    <script src="espace-employe.js" defer></script>
</head>
<body>

    <header class="header">
        <a href="../index.php" class="logo">
            <span>Vite &</span> Gourmand
            <small>TRAITEUR ÉVÉNEMENTIEL</small>
        </a>

        <div class="header-search">
            <label class="search-box">
                <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                <input type="search" placeholder="Rechercher une commande, un menu, une table...">
            </label>
        </div>

        <div class="header-actions">
            <select class="outlet-select" aria-label="Lieu de travail">
                <option>Cuisine centrale</option>
                <option>Salle de réception</option>
                <option>Service livraison</option>
                <option>Tous les lieux</option>
            </select>

            <button class="notification" type="button" aria-label="Notifications">
                <i class="fa-regular fa-bell" aria-hidden="true"></i>
                <span class="notification-badge">3</span>
            </button>

            <button class="account" type="button">
                <span class="avatar-header">JD</span>
                <span class="account-info">Julien D.<small>Employé</small></span>
                <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
            </button>
        </div>
    </header>

    <div class="layout">

        <aside class="sidebar">
            <h2>Espace Employé</h2>

            <nav class="sidebar-nav">
                <a href="espace employe.php" class="side-link active">
                    <span>▦</span> Tableau de bord
                </a>

                <a href="commandes.php" class="side-link">
                    <span>▤</span> Commandes
                    <span class="badge">5</span>
                </a>

                <a href="menus.php" class="side-link">
                    <span>♜</span> Menus
                </a>

                <a href="plats.php" class="side-link">
                    <span>♨</span> Plats
                </a>

                <a href="horaires.php" class="side-link">
                    <span>▦</span> Horaires
                </a>

                <a href="avis.php" class="side-link">
                    <span>☆</span> Avis clients
                    <span class="badge">3</span>
                </a>

                <a href="../Connexion/connexion.php?deconnexion=1" class="side-link logout">
                    <span>⇥</span> Déconnexion
                </a>
            </nav>
        </aside>

        <main class="main-content">

            <div class="breadcrumb">
                <a href="../index.php">Accueil</a>
                <span>›</span>
                Espace employé
            </div>

            <section class="welcome">
                <div>
                    <h1>Bonjour Julien !</h1>
                    <p>Voici un aperçu de l'activité aujourd'hui.</p>
                </div>

                <div class="today">
                    <span>▦</span>
                    <span id="current-date">Aujourd'hui</span>
                </div>
            </section>

            <section class="statistics">

                <article class="stat-card">
                    <div class="stat-icon">🛒</div>
                    <div>
                        <strong>12</strong>
                        <p>Commandes aujourd'hui</p>
                        <small>▲ +3 par rapport à hier</small>
                    </div>
                </article>

                <article class="stat-card">
                    <div class="stat-icon">◷</div>
                    <div>
                        <strong>5</strong>
                        <p>En préparation</p>
                        <small>▲ +2 par rapport à hier</small>
                    </div>
                </article>

                <article class="stat-card">
                    <div class="stat-icon">🚚</div>
                    <div>
                        <strong>3</strong>
                        <p>En cours de livraison</p>
                        <small>▲ +1 par rapport à hier</small>
                    </div>
                </article>

                <article class="stat-card completed">
                    <div class="stat-icon">✓</div>
                    <div>
                        <strong>28</strong>
                        <p>Terminées</p>
                        <small>▲ +6 cette semaine</small>
                    </div>
                </article>

            </section>

            <div class="dashboard-grid">

                <section class="panel orders-panel" id="commandes">

                    <div class="panel-heading">
                        <h2>🛒 Commandes</h2>
                        <a href="commandes.php" class="text-link">
                            Voir toutes les commandes →
                        </a>
                    </div>

                    <div class="filters">

                        <input
                            type="search"
                            id="search-client"
                            placeholder="Rechercher un client..."
                            aria-label="Rechercher un client"
                        >

                        <select id="filter-status" aria-label="Filtrer par statut">
                            <option value="">Tous les statuts</option>
                            <option value="Accepté">Accepté</option>
                            <option value="En préparation">En préparation</option>
                            <option value="En cours de livraison">En cours de livraison</option>
                            <option value="Livré">Livré</option>
                            <option value="En attente du retour de matériel">Retour matériel</option>
                            <option value="Terminée">Terminée</option>
                        </select>

                        <select id="filter-date" aria-label="Filtrer par date">
                            <option value="">Toutes les dates</option>
                            <option value="2026-09-10">10/09/2026</option>
                            <option value="2026-09-09">09/09/2026</option>
                            <option value="2026-09-08">08/09/2026</option>
                        </select>

                        <button type="button" id="reset-filters">
                            Réinitialiser
                        </button>

                    </div>

                    <div class="table-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>N° commande</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Menu</th>
                                    <th>Total</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody id="orders-body">

                                <tr data-client="marie dupont marie@example.fr 0600000001" data-status="En préparation" data-date="2026-09-10">
                                    <td>CMD-0158</td>
                                    <td>10/09/2026</td>
                                    <td>Marie Dupont</td>
                                    <td>Menu Élégance</td>
                                    <td>780,00 €</td>
                                    <td><span class="status preparation">En préparation</span></td>
                                    <td><button class="action-button" data-message="Consulter la commande CMD-0158">◉</button></td>
                                </tr>

                                <tr data-client="thomas bernard thomas@example.fr 0600000002" data-status="Accepté" data-date="2026-09-10">
                                    <td>CMD-0157</td>
                                    <td>10/09/2026</td>
                                    <td>Thomas Bernard</td>
                                    <td>Menu Saveurs</td>
                                    <td>520,00 €</td>
                                    <td><span class="status accepted">Accepté</span></td>
                                    <td><button class="action-button" data-message="Consulter la commande CMD-0157">◉</button></td>
                                </tr>

                                <tr data-client="sophie martin sophie@example.fr 0600000003" data-status="En cours de livraison" data-date="2026-09-09">
                                    <td>CMD-0156</td>
                                    <td>09/09/2026</td>
                                    <td>Sophie Martin</td>
                                    <td>Menu Gourmand</td>
                                    <td>450,00 €</td>
                                    <td><span class="status delivery">En cours de livraison</span></td>
                                    <td><button class="action-button" data-message="Consulter la commande CMD-0156">◉</button></td>
                                </tr>

                                <tr data-client="lucas petit lucas@example.fr 0600000004" data-status="Livré" data-date="2026-09-09">
                                    <td>CMD-0155</td>
                                    <td>09/09/2026</td>
                                    <td>Lucas Petit</td>
                                    <td>Menu Végétarien</td>
                                    <td>600,00 €</td>
                                    <td><span class="status delivered">Livré</span></td>
                                    <td><button class="action-button" data-message="Consulter la commande CMD-0155">◉</button></td>
                                </tr>

                                <tr data-client="camille rousseau camille@example.fr 0600000005" data-status="En attente du retour de matériel" data-date="2026-09-08">
                                    <td>CMD-0154</td>
                                    <td>08/09/2026</td>
                                    <td>Camille Rousseau</td>
                                    <td>Menu Prestige</td>
                                    <td>1 250,00 €</td>
                                    <td><span class="status material">Retour matériel</span></td>
                                    <td><button class="action-button" data-message="Consulter la commande CMD-0154">◉</button></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="table-footer">
                        <span id="orders-count">5 commandes affichées</span>
                        <a href="commandes.php" class="text-link">Toutes les commandes →</a>
                    </div>

                </section>

                <section class="panel reviews-panel" id="avis">

                    <div class="panel-heading">
                        <h2>☆ Avis à traiter</h2>
                        <a href="avis.php" class="text-link">Voir tous les avis →</a>
                    </div>

                    <article class="review">
                        <div class="review-header">
                            <div class="avatar">SM</div>
                            <div>
                                <strong>Sophie Martin</strong>
                                <div class="stars">★★★★☆</div>
                            </div>
                            <small>09/09/2026</small>
                        </div>

                        <p>« Un service excellent et des plats délicieux pour notre mariage. »</p>

                        <div class="review-actions">
                            <button class="validate" data-review-action="validé">Valider</button>
                            <button class="reject" data-review-action="refusé">Refuser</button>
                        </div>
                    </article>

                    <article class="review">
                        <div class="review-header">
                            <div class="avatar">TB</div>
                            <div>
                                <strong>Thomas Bernard</strong>
                                <div class="stars">★★★★☆</div>
                            </div>
                            <small>08/09/2026</small>
                        </div>

                        <p>« Très bonne qualité, équipe professionnelle. »</p>

                        <div class="review-actions">
                            <button class="validate" data-review-action="validé">Valider</button>
                            <button class="reject" data-review-action="refusé">Refuser</button>
                        </div>
                    </article>

                </section>

            </div>

</body>
</html>
