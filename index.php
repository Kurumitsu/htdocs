<?php

/**
 * Page d'accueil du site Monster Hunter World
 * Affiche la liste des monstres et leurs lieux de vie associés
 * Gère également l'état de connexion de l'utilisateur
 */
session_start();
include('config/configuration.php');
include('scripts/connection.php');

/**
 * Récupération des lieux de vie
 */
$requete_lieux = "
	SELECT
		ID_Lieu_vie,
		Nom_du_lieu,
		image
	FROM
		lieux_vie
";

$resultats_lieux = $connection->query($requete_lieux);
$lieux = $resultats_lieux->fetchAll(PDO::FETCH_ASSOC);
$resultats_lieux->closeCursor();

/**
 * Récupération des monstres avec leurs lieux de vie
 */
$requete_monstres = '
	SELECT
		ID_Monstre,
		Nom_Monstre,
		Image_Monstre,
		lv.Nom_du_lieu AS Lieu_de_vie,
		lv.image AS Image_Lieu_de_vie,
		lv.ID_Lieu_vie
	FROM
		monstres m
	INNER JOIN
		lieux_vie lv ON m.ID_Lieu_vie = lv.ID_Lieu_vie
';

$resultats_monstres = $connection->query($requete_monstres);
$monstres = $resultats_monstres->fetchAll(PDO::FETCH_ASSOC);
$resultats_monstres->closeCursor();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monster Hunter: World</title>
    <script src="js/filtre.js"></script>
    <script src="js/jour_nuit.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Bienvenue</h1>
    <?php if (isset($_SESSION['utilisateur_id'])): ?>
        <p>Connecté en tant que <?= htmlspecialchars($_SESSION['pseudo']) ?>. <a href="deconnexion.php">Déconnexion</a></p>
    <?php else: ?>
        <a href="connexion.php">CONNEXION</a> | <a href="inscription.php">INSCRIPTION</a>
    <?php endif; ?>

    <button id="toggle-theme">Mode nuit</button>

    <label for="filtre-lieu">Filtrer par lieu de vie :</label>
    <select id="filtre-lieu">
        <option value="">Tous les lieux</option>
        <?php foreach ($lieux as $lieu): ?>
            <option value="<?= htmlspecialchars($lieu['ID_Lieu_vie']) ?>">
                <?= htmlspecialchars($lieu['Nom_du_lieu']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <h2>Monstres</h2>
    <div id="liste-monstres">
    <?php foreach ($monstres as $monstre): ?>
        <fieldset class="carte-monstre"
            data-lieu="<?= htmlspecialchars($monstre["ID_Lieu_vie"]) ?>">
            <legend><?php echo htmlspecialchars($monstre["Nom_Monstre"]); ?></legend>
            <p>Lieu de vie: <?php echo htmlspecialchars($monstre["Lieu_de_vie"]); ?></p>
            <a href="lieux_vie.php?ID_Lieu_vie=<?php echo htmlspecialchars($monstre["ID_Lieu_vie"]); ?>">
                <img src="images/<?php echo htmlspecialchars($monstre["Image_Lieu_de_vie"]); ?>" alt="<?php echo htmlspecialchars($monstre["Lieu_de_vie"]); ?>" style="max-width: 200px; height: auto;" />
            </a>
            <a href="monstre.php?ID_Monstre=<?php echo htmlspecialchars($monstre["ID_Monstre"]); ?>">
                <img src="images/<?php echo htmlspecialchars($monstre["Image_Monstre"]); ?>" alt="<?php echo htmlspecialchars($monstre["Nom_Monstre"]); ?>" style="max-width: 200px; height: auto;" />
            </a>
        </fieldset>
    <?php endforeach; ?>
    </div>
</body>

</html>
