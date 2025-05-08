<?php

/**
 * Entité Article, un article est défini par les champs
 * id, id_user, title, content, date_creation, date_update
 */
 class Article extends AbstractEntity 
 {
    private int $idUser;
    private string $title = "";
    private string $content = "";
    private int $nbvues=0;
    private ?DateTime $date_Creation = null;
    private ?DateTime $date_Update = null;
    private int $qteCommentaires = 0;

    /**
     * Setter pour l'id de l'utilisateur. 
     * @param int $idUser
     */
    public function setIdUser(int $idUser) : void 
    {
        $this->idUser = $idUser;
    }

    /**
     * Getter pour l'id de l'utilisateur.
     * @return int
     */
    public function getIdUser() : int 
    {
        return $this->idUser;
    }

    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitle(string $title) : void 
    {
        $this->title = $title;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitle() : string 
    {
        return $this->title;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     */
    public function setContent(string $content) : void 
    {
        $this->content = $content;
    }

    
    /**
     * Getter pour le contenu.
     * Retourne les $length premiers caractères du contenu.
     * @param int $length : le nombre de caractères à retourner.
     * Si $length n'est pas défini (ou vaut -1), on retourne tout le contenu.
     * Si le contenu est plus grand que $length, on retourne les $length premiers caractères avec "..." à la fin.
     * @return string
     */
    public function getContent(int $length = -1) : string 
    {
        if ($length > 0) {
            // Ici, on utilise mb_substr et pas substr pour éviter de couper un caractère en deux (caractère multibyte comme les accents).
            $content = mb_substr($this->content, 0, $length);
            if (strlen($this->content) > $length) {
                $content .= "...";
            }
            return $content;
        }
        return $this->content;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s') : void
    {
        if (is_string($dateCreation)) {
            $dateCreation = DateTime::createFromFormat($format, $dateCreation);
        }
        $this->date_Creation = $dateCreation;
    }

    /**
     * Getter pour la date de création.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime
     */
    public function getDateCreation() : DateTime
    {
        return $this->date_Creation;
    }

    /**
     * Setter pour la date de mise à jour. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateUpdate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. string|DateTime
     */
    public function setDateUpdate($dateUpdate, string $format = 'Y-m-d H:i:s') : void
    {
        $this->date_Update = null;
        if (isset($dateUpdate)) {
            if (is_string($dateUpdate)) {
                $dateUpdate = DateTime::createFromFormat($format, $dateUpdate);
            }
            $this->date_Update = $dateUpdate;
        }

    }

    /**
     * Getter pour la date de mise à jour.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime ou null
     * si la date de mise à jour n'a pas été définie.
     * @return DateTime|null
     */
    public function getDateUpdate() : ?DateTime 
    {
        return $this->date_Update;
    }

     /**
      * @param int $nb_vues
      * @return void
      */
     public function setNbvues(int $nb_vues) : void
    {
        $this->nbvues = $nb_vues;
    }

     /**
      * @return int
      */
     public function getNbvues() : int
    {
         return $this->nbvues;
    }

     /**
      * @param int $qte_commentaires
      * @return void
      */
     public function setQteCommentaires(int $qte_commentaires) : void{
        $this->qteCommentaires = $qte_commentaires;
    }

     /**
      * @return int
      */
     public function getQteCommentaires() : int
    {
        return $this->qteCommentaires;
    }

     /**
      * Serializes the data for a datatable in JSON format.
      * @return array The serialized data as an associative array.
      */
     public function jsonSerializeDatatable():array {
         $data = [
             'id' => strval($this->id),
             'datecreation' => utils::convertDateToFrenchFormat($this->getDateCreation()),
             'title' => $this->getTitle(),
             'nbvues' => strval($this->getNbvues()),
             'qteCommentaires' => strval($this->getQteCommentaires()),
             'details' => ""
         ];
         return $data;
    }
 }