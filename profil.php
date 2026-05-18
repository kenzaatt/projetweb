<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

$serveur = "localhost";
$utilisateur = "root";
$motdepasse_bdd = "";
$base = "omnesevent";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse_bdd, $base);

if (!$connexion) {
    die("Erreur de connexion");
}

$id = $_SESSION['id'];

$requete = "SELECT * FROM utilisateurs WHERE id = '$id'";

$resultat = mysqli_query($connexion, $requete);

$profil = mysqli_fetch_assoc($resultat);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Profil</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>

    <a href="index.php">Accueil</a>

    <a href="mes_billets.php">Mes billets</a>

    <?php
    if ($_SESSION['role'] == "organisateur") {
        echo '<a href="dashboard_organisateur.php">Espace organisateur</a>';
    }
    ?>

    <a href="deconnexion.php">Déconnexion</a>

</nav>

<header>
    <h1>Mon Profil</h1>
</header>

<main>

    <section class="carte">

        <h2>Informations</h2>

        <p>
            <strong>Nom :</strong>
            <?php echo $profil['nom']; ?>
        </p>

        <p>
            <strong>Email :</strong>
            <?php echo $profil['email']; ?>
        </p>

        <p>
            <strong>Rôle :</strong>
            <?php echo $profil['role']; ?>
        </p>

    </section>

</main>

<footer>
    <p>OmnesEvent</p>
</footer>

</body>

</html>