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

$titre = $_POST['titre'];
$description = $_POST['description'];
$date_event = $_POST['date_event'];
$lieu = $_POST['lieu'];
$categorie = $_POST['categorie'];
$association = $_POST['association'];
$capacite = $_POST['capacite'];
$id_organisateur = $_SESSION['id'];

$affiche = "";


$requete = "
INSERT INTO evenements(titre, description, date_event, lieu, categorie, association, capacite, id_organisateur)
VALUES('$titre', '$description', '$date_event', '$lieu', '$categorie', '$association', '$capacite', '$id_organisateur')
";

mysqli_query($connexion, $requete);

header("Location: dashboard_organisateur.php");

?>