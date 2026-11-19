document.addEventListener('DOMContentLoaded', () => {

    function showDeleteModal(onConfirm) {
        const overlay = document.createElement('div');
        overlay.className = 'delete-modal-overlay';

        const modal = document.createElement('div');
        modal.className = 'delete-modal';
        modal.innerHTML = `
            <div class="delete-modal-header">${document.title.includes('Mes avis') ? 'Mes avis' : 'Suppression'}</div>
            <div class="delete-modal-body">Voulez-vous vraiment supprimer cet avis ?</div>
            <div class="delete-modal-actions">
                <button type="button" class="delete-modal-confirm">OK</button>
                <button type="button" class="delete-modal-cancel">Annuler</button>
            </div>
        `;

        overlay.appendChild(modal);
        document.body.appendChild(overlay);

        const confirmBtn = modal.querySelector('.delete-modal-confirm');
        const cancelBtn = modal.querySelector('.delete-modal-cancel');

        confirmBtn.addEventListener('click', () => {
            onConfirm();
            overlay.remove();
        });

        cancelBtn.addEventListener('click', () => {
            overlay.remove();
        });

        overlay.addEventListener('click', (event) => {
            if (event.target === overlay) {
                overlay.remove();
            }
        });
    }

    // Boutons + / - du foyer
    document.querySelectorAll('.counter').forEach((counter, index) => {
        const buttons = counter.querySelectorAll('button');
        const minusButton = buttons[0];
        const plusButton = buttons[1];
        const value = counter.querySelector('strong');
        const isAdults = index === 0;
        const minValue = isAdults ? 1 : 0;
        const maxValue = 10;

        minusButton.addEventListener('click', () => {
            const current = Number(value.textContent.trim()) || 0;
            if (current > minValue) {
                value.textContent = current - 1;
            }
        });

        plusButton.addEventListener('click', () => {
            const current = Number(value.textContent.trim()) || 0;
            if (current < maxValue) {
                value.textContent = current + 1;
            }
        });
    });

    // Modifier ou supprimer un avis (page tableau de bord)
    document.querySelectorAll('.review-actions button').forEach((button) => {
        const review = button.closest('.review');
        const reviewText = review.querySelector('.review-content p');

        if (button.querySelector('.fa-pen')) {
            button.addEventListener('click', () => {
                const originalText = reviewText.textContent.trim();
                const textarea = document.createElement('textarea');
                textarea.value = originalText;
                textarea.style.width = '100%';
                textarea.style.minHeight = '60px';
                textarea.style.padding = '8px';
                textarea.style.border = '1px solid #ccc8c0';
                textarea.style.borderRadius = '4px';
                textarea.style.fontFamily = 'inherit';
                textarea.style.fontSize = 'inherit';

                const container = document.createElement('div');
                container.style.display = 'flex';
                container.style.gap = '10px';
                container.style.marginTop = '10px';

                const btnValidate = document.createElement('button');
                btnValidate.textContent = 'Valider';
                btnValidate.type = 'button';
                btnValidate.style.padding = '6px 12px';
                btnValidate.style.background = '#102820';
                btnValidate.style.color = 'white';
                btnValidate.style.border = 'none';
                btnValidate.style.borderRadius = '4px';
                btnValidate.style.cursor = 'pointer';

                const btnCancel = document.createElement('button');
                btnCancel.textContent = 'Annuler';
                btnCancel.type = 'button';
                btnCancel.style.padding = '6px 12px';
                btnCancel.style.background = '#ddd9d1';
                btnCancel.style.border = 'none';
                btnCancel.style.borderRadius = '4px';
                btnCancel.style.cursor = 'pointer';

                container.appendChild(btnValidate);
                container.appendChild(btnCancel);

                reviewText.replaceWith(textarea);
                textarea.parentElement.insertBefore(container, textarea.nextSibling);
                textarea.focus();

                btnValidate.addEventListener('click', () => {
                    const newText = textarea.value.trim();
                    if (newText !== '') {
                        const p = document.createElement('p');
                        p.textContent = newText;
                        textarea.replaceWith(p);
                        container.remove();
                    }
                });

                btnCancel.addEventListener('click', () => {
                    const p = document.createElement('p');
                    p.textContent = originalText;
                    textarea.replaceWith(p);
                    container.remove();
                });
            });
        }

        if (button.querySelector('.fa-trash-can')) {
            button.addEventListener('click', () => {
                showDeleteModal(() => {
                    review.remove();
                });
            });
        }
    });

    // Modifier les étoiles des derniers avis du tableau de bord


document.querySelectorAll('.review-content .stars').forEach((container) => {
    container.querySelectorAll('i').forEach((star, index) => {
        star.style.cursor = 'pointer';
        star.setAttribute('role', 'button');
        star.setAttribute('aria-label', `Noter ${index + 1} sur 5`);

        star.addEventListener('click', () => {
            container.querySelectorAll('i').forEach((item, i) => {
                item.classList.toggle('fa-solid', i <= index);
                item.classList.toggle('fa-regular', i > index);
            });
        });
    });
});


    // ==================================================
    // MES COMMANDES
    // ==================================================

    const filterSelect = document.getElementById('filterStatus');
    const orderCards = document.querySelectorAll('.order-card');

    if (filterSelect) {
        filterSelect.addEventListener('change', (e) => {
            const filterValue = e.target.value;

            orderCards.forEach((card) => {
                const status = card.dataset.status;
                card.style.display = (filterValue === '' || status === filterValue) ? 'block' : 'none';
            });
        });
    }


    // ==================================================
    // DETAIL DE COMMANDE
    // ==================================================

    const orderStatus = document.getElementById('orderStatus');
    const editOrderBtn = document.getElementById('editOrderBtn');
    const cancelOrderBtn = document.querySelector('.button-danger');
    const editInstructionsBtn = document.getElementById('editInstructionsBtn');
    const orderNumberLabel = document.getElementById('orderNumber');
    const orderDateLabel = document.getElementById('orderDateLabel');
    const summaryImage = document.getElementById('summaryImage');
    const summaryTitle = document.getElementById('summaryTitle');
    const summaryDescription = document.getElementById('summaryDescription');
    const summaryQuantity = document.getElementById('summaryQuantity');
    const summaryDelivery = document.getElementById('summaryDelivery');
    const summaryTotal = document.getElementById('summaryTotal');
    const totalMenuLabel = document.getElementById('totalMenuLabel');
    const totalMenuPrice = document.getElementById('totalMenuPrice');
    const totalFinalPrice = document.getElementById('totalFinalPrice');
    const finishedReviewSection = document.getElementById('finishedReviewSection');
    const finishedRatingStars = document.getElementById('finishedRatingStars');
    const ratingLabel = document.getElementById('ratingLabel');
    const finishedReviewComment = document.getElementById('finishedReviewComment');
    const submitFinishedReview = document.getElementById('submitFinishedReview');
    const reviewMessage = document.getElementById('reviewMessage');
    const trackingLocked = document.querySelector('.tracking-locked');
    const trackingIntro = document.querySelector('.tracking-intro');
    const trackingSteps = document.querySelectorAll('.tracking-timeline .timeline-step');
    const orderNotice = document.querySelector('.order-notice');
    const detailFootnote = document.querySelector('.detail-footnote');
    let instructions = document.getElementById('customerInstructions');
    const instructionActions = document.querySelector('.instruction-actions');
    const orderActions = document.querySelector('.order-actions');

    const orderCatalog = {
        '000124': {
            id: '000124',
            status: 'preparing',
            orderedAt: '12 août 2026 à 18:45',
            date: '14 août 2026',
            creneau: '19 h - 20 h',
            mode: 'Livraison à domicile',
            adresse: '12 rue des Fleurs, 75000 Paris',
            nom: 'Kévin Dupont',
            email: 'kevin.dupont@email.com',
            telephone: '06 12 34 56 79',
            title: 'Menu Gourmand',
            description: 'Un menu généreux pour profiter d\'un repas convivial.',
            image: 'images/photo menu 2.png',
            quantityLabel: '2 personnes',
            deliveryLabel: 'Livraison à domicile',
            total: 25,
            instructions: 'Merci de sonner à l\'interphone à votre arrivée.'
        },
        '000123': {
            id: '000123',
            status: 'finished',
            orderedAt: '10 août 2026 à 12:30',
            date: '10 août 2026',
            creneau: '12 h - 13 h',
            mode: 'Livraison à domicile',
            adresse: '12 rue des Fleurs, 75000 Paris',
            nom: 'Kévin Dupont',
            email: 'kevin.dupont@email.com',
            telephone: '06 12 34 56 79',
            title: 'Menu Équilibre',
            description: 'Des saveurs fraîches et équilibrées pour un déjeuner complet.',
            image: 'images/quiche.jpg',
            quantityLabel: '2 personnes',
            deliveryLabel: 'Livraison à domicile',
            total: 44.00,
            instructions: 'Laisser le colis chez la gardienne si besoin.'
        },
        '000122': {
            id: '000122',
            status: 'finished',
            orderedAt: '07 août 2026 à 19:10',
            date: '07 août 2026',
            creneau: '19 h - 20 h',
            mode: 'À retirer',
            adresse: 'Retrait au point de vente',
            nom: 'Kévin Dupont',
            email: 'kevin.dupont@email.com',
            telephone: '06 12 34 56 79',
            title: 'Menu Plaisir',
            description: 'Un menu gourmand pour un dîner convivial.',
            image: 'images/pates.jpg',
            quantityLabel: '2 personnes',
            deliveryLabel: 'À retirer',
            total: 40.00,
            instructions: 'Je passerai récupérer la commande à 19h.'
        },
        '000121': {
            id: '000121',
            status: 'finished',
            orderedAt: '02 août 2026 à 14:20',
            date: '02 août 2026',
            creneau: '14 h - 15 h',
            mode: 'Livraison à domicile',
            adresse: '12 rue des Fleurs, 75000 Paris',
            nom: 'Kévin Dupont',
            email: 'kevin.dupont@email.com',
            telephone: '06 12 34 56 79',
            title: 'Menu Cocktail',
            description: 'Format événementiel pour un grand groupe.',
            image: 'images/cocktail.jpg',
            quantityLabel: '10 personnes',
            deliveryLabel: 'Livraison à domicile',
            total: 180.00,
            instructions: 'Accès possible par la porte arrière du bâtiment.'
        }
    };

    const formatCurrency = (amount) => new Intl.NumberFormat('fr-FR', {
        style: 'currency',
        currency: 'EUR'
    }).format(amount);

    const params = new URLSearchParams(window.location.search);
    const requestedOrderId = params.get('id') || '000124';
    const selectedOrder = orderCatalog[requestedOrderId] || orderCatalog['000124'];
    const forcedStatus = params.get('status');
    const currentStatus = forcedStatus || selectedOrder.status;

    if (orderStatus && selectedOrder) {
        const statusMap = {
            pending: { label: "En attente d'acceptation", cssClass: 'waiting' },
            preparing: { label: 'En préparation', cssClass: 'preparing' },
            finished: { label: 'Terminée', cssClass: 'finished' }
        };

        const statusConfig = statusMap[currentStatus] || statusMap.pending;

        orderStatus.textContent = statusConfig.label;
        orderStatus.dataset.status = currentStatus;
        orderStatus.classList.remove('waiting', 'preparing', 'finished', 'cancelled');
        orderStatus.classList.add(statusConfig.cssClass);

        if (orderNumberLabel) orderNumberLabel.textContent = `#${selectedOrder.id}`;
        if (orderDateLabel) orderDateLabel.textContent = `Commandée le ${selectedOrder.orderedAt}`;
        if (summaryImage) {
            summaryImage.src = selectedOrder.image;
            summaryImage.alt = `Photo du ${selectedOrder.title}`;
        }
        if (summaryTitle) summaryTitle.textContent = selectedOrder.title;
        if (summaryDescription) summaryDescription.textContent = selectedOrder.description;
        if (summaryQuantity) summaryQuantity.textContent = selectedOrder.quantityLabel;
        if (summaryDelivery) summaryDelivery.textContent = selectedOrder.deliveryLabel;
        if (summaryTotal) summaryTotal.textContent = formatCurrency(selectedOrder.total);
        if (totalMenuLabel) totalMenuLabel.textContent = `${selectedOrder.title} × ${selectedOrder.quantityLabel}`;
        if (totalMenuPrice) totalMenuPrice.textContent = formatCurrency(selectedOrder.total);
        if (totalFinalPrice) totalFinalPrice.textContent = formatCurrency(selectedOrder.total);
        if (instructions) instructions.textContent = selectedOrder.instructions;

        document.querySelector('[data-editable="date"]')?.replaceChildren(document.createTextNode(selectedOrder.date));
        document.querySelector('[data-editable="creneau"]')?.replaceChildren(document.createTextNode(selectedOrder.creneau));
        document.querySelector('[data-editable="mode"]')?.replaceChildren(document.createTextNode(selectedOrder.mode));
        document.querySelector('[data-editable="adresse"]')?.replaceChildren(document.createTextNode(selectedOrder.adresse));
        document.querySelector('[data-editable="nom"]')?.replaceChildren(document.createTextNode(selectedOrder.nom));
        document.querySelector('[data-editable="email"]')?.replaceChildren(document.createTextNode(selectedOrder.email));
        document.querySelector('[data-editable="telephone"]')?.replaceChildren(document.createTextNode(selectedOrder.telephone));
    }

    // La commande est modifiable tant qu'elle n'est pas terminée.
    const canEditOrder = () => {
        const statusValue = orderStatus?.dataset.status;
        return statusValue === 'pending' || statusValue === 'preparing';
    };

    if (currentStatus === 'finished') {
        if (orderNotice) {
            orderNotice.classList.add('success');
            orderNotice.innerHTML = '<i class="fa-solid fa-circle-check"></i><p>Votre commande est terminée. Consultez le récapitulatif et publiez votre avis ci-dessous.</p>';
        }

        if (trackingLocked) {
            trackingLocked.innerHTML = '<i class="fa-solid fa-check"></i> Historique complet';
        }

        if (trackingIntro) {
            trackingIntro.textContent = 'Les étapes de cette commande sont finalisées.';
        }

        if (trackingSteps.length >= 4) {
            trackingSteps[1].className = 'timeline-step completed';
            trackingSteps[1].querySelector('strong').textContent = 'Commande acceptée';
            trackingSteps[1].querySelector('p').textContent = 'Traitée par un employé';

            trackingSteps[2].className = 'timeline-step completed';
            trackingSteps[2].querySelector('strong').textContent = 'Commande en préparation';
            trackingSteps[2].querySelector('p').textContent = 'Votre menu a été préparé';

            trackingSteps[3].className = 'timeline-step completed';
            trackingSteps[3].querySelector('strong').textContent = 'Commande terminée';
            trackingSteps[3].querySelector('p').textContent = 'Commande livrée ou retirée';
        }

        if (orderActions) {
            orderActions.classList.add('is-hidden');
        }
        if (editInstructionsBtn) editInstructionsBtn.disabled = true;
        if (detailFootnote) detailFootnote.textContent = 'Vous pouvez modifier votre avis à tout moment depuis cette page.';

        if (finishedReviewSection) {
            finishedReviewSection.hidden = false;
        }

        if (finishedRatingStars && submitFinishedReview && ratingLabel && finishedReviewComment) {
            const storageKey = `vg-review-${selectedOrder.id}`;
            let selectedRating = 0;

            const updateStars = (rating) => {
                finishedRatingStars.querySelectorAll('button').forEach((button) => {
                    const value = Number(button.dataset.rating);
                    const icon = button.querySelector('i');
                    icon.className = value <= rating ? 'fa-solid fa-star' : 'fa-regular fa-star';
                });
            };

            const updateRatingLabel = (rating) => {
                ratingLabel.textContent = rating > 0
                    ? `${rating}/5 sélectionné${rating > 1 ? 's' : ''}`
                    : 'Aucune note sélectionnée';
            };

            const savedReview = localStorage.getItem(storageKey);
            if (savedReview) {
                try {
                    const parsed = JSON.parse(savedReview);
                    selectedRating = Number(parsed.rating) || 0;
                    finishedReviewComment.value = parsed.comment || '';
                    updateStars(selectedRating);
                    updateRatingLabel(selectedRating);
                    if (reviewMessage) {
                        reviewMessage.textContent = 'Votre avis est déjà enregistré. Vous pouvez le modifier puis republier.';
                    }
                } catch (error) {
                    localStorage.removeItem(storageKey);
                }
            }

            finishedRatingStars.querySelectorAll('button').forEach((button) => {
                button.addEventListener('click', () => {
                    selectedRating = Number(button.dataset.rating);
                    updateStars(selectedRating);
                    updateRatingLabel(selectedRating);
                });
            });

            submitFinishedReview.addEventListener('click', () => {
                const comment = finishedReviewComment.value.trim();

                if (!selectedRating) {
                    if (reviewMessage) reviewMessage.textContent = 'Veuillez sélectionner une note avant de publier.';
                    return;
                }

                if (!comment) {
                    if (reviewMessage) reviewMessage.textContent = 'Veuillez saisir un commentaire avant de publier.';
                    return;
                }

                localStorage.setItem(storageKey, JSON.stringify({
                    orderId: selectedOrder.id,
                    menu: selectedOrder.title,
                    rating: selectedRating,
                    comment,
                    submittedAt: new Date().toISOString()
                }));

                if (reviewMessage) {
                    reviewMessage.textContent = 'Merci ! Votre avis a bien été publié.';
                }
            });
        }
    }

    // Modifier les instructions de livraison
    if (editInstructionsBtn && instructions && instructionActions) {
        editInstructionsBtn.addEventListener('click', () => {
            if (!canEditOrder()) {
                alert("Cette commande ne peut plus être modifiée car elle a déjà été acceptée ou clôturée.");
                return;
            }

            if (document.querySelector('.instructions-editor')) {
                return;
            }

            const originalText = instructions.textContent.trim();
            const textarea = document.createElement('textarea');
            textarea.className = 'instructions-editor';
            textarea.value = originalText;
            textarea.setAttribute('aria-label', 'Instructions complémentaires');

            const actions = document.createElement('div');
            actions.className = 'instruction-actions';

            const saveButton = document.createElement('button');
            saveButton.type = 'button';
            saveButton.className = 'validate-btn';
            saveButton.textContent = 'Valider';

            const cancelButton = document.createElement('button');
            cancelButton.type = 'button';
            cancelButton.className = 'cancel-btn';
            cancelButton.textContent = 'Annuler';

            instructions.replaceWith(textarea);
            actions.append(saveButton, cancelButton);
            textarea.parentElement.insertBefore(actions, textarea.nextSibling);
            textarea.focus();

            saveButton.addEventListener('click', () => {
                const newText = textarea.value.trim();

                if (!newText) {
                    alert('Veuillez saisir vos instructions ou indiquer « Aucune instruction ».');
                    return;
                }

                const updatedInstructions = document.createElement('p');
                updatedInstructions.className = 'customer-note';
                updatedInstructions.id = 'customerInstructions';
                updatedInstructions.textContent = newText;
                textarea.replaceWith(updatedInstructions);
                actions.remove();
                instructions = updatedInstructions;
            });

            cancelButton.addEventListener('click', () => {
                const restoredInstructions = document.createElement('p');
                restoredInstructions.className = 'customer-note';
                restoredInstructions.id = 'customerInstructions';
                restoredInstructions.textContent = originalText;
                textarea.replaceWith(restoredInstructions);
                actions.remove();
                instructions = restoredInstructions;
            });
        });
    }

    // Modifier les informations de livraison sans changer le menu
    if (editOrderBtn && orderActions) {
        editOrderBtn.addEventListener('click', () => {
            if (!canEditOrder()) {
                alert("La modification n'est plus possible après l'acceptation de la commande.");
                return;
            }

            if (editOrderBtn.dataset.editing === 'true') {
                return;
            }

            const editableFields = Array.from(document.querySelectorAll('[data-editable]'));
            const originalValues = new Map();

            editableFields.forEach((element) => {
                const key = element.dataset.editable;
                originalValues.set(key, element.textContent.trim());

                const input = document.createElement('input');
                input.className = 'edit-field';
                input.type = 'text';
                input.value = element.textContent.trim();
                input.dataset.editable = key;
                input.setAttribute('aria-label', key);
                element.replaceWith(input);
            });

            const actionContainer = document.createElement('div');
            actionContainer.className = 'edit-actions';

            const saveButton = document.createElement('button');
            saveButton.type = 'button';
            saveButton.className = 'button-primary';
            saveButton.textContent = 'Enregistrer les modifications';

            const cancelButton = document.createElement('button');
            cancelButton.type = 'button';
            cancelButton.className = 'button-secondary';
            cancelButton.textContent = 'Annuler les modifications';

            actionContainer.append(saveButton, cancelButton);
            orderActions.before(actionContainer);
            editOrderBtn.dataset.editing = 'true';
            editOrderBtn.disabled = true;

            const restoreFields = (save) => {
                document.querySelectorAll('input[data-editable]').forEach((input) => {
                    const span = document.createElement('strong');
                    span.dataset.editable = input.dataset.editable;
                    span.textContent = save ? input.value.trim() : originalValues.get(input.dataset.editable);
                    input.replaceWith(span);
                });

                actionContainer.remove();
                editOrderBtn.disabled = false;
                delete editOrderBtn.dataset.editing;
            };

            saveButton.addEventListener('click', () => {
                const inputs = Array.from(document.querySelectorAll('input[data-editable]'));

                if (inputs.some((input) => input.value.trim() === '')) {
                    alert('Veuillez compléter tous les champs avant d’enregistrer.');
                    return;
                }

                restoreFields(true);
                alert('Modifications appliquées à cette démonstration. Elles ne seront pas conservées après actualisation.');
            });

            cancelButton.addEventListener('click', () => restoreFields(false));
        });
    }

    // Annuler la commande avec confirmation
    if (cancelOrderBtn && orderStatus) {
        cancelOrderBtn.addEventListener('click', () => {
            if (!canEditOrder()) {
                alert("Cette commande ne peut plus être annulée car elle a déjà été acceptée ou clôturée.");
                return;
            }

            if (!confirm(`Voulez-vous vraiment annuler la commande #${selectedOrder.id} ?`)) {
                return;
            }

            orderStatus.textContent = 'Annulée';
            orderStatus.dataset.status = 'cancelled';
            orderStatus.classList.remove('waiting', 'preparing', 'finished');
            orderStatus.classList.add('cancelled');

            if (orderNotice) {
                orderNotice.classList.remove('success');
                orderNotice.innerHTML = '<i class="fa-solid fa-circle-info"></i><p>Cette commande a été annulée. La modification et l’annulation ne sont plus disponibles.</p>';
            }

            if (editOrderBtn) {
                editOrderBtn.disabled = true;
            }

            cancelOrderBtn.disabled = true;

            if (editInstructionsBtn) {
                editInstructionsBtn.disabled = true;
            }

            if (finishedReviewSection) {
                finishedReviewSection.hidden = true;
            }

            alert('La commande est marquée comme annulée dans cette démonstration. Cet état ne sera pas conservé après actualisation.');
        });
    }

});

    // ==================================================
    // MES AVIS
    // ==================================================

    document.querySelectorAll('.review-edit-btn').forEach((button) => {
        button.addEventListener('click', () => {
            const reviewCard = button.closest('.review-card');
            const reviewText = reviewCard.querySelector('.review-card-text p');
            const starsContainer = reviewCard.querySelector('.review-card-stars');
            const originalText = reviewText.textContent.trim();
            const originalStars = Array.from(starsContainer.querySelectorAll('i')).map((star) => star.classList.contains('fa-solid'));

            const interactiveStars = document.createElement('div');
            interactiveStars.className = 'interactive-stars';

            for (let i = 1; i <= 5; i++) {
                const starButton = document.createElement('button');
                starButton.type = 'button';
                starButton.className = 'interactive-star';
                starButton.setAttribute('aria-label', `Noter ${i} étoile${i > 1 ? 's' : ''}`);
                starButton.innerHTML = '<i class="fa-regular fa-star"></i>';

                if (originalStars[i - 1]) {
                    starButton.classList.add('is-active');
                    starButton.innerHTML = '<i class="fa-solid fa-star"></i>';
                }

                starButton.addEventListener('click', () => {
                    interactiveStars.querySelectorAll('.interactive-star').forEach((star, index) => {
                        const isActive = index < i;
                        star.classList.toggle('is-active', isActive);
                        star.innerHTML = isActive ? '<i class="fa-solid fa-star"></i>' : '<i class="fa-regular fa-star"></i>';
                    });
                });

                interactiveStars.appendChild(starButton);
            }

            const textarea = document.createElement('textarea');
            textarea.value = originalText;
            textarea.style.width = '100%';
            textarea.style.minHeight = '80px';
            textarea.style.padding = '10px';
            textarea.style.border = '1px solid #ccc8c0';
            textarea.style.borderRadius = '4px';
            textarea.style.fontFamily = 'inherit';
            textarea.style.fontSize = '14px';
            textarea.style.resize = 'vertical';

            const btnContainer = document.createElement('div');
            btnContainer.style.display = 'flex';
            btnContainer.style.gap = '10px';
            btnContainer.style.marginTop = '10px';

            const btnValidate = document.createElement('button');
            btnValidate.textContent = 'Valider';
            btnValidate.type = 'button';
            btnValidate.style.padding = '8px 16px';
            btnValidate.style.background = '#102820';
            btnValidate.style.color = 'white';
            btnValidate.style.border = 'none';
            btnValidate.style.borderRadius = '6px';
            btnValidate.style.cursor = 'pointer';
            btnValidate.style.fontWeight = '500';

            const btnCancel = document.createElement('button');
            btnCancel.textContent = 'Annuler';
            btnCancel.type = 'button';
            btnCancel.style.padding = '8px 16px';
            btnCancel.style.background = '#e5e2dc';
            btnCancel.style.border = '1px solid #ccc8c0';
            btnCancel.style.borderRadius = '6px';
            btnCancel.style.cursor = 'pointer';
            btnCancel.style.fontWeight = '500';

            btnContainer.appendChild(btnValidate);
            btnContainer.appendChild(btnCancel);

            starsContainer.replaceWith(interactiveStars);
            reviewText.replaceWith(textarea);
            textarea.parentElement.insertBefore(btnContainer, textarea.nextSibling);
            textarea.focus();

            btnValidate.addEventListener('click', () => {
                const newText = textarea.value.trim();
                if (newText !== '') {
                    const finalStars = document.createElement('div');
                    finalStars.className = 'review-card-stars';
                    const selectedStars = interactiveStars.querySelectorAll('.interactive-star.is-active').length;

                    for (let i = 1; i <= 5; i++) {
                        const star = document.createElement('i');
                        star.className = i <= selectedStars ? 'fa-solid fa-star' : 'fa-regular fa-star';
                        finalStars.appendChild(star);
                    }

                    const p = document.createElement('p');
                    p.textContent = newText;
                    textarea.replaceWith(p);
                    interactiveStars.replaceWith(finalStars);
                    btnContainer.remove();
                }
            });

            btnCancel.addEventListener('click', () => {
                const p = document.createElement('p');
                p.textContent = originalText;
                textarea.replaceWith(p);
                interactiveStars.replaceWith(starsContainer);
                btnContainer.remove();
            });
        });
    });

    document.querySelectorAll('.review-delete-btn').forEach((button) => {
        button.addEventListener('click', () => {
            showDeleteModal(() => {
                button.closest('.review-card').remove();
            });
        });
    });

    // Modifier la note en cliquant directement sur les étoiles

