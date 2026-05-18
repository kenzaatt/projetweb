<?php

session_start();

$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "omnesevent";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $base);

if (!$connexion) {
    die("Erreur de connexion");
}

if (!isset($_SESSION['id']) || $_SESSION['role'] != "organisateur") {
    header("Location: connexion.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Créer un événement</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <a href="index.php">Accueil</a>
    <a href="dashboard_organisateur.php">Espace organisateur</a>
    <a href="deconnexion.php">Déconnexion</a>
</nav>

<header>
    <h1>Créer un événement</h1>
</header>

<main>

    <form action="traitement_creation_evenement.php" method="POST" enctype="multipart/form-data">

        <label>Titre :</label>
        <input type="text" name="titre" required>

        <label>Description :</label>
        <textarea name="description" required></textarea>

        <label>Date :</label>
        <input type="date" name="date_event" required>

        <label>Lieu :</label>
        <input type="text" name="lieu" required>

        <label>Catégorie :</label>
        <select name="categorie" required>
            <option value="Soirée">Soirée</option>
            <option value="Sport">Sport</option>
            <option value="Culture">Culture</option>
        </select>

        <label>Association :</label>
        <input type="text" name="association" required>

        <label>Capacité maximale :</label>
        <input type="number" name="capacite" min="1" required>

        <label>Affiche :</label>
        <input type="file" name="affiche">

        <button type="submit">Créer l'événement</button>

    </form>

</main>

<footer>
    <p>OmnesEvent - Projet Web Dynamique ING2</p>
</footer>

</body>

</html>