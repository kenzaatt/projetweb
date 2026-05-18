<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SESSION['role'] != "admin") {
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

$requete_organisateurs = "
SELECT *
FROM utilisateurs
WHERE role LIKE '%organisateur%'
AND valide = 0
";

$resultat_organisateurs = mysqli_query($connexion, $requete_organisateurs);

$requete_utilisateurs = "
SELECT *
FROM utilisateurs
ORDER BY role ASC
";

$resultat_utilisateurs = mysqli_query($connexion, $requete_utilisateurs);

$requete_evenements = "
SELECT *
FROM evenements
ORDER BY date_event ASC
";

$resultat_evenements = mysqli_query($connexion, $requete_evenements);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Espace Administrateur</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<nav>

    <a href="index.php">Accueil</a>

    <a href="profil.php">Profil</a>

    <a href="mes_billets.php">Mes billets</a>

    <a href="deconnexion.php">Déconnexion</a>

</nav>

<header>

    <h1>Espace Administrateur</h1>

    <p>
        Gestion des utilisateurs et des événements
    </p>

</header>

<main>

    <h2>Organisateurs en attente de validation</h2>

<?php

if (mysqli_num_rows($resultat_organisateurs) > 0) {

    while ($organisateur = mysqli_fetch_assoc($resultat_organisateurs)) {

?>

        <section class="carte">

            <p>
                <strong>Nom :</strong>
                <?php echo $organisateur['nom']; ?>
            </p>

            <p>
                <strong>Email :</strong>
                <?php echo $organisateur['email']; ?>
            </p>

            <p>
                <strong>Compte validé :</strong>
                <?php echo $organisateur['valide']; ?>
            </p>

            <a href="valider_organisateur.php?id=<?php echo $organisateur['id']; ?>">
                Valider cet organisateur
            </a>

        </section>

<?php

    }

} else {

    echo "<p>Aucun organisateur en attente.</p>";
}

?>

    <h2>Tous les utilisateurs</h2>

<?php

if (mysqli_num_rows($resultat_utilisateurs) > 0) {

    while ($utilisateur = mysqli_fetch_assoc($resultat_utilisateurs)) {

?>

        <section class="carte">

            <p>
                <strong>Nom :</strong>
                <?php echo $utilisateur['nom']; ?>
            </p>

            <p>
                <strong>Email :</strong>
                <?php echo $utilisateur['email']; ?>
            </p>

            <p>
                <strong>Rôle :</strong>
                <?php echo $utilisateur['role']; ?>
            </p>

            <p>
                <strong>Compte validé :</strong>
                <?php echo $utilisateur['valide']; ?>
            </p>

<?php
if ($utilisateur['id'] != $_SESSION['id']) {
?>

                <a href="supprimer_utilisateur.php?id=<?php echo $utilisateur['id']; ?>">
                    Supprimer cet utilisateur
                </a>

<?php
}
?>

        </section>

<?php

    }

} else {

    echo "<p>Aucun utilisateur trouvé.</p>";
}

?>

    <h2>Tous les événements</h2>

<?php

if (mysqli_num_rows($resultat_evenements) > 0) {

    while ($evenement = mysqli_fetch_assoc($resultat_evenements)) {

?>

        <section class="carte">

            <h3>
                <?php echo $evenement['titre']; ?>
            </h3>

<?php
if ($evenement['affiche'] != "") {
?>

                <img
                    src="uploads/<?php echo $evenement['affiche']; ?>"
                    alt="Affiche événement"
                    style="width:100%; max-width:400px; border-radius:10px; margin-bottom:15px;"
                >

<?php
}
?>

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
                <strong>Catégorie :</strong>
                <?php echo $evenement['categorie']; ?>
            </p>

            <a href="supprimer_evenement.php?id=<?php echo $evenement['id']; ?>">
                Supprimer cet événement
            </a>

        </section>

<?php

    }

} else {

    echo "<p>Aucun événement disponible.</p>";
}

?>

</main>

<footer>

    <p>
        OmnesEvent - Espace Administrateur
    </p>

</footer>

</body>

</html>