
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des horaires | Vite & Gourmand</title>
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
                <a href="plats.php" class="side-link"><span>♨</span> Plats</a>
                <a href="horaires.php" class="side-link active"><span>▦</span> Horaires</a>
                <a href="avis.php" class="side-link"><span>☆</span> Avis clients</a>
                <a href="../Connexion/connexion.php?deconnexion=1" class="side-link logout"><span>⇥</span> Déconnexion</a>
            </nav>
        </aside>

        <main class="main-content">
            <div class="breadcrumb"><a href="espace%20employe.php">Tableau de bord</a> › Horaires</div>

            <section class="welcome">
                <div>
                    <h1>Gestion des horaires</h1>
                    <p>Modifiez les horaires et les disponibilités de l'équipe.</p>
                </div>
            </section>

            <section class="panel">
                <div class="panel-heading">
                    <h2>Horaires hebdomadaires</h2>
                </div>

                <p class="info-message">Les horaires ci-dessous sont des exemples. Vérifiez les disponibilités avant de les publier aux clients.</p>

                <form id="schedule-form">
                    <div class="schedule-list">
                        <div class="schedule-row">
                            <label for="monday">Lundi</label>
                            <input id="monday" type="checkbox" class="day-enabled" checked>
                            <input type="time" value="09:00" aria-label="Ouverture lundi" class="time-field">
                            <span>à</span>
                            <input type="time" value="18:00" aria-label="Fermeture lundi" class="time-field">
                        </div>

                        <div class="schedule-row">
                            <label for="tuesday">Mardi</label>
                            <input id="tuesday" type="checkbox" class="day-enabled" checked>
                            <input type="time" value="09:00" aria-label="Ouverture mardi" class="time-field">
                            <span>à</span>
                            <input type="time" value="18:00" aria-label="Fermeture mardi" class="time-field">
                        </div>

                        <div class="schedule-row">
                            <label for="wednesday">Mercredi</label>
                            <input id="wednesday" type="checkbox" class="day-enabled" checked>
                            <input type="time" value="09:00" aria-label="Ouverture mercredi" class="time-field">
                            <span>à</span>
                            <input type="time" value="18:00" aria-label="Fermeture mercredi" class="time-field">
                        </div>

                        <div class="schedule-row">
                            <label for="thursday">Jeudi</label>
                            <input id="thursday" type="checkbox" class="day-enabled" checked>
                            <input type="time" value="09:00" aria-label="Ouverture jeudi" class="time-field">
                            <span>à</span>
                            <input type="time" value="18:00" aria-label="Fermeture jeudi" class="time-field">
                        </div>

                        <div class="schedule-row">
                            <label for="friday">Vendredi</label>
                            <input id="friday" type="checkbox" class="day-enabled" checked>
                            <input type="time" value="09:00" aria-label="Ouverture vendredi" class="time-field">
                            <span>à</span>
                            <input type="time" value="18:00" aria-label="Fermeture vendredi" class="time-field">
                        </div>

                        <div class="schedule-row">
                            <label for="saturday">Samedi</label>
                            <input id="saturday" type="checkbox" class="day-enabled" checked>
                            <input type="time" value="08:00" aria-label="Ouverture samedi" class="time-field">
                            <span>à</span>
                            <input type="time" value="20:00" aria-label="Fermeture samedi" class="time-field">
                        </div>

                        <div class="schedule-row">
                            <label for="sunday">Dimanche</label>
                            <input id="sunday" type="checkbox" class="day-enabled">
                            <input type="time" value="08:00" aria-label="Ouverture dimanche" class="time-field" disabled>
                            <span>à</span>
                            <input type="time" value="14:00" aria-label="Fermeture dimanche" class="time-field" disabled>
                        </div>
                    </div>

                    <button type="submit" class="primary-button">Enregistrer les horaires</button>
                </form>
            </section>
        </main>
    </div>
    <div id="toast" class="toast" role="status"></div>
</body>
</html>
