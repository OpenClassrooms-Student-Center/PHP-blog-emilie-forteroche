<?php 
    /** 
     * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun. 
     * Et un formulaire pour ajouter un article. 
     */
?>

<div class="adminMenu">
    <a class="adminBtnMenu <?= ($_GET['action'] ?? '') === 'dashboard' ? 'inactive' : '' ?>" href="index.php?action=admin"><h2>Edition des articles</h2></a>
    <p class="separator">|</p>
    <a class="dashboardBtnMenu <?= ($_GET['action'] ?? '') === 'admin' ? 'inactive' : '' ?>" href="index.php?action=dashboard&sort=title&order=asc"><h2>Tableau de bord</h2></a>
</div>

<div class="adminArticle">
    <?php foreach ($articles as $article) { ?>
        <div class="articleLine">
            <div class="title"><?= $article->getTitle() ?></div>
            <div class="content"><?= $article->getContent(200) ?></div>
            <div><a class="submit" href="index.php?action=showUpdateArticleForm&id=<?= $article->getId() ?>">Modifier</a></div>
            <div><a class="submit" href="index.php?action=deleteArticle&id=<?= $article->getId() ?>" <?= Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?> >Supprimer</a></div>
        </div>
    <?php } ?>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>