<?php
session_start();

/* ==========================================================
   CONFIGURATION DES MENUS (prix par personne, minimum)
   ========================================================== */
$menus = [
    'menu-gourmand' => ['nom' => 'Menu Gourmand', 'prix' => 16.00, 'min' => 10],
];

const FRAIS_LIVRAISON_BASE = 5.00;     // forfait hors Bordeaux
const CODES_POSTAUX_BORDEAUX = ['33000', '33100', '33200', '33300', '33800'];
const REDUCTION_SEUIL      = 5;        // personnes en plus du minimum
const REDUCTION_TAUX       = 0.10;     // 10 %

function e(?string $valeur): string
{
    return htmlspecialchars((string)$valeur, ENT_QUOTES, 'UTF-8');
}

/** Calcule le détail du prix (utilisé côté serveur). */
function calculerPrix(float $prixUnitaire, int $personnes, int $minimum, string $codePostal): array
{
    $sousTotal = $prixUnitaire * $personnes;
    $reduction = ($personnes >= $minimum + REDUCTION_SEUIL) ? round($sousTotal * REDUCTION_TAUX, 2) : 0.0;
    $estBordeaux = in_array(trim($codePostal), CODES_POSTAUX_BORDEAUX, true);
    $livraison = $estBordeaux ? 0.0 : FRAIS_LIVRAISON_BASE;

    return [
        'sous_total' => round($sousTotal, 2),
        'reduction'  => $reduction,
        'livraison'  => $livraison,
        'total'      => round($sousTotal - $reduction + $livraison, 2),
    ];
}

$erreurs = [];
$confirmation = false;
$valeurs = [
    'nom'            => $_SESSION['nom'] ?? '',
    'prenom'         => $_SESSION['prenom'] ?? '',
    'email'          => $_SESSION['email'] ?? '',
    'tel'            => $_SESSION['tel'] ?? '',
    'adresse'        => '',
    'ville'          => '',
    'code_postal'    => '',
    'date_prestation'=> '',
    'heure_livraison'=> '',
    'menu'           => $_GET['menu'] ?? 'menu-gourmand',
    'personnes'      => '',
];

