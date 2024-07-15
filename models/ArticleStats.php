<?php 
/**
 * Class qui décrit le comportement des statistiques de l'article
 * les stats d'articles sont définies par un ID, un titre, une date de création, un nombre de vues et nombre de commentaires
 */
class ArticleStats extends AbstractEntity
{
    private string $titre = "";
    private ?DateTime $date = null;
    private int $vues = 0;
    private int $commentaires = 0;


    /**
     * Setter pour le titre.
     * @param string $title
     */
    public function setTitre(string $titre) : void 
    {
        $this->titre = $titre;
    }

    /**
     * Getter pour le titre.
     * @return string
     */
    public function getTitre() : string 
    {
        return $this->titre;
    }

    /**
     * Setter pour la date de création. Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setDate(string $date, string $format = 'Y-m-d H:i:s') : void 
    {
        if (is_string($date)) {
            $date = DateTime::createFromFormat($format, $date);
        }
        $this->date = $date;
    }

    /**
     * Getter pour la date de création.
     * Grâce au setter, on a la garantie de récupérer un objet DateTime.
     * @return DateTime
     */
    public function getDate() : DateTime
    {
        return $this->date;
    }

    /**
     * Setter pour le nombre de vues. 
     * @param int $nbViews
     */
    public function setVues(int $Vues) : void 
    {
        $this->Vues = $Vues;
    }

    /**
     * Getter pour le nombre de vues. 
     * @return int
     */
    public function getVues() : int 
    {
        return $this->Vues;
    }
  
   /**
     * Setter pour le nombre de commentaires. 
     * @param int $commentaires
     */
    public function setCommentaires(int $commentaires) : void 
    {
        $this->commentaires = $commentaires;
    }

    /**
     * Getter pour le nombre de commentaires. 
     * @return int
     */
    public function getCommentaires() : int
    {
        return $this->commentaires;
    }
}

