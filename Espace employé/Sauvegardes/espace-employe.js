
/* ==================================================
   1. NOTIFICATIONS ET MESSAGES
   ================================================== */

// Récupère la notification si elle existe sur la page actuelle.

const toast = document.getElementById("toast");

let toastTimeout;

// Affiche un message temporaire dans l'interface.

function showToast(message) {
    if (!toast) {
        return;
    }

    toast.textContent = message;
    toast.classList.add("show");

    clearTimeout(toastTimeout);

    toastTimeout = setTimeout(() => {
        toast.classList.remove("show");
    }, 2800);
}


/* ==================================================
   2. DATE DU TABLEAU DE BORD
   ================================================== */

// Affiche la date du jour uniquement si l'élément existe.

const currentDate = document.getElementById("current-date");

if (currentDate) {
    currentDate.textContent = new Intl.DateTimeFormat("fr-FR", {
        weekday: "long",
        day: "numeric",
        month: "long",
        year: "numeric"
    }).format(new Date());
}


/* ==================================================
   3. RECHERCHE ET FILTRES DES COMMANDES
   ================================================== */

// Récupère les champs de recherche, les filtres et le tableau.

const searchClient = document.getElementById("search-client");
const filterStatus = document.getElementById("filter-status");
const filterDate = document.getElementById("filter-date");
const resetFilters = document.getElementById("reset-filters");
const ordersBody = document.getElementById("orders-body");
const ordersCount = document.getElementById("orders-count");

// Active le filtrage uniquement sur les pages contenant le tableau.

if (ordersBody && searchClient && filterStatus) {
    const rows = [...ordersBody.querySelectorAll("tr")];

    // Compare chaque commande aux critères sélectionnés.

    function filterOrders() {
        const search = searchClient.value.trim().toLocaleLowerCase("fr");
        const status = filterStatus.value;
        const date = filterDate ? filterDate.value : "";

        let visible = 0;

        rows.forEach(row => {
            const client = (row.dataset.client || "").toLocaleLowerCase("fr");
            const rowStatus = row.dataset.status || "";
            const rowDate = row.dataset.date || "";

            const matchesSearch = client.includes(search);
            const matchesStatus = !status || rowStatus === status;
            const matchesDate = !date || rowDate === date;

            const matches = matchesSearch && matchesStatus && matchesDate;

            row.hidden = !matches;

            if (matches) {
                visible++;
            }
        });

        // Actualise le nombre de commandes visibles.

        if (ordersCount) {
            ordersCount.textContent =
                `${visible} commande${visible > 1 ? "s" : ""} affichée${visible > 1 ? "s" : ""}`;
        }
    }

    // Relance le filtrage lors d'une modification des champs.

    searchClient.addEventListener("input", filterOrders);
    filterStatus.addEventListener("change", filterOrders);

    if (filterDate) {
        filterDate.addEventListener("change", filterOrders);
    }

    // Réinitialise tous les filtres.

    if (resetFilters) {
        resetFilters.addEventListener("click", () => {
            searchClient.value = "";
            filterStatus.value = "";

            if (filterDate) {
                filterDate.value = "";
            }

            filterOrders();
        });
    }

    filterOrders();
}


/* ==================================================
   4. RECHERCHE ET FILTRES DES MENUS
   ================================================== */

// Récupère les éléments propres à la page des menus.

const searchMenu = document.getElementById("search-menu");
const filterMenuTheme = document.getElementById("filter-menu-theme");
const resetMenuFilters = document.getElementById("reset-menu-filters");
const menusBody = document.getElementById("menus-body");

