<?php 
    /** 
     * Affichage de la partie admin : commentaires et suppression des commentaires. 
     */
?>

<h2>Gestion des commentaires</h2>
<div>
    <?php Utils::createTable($comments);?>
</div>

<nav>
    <div class="nav">
        <a class="submit" href="index.php?action=admin">Retour aux articles</a>

    </div>
</nav>