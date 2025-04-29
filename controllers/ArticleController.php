<?php 

class ArticleController 
{
    /**
     * Affiche la page d'accueil.
     * @return void
     */
    public function showHome() : void
    {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        $view = new View("Accueil");
        $view->render("home", ['articles' => $articles]);
    }

    /**
     * Affiche la page avec entête DataTable.
     * @return void
     */
     Public function DatatableArticle() : void
    {
        /* Récupération des données POST */
        $draw = Utils::request("draw", 1 );
        $start = Utils::request('start',1);
        $length = Utils::request('length',null);
        $order = Utils::request('order',null);
        /* Référencement des colonnes d'un tableau */
        $columns = ['a.id', 'a.date_creation', 'a.title', 'a.nbvues', 'qteCommentaires'];
        $tridatable = "";
        /* extraction pour le tri sur la colonne choisit */
        if (!empty($order[0]['column'])) {
            $orderColumnIndex = $order[0]['column'];
            $orderDir = $order[0]['dir'];
            $orderColumn = $columns[$orderColumnIndex] ?? "";
            $tridatable = " ORDER BY $orderColumn $orderDir";
        }
        /* Requete affichage des donnés */
        $articleManager = new ArticleManager();
        $total = $articleManager->getCountAllArticles();
        $data = $articleManager->getAllArticlesGroupByComment($tridatable);
       // Format JSON attendu par DataTables
        $response = [
            "draw" => intval($draw),
            "recordsTotal" => $total,
            "data" => $data
        ];
        /* - Le type MIME de la réponse est défini comme **JSON** */
        header('Content-Type: application/json');
        /* encodage de la réponse en JSON */
        $infoData =json_encode($response,JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        echo $infoData;
    }

    public function ShowDatatable() : void
    {
        $view = new View("liste Data");
        $view->render("ArticleDataStatistic");
    }

    /**
     * Affiche le détail d'un article.
     * @return void
     */
    public function showArticle() : void
    {
        // Récupération de l'id de l'article demandé.
        $id = Utils::request("id", -1);

        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);
        
        if (!$article) {
            throw new Exception("L'article demandé n'existe pas.");
        }
        /* incrementer le nombre de vue */
        $vueQte = $article->getNbvues()+1;
        $article->setNbvues($vueQte);        /* Mettre à jour le compteur de vues */
        /* Modifier la valeur dans la table Article */
        $articleManager->updateArticle($article);
        /* affichage des commentaires */
        $commentManager = new CommentManager();
        $comments = $commentManager->getAllCommentsByArticleId($id);

        $view = new View($article->getTitle());
        $view->render("detailArticle", ['article' => $article, 'comments' => $comments]);
    }

    /**
     * Affiche le formulaire d'ajout d'un article.
     * @return void
     */
    public function addArticle() : void
    {
        $view = new View("Ajouter un article");
        $view->render("addArticle");
    }

    /**
     * Affiche la page "à propos".
     * @return void
     */
    public function showApropos() {
        $view = new View("A propos");
        $view->render("apropos");
    }
}