if (searchMenu && menusBody) {
    const rows = [...menusBody.querySelectorAll("tr")];

    // Affiche uniquement les menus correspondant aux filtres.

    function filterMenus() {
        const search = searchMenu.value.trim().toLocaleLowerCase("fr");
        const theme = filterMenuTheme ? filterMenuTheme.value : "";

        rows.forEach(row => {
            const name = (row.dataset.name || "").toLocaleLowerCase("fr");
            const rowTheme = row.dataset.theme || "";

            const matchesSearch = name.includes(search);
            const matchesTheme = !theme || rowTheme === theme;

            row.hidden = !(matchesSearch && matchesTheme);
        });
    }

    searchMenu.addEventListener("input", filterMenus);

    if (filterMenuTheme) {
        filterMenuTheme.addEventListener("change", filterMenus);
    }

    // Efface la recherche et le thème sélectionné.

    if (resetMenuFilters) {
        resetMenuFilters.addEventListener("click", () => {
            searchMenu.value = "";

            if (filterMenuTheme) {
                filterMenuTheme.value = "";
            }

            filterMenus();
        });
    }

    filterMenus();
}


/* ==================================================
   5. RECHERCHE ET FILTRES DES PLATS
   ================================================== */

// Récupère les champs de recherche des plats.

const searchDish = document.getElementById("search-dish");
const filterDishType = document.getElementById("filter-dish-type");
const filterDishDiet = document.getElementById("filter-dish-diet");
const resetDishFilters = document.getElementById("reset-dish-filters");
const dishesBody = document.getElementById("dishes-body");

if (searchDish && dishesBody) {
    const rows = [...dishesBody.querySelectorAll("tr")];

    // Filtre les plats par nom, type et régime alimentaire.

    function filterDishes() {
        const search = searchDish.value.trim().toLocaleLowerCase("fr");
        const type = filterDishType ? filterDishType.value : "";
        const diet = filterDishDiet ? filterDishDiet.value : "";

        rows.forEach(row => {
            const name = (row.dataset.name || "").toLocaleLowerCase("fr");
            const rowType = row.dataset.type || "";
            const rowDiet = row.dataset.diet || "";

            const matchesSearch = name.includes(search);
            const matchesType = !type || rowType === type;
            const matchesDiet = !diet || rowDiet === diet;

            row.hidden = !(matchesSearch && matchesType && matchesDiet);
        });
    }

    searchDish.addEventListener("input", filterDishes);

    if (filterDishType) {
        filterDishType.addEventListener("change", filterDishes);
    }

    if (filterDishDiet) {
        filterDishDiet.addEventListener("change", filterDishes);
    }

    // Réinitialise les trois critères de recherche.

    if (resetDishFilters) {
        resetDishFilters.addEventListener("click", () => {
            searchDish.value = "";

            if (filterDishType) {
                filterDishType.value = "";
            }

            if (filterDishDiet) {
                filterDishDiet.value = "";
            }

            filterDishes();
        });
    }

    filterDishes();
}


/* ==================================================
   6. ACTIVATION ET DESACTIVATION DES HORAIRES
   ================================================== */

// Désactive les champs horaires lorsque le jour est fermé.

document.querySelectorAll(".schedule-row").forEach(row => {
    const checkbox = row.querySelector(".day-enabled");
    const times = row.querySelectorAll('input[type="time"]');

    if (checkbox) {
        function updateDay() {
            times.forEach(input => {
                input.disabled = !checkbox.checked;
            });
        }

        checkbox.addEventListener("change", updateDay);

        // Applique l'état initial du jour.

        updateDay();
    }
});


/* ==================================================
   7. ENREGISTREMENT DEMONSTRATIF DES HORAIRES
   ================================================== */

// Empêche le rechargement du formulaire.
// Aucun enregistrement permanent n'est effectué sans serveur.

const scheduleForm = document.getElementById("schedule-form");

if (scheduleForm) {
    scheduleForm.addEventListener("submit", event => {
        event.preventDefault();

        showToast("Démonstration : les horaires ne sont pas encore enregistrés.");
    });
}


/* ==================================================
   8. RECHERCHE ET FILTRES DES AVIS
   ================================================== */

// Récupère les éléments de la page de modération.

const reviewList = document.getElementById("review-list");
const searchReview = document.getElementById("search-review");
const filterReviewStatus = document.getElementById("filter-review-status");
const pendingCount = document.getElementById("pending-count");

