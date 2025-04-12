<?php

/**
 * Page de détail d'un monstre
 * Affiche les informations détaillées d'un monstre spécifique
 * Gère l'affichage et la gestion des commentaires associés
 * Affiche les armes et armures liées au monstre
 */
session_start();
include('config/configuration.php');
include('scripts/connection.php');

/**
 * Récupération et validation de l'ID du monstre
 */
$ID_Monstre = isset($_GET['ID_Monstre']) ? intval($_GET['ID_Monstre']) : 0;

/**
 * Requête pour les informations du monstre et son lieu de vie
 */
$requete_monstre = "SELECT m.ID_Monstre, m.Nom_Monstre, m.Niveau, m.Biographie, m.Image_Monstre,
lv.Nom_du_lieu AS Lieu_de_vie
FROM monstres m
INNER JOIN lieux_vie lv ON m.ID_Lieu_vie = lv.ID_Lieu_vie
WHERE m.ID_Monstre = :ID_Monstre";

$stmt_monstre = $connection->prepare($requete_monstre);
$stmt_monstre->bindParam(':ID_Monstre', $ID_Monstre, PDO::PARAM_INT);
$stmt_monstre->execute();
$monstre = $stmt_monstre->fetch(PDO::FETCH_ASSOC);

/**
 * Vérification de l'existence du monstre
 */
if (!$monstre) {
	echo "Monstre non trouvé.";
	exit();
}

/**
 * Récupération des armes et armures du monstre
 */
$id_armure_arme = isset($_GET['ID_Arme_Armure']) ? intval($_GET['ID_Arme_Armure']) : 0;
$requete_arme_armure = "SELECT ID_Arme_Armure,Nom,Type,Puissance,Defense,Niveau
FROM armes_armures
WHERE ID_Monstre = :ID_Monstre";

$ARM_ARMURE = $connection->prepare($requete_arme_armure);
$ARM_ARMURE->bindParam(':ID_Monstre', $ID_Monstre, PDO::PARAM_INT);
$ARM_ARMURE->execute();
$ARME_ARMURE = $ARM_ARMURE->fetchAll((PDO::FETCH_ASSOC));
$ARM_ARMURE->closeCursor();

/**
 * Traitement des commentaires
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['contenu_commentaire']) && isset($_SESSION['utilisateur_id'])) {
		// Ajout nouveau commentaire
		$requete_commentaire = "INSERT INTO commentaires (Id_utilisateur, ID_Monstre, Contenu_commentaire)
		VALUES (:Id_utilisateur, :ID_Monstre, :contenu_commentaire)";

		$stmt = $connection->prepare($requete_commentaire);
		$stmt->execute([
			':Id_utilisateur' => $_SESSION['utilisateur_id'],
			':ID_Monstre' => $ID_Monstre,
			':contenu_commentaire' => $_POST['contenu_commentaire']
		]);

		header("Location: monstre.php?ID_Monstre=" . $ID_Monstre);
		exit();
	}

	if (isset($_POST['action'])) {
		// Modification commentaire existant
		$id_comm = intval($_POST['id_comm']);

		// Vérification propriétaire
		$stmt = $connection->prepare("SELECT Id_utilisateur FROM commentaires WHERE id_comm = ?");
		$stmt->execute([$id_comm]);
		$proprietaire = $stmt->fetchColumn();

		if ($proprietaire == $_SESSION['utilisateur_id']) {
			if ($_POST['action'] == 'modifier') {
				$stmt = $connection->prepare("UPDATE commentaires SET Contenu_commentaire = ? WHERE id_comm = ?");
				$stmt->execute([$_POST['contenu_modifie'], $id_comm]);
			} elseif ($_POST['action'] == 'supprimer') {
				$stmt = $connection->prepare("DELETE FROM commentaires WHERE id_comm = ?");
				$stmt->execute([$id_comm]);
			}
		}
		header("Location: monstre.php?ID_Monstre=" . $ID_Monstre);
		exit();
	}
}

/**
 * Récupération des commentaires avec id_comm et Id_utilisateur
 */
$requete_commentaires = "SELECT c.id_comm, c.Id_utilisateur, c.Contenu_commentaire, u.Pseudo
FROM commentaires c
INNER JOIN utilisateur u ON c.Id_utilisateur = u.Id_utilisateur
WHERE c.ID_Monstre = :ID_Monstre
ORDER BY c.id_comm DESC";

