<?php
    /**
     * Ce template affiche les commentaires d'un article.
     */
    $idArticle = $article->getid();
?>
<h2> Liste des Commentaires </h2>
<h3>Titre article : <?=$article->getTitle() ?></h3>
<table id="TableMemo" class="display" style="width:100%" data-id="<?=$idArticle?>">
    <thead>
    <tr>
        <th>id</th>
        <th>Crée le</th>
        <th>Pseudo</th>
        <th>Commentaire</th>
        <th>Supprimer</th>
    </tr>
    </thead>
</table>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="ModalTitre" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="ModalTitre">Suppression Commentaire</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4> êtes-vous sur de vouloir supprimer ce commentaire ?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Annuler</button>
                <button type="button" id="confirmDelete" class="btn btn-warning">Suppression</button>
            </div>
        </div>
    </div>
</div>