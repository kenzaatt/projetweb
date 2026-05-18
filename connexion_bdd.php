<?php

$serveur = "fdb1031.your-hosting.net";
$utilisateur = "4760301_ng2groupe3h26";
$motdepasse_bdd = "262026henrilekk+1@246";
$base = "4760301_ng2groupe3h26";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse_bdd, $base);

if (!$connexion) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

mysqli_set_charset($connexion, "utf8");

?>



