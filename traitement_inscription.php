<?php

$serveur = "localhost";
$utilisateur = "root";
$motdepasse_bdd = "";
$base = "omnesevent";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse_bdd, $base);

if (!$connexion) {
    die("Erreur de connexion - recommencez");
}

$nom = $_POST['nom'];
$email = $_POST['email'];
$motdepasse = md5($_POST['motdepasse']);
$role = $_POST['role'];

$requete_verif = "SELECT * FROM utilisateurs WHERE email = '$email'";
$resultat_verif = mysqli_query($connexion, $requete_verif);

if (mysqli_num_rows($resultat_verif) > 0) {

    echo "Cet email est déjà utilisé.";

} else {

    $requete = "
    INSERT INTO utilisateurs(nom, email, motdepasse, role)
    VALUES('$nom', '$email', '$motdepasse', '$role')
    ";

    mysqli_query($connexion, $requete);

    header("Location: connexion.php");
    exit();
}

?>