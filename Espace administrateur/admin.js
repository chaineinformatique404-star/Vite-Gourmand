
document.addEventListener("DOMContentLoaded", function () {

    // ==================================================
    // 1. NAVIGATION ENTRE LES PAGES DU TABLEAU DE BORD
    // ==================================================

    const navLinks = document.querySelectorAll(".nav-link[data-page]");
    const sections = document.querySelectorAll(".page-section");
    const pageTitle = document.getElementById("page-title");

    // Associe un titre à chaque page de l'espace administrateur.
    const titles = {
        dashboard: "Tableau de bord",
        employees: "Gestion des employés",
        orders: "Commandes",
        statistics: "Statistiques"
    };

    // Change la section affichée lorsque l'administrateur clique sur un lien.
    navLinks.forEach(function (link) {
        link.addEventListener("click", function (event) {
            event.preventDefault();

            const page = link.dataset.page;

            // Met à jour le lien actif dans la navigation.
            navLinks.forEach(function (item) {
                item.classList.toggle("active", item === link);
            });

            // Affiche uniquement la section correspondant à la page choisie.
            sections.forEach(function (section) {
                section.classList.toggle("active", section.id === page);
            });

            // Met à jour le titre si l'élément existe.
            if (pageTitle && titles[page]) {
                pageTitle.textContent = titles[page];
            }
        });
    });


    // ==================================================
    // 2. AFFICHAGE DE LA DATE DU JOUR
    // ==================================================

    const currentDate = document.getElementById("current-date");

    if (currentDate) {
        currentDate.textContent = new Intl.DateTimeFormat("fr-FR", {
            dateStyle: "long"
        }).format(new Date());
    }


    // ==================================================
    // 3. CONFIGURATION DES GRAPHIQUES
    // ==================================================

    // Ces données sont transmises par index.php depuis PHP.
    // Données fictives (maquette) : remplacer par les données de la base.
    const chartData = window.adminChartData || {
        labels: ["Tradition", "Végétarien", "Gourmand", "Prestige", "Enfant"],
        orders: [124, 67, 98, 52, 31],
        revenue: [3850, 2140, 3620, 4180, 1370]
    };

    const labels = chartData.labels;
    const orders = chartData.orders;
    const revenue = chartData.revenue;

    // Couleurs utilisées pour distinguer les différents menus.
    const colors = [
        "#b96a3c",
        "#62ad7a",
        "#dc6262",
        "#f3c35b",
        "#5ba7dc",
        "#9b83c5"
    ];

    // Évite une erreur si Chart.js n'est pas chargé.
    if (typeof Chart !== "undefined") {

        // Crée un graphique en barres.
        function makeBarChart(id, data, label, money) {
            const canvas = document.getElementById(id);

            // Ne crée pas de graphique si le canvas n'existe pas.
            if (!canvas) {
                return;
            }

            new Chart(canvas, {
                type: "bar",

                data: {
                    labels: labels,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: colors,
                        borderRadius: 4,
                        maxBarThickness: 54
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    // Masque la légende pour alléger l'affichage.
                    plugins: {
                        legend: {
                            display: false
                        }
                    },

                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                precision: 0
                            },

                            // Ajoute le symbole € pour les montants.
                            ticks: {
                                callback: function (value) {
                                    return money
                                        ? Math.round(value).toLocaleString("fr-FR") + " €"
                                        : Math.round(value);
                                }
                            }
                        },

                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Graphique du nombre de commandes par menu.
        makeBarChart("ordersChart", orders, "Commandes", false);

        // Graphique détaillé du nombre de commandes, si présent dans le HTML.
        makeBarChart("ordersDetailChart", orders, "Commandes", false);

        // Graphique du chiffre d'affaires par menu.
        makeBarChart("combinedChart", revenue, "Chiffre d'affaires (€)", true);


        // ----------------------------------------------
        // Graphique circulaire du chiffre d'affaires
        // ----------------------------------------------

        const revenueCanvas = document.getElementById("revenueChart");

        if (revenueCanvas) {
            new Chart(revenueCanvas, {
                type: "doughnut",

                data: {
                    labels: labels,
                    datasets: [{
                        label: "Chiffre d'affaires (€)",
                        data: revenue,
                        backgroundColor: colors,
                        borderWidth: 2,
                        borderColor: "#ffffff"
                    }]
                },

                options: {
                    responsive: true,
                    maintainAspectRatio: false,

                    plugins: {
                        legend: {
                            position: "bottom",

                            labels: {
                                boxWidth: 10,
                                padding: 12
                            }
                        }
                    }
                }
            });
        }
    }


    // ==================================================
    // 4. OUVERTURE ET FERMETURE DU FORMULAIRE EMPLOYÉ
    // ==================================================

    const dialog = document.getElementById("employee-dialog");
    const form = document.getElementById("employee-form");
    const emailInput = document.getElementById("employee-email");
    const passwordInput = document.getElementById("employee-password");
    const message = document.getElementById("form-message");

    // Ferme la fenêtre et réinitialise le formulaire.
    function closeDialog() {
        if (dialog && dialog.open) {
            dialog.close();
        }

        if (form) {
            form.reset();
        }

        if (message) {
            message.textContent = "";
        }
    }

    // Ouvre la fenêtre de création d'un employé.
    const openCreate = document.getElementById("open-create");

    if (openCreate && dialog) {
        openCreate.addEventListener("click", function () {
            dialog.showModal();
        });
    }

    // Bouton de fermeture de la fenêtre.
    const closeCreate = document.getElementById("close-create");

    if (closeCreate) {
        closeCreate.addEventListener("click", closeDialog);
    }

    // Bouton d'annulation de la création.
    const cancelCreate = document.getElementById("cancel-create");

    if (cancelCreate) {
        cancelCreate.addEventListener("click", closeDialog);
    }


    // ==================================================
    // 5. VÉRIFICATION DU FORMULAIRE EMPLOYÉ
    // ==================================================

    if (form && emailInput && passwordInput && message) {
        form.addEventListener("submit", function (event) {

            // Récupère les valeurs saisies.
            const email = emailInput.value.trim().toLowerCase();
            const password = passwordInput.value;

            // Vérifie que l'adresse e-mail a un format valide.
            const emailIsValid = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

            if (!emailIsValid) {
                event.preventDefault();
                message.textContent = "Veuillez saisir une adresse e-mail valide.";
                return;
            }

            // Vérifie la longueur minimale du mot de passe.
            if (password.length < 10) {
                event.preventDefault();
                message.textContent = "Le mot de passe doit contenir au moins 10 caractères.";
                return;
            }

            // Si les vérifications passent, le formulaire est envoyé à PHP.
            // Le serveur doit ensuite vérifier les données et créer le compte.
            message.textContent = "Envoi du formulaire...";
        });
    }


    // ==================================================
    // 6. RECHERCHE D'UN EMPLOYÉ
    // ==================================================

    const employeeSearch = document.getElementById("employee-search");
    const employeeTable = document.getElementById("employee-table");

    if (employeeSearch && employeeTable) {
        employeeSearch.addEventListener("input", function () {

            // Récupère le texte recherché sans tenir compte des majuscules.
            const query = employeeSearch.value.trim().toLowerCase();

            // Parcourt les lignes du tableau.
            employeeTable.querySelectorAll("tr").forEach(function (row) {
                const emailCell = row.cells[0];

                if (!emailCell) {
                    return;
                }

                // Masque les lignes dont l'e-mail ne correspond pas.
                row.hidden = !emailCell.textContent.toLowerCase().includes(query);
            });
        });
    }


    // ==================================================
    // 7. CONFIRMATION AVANT UNE ACTION SUR UN EMPLOYÉ
    // ==================================================

    // Les boutons doivent être placés dans un formulaire HTML
    // qui envoie l'action à employee-action.php.
    document.querySelectorAll(".toggle-status-form").forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const button = event.submitter;

            if (!button || !button.dataset.confirm) {
                return;
            }

            // Demande une confirmation avant d'activer ou désactiver le compte.
            if (!window.confirm(button.dataset.confirm)) {
                event.preventDefault();
            }
        });
    });

});
0