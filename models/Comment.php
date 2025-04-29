<?php

/**
 * Entité représentant un commentaire.
 * Avec les champs id, pseudo, content, et idArticle.
 */
 
class Comment extends AbstractEntity 
{
    private int $idArticle;
    private string $pseudo;
    private string $content;
    private DateTime $dateCreation;
    Private string $title;
    /**
     * Getter pour l'id de l'article.
     * @return int
     */
    public function getIdArticle(): int 
    {
        return $this->idArticle;
    }

    /**
     * Setter pour l'id de l'article.
     * @param int $idArticle
     * @return void
     */
    public function setIdArticle(int $idArticle): void 
    {
        $this->idArticle = $idArticle;
    }

    /**
     * Getter pour le pseudo.
     * @return string
     */
    public function getPseudo(): string 
    {
        return $this->pseudo;
    }

    /**
     * Setter pour le pseudo.
     * @param string $pseudo
     * @return void
     */
    public function setPseudo(string $pseudo): void 
    {
        $this->pseudo = $pseudo;
    }

    /**
     * Getter pour le contenu.
     * @return string
     */
    public function getContent(): string 
    {
        return $this->content;
    }

    /**
     * Setter pour le contenu.
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void 
    {
        $this->content = $content;
    }

    /**
     * Getter pour la date de création.
     * @return DateTime
     */
    public function getDateCreation(): DateTime 
    {
        return $this->dateCreation;
    }

    /**
     * Setter pour la date de création. 
     * Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $dateCreation
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s') : void 
    {
        if (is_string($dateCreation)) {
            $dateCreation = DateTime::createFromFormat($format, $dateCreation);
        }
        $this->dateCreation = $dateCreation;
    }

    /**
     * Sets the title.
     *
     * @param string $title The title to set.
     * @return void
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     * Retrieves the title.
     *
     * @return string The current title.
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Serializes the object data for use in a datatable.
     *
     * @return array An associative array containing serialized data with keys like 'id', 'idArticle', 'datecreation', 'pseudo', 'content', 'title', and 'details'.
     */
    public function jsonSerializeDatatable():array {
        $data = [
            'id' => strval($this->id),
            'idArticle' => strval($this->getIdArticle()),
            'datecreation' => utils::convertDateToFrenchFormat($this->getDateCreation()),
            'pseudo' => $this->getPseudo(),
            'content' => $this->getContent(),
            'title'=> $this->getTitle(),
            'details' => ""
        ];
        return $data;
    }

}