$stmt_commentaires = $connection->prepare($requete_commentaires);
$stmt_commentaires->bindParam(':ID_Monstre', $ID_Monstre, PDO::PARAM_INT);
$stmt_commentaires->execute();
$commentaires = $stmt_commentaires->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= htmlspecialchars($monstre["Nom_Monstre"]) ?></title>
	<script>
		function confirmerSuppression(id) {
			if (confirm("Êtes-vous sûr de vouloir supprimer ce commentaire ?")) {
				document.getElementById('form-' + id).action = 'monstre.php?ID_Monstre=<?= $ID_Monstre ?>';
				document.getElementById('action-' + id).value = 'supprimer';
				document.getElementById('form-' + id).submit();
			}
		}

		function activerEdition(id) {
			const affichage = document.getElementById('commentaire-' + id);
			const edition = document.getElementById('edition-' + id);
			affichage.style.display = 'none';
			edition.style.display = 'block';
		}
	</script>
</head>

<body>
	<h1><?= htmlspecialchars($monstre["Nom_Monstre"]) ?></h1>
	<img src="images/<?= htmlspecialchars($monstre["Image_Monstre"]) ?>" alt="<?= htmlspecialchars($monstre["Nom_Monstre"]) ?>" style="max-width:200px">

	<p>Lieu de vie: <?= htmlspecialchars($monstre["Lieu_de_vie"]) ?></p>
	<p>Niveau: <?= htmlspecialchars($monstre["Niveau"]) ?></p>
	<p>Biographie: <?= htmlspecialchars($monstre["Biographie"]) ?></p>

	<h2>Arme(s) et Armure(s) liée(s)</h2>

	<?php if (!empty($ARME_ARMURE)): ?>
		<ul> <?php foreach ($ARME_ARMURE as $equipement): ?>
				<li>
					<?php echo htmlspecialchars($equipement["Nom"]) ?>
					(<?php echo htmlspecialchars($equipement["Type"]) ?>)
					Puissance: <?php echo htmlspecialchars($equipement["Puissance"]) ?>
					Defense: <?php echo htmlspecialchars($equipement["Defense"]) ?>
					Niveau: <?php echo htmlspecialchars($equipement["Niveau"]) ?>
				</li>
			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p>Rien associée à ce monstre</p>
	<?php endif; ?>

	<a href="index.php">Retour aux monstres</a>

	<h2>Commentaires</h2>

	<?php if (isset($_SESSION['utilisateur_id'])): ?>
		<form method="POST">
			<textarea name="contenu_commentaire" required></textarea><br>
			<button type="submit">Poster</button>
		</form>
	<?php else: ?>
		<p><a href="connexion.php">Connectez-vous</a> pour commenter</p>
	<?php endif; ?>

	<?php foreach ($commentaires as $commentaire): ?>
		<div style="border:1px solid #ccc; margin:10px 0; padding:10px">
			<p><strong><?= htmlspecialchars($commentaire["Pseudo"]) ?>:</strong></p>

			<!-- Affichage normal -->
			<div id="commentaire-<?= $commentaire['id_comm'] ?>">
				<p><?= htmlspecialchars($commentaire["Contenu_commentaire"]) ?></p>

				<?php if (isset($_SESSION['utilisateur_id']) && $_SESSION['utilisateur_id'] == $commentaire['Id_utilisateur']): ?>
					<button onclick="activerEdition(<?= $commentaire['id_comm'] ?>)">Modifier</button>
					<button onclick="confirmerSuppression(<?= $commentaire['id_comm'] ?>)">Supprimer</button>
				<?php endif; ?>
			</div>

			<!-- Formulaire d'édition caché -->
			<div id="edition-<?= $commentaire['id_comm'] ?>" style="display:none">
				<form id="form-<?= $commentaire['id_comm'] ?>" method="POST">
					<textarea name="contenu_modifie"><?= htmlspecialchars($commentaire["Contenu_commentaire"]) ?></textarea><br>
					<input type="hidden" name="id_comm" value="<?= $commentaire['id_comm'] ?>">
					<input type="hidden" id="action-<?= $commentaire['id_comm'] ?>" name="action" value="modifier">
					<button type="submit">Enregistrer</button>
					<button type="button" onclick="document.getElementById('edition-<?= $commentaire['id_comm'] ?>').style.display='none'">Annuler</button>
				</form>
			</div>
		</div>
	<?php endforeach; ?>

	<a href="index.php">Retour aux monstres</a>
</body>

</html>
