<?php

session_start();

$serveur = "localhost";
$utilisateur = "root";
$motdepasse_bdd = "";
$base = "omnesevent";

$connexion = mysqli_connect($serveur, $utilisateur, $motdepasse_bdd, $base);

if (!$connexion) {
    die("Erreur de connexion");
}

$email = $_POST['email'];

$motdepasse = md5($_POST['motdepasse']);

$requete = "
SELECT *
FROM utilisateurs
WHERE email = '$email'
AND motdepasse = '$motdepasse'
";

$resultat = mysqli_query($connexion, $requete);

if (mysqli_num_rows($resultat) == 1) {

    $utilisateur = mysqli_fetch_assoc($resultat);

    $_SESSION['id'] = $utilisateur['id'];

    $_SESSION['nom'] = $utilisateur['nom'];

    $_SESSION['role'] = $utilisateur['role'];

    header("Location: index.php");
    exit();

} else {

    echo "Email ou mot de passe incorrect";

}

?>