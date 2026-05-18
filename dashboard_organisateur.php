<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SESSION['role'] != "organisateur") {
    header("Location: index.php");
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

$id_organisateur = $_SESSION['id'];

$requete = "
SELECT *
FROM evenements
WHERE id_organisateur = '$id_organisateur'
ORDER BY date_event ASC
";

$resultat = mysqli_query($connexion, $requete);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Espace Organisateur</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>

    <a href="index.php">Accueil</a>

    <a href="profil.php">Profil</a>

    <a href="mes_billets.php">Mes billets</a>

    <a href="creer_evenement.php">Créer un événement</a>

    <a href="deconnexion.php">Déconnexion</a>

</nav>

<header>
    <h1>Espace Organisateur</h1>
</header>

<main>

    <h2>Mes événements</h2>

<?php

if (mysqli_num_rows($resultat) > 0) {

    while ($evenement = mysqli_fetch_assoc($resultat)) {

?>

        <section class="carte">

            <h3>
                <?php echo $evenement['titre']; ?>
            </h3>

            <p>
                <?php echo $evenement['description']; ?>
            </p>

            <p>
                <strong>Date :</strong>
                <?php echo $evenement['date_event']; ?>
            </p>

            <p>
                <strong>Lieu :</strong>
                <?php echo $evenement['lieu']; ?>
            </p>

            <p>
                <strong>Capacité :</strong>
                <?php echo $evenement['capacite']; ?>
            </p>

            <a href="supprimer_evenement.php?id=<?php echo $evenement['id']; ?>">
            Supprimer
            </a>

        </section>

<?php

    }

} else {

    echo "<p>Aucun événement créé.</p>";
}

?>

</main>

<footer>
    <p>OmnesEvent</p>
</footer>

</body>

</html>