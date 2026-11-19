document.addEventListener('DOMContentLoaded', () => {
  const form = document.querySelector('.commande-form');
  if (!form) return;

  const FRAIS_BASE = 5;
  const CODES_BORDEAUX = ['33000', '33100', '33200', '33300', '33800'];
  const SEUIL_REDUCTION = 5;
  const TAUX_REDUCTION = 0.10;

  const menu = document.getElementById('menu');
  const personnes = document.getElementById('personnes');
  const codePostal = document.getElementById('code-postal');
  const minSpan = document.getElementById('min-personnes');

  const euros = (n) => n.toFixed(2).replace('.', ',') + ' €';

  function majPrix() {
    const option = menu.options[menu.selectedIndex];
    const prixUnitaire = parseFloat(option.dataset.prix);
    const min = parseInt(option.dataset.min, 10);

    personnes.min = min;
    minSpan.textContent = min;

    let nb = parseInt(personnes.value, 10);
    if (isNaN(nb)) nb = 0;

    const sousTotal = prixUnitaire * nb;
    const reduction = nb >= min + SEUIL_REDUCTION ? sousTotal * TAUX_REDUCTION : 0;
    const estBordeaux = CODES_BORDEAUX.includes(codePostal.value.trim());
    const livraison = estBordeaux ? 0 : FRAIS_BASE;
    const total = sousTotal - reduction + livraison;

    document.getElementById('r-sous-total').textContent = euros(sousTotal);
    document.getElementById('r-reduction').textContent = '-' + euros(reduction);
    document.getElementById('r-livraison').textContent = euros(livraison);
    document.getElementById('r-total').textContent = euros(total);
  }

  form.addEventListener('input', majPrix);
  form.addEventListener('change', majPrix);

  form.addEventListener('submit', (event) => {
    const min = parseInt(personnes.min, 10) || 0;
    if (parseInt(personnes.value, 10) < min) {
      event.preventDefault();
      alert('Le nombre de personnes doit être au minimum de ' + min + '.');
      personnes.focus();
    }
  });

  majPrix();
});
