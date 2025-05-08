<?php

/**
 * Cette classe sert à gérer les commentaires. 
 */
class CommentManager extends AbstractEntityManager
{
    /**
     * Récupère tous les commentaires d'un article.
     * @param int $idArticle : l'id de l'article.
     * @return array : un tableau d'objets Comment.
     */
    public function getAllCommentsByArticleId(int $idArticle) : array
    {
        $sql = "SELECT * FROM comment WHERE id_article = :idArticle";
        $result = $this->db->query($sql, ['idArticle' => $idArticle]);
        $comments = [];

        while ($comment = $result->fetch()) {
            $comments[] = new Comment($comment);
        }
        return $comments;
    }

    /**
     * Récupère le nombre total de commentaires.
     * @return int : le nombre total de commentaires.
     */
    public function  getCountAllComment(): int
    {
         $sql = "SELECT Count(id) FROM comment";
         $result = $this->db->query($sql);
         return $result->fetchColumn();
    }



       /**
     * Récupère un commentaire par son id.
     * @param int $id : l'id du commentaire.
     * @return Comment|null : un objet Comment ou null si le commentaire n'existe pas.
     */
    public function getCommentById(int $id) : ?Comment
    {
        $sql = "SELECT * FROM comment WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $comment = $result->fetch();
        if ($comment) {
            return new Comment($comment);
        }
        return null;
    }

    /**
     * Ajoute un commentaire.
     * @param Comment $comment : l'objet Comment à ajouter.
     * @return bool : true si l'ajout a réussi, false sinon.
     */
    public function addComment(Comment $comment) : bool
    {
        $sql = "INSERT INTO comment (pseudo, content, id_article, date_creation) VALUES (:pseudo, :content, :idArticle, NOW())";
        $result = $this->db->query($sql, [
            'pseudo' => $comment->getPseudo(),
            'content' => $comment->getContent(),
            'idArticle' => $comment->getIdArticle()
        ]);
        return $result->rowCount() > 0;
    }

    /**
     * Supprime un commentaire.
     * @param Comment $comment : l'objet Comment à supprimer.
     * @return bool : true si la suppression a réussi, false sinon.
     */
    public function deleteComment(Comment $comment) : bool
    {
        $sql = "DELETE FROM comment WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $comment->getId()]);
        return $result->rowCount() > 0;
    }

    /**
     * Récupère une liste de commentaires associés à un article, avec une option de tri.
     * @param int $keyid : l'id de l'article pour lequel récupérer les commentaires. Par défaut -1 pour tous.
     * @param string $tridata : une chaîne représentant les conditions ou clauses de tri SQL supplémentaires.
     * @return array : un tableau d'objets Comment contenant les informations des commentaires et des articles associés.
     */
    Public function ListCommentTable(int $keyid=-1,string $tricol = '',int $triSens = 3 ){
        $sql = "SELECT B.title as 'title',A.id,A.id_article,A.pseudo,A.content,A.date_creation FROM comment A
        LEFT JOIN article B on (A.id_article=B.ID)
        WHERE (A.id_article = :idArticle)
        order by A.id ASC";
        // éxecution de la requête
        $result = $this->db->query($sql, ['idArticle' => $keyid]);
        //Serialisation tu tableau
        $comments = [];
        while ($comment = $result->fetch()) {
            $dataComment = new Comment($comment);
            $comments[] = $dataComment->jsonSerializeDatatable();
        }
        //$tricol='datecreation';
        /*tri du tableau avant Setialisation*/
        $colselected= array_column($comments,$tricol);
        // tri du tableau sur la colonne choisit
        array_multisort($colselected, $triSens, $comments);
        return $comments;
    }

}
