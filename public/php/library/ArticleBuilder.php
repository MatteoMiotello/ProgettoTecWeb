<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/library/AbstractBuilder.php');

class ArticleBuilder extends AbstractBuilder
{

    /**
     * Le costanti aiutano a tenere traccia delle label utilizzate per la sostituzione dei parametri
     */
    const TITOLO = '{{title}}';
    const DESCRIPTION = '{{description}}';
    const ARTICLECONTENT = '{{articleContent}}';
    const IMGALTARTICLE = '{{altImg}}';
    const IMGPATHARTICLE = '{{articleImgPath}}';
    const AUTHORNAME = '{{authorName}}';
    const AUTHOREMAIL = '{{authorEmail}}';
    const IMGPATHAUTHOR = '{{authorImg}}';
    const ARTICLECATEGORIES = '<categories />';
    const ARTICLECOMMENTS = '<listaCommenti />';

    function __construct()
    {
        $this->Params[ArticleBuilder::TITOLO] = "";
        $this->Params[ArticleBuilder::DESCRIPTION] = "";
        $this->Params[ArticleBuilder::ARTICLECONTENT] = "";
        $this->Params[ArticleBuilder::AUTHORNAME] = "";
        $this->Params[ArticleBuilder::AUTHOREMAIL] = "";
        $this->Params[ArticleBuilder::ARTICLECATEGORIES]  = "";
        $this->Params[ArticleBuilder::ARTICLECOMMENTS] = "";
    }

    /**
     * Titolo dell'articolo
     * @var string
     */
    private $Title;

    /**
     * Descrizione dell'articolo
     */
    private $Description;

    /**
     * Contenuto dell'articolo
     * @var string
     */
    private $Content;

    /**
     * Path dell'immagine usata per l'articolo
     * @var string 
     */
    private $ImgPathArticle;

    /**
     * Alt usato per l'immagine dell'articolo
     * @var string 
     */
    private $ImgAltArticle;

    /**
     * Path dell'immagine usata per l'autore dell'articolo
     * @var string 
     */
    private $ImgPathUser;

    /**
     * Array usato per contenere le categorie di cui l'articolo appartiene
     * @var array
     */
    private $Categories;

    /**
     * Email dell'autore dell'articolo
     *@var string  
     */
    private $AuthorEmail;

    /**
     * Nome dell'autore dell'articolo
     *@var string  
     */
    private $AuthorName;

    /**
     * Commenti all'articolo
     * @var array
     */
    private $Comments;
    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->Title;
    }

    /**
     * @param mixed $Title
     */
    public function setTitle($Title): self
    {
        $this->Title = $Title;
        $this->Params[ArticleBuilder::TITOLO] = $this->getTitle();
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * @param mixed $Content
     */
    public function setContent($Content)
    {
        $this->Content = $Content;
        $this->Params[ArticleBuilder::ARTICLECONTENT] = $this->getContent();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImgArticlePath()
    {
        return $this->ImgPathArticle;
    }

    /**
     * @param $ImgPath
     */
    public function setImgArticlePath($ImgPath)
    {
        $this->ImgPathArticle = $ImgPath;
        $this->Params[ArticleBuilder::IMGPATHARTICLE] = $this->getImgArticlePath();
        return $this;
    }

    /**
     * @return mixed
     */
    public function getImgArticleAlt()
    {
        return $this->ImgAltArticle;
    }

    /**
     * @param $imgAlt
     */
    public function setImgArticleAlt($ImgAlt)
    {
        $this->ImgAltArticle = $ImgAlt;
        $this->Params[ArticleBuilder::IMGALTARTICLE] = $this->getImgArticleAlt();
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getNameAuthor()
    {
        return $this->AuthorName;
    }

    /**
     * @param $Name
     */
    public function setNameAuthor($Name)
    {
        $this->AuthorName = $Name;
        $this->Params[ArticleBuilder::AUTHORNAME] = $this->getNameAuthor();
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getEmailAuthor()
    {
        return $this->AuthorEmail;
    }

    /**
     * @param $Email
     */
    public function setEmailAuthor($Email)
    {
        $this->AuthorEmail = $Email;
        $this->Params[ArticleBuilder::IMGALTARTICLE] = $this->getEmailAuthor();
        return $this;
    }

    /**
     * @return mixed 
     */
    public function getImgPathAuthor()
    {
        return $this->ImgPathUser;
    }

    /**
     * @param mixed $path
     */
    public function setImgPathAuthor($path)
    {
        $this->ImgPathUser = $path;
        $this->Params[ArticleBuilder::IMGPATHAUTHOR] = $this->getImgPathAuthor();
        return $this;
    }

    /**
     * @param $Description
     */
    public function setDescription($Description) {
        $this->Description = $Description;
        $this->Params[ArticleBuilder::DESCRIPTION] = $this->getDescription();
        return $this;
    } 

    /**
     * @return mixed
     */
    public function getDescription() {
        return $this->Description;
    }

    /**
     * @param $categoria
     */
    public function addCategory($categoria)
    {
        if ($this->Categories != '')
            $this->Categories = $this->Categories . '<p>' . $categoria . '</p>';
        else {
            $this->Categories = $categoria;
        }
        $this->Params[ArticleBuilder::ARTICLECATEGORIES] = $this->getCategories();
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->Categories;
    }

    public function getComments() {
        return $this->Comments;
    }

    public function addComment($Comment)
    {
        if ($this->Comments != '')
            $this->Comments = $this->Categories . $Comment;
        else {
            $this->Comments = $Comment;
        }
        $this->Params[ArticleBuilder::ARTICLECOMMENTS] = $this->getComments();
    }
}
