<?php
session_start();
include('config/configuration.php');
include('scripts/connection.php');

$ID_Lieu_vie = isset($_GET['ID_Lieu_vie']) ? intval($_GET['ID_Lieu_vie']) : 0;
$requete_lieu = "
    SELECT 
        ID_Lieu_vie,
        Nom_du_lieu,
        Type_de_lieu,
        Description,
        image
    FROM 
        lieux_vie
    WHERE
        ID_Lieu_vie = :ID_Lieu_vie
";

$stmt_lieu = $connection->prepare($requete_lieu);
$stmt_lieu->bindParam(':ID_Lieu_vie', $ID_Lieu_vie, PDO::PARAM_INT);
$stmt_lieu->execute();
$lieu = $stmt_lieu->fetch(PDO::FETCH_ASSOC);
$stmt_lieu->closeCursor();

if (!$lieu) {
    echo "Lieu de vie non trouvé.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($lieu["Nom_du_lieu"]); ?></title>
</head>
<body>
    <h1><?php echo htmlspecialchars($lieu["Nom_du_lieu"]); ?></h1>

    <img src="images/<?php echo htmlspecialchars($lieu["image"]); ?>" alt="<?php echo htmlspecialchars($lieu["Nom_du_lieu"]); ?>" style="max-width: 400px; height: auto;" />

    <p>Type: <?php echo htmlspecialchars($lieu["Type_de_lieu"]); ?></p>
    <p>Description: <?php echo htmlspecialchars($lieu["Description"]); ?></p>

    <a href="index.php">Retour à la liste des lieux de vie</a>
</body>
</html>