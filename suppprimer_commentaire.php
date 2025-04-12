<?php

/**
 * Script de suppression des commentaires
 * Permet à un utilisateur de supprimer son propre commentaire
 * Vérifie l'autorisation de l'utilisateur avant suppression
 */
session_start();
include('config/configuration.php');
include('scripts/connection.php');

/**
 * Vérification des droits d'accès
 */
if (!isset($_SESSION['utilisateur_id'])) {
    header("HTTP/1.1 403 Forbidden");
    exit();
}

/**
 * Récupération et validation de l'ID du commentaire
 */
$id_commentaire = isset($_GET['id']) ? intval($_GET['id']) : 0;

/**
 * Vérification de l'appartenance du commentaire
 */
$requete_verification = "SELECT Id_utilisateur FROM commentaires WHERE id_commentaire = :id";
$stmt = $connection->prepare($requete_verification);
$stmt->bindParam(':id', $id_commentaire);
$stmt->execute();
$commentaire = $stmt->fetch();

if ($commentaire && $commentaire['Id_utilisateur'] === $_SESSION['utilisateur_id']) {
    $requete_suppression = "DELETE FROM commentaires WHERE id_commentaire = :id";
    $stmt = $connection->prepare($requete_suppression);
    $stmt->bindParam(':id', $id_commentaire);
    $stmt->execute();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
