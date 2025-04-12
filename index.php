<?php
session_start();
include('config/configuration.php');
include('scripts/connection.php');
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
</head>

<body>
    <h1>Bienvenue</h1>
    <?php if (isset($_SESSION['utilisateur_id'])): ?>
        <p>Connecté en tant que <?= htmlspecialchars($_SESSION['pseudo']) ?>. <a href="deconnexion.php">Déconnexion</a></p>
    <?php else: ?>
        <a href="connexion.php">CONNEXION</a> | <a href="inscription.php">INSCRIPTION</a>
    <?php endif; ?>

    <h2>Monstres</h2>
    <?php foreach ($monstres as $monstre): ?>
        <fieldset>
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
</body>

</html>
