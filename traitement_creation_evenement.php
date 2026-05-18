<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

include_once 'connexion_bdd.php';

$titre = $_POST['titre'];
$description = $_POST['description'];
$date_event = $_POST['date_event'];
$lieu = $_POST['lieu'];
$categorie = $_POST['categorie'];
$association = $_POST['association'];
$capacite = $_POST['capacite'];
$id_organisateur = $_SESSION['id'];

$affiche = "";

if (isset($_FILES['affiche']) && $_FILES['affiche']['name'] != "") {

    if (!is_dir("uploads")) {
        mkdir("uploads");
    }

    $affiche = $_FILES['affiche']['name'];

    move_uploaded_file(
        $_FILES['affiche']['tmp_name'],
        "uploads/" . $affiche
    );
}

$requete = "
INSERT INTO evenements(
titre,
description,
date_event,
lieu,
categorie,
association,
affiche,
capacite,
id_organisateur
)
VALUES(
'$titre',
'$description',
'$date_event',
'$lieu',
'$categorie',
'$association',
'$affiche',
'$capacite',
'$id_organisateur'
)
";

mysqli_query($connexion, $requete);

header("Location: dashboard_organisateur.php");
exit();

?>