<?php

session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] != "admin") {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard_admin.php");
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

$id = $_GET['id'];

$requete = "
UPDATE utilisateurs
SET valide = 1
WHERE id = '$id'
AND role = 'organisateur'
";

mysqli_query($connexion, $requete);

header("Location: dashboard_admin.php");
exit();

?>