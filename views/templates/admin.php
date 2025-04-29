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
            <div><button type="button" class="submit" data-bs-toggle="modal" data-bs-target="#ArticleconfirmModal" data-bs-id=<?= $article->getId() ?> >Supprimer</button></div>
        </div>
    <?php } ?>
</div>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>


<!-- Modal -->
<div class="modal fade" id="ArticleconfirmModal" tabindex="-1" aria-labelledby="ModalTitre" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="ModalTitre">Suppression Article</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4> êtes-vous sur de vouloir supprimer cet Article ?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="confirmDeleteBtn" data-button-id="-1">Suppression</button>
            </div>
        </div>
    </div>
</div>