if (reviewList) {
    // Affiche les avis correspondant au nom et au statut choisis.

    function filterReviews() {
        const search = searchReview
            ? searchReview.value.trim().toLocaleLowerCase("fr")
            : "";

        const status = filterReviewStatus ? filterReviewStatus.value : "";
        const reviews = [...reviewList.querySelectorAll(".review-item")];

        reviews.forEach(review => {
            const name = (review.dataset.name || "").toLocaleLowerCase("fr");
            const reviewStatus = review.dataset.reviewStatus || "";

            const matchesSearch = name.includes(search);
            const matchesStatus = !status || reviewStatus === status;

            review.hidden = !(matchesSearch && matchesStatus);
        });
    }

    if (searchReview) {
        searchReview.addEventListener("input", filterReviews);
    }

    if (filterReviewStatus) {
        filterReviewStatus.addEventListener("change", filterReviews);
    }

    // Traite la validation ou le refus d'un avis.

    reviewList.addEventListener("click", event => {
        const button = event.target.closest("[data-moderate]");

        if (!button) {
            return;
        }

        const review = button.closest(".review-item");

        if (!review || review.dataset.reviewStatus !== "En attente") {
            return;
        }

        const newStatus = button.dataset.moderate;
        const name = review.dataset.name;

        // Modifie uniquement le statut affiché dans le navigateur.

        review.dataset.reviewStatus = newStatus;

        const label = review.querySelector(".review-status-label");

        if (label) {
            label.textContent = newStatus;
        }

        // Empêche de traiter plusieurs fois le même avis.

        review.querySelectorAll("[data-moderate]").forEach(action => {
            action.disabled = true;
        });

        // Actualise le nombre d'avis en attente.

        if (pendingCount) {
            const pending = reviewList.querySelectorAll(
                '.review-item[data-review-status="En attente"]'
            ).length;

            pendingCount.textContent = pending;
        }

        showToast(`Avis de ${name} : ${newStatus.toLowerCase()} en démonstration.`);

        filterReviews();
    });

    filterReviews();
}


/* ==================================================
   9. BOUTONS DE DEMONSTRATION
   ================================================== */

// Affiche un message pour les actions qui ne sont pas encore développées.
// Cette partie concerne notamment les boutons Modifier, Supprimer et Voir.

const modal = document.getElementById("modal");
const modalTitle = document.getElementById("modal-title");
const modalBody = document.getElementById("modal-body");
const modalClose = document.getElementById("modal-close");

// Composition des menus (données de démonstration)
const menuCompositions = {
    "Menu Élégance": ["Saumon fumé et agrumes", "Filet de bœuf sauce truffe", "Tarte au citron meringuée"],
    "Menu Saveurs": ["Tartare de légumes de saison", "Filet de bœuf sauce truffe", "Tarte au citron meringuée"],
    "Menu Gourmand": ["Saumon fumé et agrumes", "Filet de bœuf sauce truffe", "Tarte au citron meringuée"],
    "Menu Végétarien": ["Tartare de légumes de saison", "Tarte au citron meringuée"],
    "Menu Prestige": ["Saumon fumé et agrumes", "Filet de bœuf sauce truffe", "Tarte au citron meringuée"]
};

function openModal(title, content) {
    modalTitle.textContent = title;
    modalBody.replaceChildren(content);
    modal.hidden = false;
    modalClose.focus();
}

function closeModal() {
    modal.hidden = true;
    modalBody.replaceChildren();
}

function createInput(value, type = "text") {
    const input = document.createElement("input");
    input.type = type;
    input.value = value;
    input.required = true;
    return input;
}

function createSelect(options, value) {
    const select = document.createElement("select");
    options.forEach(option => {
        const element = document.createElement("option");
        element.value = option;
        element.textContent = option;
        select.append(element);
    });
    select.value = value;
    return select;
}

function createField(labelText, control) {
    const label = document.createElement("label");
    label.className = "modal-field";
    const span = document.createElement("span");
    span.textContent = labelText;
    label.append(span, control);
    return label;
}

