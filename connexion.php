<?php
include('config/configuration.php');
include('scripts/connection.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT); 

    $requete_utilisateur = "SELECT COUNT(*) FROM utilisateur WHERE Email = :email";
    $utilisateur1 = $connection->prepare($requete_utilisateur);
    $utilisateur1->bindParam(':email', $email, PDO::PARAM_STR);
    $utilisateur1->execute();


    if ($utilisateur = $utilisateur1->fetch(PDO::FETCH_ASSOC))
    //* {
        //*if {
           //* $_SESSION['Pwd'] = $utilisateur['Pwd'];
             //*   $_SESSION['id_utilisateur'] = $utilisateur['id_utilisateur'];
       //* $_SESSION['pseudo'] = $utilisateur['pseudo'];
    //* }
    //* else {
    //*     $message="Mot de passe incorrect"
    //* }
    //* }header("location: index.php");
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

        <button type="submit">S'inscrire</button>
    </form>

    <br><a href="inscription.php">S'inscrire</a>
</body>
</html>