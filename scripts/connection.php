<?php

/**
 * Script de connexion à la base de données
 * Établit la connexion PDO avec gestion des erreurs et de l'encodage
 */
// Options pour la gestion de l'encodage
$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $encodage);

/**
 * Tentative de connexion à la base de données
 */
try {
    $connection = new PDO('mysql:host=' . $hote . ';port=' . $port . ';dbname=' . $nom_bd, $identifiant, $mot_de_passe, $options);
    if ($debug) {
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
} catch (PDOException $erreur) {
    echo "Serveur actuellement innaccessible, veuillez nous excuser.";
    exit();
}
