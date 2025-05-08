<?php

/**
 * Classe qui gère les articles.
 */
class ArticleManager extends AbstractEntityManager 
{
    /**
     * Récupère tous les articles.
     * @return array : un tableau d'objets Article.
     */
    public function getAllArticles() : array
    {
        $sql = "SELECT * FROM article";
        $result = $this->db->query($sql);
        $articles = [];

        while ($article = $result->fetch()) {
            $articles[] = new Article($article);
        }
       return $articles;
    }
    /*
     * La méthode `getCountAllArticles()` est une fonction publique définie dans la classe `ArticleManager`,
     * qui a pour objectif de compter tous les articles présents dans la table `article` de la base de données,
     * et de retourner ce nombre sous forme d'un entier.
     * @return int : nombre article au total.
     */
    public function getCountAllArticles() : int
    {
        $sql = "SELECT Count(id) FROM article";
        $result = $this->db->query($sql);
        return $result->fetchColumn();
    }

    /**
     * Cette fonction appartient à la classe `ArticleManager` et sert à récupérer une liste paginée d'articles,
     * tout en comptant le nombre de commentaires associés à chaque article.
     * Les résultats sont ensuite triés en fonction d'une colonne et d'un sens définis dynamiquement par les paramètres
     * de la méthode. Enfin, les articles sont retournés sous forme d'un tableau d'objets `Article`.
     * @return array : un tableau d'objets Article.
    */
    public function getAllArticlesGroupByComment(string $tridata = '') : array
    {
       $sql = "SELECT Count(b.id) as 'qteCommentaires',a.id,a.title,a.nbvues,a.date_creation FROM article a
       LEFT JOIN comment b On (a.id = b.id_article)
       GROUP BY a.id,a.title,a.nbvues,a.date_creation
       $tridata";


        $result = $this->db->query($sql); /*'start'=>$start,'lenght'=>$lenght*/
        $articles = [];
        while ($article = $result->fetch()) {
            $DataArticle = new Article($article);
            $articles[]= $DataArticle->jsonSerializeDatatable();

        }
        return $articles;
    }


    /**
     * Récupère un article par son id.
     * @param int $id : l'id de l'article.
     * @return Article|null : un objet Article ou null si l'article n'existe pas.
     */
    public function getArticleById(int $id) : ?Article
    {
        $sql = "SELECT * FROM article WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $id]);
        $article = $result->fetch();
        if ($article) {
            return new Article($article);
        }
        return null;
    }

    /**
     * Ajoute ou modifie un article.
     * On sait si l'article est un nouvel article car son id sera -1.
     * @param Article $article : l'article à ajouter ou modifier.
     * @return void
     */
    public function addOrUpdateArticle(Article $article) : void 
    {
        if ($article->getId() == -1) {
            $this->addArticle($article);
        } else {
            $this->updateArticle($article);
        }
    }

    /**
     * Ajoute un article.
     * @param Article $article : l'article à ajouter.
     * @return void
     */
    public function addArticle(Article $article) : void
    {
        $sql = "INSERT INTO article (id_user, title, content, nbvues, date_creation) VALUES (:id_user, :title, :content, :nbvues, NOW())";
        $this->db->query($sql, [
            'id_user' => $article->getIdUser(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'nbvues' => $article->getNbvues()
        ]);
    }

    /**
     * Modifie un article.
     * @param Article $article : l'article à modifier.
     * @return void
     */
    public function updateArticle(Article $article) : void
    {
        $sql = "UPDATE article SET title = :title, content = :content, date_update = NOW(), nbvues = :nb_vue  WHERE id = :id";
        $this->db->query($sql, [
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'nb_vue' => $article->getNbvues(),
            'id' => $article->getId()
        ]);
    }

    /**
     * Supprime un article.
     * @param int $id : l'id de l'article à supprimer.
     * @return void
     */
    public function deleteArticle(int $id) : void
    {
        $sql = "DELETE FROM article WHERE id = :id";
        $this->db->query($sql, ['id' => $id]);
        http_response_code(200);
    }
}