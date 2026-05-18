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

include_once 'connexion_bdd.php';

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