<?php
include_once 'connexion_bdd.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="UTF-8">

    <title>Connexion</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<nav>

    <a href="index.php">Accueil</a>

    <a href="connexion.php">Connexion</a>

    <a href="inscription.php">Inscription</a>

</nav>

<main>

    <h1>Connexion</h1>

    <form action="traitement_connexion.php" method="POST">

        <label>Email :</label>

        <input type="email" name="email" required>

        <label>Mot de passe :</label>

        <input type="password" name="motdepasse" required>

        <button type="submit">
            Se connecter
        </button>

    </form>

</main>

<footer>

    <p>
        OmnesEvent - Projet Web Dynamique
    </p>

</footer>

</body>

</html>