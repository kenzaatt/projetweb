<?php

session_start();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription - OmnesEvent</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <a href="index.php">Accueil</a>
    <a href="connexion.php">Connexion</a>
    <a href="inscription.php">Inscription</a>
</nav>

<header>
    <h1>Inscription</h1>
    <p>Créer un compte sur OmnesEvent</p>
</header>

<main>

    <form action="traitement_inscription.php" method="POST">

        <label>Nom :</label>
        <input type="text" name="nom" required>

        <label>Email :</label>
        <input type="email" name="email" required>

        <label>Mot de passe :</label>
        <input type="password" name="motdepasse" required>

        <label>Rôle :</label>
        <select name="role">
            <option value="participant">Participant</option>
            <option value="organisateur">Organisateur</option>
        </select>

        <button type="submit">Créer mon compte</button>

    </form>

</main>

<footer>
    <p>OmnesEvent - Projet Web Dynamique ING2</p>
</footer>

</body>

</html>