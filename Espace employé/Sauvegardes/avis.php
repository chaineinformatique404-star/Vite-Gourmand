
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis clients | Vite & Gourmand</title>
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
                <a href="menus.html" class="side-link"><span>♜</span> Menus</a>
                <a href="plats.html" class="side-link"><span>♨</span> Plats</a>
                <a href="horaires.html" class="side-link"><span>▦</span> Horaires</a>
                <a href="avis.html" class="side-link active"><span>☆</span> Avis clients</a>
                <a href="../connexion.html" class="side-link logout"><span>⇥</span> Déconnexion</a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="breadcrumb"><a href="espace-employe.html">Tableau de bord</a> › Avis clients</div>

            <section class="welcome">
                <div>
                    <h1>Avis clients</h1>
                    <p>Modérez les avis avant leur publication sur la page d'accueil.</p>
                </div>
            </section>

            <section class="statistics review-statistics">
                <article class="stat-card">
                    <div class="stat-icon">◷</div>
                    <div><strong id="pending-count">2</strong><p>En attente</p></div>
                </article>
                <article class="stat-card completed">
                    <div class="stat-icon">✓</div>
                    <div><strong>12</strong><p>Avis validés</p></div>
                </article>
                <article class="stat-card">
                    <div class="stat-icon">✕</div>
                    <div><strong>2</strong><p>Avis refusés</p></div>
                </article>
            </section>

            <section class="panel">
                <div class="filters">
                    <input type="search" id="search-review" placeholder="Rechercher un client...">
                    <select id="filter-review-status">
                        <option value="En attente">En attente</option>
                        <option value="Validé">Validés</option>
                        <option value="Refusé">Refusés</option>
                        <option value="">Tous les avis</option>
                    </select>
                </div>

                <div class="review-list" id="review-list">
                    <article class="review review-item" data-name="sophie martin" data-review-status="En attente">
                        <div class="review-header">
                            <div class="avatar">SM</div>
                            <div>
                                <strong>Sophie Martin</strong>
                                <div class="stars">★★★★★</div>
                            </div>
                            <small>09/09/2026</small>
                        </div>
                        <p>Menu : Menu Élégance</p>
                        <blockquote>« Un service excellent et des plats délicieux pour notre mariage. Je recommande vivement ! »</blockquote>
                        <div class="review-actions">
                            <button type="button" class="validate" data-moderate="Validé">Valider l'avis</button>
                            <button type="button" class="reject" data-moderate="Refusé">Refuser l'avis</button>
                        </div>
                        <span class="review-status-label">En attente</span>
                    </article>

                    <article class="review review-item" data-name="thomas bernard" data-review-status="En attente">
                        <div class="review-header">
                            <div class="avatar">TB</div>
                            <div>
                                <strong>Thomas Bernard</strong>
                                <div class="stars">★★★★☆</div>
                            </div>
                            <small>08/09/2026</small>
                        </div>
                        <p>Menu : Menu Saveurs</p>
                        <blockquote>« Très bonne qualité, équipe professionnelle. »</blockquote>
                        <div class="review-actions">
                            <button type="button" class="validate" data-moderate="Validé">Valider l'avis</button>
                            <button type="button" class="reject" data-moderate="Refusé">Refuser l'avis</button>
                        </div>
                        <span class="review-status-label">En attente</span>
                    </article>
                </div>
            </section>
        </main>
    </div>
    <div id="toast" class="toast" role="status"></div>
</body>
</html>
