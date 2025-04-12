<?php

/**
 * Script de modification des commentaires
 * Permet à un utilisateur de modifier son propre commentaire
 * Vérifie l'autorisation de l'utilisateur avant modification
 */
session_start();
include('config/configuration.php');
include('scripts/connection.php');

/**
 * Vérification des droits d'accès
 */
if (!isset($_SESSION['utilisateur_id']) || !isset($_POST['id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

/**
 * Préparation des données
 */
$id_commentaire = intval($_POST['id']);
$nouveau_contenu = $_POST['contenu'];

/**
 * Vérification de l'appartenance du commentaire
 */
$requete_verification = "SELECT Id_utilisateur FROM commentaires WHERE id_commentaire = :id";
$stmt = $connection->prepare($requete_verification);
$stmt->bindParam(':id', $id_commentaire);
$stmt->execute();
$commentaire = $stmt->fetch();

if ($commentaire && $commentaire['Id_utilisateur'] === $_SESSION['utilisateur_id']) {
    $requete_maj = "UPDATE commentaires SET Contenu_commentaire = :contenu WHERE id_commentaire = :id";
    $stmt = $connection->prepare($requete_maj);
    $stmt->bindParam(':id', $id_commentaire);
    $stmt->bindParam(':contenu', $nouveau_contenu);
    $stmt->execute();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