$menuChoisi = $menus[$valeurs['menu']] ?? reset($menus);
$valeurs['menu'] = array_search($menuChoisi, $menus, true) ?: array_key_first($menus);
$valeurs['personnes'] = (string)$menuChoisi['min'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($valeurs as $cle => $_) {
        $valeurs[$cle] = trim((string)($_POST[$cle] ?? ''));
    }

    $menuChoisi = $menus[$valeurs['menu']] ?? null;
    if ($menuChoisi === null) {
        $erreurs[] = 'Menu invalide.';
    }

    foreach (['nom' => 'Nom', 'prenom' => 'Prénom', 'adresse' => 'Adresse', 'ville' => 'Ville',
              'date_prestation' => 'Date de la prestation', 'heure_livraison' => 'Heure de livraison',
              'tel' => 'Téléphone portable'] as $cle => $libelle) {
        if ($valeurs[$cle] === '') {
            $erreurs[] = "Le champ « $libelle » est obligatoire.";
        }
    }

    if (!preg_match('/^\d{5}$/', $valeurs['code_postal'])) {
        $erreurs[] = 'Le code postal doit comporter 5 chiffres.';
    }
    if (!filter_var($valeurs['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = 'Adresse e-mail invalide.';
    }
    if ($valeurs['date_prestation'] !== '' && strtotime($valeurs['date_prestation']) < strtotime('today')) {
        $erreurs[] = 'La date de la prestation doit être dans le futur.';
    }

    $personnes = filter_var($valeurs['personnes'], FILTER_VALIDATE_INT);

    if ($menuChoisi !== null) {
        if ($personnes === false || $personnes < $menuChoisi['min']) {
            $erreurs[] = 'Le nombre de personnes doit être au minimum de ' . $menuChoisi['min'] . '.';
        }
    }

    if (!$erreurs && $menuChoisi !== null) {
        $prix = calculerPrix($menuChoisi['prix'], (int)$personnes, $menuChoisi['min'], $valeurs['code_postal']);

        $sujet = 'Confirmation de votre commande - Vite & Gourmand';
        $corps = "Bonjour {$valeurs['prenom']} {$valeurs['nom']},\n\n"
            . "Nous vous confirmons votre commande :\n"
            . "- Menu : {$menuChoisi['nom']}\n"
            . "- Nombre de personnes : $personnes\n"
            . "- Date de la prestation : {$valeurs['date_prestation']}\n"
            . "- Heure de livraison : {$valeurs['heure_livraison']}\n"
            . "- Lieu : {$valeurs['adresse']}, {$valeurs['ville']}\n\n"
            . "Détail du prix :\n"
            . "- Sous-total : " . number_format($prix['sous_total'], 2, ',', ' ') . " €\n"
            . "- Réduction : -" . number_format($prix['reduction'], 2, ',', ' ') . " €\n"
            . "- Livraison : " . number_format($prix['livraison'], 2, ',', ' ') . " €\n"
            . "- Total : " . number_format($prix['total'], 2, ',', ' ') . " €\n\n"
            . "Merci pour votre confiance.\nVite & Gourmand";

        $headers = "From: Vite & Gourmand <contact@viteetgourmand.fr>\r\n"
            . "Content-Type: text/plain; charset=UTF-8";

        $envoye = @mail($valeurs['email'], mb_encode_mimeheader($sujet, 'UTF-8'), $corps, $headers);

        // TODO : enregistrer la commande en base de données (table commandes) une fois le schéma confirmé.
        $confirmation = [
            'envoye' => $envoye,
            'prix'   => $prix,
            'menu'   => $menuChoisi['nom'],
            'personnes' => $personnes,
        ];
    }
}

/* Prix affiché au chargement (valeurs par défaut) */
$prixInitial = calculerPrix($menuChoisi['prix'], (int)$valeurs['personnes'], $menuChoisi['min'], '');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Commander un menu | Vite & Gourmand</title>

  <link rel="stylesheet" href="../.Composants/style commun.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="stylesheet" href="commande.css">
  <script src="commande.js" defer></script>
</head>
<body>



<main class="commande container">

  <h1>Commander un menu</h1>

  <?php if ($confirmation): ?>

    <section class="confirmation">
      <h2>Merci, votre commande est enregistrée !</h2>
      <p>
        <?= $confirmation['personnes'] ?> personnes – <?= e($confirmation['menu']) ?>
      </p>
      <?php if ($confirmation['envoye']): ?>
        <p>Un e-mail de confirmation vous a été envoyé.</p>
      <?php else: ?>
        <p>Votre commande est enregistrée, mais l'e-mail de confirmation n'a pas pu être envoyé.</p>
      <?php endif; ?>
      <p><strong>Total : <?= number_format($confirmation['prix']['total'], 2, ',', ' ') ?> €</strong></p>
      <a href="../Accueil/Accueil.php" class="btn">Retour à l'accueil</a>
    </section>

  <?php else: ?>

    <?php if ($erreurs): ?>
      <div class="erreurs" role="alert">
        <ul>
          <?php foreach ($erreurs as $erreur): ?>
            <li><?= e($erreur) ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form method="post" action="commande.php" class="commande-form" novalidate>

      <!-- 1. CLIENT -->
      <fieldset>
        <legend>1. Vos informations</legend>

        <div class="grille">
          <label>Nom *
            <input type="text" name="nom" value="<?= e($valeurs['nom']) ?>" required>
          </label>
          <label>Prénom *
            <input type="text" name="prenom" value="<?= e($valeurs['prenom']) ?>" required>
          </label>
          <label>E-mail *
            <input type="email" name="email" value="<?= e($valeurs['email']) ?>" required>
          </label>
          <label>Téléphone portable *
            <input type="tel" name="tel" value="<?= e($valeurs['tel']) ?>" required>
          </label>
        </div>
      </fieldset>

      <!-- 2. PRESTATION -->
      <fieldset>
        <legend>2. Prestation et livraison</legend>

        <div class="grille">
          <label class="pleine">Adresse de la prestation *
            <input type="text" name="adresse" value="<?= e($valeurs['adresse']) ?>" required>
          </label>
          <label>Ville *
            <input type="text" name="ville" id="ville" value="<?= e($valeurs['ville']) ?>" required>
          </label>
          <label>Code postal *
            <input type="text" name="code_postal" id="code-postal" inputmode="numeric" maxlength="5" pattern="\d{5}" value="<?= e($valeurs['code_postal']) ?>" required>
          </label>
          <label>Date de la prestation *
            <input type="date" name="date_prestation" value="<?= e($valeurs['date_prestation']) ?>" required>
          </label>
          <label>Heure souhaitée de livraison *
            <input type="time" name="heure_livraison" value="<?= e($valeurs['heure_livraison']) ?>" required>
          </label>
        </div>
      </fieldset>

      <!-- 3. MENU -->
      <fieldset>
        <legend>3. Menu et nombre de personnes</legend>

        <div class="grille">
          <label>Menu *
            <select name="menu" id="menu">
              <?php foreach ($menus as $cle => $m): ?>
                <option value="<?= e($cle) ?>"
                        data-prix="<?= e($m['prix']) ?>"
                        data-min="<?= e($m['min']) ?>"
                        <?= $cle === $valeurs['menu'] ? 'selected' : '' ?>>
                  <?= e($m['nom']) ?> (<?= number_format($m['prix'], 2, ',', ' ') ?> € / pers.)
                </option>
              <?php endforeach; ?>
            </select>
          </label>
          <label>Nombre de personnes *
            <input type="number" name="personnes" id="personnes"
                   min="<?= (int)$menuChoisi['min'] ?>"
                   value="<?= e($valeurs['personnes']) ?>" required>
            <small>Minimum : <span id="min-personnes"><?= (int)$menuChoisi['min'] ?></span> personnes</small>
          </label>
        </div>
      </fieldset>

      <!-- DETAIL DU PRIX -->
      <section class="recap" aria-live="polite">
        <h2>Détail du prix</h2>
        <ul>
          <li><span>Sous-total menu</span><span id="r-sous-total"><?= number_format($prixInitial['sous_total'], 2, ',', ' ') ?> €</span></li>
          <li><span>Réduction (10 %, +5 pers.)</span><span id="r-reduction">-0,00 €</span></li>
          <li><span>Livraison</span><span id="r-livraison">0,00 €</span></li>
          <li class="total"><span>Total</span><span id="r-total"><?= number_format($prixInitial['total'], 2, ',', ' ') ?> €</span></li>
        </ul>
        <p class="note">Livraison : gratuite à Bordeaux, sinon 5 € (forfait).</p>
      </section>

      <button type="submit" class="btn">Valider la commande</button>
    </form>

  <?php endif; ?>

</main>

</body>
</html>
