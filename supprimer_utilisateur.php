<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != "admin") {
    header("Location: index.php");
    exit();
}

$connexion = mysqli_connect("localhost", "root", "", "omnesevent");

if (!$connexion) {
    die("Erreur de connexion");
}

$id = $_GET['id'];

if ($id == $_SESSION['id']) {
    header("Location: dashboard_admin.php");
    exit();
}

$requete_reservations = "
DELETE FROM reservations
WHERE id_utilisateur = '$id'
";

mysqli_query($connexion, $requete_reservations);

$requete_evenements = "
DELETE FROM evenements
WHERE id_organisateur = '$id'
";

mysqli_query($connexion, $requete_evenements);

$requete_utilisateur = "
DELETE FROM utilisateurs
WHERE id = '$id'
";

mysqli_query($connexion, $requete_utilisateur);

header("Location: dashboard_admin.php");
exit();

?>