function createFormActions(form, onDelete) {
    const actions = document.createElement("div");
    actions.className = "modal-actions";

    if (onDelete) {
        const remove = document.createElement("button");
        remove.type = "button";
        remove.className = "danger-button modal-delete";
        remove.textContent = "Supprimer";
        remove.addEventListener("click", onDelete);
        actions.append(remove);
    }

    const cancel = document.createElement("button");
    cancel.type = "button";
    cancel.textContent = "Annuler";
    cancel.addEventListener("click", closeModal);

    const submit = document.createElement("button");
    submit.type = "submit";
    submit.className = "primary-button";
    submit.textContent = "Enregistrer";

    actions.append(cancel, submit);
    form.append(actions);
}

// Demande une confirmation avant de supprimer une ligne du tableau.
function openDeleteModal(row, name) {
    const wrapper = document.createElement("div");

    const text = document.createElement("p");
    text.textContent = `Voulez-vous vraiment supprimer « ${name} » ?`;

    const actions = document.createElement("div");
    actions.className = "modal-actions";

    const cancel = document.createElement("button");
    cancel.type = "button";
    cancel.textContent = "Annuler";
    cancel.addEventListener("click", closeModal);

    const confirm = document.createElement("button");
    confirm.type = "button";
    confirm.className = "danger-button";
    confirm.textContent = "Confirmer la suppression";
    confirm.addEventListener("click", () => {
        row.remove();
        closeModal();
        showToast(`${name} a bien été supprimé.`);
    });

    actions.append(cancel, confirm);
    wrapper.append(text, actions);
    openModal(`Supprimer ${name}`, wrapper);
}

function openOrderModal(row) {
    const [number, date, client, menu, total, status] = [...row.cells].map(cell => cell.textContent.trim());

    const details = document.createElement("dl");
    details.className = "modal-details";
    [
        ["N° commande", number],
        ["Date", date],
        ["Client", client],
        ["Menu", menu],
        ["Total", total],
        ["Statut", status]
    ].forEach(([term, value]) => {
        const dt = document.createElement("dt");
        dt.textContent = term;
        const dd = document.createElement("dd");
        dd.textContent = value;
        details.append(dt, dd);
    });

    const heading = document.createElement("h3");
    heading.textContent = "Menus et plats inclus";

    const list = document.createElement("ul");
    (menuCompositions[menu] || ["Composition non renseignée"]).forEach(dish => {
        const item = document.createElement("li");
        item.textContent = dish;
        list.append(item);
    });

    const wrapper = document.createElement("div");
    wrapper.append(details, heading, list);
    openModal(`Commande ${number}`, wrapper);
}

function openMenuModal(row) {
    const [nameCell, themeCell, minCell, priceCell, availCell] = row.cells;
    const availBadge = availCell.querySelector(".status");

    const nameInput = createInput(nameCell.textContent.trim());
    const themeSelect = createSelect(["Classique", "Gastronomique", "Végétarien"], themeCell.textContent.trim());
    const minInput = createInput(minCell.textContent.trim(), "number");
    minInput.min = "1";
    const priceInput = createInput(
        priceCell.textContent.replace("€", "").replace(/\s/g, "").replace(",", "."),
        "number"
    );
    priceInput.step = "0.01";
    priceInput.min = "0";
    const availSelect = createSelect(["Disponible", "Indisponible"], availBadge.textContent.trim());

    const form = document.createElement("form");
    form.className = "modal-form";
    form.append(
        createField("Nom du menu", nameInput),
        createField("Thème", themeSelect),
        createField("Personnes min.", minInput),
        createField("Prix / personne (€)", priceInput),
        createField("Disponibilité", availSelect)
    );
    createFormActions(form, () => openDeleteModal(row, nameCell.textContent.trim()));

    form.addEventListener("submit", event => {
        event.preventDefault();
        const name = nameInput.value.trim();

        nameCell.textContent = name;
        themeCell.textContent = themeSelect.value;
        minCell.textContent = minInput.value;
        priceCell.textContent = Number(priceInput.value).toFixed(2).replace(".", ",") + " €";

        availBadge.textContent = availSelect.value;
        availBadge.className = `status ${availSelect.value === "Disponible" ? "accepted" : "material"}`;

        row.dataset.name = name.toLocaleLowerCase("fr");
        row.dataset.theme = themeSelect.value;

        closeModal();
        showToast(`${name} a bien été modifié.`);
    });

    openModal(`Modifier ${nameCell.textContent.trim()}`, form);
}

