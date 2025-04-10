<?php
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
        m.ID_Monstre,
        m.Nom_Monstre,
        m.Image_Monstre,
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

        <a href="connexion.php">CONNEXION</a>
        <br><br><a href="inscription.php">INSCRIPTION</a>

    <h2>Monstres</h2>
    <?php foreach ($monstres as $monstre): ?>
        <fieldset>
            <legend><?php echo htmlspecialchars($monstre["Nom_Monstre"]); ?></legend>
        </fieldset>
    <?php endforeach; ?>
</body>
</html>
