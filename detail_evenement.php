<?php

session_start();

$serveur = "localhost";
$utilisateur = "root";
$motdepasse_bdd = "";
$base = "omnesevent";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse_bdd, $base);

if (!$connexion) {
    die("Erreur de connexion");
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_evenement = $_GET['id'];

$requete = "SELECT * FROM evenements WHERE id = '$id_evenement'";
$resultat = mysqli_query($connexion, $requete);

if (mysqli_num_rows($resultat) == 0) {
    header("Location: index.php");
    exit();
}

$evenement = mysqli_fetch_assoc($resultat);

$requete_places = "
SELECT COUNT(*) AS nb_reservations
FROM reservations
WHERE id_evenement = '$id_evenement'
";

$resultat_places = mysqli_query($connexion, $requete_places);
$places = mysqli_fetch_assoc($resultat_places);

$places_restantes = $evenement['capacite'] - $places['nb_reservations'];

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Détail événement</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <a href="index.php">Accueil</a>

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
    <h1><?php echo $evenement['titre']; ?></h1>
</header>

<main>

    <section class="carte">

         <img src="assets/uploads/<?php echo $evenement['affiche']; ?>">
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

        <p>
            <strong>Association :</strong>
            <?php echo $evenement['association']; ?>
        </p>

        <p>
            <strong>Capacité maximale :</strong>
            <?php echo $evenement['capacite']; ?>
        </p>

        <p>
            <strong>Places restantes :</strong>
            <?php echo $places_restantes; ?>
        </p>

        <?php
        if (isset($_SESSION['id'])) {

            if ($places_restantes > 0) {
                echo '<a href="reserver.php?id=' . $evenement['id'] . '">Réserver ma place</a>';
            } else {
                echo "<p>Événement complet.</p>";
            }

        } else {
            echo '<p>Connectez-vous pour réserver cet événement.</p>';
            echo '<a href="connexion.php">Se connecter</a>';
        }
        ?>

    </section>

</main>

<footer>
    <p>OmnesEvent</p>
</footer>

</body>

</html>