function openDishModal(row) {
    const [nameCell, typeCell, dietCell, allergenCell] = row.cells;

    const nameInput = createInput(nameCell.textContent.trim());
    const typeSelect = createSelect(["Entrée", "Plat", "Dessert"], typeCell.textContent.trim());
    const dietSelect = createSelect(["Normal", "Végétarien", "Végétalien"], dietCell.textContent.trim());
    const allergenInput = createInput(allergenCell.textContent.trim());

    const form = document.createElement("form");
    form.className = "modal-form";
    form.append(
        createField("Nom du plat", nameInput),
        createField("Type", typeSelect),
        createField("Régime", dietSelect),
        createField("Allergènes", allergenInput)
    );
    createFormActions(form, () => openDeleteModal(row, nameCell.textContent.trim()));

    form.addEventListener("submit", event => {
        event.preventDefault();
        const name = nameInput.value.trim();

        nameCell.textContent = name;
        typeCell.textContent = typeSelect.value;
        dietCell.textContent = dietSelect.value;
        allergenCell.textContent = allergenInput.value.trim();

        row.dataset.name = name.toLocaleLowerCase("fr");
        row.dataset.type = typeSelect.value;
        row.dataset.diet = dietSelect.value;

        closeModal();
        showToast(`${name} a bien été modifié.`);
    });

    openModal(`Modifier ${nameCell.textContent.trim()}`, form);
}

if (modal) {
    modalClose.addEventListener("click", closeModal);

    modal.addEventListener("click", event => {
        if (event.target === modal) {
            closeModal();
        }
    });

    document.addEventListener("keydown", event => {
        if (event.key === "Escape" && !modal.hidden) {
            closeModal();
        }
    });

    document.querySelectorAll("tbody").forEach(tbody => {
        tbody.addEventListener("click", event => {
            const button = event.target.closest("button");
            if (!button || !tbody.contains(button)) {
                return;
            }

            const row = button.closest("tr");
            const label = button.textContent.trim();

            if (label === "Voir") {
                openOrderModal(row);
            } else if (label === "Modifier" && tbody.id === "menus-body") {
                openMenuModal(row);
            } else if (label === "Modifier" && tbody.id === "dishes-body") {
                openDishModal(row);
            } else if (label === "Supprimer") {
                openDeleteModal(row, row.cells[0].textContent.trim());
            }
        });
    });
}

document.querySelectorAll("[data-message]").forEach(button => {
    // Les boutons des tableaux sont gérés ci-dessus sur les pages avec modale
    if (modal && button.closest("tbody")) {
        return;
    }

    button.addEventListener("click", () => {
        showToast(button.dataset.message);
    });
});


/* ==================================================
   10. AVIS SUR LE TABLEAU DE BORD
   ================================================== */

// Gère les boutons de validation et de refus présents sur le tableau
// de bord, distincts de ceux de la page complète des avis.

document.querySelectorAll(
    ".review:not(.review-item) [data-review-action]"
).forEach(button => {
    button.addEventListener("click", () => {
        const review = button.closest(".review");
        const name = review.querySelector(".review-header strong").textContent;
        const action = button.dataset.reviewAction;

        showToast(`Avis de ${name} : ${action} en démonstration.`);

        // Désactive les boutons pour signaler que l'action a été simulée.

        review.querySelectorAll("button").forEach(actionButton => {
            actionButton.disabled = true;
        });

        review.style.opacity = "0.55";
    });
});
