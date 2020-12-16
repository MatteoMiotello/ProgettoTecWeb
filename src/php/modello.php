<?php

class Articolo
{
    /**
     * @var void
     */
    private $ID;


    /**
     * @var void
     */
    private $titolo;


    private $testo;


    private $autore;


    private $dataPub;


    private $upVotes;


    private $downVotes;


    private $imgPath;


    function __construct($ID, $titolo, $testo, $autore, $dataPub, $upVotes, $downVotes, $imgPath)
    {
        $this->ID = $this->setID($ID);
        $this->titolo = $this->setTitolo($titolo);
        $this->testo = $this->setTesto($testo);
        $this->autore = $this->setAutore($autore);
        $this->dataPub = $this->setDataPub($dataPub);
        $this->upVotes = $this->setUpVotes($upVotes);
        $this->downVotes = $this->setDownVotes($downVotes);
        $this->imgPath = $this->setImgPath($imgPath);
    }


    /* getters */

    public function setImgPath($value)
    {
        (ctype_alnum($value) && strlen($value) <= 255) ? $this->imgPath = $value : $this->imgPath = null;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function setID($value)
    {
        (ctype_digit($value) && strlen($value) <= 6) ? $this->ID = $value : $this->ID = null;
    }

    public function getTitolo()
    {
        return $this->titolo;
    }

function setTitolo($value)
{
    (ctype_alnum($value) && strlen($value) <= 126) ? $this->titolo = $value : $this->titolo = "";
}

    public function getTesto()
    {
        return $this->testo;
    }

    public function setTesto($value)
    {
        (ctype_alnum($value) && strlen($value) <= 10000) ? $this->testo = $value : $this->testo = "";
    }


    // setters

    public function getAutore()
    {
        return $this->autore;
    }


    public function setAutore($value)
    {
        (ctype_digit($value) && strlen($value) <= 6) ? $this->autore = $value : $this->autore = null;
    }

    public function getDataPub()
    {
        return $this->dataPub;
    }

    public function setDataPub($value)
    {
        (DateTime::createFromFormat('Y/m/d', $value) !== false) ? $this->dataPub = $value : $this->dataPub = null;
    }

    public function getUpVotes()
    {
        return $this->upVotes;
    }

    public function setUpVotes($value)
    {
        (ctype_digit($value) && strlen($value) <= 7) ? $this->upVotes = $value : $this->upVotes = null;
    }

    public function getDownVotes()
    {
        return $this->downVotes;
    }

    public function setDownVotes($value)
    {
        (ctype_digit($value) && strlen($value) <= 7) ? $this->downVotes = $value : $this->downVotes = null;
    }
}

class Categoria
{
    private $nome;
    private $descrizione;

    function __construct($nome, $descrizione)
    {
        $this->nome = $this->setNome($nome);
        $this->descrizione = $this->setDescrizione($descrizione);
    }

    //getter

    public function setDescrizione($value)
    {
        (ctype_alnum($value) && strlen($value) <= 255) ? $this->nome = $value : $this->nome = "";
    }

    public function getNome()
    {
        return $this->nome;
    }

    //setter

    public function setNome($value)
    {
        (ctype_alnum($value) && strlen($value) <= 20) ? $this->nome = $value : $this->nome = null;
    }

    public function getCategoria()
    {
        return $this->descrizione;
    }
}

?>