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

$requete = "
SELECT evenements.*, reservations.id AS id_reservation
FROM reservations
INNER JOIN evenements
ON reservations.id_evenement = evenements.id
WHERE reservations.id_utilisateur = '$id'
";

$resultat = mysqli_query($connexion, $requete);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mes Billets</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>

    <a href="index.php">Accueil</a>

    <a href="profil.php">Profil</a>

    <?php
    if ($_SESSION['role'] == "organisateur") {
        echo '<a href="dashboard_organisateur.php">Espace organisateur</a>';
    }
    ?>

    <a href="deconnexion.php">Déconnexion</a>

</nav>

<header>
    <h1>Mes Billets</h1>
</header>

<main>

<?php

if (mysqli_num_rows($resultat) > 0) {

    while ($evenement = mysqli_fetch_assoc($resultat)) {

        $contenu_qr = "Reservation:" . $evenement['id_reservation'] . " - " . $evenement['titre'] . " - " . $evenement['date_event'] . " - " . $evenement['lieu'];

        $url_qr = "https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=" . urlencode($contenu_qr);

?>

        <section class="carte">

            <h2>
                <?php echo $evenement['titre']; ?>
            </h2>

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

            <p><strong>Votre billet :</strong></p>

            <img src="<?php echo $url_qr; ?>" alt="QR Code billet">

        </section>

<?php

    }

} else {

    echo "<p>Vous n'avez aucun billet.</p>";
}

?>

</main>

<footer>
    <p>OmnesEvent</p>
</footer>

</body>

</html>