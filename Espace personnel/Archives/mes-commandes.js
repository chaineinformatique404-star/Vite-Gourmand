document.addEventListener('DOMContentLoaded', () => {

    const filterSelect = document.getElementById('filterStatus');
    const orderCards = document.querySelectorAll('.order-card');

    filterSelect.addEventListener('change', (e) => {
        const filterValue = e.target.value;

        orderCards.forEach((card) => {
            const status = card.dataset.status;

            if (filterValue === '' || status === filterValue) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

});
