<?php
include('config/configuration.php');
include('scripts/connection.php');

$ID_Monstre = isset($_GET['ID_Monstre']) ? intval($_GET['ID_Monstre']) : 0;
$requete_monstre = "
    SELECT 
        m.ID_Monstre,
        m.Nom_Monstre,
        m.Niveau,
        m.Biographie,
        m.Image_Monstre,
        lv.Nom_du_lieu AS Lieu_de_vie
    FROM 
        monstres m
    INNER JOIN 
        lieux_vie lv ON m.ID_Lieu_vie = lv.ID_Lieu_vie
    WHERE
        m.ID_Monstre = :ID_Monstre
";

$stmt_monstre = $connection->prepare($requete_monstre);
$stmt_monstre->bindParam(':ID_Monstre', $ID_Monstre, PDO::PARAM_INT);
$stmt_monstre->execute();
$monstre = $stmt_monstre->fetch(PDO::FETCH_ASSOC);
$stmt_monstre->closeCursor();

if (!$monstre) {
    echo "Monstre non trouvé.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($monstre["Nom_Monstre"]); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($monstre["Nom_Monstre"]); ?></h1>

    <img src="images/<?php echo htmlspecialchars($monstre["Image_Monstre"]); ?>" alt="<?php echo htmlspecialchars($monstre["Nom_Monstre"]); ?>" style="max-width: 200px; height: auto;" />

    <p>Lieu de vie: <?php echo htmlspecialchars($monstre["Lieu_de_vie"]); ?></p>
    <p>Niveau: <?php echo htmlspecialchars($monstre["Niveau"]); ?></p>
    <p>Biographie: <?php echo htmlspecialchars($monstre["Biographie"]); ?></p>

    <h2>Commentaires</h2>
    <a href="index.php">Retour à la liste des monstres</a>
</body>
</html>
