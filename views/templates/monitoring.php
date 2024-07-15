<?php 
    /** 
     * Affichage de la partie admin : statistiques de consultation des articles et commentaires. 
     */
?>

<h2>Statistiques de consultation</h2>

<div>
    <?php
    Utils::createTable($statsArticle);
    ?>
</div>

<nav>
    <div class="nav">
        <a class="submit" href="index.php?action=admin">Retour aux articles</a>

    </div>
</nav>