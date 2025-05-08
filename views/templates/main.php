<?php
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.
 *
 * Les variables qui doivent impérativement être définie sont :
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page.
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emilie Forteroche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

</head>

<body>
<header>
    <nav>
        <ul class="menu">
            <li><a href="index.php">Articles</a></li>
            <li><a href="index.php?action=apropos">À propos</a></li>
            <?php
            // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion :
            if (isset($_SESSION['user'])) {
                //$user_actif =;
                echo ' <li class="menu-item"> <a href="#">Connecté :' . $_SESSION['login'] . '</a>';
                echo ' <ul class="submenu">';
                echo '<li> <a href="index.php?action=admin">Liste des articles</a> </li>';
                echo '<li> <a href="index.php?action=ShowStatistics">Liste des commentaires</a> </li>';
                echo '</ul> </li>';
                echo '<li><a href="index.php?action=disconnectUser">Déconnexion</a></li>';
            }
            ?>

        </ul>
    </nav>
    <h1>Emilie Forteroche</h1>
</header>

<main>
    <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
</main>

<footer>
    <p>Copyright © Emilie Forteroche 2023 - Openclassrooms - <a href="index.php?action=admin">Admin</a>
</footer>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script src="./js/DataTableAction.js"></script>

</body>
</html>