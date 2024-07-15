<?php 
    /** 
     * Affichage de la partie admin : statistiques de consultation globales. 
     */
?>

<h2>Statistiques de consultation globales du mois en cours</h2>

<div>
    <?php
    /**
     * Méthode de création dynamique de tableaux croisés
     */
    Utils::createTable($stats);
    ?>
</div>

<nav>
    <div class="nav">
        <a class="submit" href="index.php?action=admin">Retour aux articles</a>

    </div>
</nav>