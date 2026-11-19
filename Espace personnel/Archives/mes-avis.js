document.addEventListener('DOMContentLoaded', () => {

    // Modifier un avis
    document.querySelectorAll('.review-edit-btn').forEach((button) => {
        button.addEventListener('click', () => {
            const reviewCard = button.closest('.review-card');
            const reviewText = reviewCard.querySelector('.review-card-text p');
            const originalText = reviewText.textContent.trim();
            
            // Créer un textarea
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
            
            // Créer les boutons
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
            
            // Remplacer le texte
            reviewText.replaceWith(textarea);
            textarea.parentElement.insertBefore(btnContainer, textarea.nextSibling);
            textarea.focus();
            
            // Valider
            btnValidate.addEventListener('click', () => {
                const newText = textarea.value.trim();
                if (newText !== '') {
                    const p = document.createElement('p');
                    p.textContent = newText;
                    textarea.replaceWith(p);
                    btnContainer.remove();
                }
            });
            
            // Annuler
            btnCancel.addEventListener('click', () => {
                const p = document.createElement('p');
                p.textContent = originalText;
                textarea.replaceWith(p);
                btnContainer.remove();
            });
        });
    });

    // Supprimer un avis
    document.querySelectorAll('.review-delete-btn').forEach((button) => {
        button.addEventListener('click', () => {
            if (confirm('Voulez-vous vraiment supprimer cet avis ?')) {
                button.closest('.review-card').remove();
            }
        });
    });

});
