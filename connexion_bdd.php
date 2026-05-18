<?php

$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base = "omnesevent";

$connexion = mysqli_connect(
    $serveur,
    $utilisateur,
    $motdepasse,
    $base
);

if (!$connexion) {
    die("Erreur de connexion");
}

?>