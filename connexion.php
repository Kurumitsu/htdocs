<?php
session_start();
include('config/configuration.php');
include('scripts/connection.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];

    $requete_utilisateur = "SELECT * FROM utilisateur WHERE Email = :email AND pseudo = :pseudo";
    $connection = $connection->prepare($requete_utilisateur);
    $connection->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $connection->bindParam(':email', $email, PDO::PARAM_STR);
    $connection->execute();

    if ($utilisateur = $connection->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($pwd, $utilisateur['Pwd'])) {
            $_SESSION['utilisateur_id'] = $utilisateur['Id_utilisateur'];
            $_SESSION['pseudo'] = $utilisateur['Pseudo'];
            header("Location: index.php");
            exit();
        } else {
            $message = "Mot de passe incorrect.";
        }
    } else {
        $message = "Email ou pseudo incorrect ou les deux.";
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

        <button type="submit">connexion</button>
    </form>

    <br><a href="inscription.php">S'inscrire</a>
</body>

</html>
