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
$role = $_SESSION['role'];

$requete = "
SELECT *
FROM evenements
WHERE id = '$id_evenement'
";

$resultat = mysqli_query($connexion, $requete);

if (mysqli_num_rows($resultat) == 0) {
    header("Location: index.php");
    exit();
}

$evenement = mysqli_fetch_assoc($resultat);

if ($role == "admin" || $evenement['id_organisateur'] == $id_utilisateur) {

    $requete_reservations = "
    DELETE FROM reservations
    WHERE id_evenement = '$id_evenement'
    ";

    mysqli_query($connexion, $requete_reservations);

    $requete_suppression = "
    DELETE FROM evenements
    WHERE id = '$id_evenement'
    ";

    mysqli_query($connexion, $requete_suppression);

    header("Location: index.php");
    exit();

} else {

    echo "Vous n'avez pas le droit de supprimer cet événement.";
}

?>