document.querySelectorAll('.review-card-stars').forEach((container) => {
    container.querySelectorAll('i').forEach((star, index) => {
        star.style.cursor = 'pointer';
        star.setAttribute('role', 'button');
        star.setAttribute('aria-label', `Noter ${index + 1} sur 5`);

        star.addEventListener('click', () => {
            container.querySelectorAll('i').forEach((item, i) => {
                item.classList.toggle('fa-solid', i <= index);
                item.classList.toggle('fa-regular', i > index);
            });
        });
    });
});

    // ==================================================
    // MON PROFIL
    // ==================================================

    const profileForm = document.querySelector('.profile-form');
    const profileName = document.querySelector('.profile-identity h2');
    const saveStatus = document.querySelector('.save-status');

    if (profileForm && profileName) {
        const firstNameInput = document.getElementById('prenom');
        const lastNameInput = document.getElementById('nom');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('telephone');
        const cityInput = document.getElementById('ville');
        const addressInput = document.getElementById('adresse');

        const updateProfileName = () => {
            const prenom = firstNameInput?.value.trim() || 'Kévin';
            const nom = lastNameInput?.value.trim() || 'Dupont';
            profileName.textContent = `${prenom} ${nom}`;
        };

        const showSaveStatus = (message) => {
            if (!saveStatus) return;
            saveStatus.textContent = message;
            saveStatus.classList.add('is-success');
            setTimeout(() => {
                saveStatus.classList.remove('is-success');
            }, 2200);
        };

        const restoreProfileData = () => {
            const savedFirstName = localStorage.getItem('profile-firstname');
            const savedLastName = localStorage.getItem('profile-lastname');
            const savedEmail = localStorage.getItem('profile-email');
            const savedPhone = localStorage.getItem('profile-phone');
            const savedCity = localStorage.getItem('profile-city');
            const savedAddress = localStorage.getItem('profile-address');

            if (savedFirstName) firstNameInput.value = savedFirstName;
            if (savedLastName) lastNameInput.value = savedLastName;
            if (savedEmail) emailInput.value = savedEmail;
            if (savedPhone) phoneInput.value = savedPhone;
            if (savedCity) cityInput.value = savedCity;
            if (savedAddress) addressInput.value = savedAddress;
        };

        firstNameInput?.addEventListener('input', updateProfileName);
        lastNameInput?.addEventListener('input', updateProfileName);

        profileForm.addEventListener('submit', (event) => {
            event.preventDefault();

            const prenom = firstNameInput?.value.trim() || 'Kévin';
            const nom = lastNameInput?.value.trim() || 'Dupont';

            localStorage.setItem('profile-firstname', prenom);
            localStorage.setItem('profile-lastname', nom);
            localStorage.setItem('profile-email', emailInput?.value.trim() || '');
            localStorage.setItem('profile-phone', phoneInput?.value.trim() || '');
            localStorage.setItem('profile-city', cityInput?.value.trim() || '');
            localStorage.setItem('profile-address', addressInput?.value.trim() || '');

            updateProfileName();
            showSaveStatus('Enregistrement effectué');
        });

        restoreProfileData();
        updateProfileName();
    }


