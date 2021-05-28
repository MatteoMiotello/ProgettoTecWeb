<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/models/User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/DotEnv.php';
class CheckValues {
    public static function checkForCorrectValues($value, $typeOfCheck, $length) {
        $correctCharacters = true;
        switch ($typeOfCheck) {
            case "digit":
                $correctCharacters = ctype_digit($value);
                break;
            case "alpha":
                $copy = CheckValues::sanitize($value);
                $copy = str_replace(' ', '', $copy);            
                $correctCharacters = preg_match('/[a-zA-Zèéàòùì]+/', $copy);
                break;
            case "alnum":
                $correctCharacters = ctype_alnum(CheckValues::sanitize($value));
                break;
            case "data":
                $correctCharacters = DateTime::createFromFormat('Y-m-d G:i:s', $value);
                break;
            //controllo mail
            case "email":
                $correctCharacters = filter_var($value, FILTER_VALIDATE_EMAIL);
                break;
            //SQL injection
        }
        $correctCharacters = $correctCharacters && (strlen($value) <= $length);
        return $correctCharacters;
    }

    public static function sanitize($var){
      $var = trim($var);
      $var = stripslashes($var);
      $var = htmlspecialchars($var);
      return $var;
    }


    public static function createMsgError($value) {
        return "Error Processing Request, $value Has Incorrect Characters Or Is Too Long";
    }


}

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
    public static function getArticoli($category,$limit) {
        $connection = DBAccess::openDBConnection();

        if ($category != null)
            $querySelect = "SELECT * FROM articolo, cat_art
                            WHERE  cat_art.nome_cat = '$category' AND articolo.ID = cat_art.ID_art
                            ORDER BY ID ASC";
        else
            $querySelect = "SELECT * FROM articolo ORDER BY ID ASC";
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
        if(!$queryResult)
            return null;
        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        } else {
            $riga = mysqli_fetch_assoc($queryResult);
            $singoloArticolo = new Articolo($riga['ID'], $riga['titolo'], $riga['descrizione'], $riga['testo'], $riga['autore'], $riga['data_pub'], $riga['upvotes'], $riga['downvotes'], $riga['img_path'], $riga['alt_img'], $riga['verificato']);
            return $singoloArticolo;
        }
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
        $content = $articolo->getDescription();
        $autore = $articolo->getAuthor();
        $data_pub = $articolo->getDataPub();
        $upVotes = $articolo->getUpVotes();
        $downVotes = $articolo->getDownVotes();
        $path = $articolo->getImgPath();
        $alt = $articolo->getAltImg();
        $verificato = $articolo->getValidation();
        
        $Connection = DBAccess::openDBConnection();

        $querySelect = 'INSERT INTO articolo(ID, titolo, descrizione, testo, autore, data_pub,upvotes, downvotes, img_path, alt_img, verificato) values('.$article_id.',"'.$title.'", "'.$descrizione.'", "'.$content.'", '.$autore.', "'.$data_pub.'",'.$upVotes.', '.$downVotes.', "'.$path.'", "'.$alt.'", "'.$verificato.'")';
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
            return  mysqli_fetch_assoc($queryResult);
        }
    }
    public static function getMaxId() {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT MAX(ID) from articolo";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0) {
            return false;
        } else {
            return  mysqli_fetch_assoc($queryResult)['MAX(ID)'];
        }
    }
}

class Categoria {
    private $nome;

    private $descrizione;

    private $img;


    function __construct(string $nome, string $descrizione, string $img) {
        try {
            $this->setNome($nome);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        try {
            $this->setDescrizione($descrizione);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
        try {
            $this->setImg($img);
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }


    public function setDescrizione($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 255);
        if ($correctCharacters)
            $this->descrizione = $value;
        else
            throw new Exception(CheckValues::createMsgError("Descrizione"), 1);
    }


    public function getNome() {
        return $this->nome;
    }


    public function setNome($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "alnum", 20);
        if ($correctCharacters)
            $this->nome = $value;
        else
            throw new Exception(CheckValues::createMsgError("Name"), 1);
    }


    public function getDescrizione() {
        return $this->descrizione;
    }


    public function getImg() {
        return $this->img;
    }


    public function setImg($value) {
        $correctCharacters = CheckValues::checkForCorrectValues($value, "", 255);
        if ($correctCharacters)
            $this->img = $value;
        else
            throw new Exception(CheckValues::createMsgError("Img Of Category"), 1);
    }


    public static function getCategorie() {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT * FROM categoria";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else { // ritorno la lista delle categorie all'interno del db
            $listaCategorie = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singolaCategoria = new Categoria(strval($riga['nome']), $riga['descrizione'], $riga['img']);
                array_push($listaCategorie, $singolaCategoria);
            }
        }
        return $listaCategorie;
    }


    public static function getCategorieArticolo($id_articolo) {
        $connection = DBAccess::openDBConnection();
        $querySelect = "SELECT categoria.nome, categoria.descrizione, categoria.img FROM cat_art INNER JOIN categoria ON cat_art.nome_cat = categoria.nome WHERE cat_art.ID_art = $id_articolo";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else { // ritorno la lista delle categorie all'interno del db
            $listaCategorie = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singolaCategoria = new Categoria($riga['nome'], $riga['descrizione'], $riga['img']);
                array_push($listaCategorie, $singolaCategoria);
            }
        }
        return $listaCategorie;
    }

    public static function loadNewCategoryForArticle($category, $article_id) {
        $connection = DBAccess::openDBConnection();
        $querySelect = 'INSERT INTO cat_art values('.$article_id.',"'.$category.'") ';
        return mysqli_query($connection, $querySelect);
    }
}

?>
