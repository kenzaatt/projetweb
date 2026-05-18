<?php

include_once 'connexion_bdd.php';

$nom = $_POST['nom'];
$email = $_POST['email'];
$motdepasse = md5($_POST['motdepasse']);
$role = $_POST['role'];

if ($role == "participant") {

    $valide = 1;

} else {

    $valide = 0;
}

$requete_verif = "
SELECT *
FROM utilisateurs
WHERE email = '$email'
";

$resultat_verif = mysqli_query($connexion, $requete_verif);

if (mysqli_num_rows($resultat_verif) > 0) {

    echo "Cet email est déjà utilisé.";

} else {

    $requete = "
    INSERT INTO utilisateurs(
    nom,
    email,
    motdepasse,
    role,
    valide
    )

    VALUES(
    '$nom',
    '$email',
    '$motdepasse',
    '$role',
    '$valide'
    )
    ";

    mysqli_query($connexion, $requete);

    header("Location: connexion.php");
    exit();
}

?>