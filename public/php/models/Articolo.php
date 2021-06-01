<?php
require_once __DIR__.'/CheckValues.php';
require_once __DIR__.'/User.php';
require_once __DIR__.'/dBConnection.php';

class Articolo {
    private $ID;

    private $titolo;

    private $descrizione;

    private $testo;


    private $autore;


    private $dataPub;


    private $upVotes;


    private $downVotes;


    private $imgPath;

    private $altImg;

    private $validation;

    function __construct($ID, $titolo, $descrizione, $testo, $autore, $dataPub, $upVotes, $downVotes, $imgPath, $altImg, $validation) {
        $this->setID($ID);
        $this->setTitle($titolo);
        $this->setContent($testo);
        $this->setDescription($descrizione);
        $this->setAuthor($autore);
        $this->setDataPub($dataPub);
        $this->setUpVotes($upVotes);
        $this->setDownVotes($downVotes);
        $this->setImgPath($imgPath);
        $this->setAltImg($altImg);
        $this->validation = $validation;
    }


    public function setImgPath($value) {
        if ( !$value ){
            $this->imgPath = $value;
        }

        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 255);
        if ($correctCharacters)
            $this->imgPath = $value;
        else
            throw new Exception(CheckValues::createMsgError("ImgPath"), 1);
    }


    public function getImgPath() {
        return $this->imgPath;
    }


    public function getID() {
        return $this->ID;
    }


    public function setID($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "digit", 6);
        if ($correctCharacters)
            $this->ID = $value;
        else
            throw new Exception(CheckValues::createMsgError("ID"), 1);
    }


    public function getTitle() {
        return $this->titolo;
    }


    function setTitle($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 127);
        if ($correctCharacters)
            $this->titolo = $value;
        else
            throw new Exception(CheckValues::createMsgError("Title"), 1);
    }


    function getDescription() {
        return $this->descrizione;
    }


    function setDescription($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 350);
        if ($correctCharacters)
            $this->descrizione = $value;
        else
            throw new Exception(CheckValues::createMsgError("Description"), 1);
    }


    public function getContent() {
        return $this->testo;
    }


    public function setContent($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 10000);
        if ($correctCharacters)
            $this->testo = $value;
        else
            throw new Exception(CheckValues::createMsgError("Text"), 1);
    }


    public function getAuthor() {
        return $this->autore;
    }


    public function setAuthor($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "digit", 6);
        if ($correctCharacters)
            $this->autore = $value;
        else
            throw new Exception(CheckValues::createMsgError("Author"), 1);
    }


    public function getDataPub() {
        return $this->dataPub;
    }


    public function setDataPub($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "data", 19);
        if ($correctCharacters)
            $this->dataPub = $value;
        else
            throw new Exception(CheckValues::createMsgError("Data Publishment"), 1);
    }


    public function getUpVotes() {
        return $this->upVotes;
    }


    public function setUpVotes($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "digit", 7);
        if ($correctCharacters)
            $this->upVotes = $value;
        else
            throw new Exception(CheckValues::createMsgError("Up Votes"), 1);
    }


    public function getDownVotes() {
        return $this->downVotes;
    }


    public function setDownVotes($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "digit", 7);
        if ($correctCharacters)
            $this->downVotes = $value;
        else
            throw new Exception(CheckValues::createMsgError("Down Votes"), 1);
    }


    public function setAltImg($value) {
        if ( !$value ) {
            $this->altImg = $value;
            return;
        }

        $correctCharacters = CheckValues::checkForCorrectValues($value, "alpha", 255);
        if ($correctCharacters)
            $this->altImg = $value;
        else {
            throw new Exception(CheckValues::createMsgError("Alt Image"), 1);
        }
    }


    public function getAltImg() {
        return $this->altImg;
    }

    public function getValidation() {
        return $this->validation;
    }

    public function setValidation($validation) {
        $this->validation = $validation;
        // qui bisogna fare la query per aggiornare la validazione dell-articolo
        // non  necessariamente, basta aggiungere una query che prenda tutti i valori dell'articolo e li salva.
    }

    public static function getArticoli($category, $limit, $verified) {
        $connection = DBAccess::openDBConnection();

        if ($category != null)
            $querySelect = "SELECT * FROM articolo, cat_art
                            WHERE  cat_art.nome_cat = '$category' AND articolo.ID = cat_art.ID_art AND verificato=1
                            ORDER BY ID DESC";
        elseif ($verified)
            $querySelect = "SELECT * FROM articolo WHERE verificato=1 ORDER BY ID DESC";
        else
            $querySelect = "SELECT * FROM articolo ORDER BY ID DESC";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        } else { // ritorno la lista degli articoli all'interno del db
            $listaArticoli = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singoloArticolo = new Articolo($riga['ID'], $riga['titolo'], $riga['descrizione'], $riga['testo'], $riga['autore'], $riga['data_pub'], $riga['upvotes'], $riga['downvotes'], $riga['img_path'], $riga['alt_img'], $riga['verificato']);
                array_push($listaArticoli, $singoloArticolo);
            }
            if ($limit != null && count($listaArticoli) >= $limit)
                $listaArticoli = array_slice($listaArticoli, -$limit, $limit, true);
        }
        return $listaArticoli;
    }


    public static function getArticolo($id_articolo) {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT * FROM articolo WHERE articolo.ID=$id_articolo";
        $queryResult = mysqli_query($connection, $querySelect);
        if (!$queryResult)
            return null;
        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        } else {
            $riga = mysqli_fetch_assoc($queryResult);
            $singoloArticolo = new Articolo($riga['ID'], $riga['titolo'], $riga['descrizione'], $riga['testo'], $riga['autore'], $riga['data_pub'], $riga['upvotes'], $riga['downvotes'], $riga['img_path'], $riga['alt_img'], $riga['verificato']);
            return $singoloArticolo;
        }
    }


    public function getCategorie() {
        $query = 'SELECT * FROM `categoria` join `cat_art` on `cat_art`.`nome_cat` = `categoria`.nome join `articolo` on `articolo`.`ID` = `cat_art`.`ID_art`';
        $connection = DBAccess::openDBConnection();
        $categorie = [];
        foreach ( $connection->query( $query )->fetch_assoc() as $item) {
            var_dump( $item ,'<br/>' );

        }

        return $categorie;
    }


    public static function searchArticolo($keyword, $limit) {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT *  FROM articolo WHERE articolo.titolo LIKE '%$keyword%' OR articolo.descrizione LIKE '%$keyword%' OR articolo.testo LIKE '%$keyword%'";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        } else { // ritorno la lista degli articoli all'interno del db
            $listaArticoli = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singoloArticolo = new Articolo($riga['ID'], $riga['titolo'], $riga['descrizione'], $riga['testo'], $riga['autore'], $riga['data_pub'], $riga['upvotes'], $riga['downvotes'], $riga['img_path'], $riga['alt_img'], $riga['verificato']);
                array_push($listaArticoli, $singoloArticolo);
            }
            if ($limit != null && count($listaArticoli) >= $limit)
                $listaArticoli = array_slice($listaArticoli, -$limit, $limit, true);
        }
        return $listaArticoli;
    }

    public static function validateArticle($Id) {
        $Connection = DBAccess::openDBConnection();
        $querySelect = "UPDATE articolo SET articolo.verificato = 1 WHERE articolo.ID = $Id";
        return mysqli_query($Connection, $querySelect);
    }

    public static function loadNewArticle($articolo) {
        $article_id = $articolo->getID();
        $title = $articolo->getTitle();
        $descrizione = $articolo->getDescription();
        $content = $articolo->getContent();
        $autore = $articolo->getAuthor();
        $data_pub = $articolo->getDataPub();
        $upVotes = $articolo->getUpVotes();
        $downVotes = $articolo->getDownVotes();
        $path = $articolo->getImgPath();
        $alt = $articolo->getAltImg();
        $verificato = $articolo->getValidation();

        $Connection = DBAccess::openDBConnection();

        $querySelect = 'INSERT INTO articolo(ID, titolo, descrizione, testo, autore, data_pub,upvotes, downvotes, img_path, alt_img, verificato) values(' . $article_id . ',"' . $title . '", "' . $descrizione . '", "' . $content . '", ' . $autore . ', "' . $data_pub . '",' . $upVotes . ', ' . $downVotes . ', "' . $path . '", "' . $alt . '", "' . $verificato . '")';
        $queryResult = mysqli_query($Connection, $querySelect);
        return $queryResult;
    }

    public static function getAutoreArticolo($id_articolo) {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT * FROM utente INNER JOIN articolo on (utente.ID = articolo.autore) WHERE articolo.ID = $id_articolo";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else {
            $riga = mysqli_fetch_assoc($queryResult);
            $autore = new User($riga['ID'], $riga['nome'], $riga['cognome'], $riga['email'], $riga['password'], $riga['permesso'], $riga['img_path']);
            return $autore;
        }
    }

    public static function deleteArticle($id_articolo) {
        $connection = DBAccess::openDBConnection();
        $querySelect = "DELETE FROM articolo WHERE articolo.ID = $id_articolo";
        return mysqli_query($connection, $querySelect);
    }

    public static function getUpVotesFromArticle($id_articolo) {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT SUM(voto.up) FROM voto WHERE articolo = $id_articolo";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0) {
            return false;
        } else {
            return mysqli_fetch_assoc($queryResult);
        }
    }

    public static function getDownVotesFromArticle($id_articolo) {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT SUM(voto.down) FROM voto WHERE articolo = $id_articolo";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0) {
            return false;
        } else {
            return mysqli_fetch_assoc($queryResult);
        }
    }

    public static function getMaxId() {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT MAX(ID) from articolo";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0) {
            return false;
        } else {
            return mysqli_fetch_assoc($queryResult)['MAX(ID)'];
        }
    }

    public static function updateArticolo( Articolo $articolo ) {
        $connection = DBAccess::openDBConnection();
        //$querySelect = 'UPDATE `articolo` SET `titolo` = "'.$articolo->getTitle().'", `descrizione` = "'.$articolo->getDescription().'", `testo` = "'.$articolo->getContent().'", `autore` = "'.$articolo->getAuthor().'", `img_path` = "'.$articolo->getImgPath().'", `alt_img` = "'.$articolo->getAltImg().'" WHERE (`ID` = "'.$articolo->getID().'");';
        $querySelect = 'UPDATE `articolo` SET `titolo` = "'.$articolo->getTitle().'", `descrizione` = "'.$articolo->getDescription().'", `testo` = "'.$articolo->getContent().'", `img_path` = "'.$articolo->getImgPath().'", `alt_img` = "'.$articolo->getAltImg().'" WHERE (`ID` = "'.$articolo->getID().'");';

        $queryDelete = 'DELETE FROM `cat_art` WHERE `ID_art` = ' . $articolo->getID();

        mysqli_query( $connection, $queryDelete );

        return mysqli_query($connection, $querySelect);
    }
}
?>
