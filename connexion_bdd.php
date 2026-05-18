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

try
{
$host = 'fdb1031 .your - hosting . net ';
$nom_base = '4470413 _test ';
$utilisateur = '4470413 _test ';
$mot_de_passe = 'votre mot de passe ... ';
$bdd = new PDO ('mysql : host =' . $host . '; dbname ='. $nom_base .';
charset = utf8 ', $utilisateur , $mot_de_passe ,
array (PDO :: ATTR_ERRMODE => PDO :: ERRMODE_EXCEPTION ));
}
catch ( Exception $e)
{
die ('Erreur : ' . $e - > getMessage () ) ;
}

?>

