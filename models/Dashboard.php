<?php
class Dashboard extends AbstractEntity
{
    private string $title = "";
    private int $viewNumber = 0;
    private int $commentNumber = 0;
    private ?DateTime $dateCreation = null;

    /**
     * Constructeur de la class Dashboard.
     *
     * @param string $title
     * @param int $viewNumber
     * @param int $commentNumber
     * @param DateTime $dateCreation
     */

    public function __construct($title, $viewNumber, $commentNumber, $dateCreation)
    {
        $this->title = $title;
        $this->viewNumber = $viewNumber;
        $this->commentNumber = $commentNumber;
        $this->dateCreation = $dateCreation;
    }

    /**
     * Getter pour le titre de l'article.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Getter pour le nombre de vues.
     */
    public function getVueNumber()
    {
        return $this->viewNumber;
    }

    /**
     * Getter pour le nombre de commentaires.
     */
    public function getCommentNumber()
    {
        return $this->commentNumber;
    }

    /**
     * Getter pour la date de création de l'article.
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Setter pour la date de création de l'article.
     */
    public function setDateCreation(string|DateTime $dateCreation, string $format = 'Y-m-d H:i:s') : void
    {
        if (is_string($dateCreation)) {
            $dateCreation = DateTime::createFromFormat($format, $dateCreation);
        }
        $this->dateCreation = $dateCreation;
    }
}