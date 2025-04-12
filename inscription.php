<?php

/**
 * Page d'inscription des utilisateurs
 * Gère la création de nouveaux comptes utilisateurs
 * Vérifie l'unicité de l'email et crypte le mot de passe
 */
session_start();
include('config/configuration.php');
include('scripts/connection.php');

/**
 * Message d'erreur ou de succès
 */
$message = '';

/**
 * Traitement du formulaire d'inscription
 */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    // Vérification de l'unicité de l'email
    $requete_email_existe = "SELECT COUNT(*) FROM utilisateur WHERE Email = :email";
    $stmt_email_existe = $connection->prepare($requete_email_existe);
    $stmt_email_existe->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt_email_existe->execute();
    $email_existe = $stmt_email_existe->fetchColumn();

    if ($email_existe > 0) {
        $message = "Cet email est déjà utilisé.";
    } else {
        $requete_insert = "INSERT INTO utilisateur (Pseudo, Email, Pwd) VALUES (:pseudo, :email, :pwd)";
        $insert = $connection->prepare($requete_insert);
        $insert->bindParam(':pseudo', $pseudo);
        $insert->bindParam(':email', $email);
        $insert->bindParam(':pwd', $pwd);

        if ($insert->execute()) {
            header("Location: connexion.php");
            exit();
        } else {
            $message = "Erreur lors de l'inscription.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>

<body>
    <h1>Inscription</h1>

    <?php if ($message): ?>
        <p><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="pseudo">Pseudo:</label>
        <input type="text" id="pseudo" name="pseudo" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="pwd">Mot de passe:</label>
        <input type="password" id="pwd" name="pwd" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>

    <a href="connexion.php">Déjà inscrit? Se connecter</a>
</body>

</html>
