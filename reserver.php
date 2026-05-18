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

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id_evenement = $_GET['id'];
$id_utilisateur = $_SESSION['id'];

$requete_evenement = "SELECT * FROM evenements WHERE id = '$id_evenement'";
$resultat_evenement = mysqli_query($connexion, $requete_evenement);

if (mysqli_num_rows($resultat_evenement) == 0) {
    header("Location: index.php");
    exit();
}

$evenement = mysqli_fetch_assoc($resultat_evenement);

$requete_deja_reserve = "
SELECT *
FROM reservations
WHERE id_utilisateur = '$id_utilisateur'
AND id_evenement = '$id_evenement'
";

$resultat_deja_reserve = mysqli_query($connexion, $requete_deja_reserve);

if (mysqli_num_rows($resultat_deja_reserve) > 0) {
    echo "Vous avez déjà réservé cet événement.";
    echo "<br><a href='mes_billets.php'>Voir mes billets</a>";
    exit();
}

$requete_nb = "
SELECT COUNT(*) AS nb_reservations
FROM reservations
WHERE id_evenement = '$id_evenement'
";

$resultat_nb = mysqli_query($connexion, $requete_nb);
$ligne_nb = mysqli_fetch_assoc($resultat_nb);

$nb_reservations = $ligne_nb['nb_reservations'];

if ($nb_reservations >= $evenement['capacite']) {
    echo "Désolé, cet événement est complet.";
    echo "<br><a href='index.php'>Retour à l'accueil</a>";
    exit();
}

$requete_reservation = "
INSERT INTO reservations(id_utilisateur, id_evenement)
VALUES('$id_utilisateur', '$id_evenement')
";

mysqli_query($connexion, $requete_reservation);

header("Location: mes_billets.php");
exit();

?>