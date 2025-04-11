<?php
include('config/configuration.php');
include('scripts/connection.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <h1>CONNEXION</h1>

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

    <br><a href="inscription.php">S'inscrire</a>
</body>
</html>