<?php

session_start();
//
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "omnesevent";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse, $base);

if (!$connexion) {
    die("Erreur de connexion");
}

$requete = "SELECT * FROM evenements WHERE 1=1";
//création de recherche dynamique
if (isset($_GET['categorie']) && $_GET['categorie'] != "") {

    $categorie = $_GET['categorie'];

    $requete .= " AND categorie = '$categorie'";
}

if (isset($_GET['association']) && $_GET['association'] != "") {

    $association = $_GET['association'];

    $requete .= " AND association LIKE '%$association%'";
}

if (isset($_GET['date_event']) && $_GET['date_event'] != "") {

    $date_event = $_GET['date_event'];

    $requete .= " AND date_event = '$date_event'";
}

$requete .= " ORDER BY date_event ASC";

$resultat = mysqli_query($connexion, $requete);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>OmnesEvent - Acccueil</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <a href="index.php">OmnesEvent Accueil</a>

    <?php
    if (isset($_SESSION['id'])) {
        echo '<a href="mes_billets.php">Mes billets</a>';
        echo '<a href="profil.php">Profil</a>';

        if ($_SESSION['role'] == "organisateur") {
            echo '<a href="dashboard_organisateur.php">Espace organisateur</a>';
        }

        echo '<a href="deconnexion.php">Déconnexion</a>';
    } else {
        echo '<a href="connexion.php">Connexion</a>';
        echo '<a href="inscription.php">Inscription</a>';
    }
    ?>
</nav>

<header>
    <h1>OmnesEvent</h1>
    <p>La plateforme des événements étudiants d’Oomnes</p>

    <?php
    if (isset($_SESSION['nom'])) {
        echo "<p>Bienvenue " . $_SESSION['nom'] . "</p>";
    }
    ?>
</header>

<main>
     <h2> Rechercher Evénement</h2>
    <form method="GET" action="index.php">

    <label>Date :</label>
    <input type="date" name="date_event">

    <label>Catégorie :</label>
    <select name="categorie">

        <option value="">Toutes</option>
        <option value="Soirée">Soirée</option>
        <option value="Sport">Sport</option>
        <option value="Culture">Culture</option>

    </select>

    <label>Association :</label>
    <input type="text" name="association">

    <button type="submit">
        Rechercher
    </button>

</form>


    <h2>Événements à venir</h2>

    <?php
    if (mysqli_num_rows($resultat) > 0) {

        while ($evenement = mysqli_fetch_assoc($resultat)) {
    ?>

            <section class="carte">

                <h3>
                    <?php echo $evenement['titre']; ?>
                </h3>

                <p>
                    <?php echo $evenement['description']; ?>
                </p>

                <p>
                    <strong>Date :</strong>
                    <?php echo $evenement['date_event']; ?>
                </p>

                <p>
                    <strong>Lieu :</strong>
                    <?php echo $evenement['lieu']; ?>
                </p>

                <p>
                    <strong>Catégorie :</strong>
                    <?php echo $evenement['categorie']; ?>
                </p>

                <a href="detail_evenement.php?id=<?php echo $evenement['id']; ?>">
                    Voir l'événement
                </a>

            </section>

    <?php
        }

    } else {
        echo "<p>Aucun événement disponible pour le moment.</p>";
    }
    ?>

</main>

<footer>
    <p>OmnesEvent - Projet Web Dynamique ING2</p>
</footer>

</body>

</html>