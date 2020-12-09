<?php
class Articolo {
    private $ID;
    private $titolo;
    private $testo;
    private $autore;
    private $dataPub;
    private $upVotes;
    private $downVotes;
    private $imgPath;
    function __construct($ID, $titolo, $testo, $autore, $dataPub, $upVotes, $downVotes,$imgPath)
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

    // getters
    public function getID() {
        return $this->ID;
    }
    public function getTitolo() {
        return $this->titolo;
    }
    public function getTesto() {
        return $this->testo;
    }
    public function getAutore() {
        return $this->autore;
    }
    public function getDataPub() {
        return $this->dataPub;
    }
    public function getUpVotes() {
        return $this->upVotes;
    }
    public function getDownVotes() {
        return $this->downVotes;
    }
    // setters
    public function setID($value) {
        (ctype_digit($value) && strlen($value)<=6)? $this->ID = $value: $this->ID = null;
    }
    public function setTitolo($value) {
        (ctype_alnum($value) && strlen($value)<=126)? $this->titolo = $value: $this->titolo = "";
    }
    public function setTesto($value) {
        (ctype_alnum($value) && strlen($value)<=10000)? $this->testo = $value: $this->testo = "";
    }
    public function setAutore($value) {
        (ctype_digit($value) && strlen($value)<=6)? $this->autore = $value: $this->autore = null;
    }
    public function setDataPub($value) {
        (DateTime::createFromFormat('Y/m/d', $value) !== false) ? $this->dataPub = $value: $this->dataPub = null;
    }
    public function setUpVotes($value) {
        (ctype_digit($value) && strlen($value)<=7)? $this->upVotes = $value: $this->upVotes = null;
    }
    public function setDownVotes($value) {
        (ctype_digit($value) && strlen($value)<=7)? $this->downVotes = $value: $this->downVotes = null;
    }
    public function setImgPath($value) {
        (ctype_alnum($value) && strlen($value)<=255)? $this->imgPath = $value: $this->imgPath = null;
    }
}

class Categoria {
    private $nome;
    private $descrizione;
    function __construct($nome, $descrizione)
    {
        $this->nome = $this->setNome($nome);
        $this->descrizione = $this->setDescrizione($descrizione);
    }
    //getter
    public function getNome() {
        return $this->nome;
    }
    public function getCategoria() {
        return $this->descrizione;
    }
    //setter
    public function setNome($value) {
        (ctype_alnum($value) && strlen($value)<=20)? $this->nome = $value: $this->nome = null;
    }
    public function setDescrizione($value) {
        (ctype_alnum($value) && strlen($value)<=255)? $this->nome = $value: $this->nome = "";
    }
}
?>