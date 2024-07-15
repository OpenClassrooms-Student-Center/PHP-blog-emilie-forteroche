<?php 
    /** 
     * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun. 
     * Et un formulaire pour ajouter un article. 
     */
?>

<h2>Edition des articles</h2>

<div class="adminArticle">
    <?php foreach ($articles as $article) { ?>
        <div class="articleLine">
            <div class="title"><?= $article->getTitle() ?></div>
            <div class="content"><?= $article->getContent(200) ?></div>
            <div><a class="submit" href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">Modifier</a></div>
            <div><a class="submit" href="index.php?action=deleteArticle&id=<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?> >Supprimer</a></div>
            <div><a class="submit" href="index.php?action=displayComments&id=<?= $article->getId() ?>">Commentaires</a></div>
        </div>
    <?php } ?>
</div>
<nav>
    <div class="nav">
        <a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>
        <a class="submit" href="index.php?action=statsArticle">Voir les statistiques des articles</a>
        <a class="submit" href="index.php?action=statsGlobales">Statistiques globales</a>

    </div>
</nav>