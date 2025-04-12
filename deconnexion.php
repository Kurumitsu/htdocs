<?php

/**
 * Script de déconnexion
 * Détruit la session utilisateur et redirige vers la page d'accueil
 */
session_start();
session_unset();
session_destroy();
header("Location: index.php");
exit();
