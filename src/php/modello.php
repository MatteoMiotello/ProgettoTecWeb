<?php
// manca il campo descrizione 
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

    private $descrizione;

    private $testo;


    private $autore;


    private $dataPub;


    private $upVotes;


    private $downVotes;


    private $imgPath;

    private $altImg;


    function __construct($ID, $titolo, $testo, $descrizione, $autore, $dataPub, $upVotes, $downVotes, $imgPath, $altImg)
    {
        $this->ID = $this->setID($ID);
        $this->titolo = $this->setTitolo($titolo);
        $this->testo = $this->setTesto($testo);
        $this->descrizione = $this->setDescrizione($descrizione);
        $this->autore = $this->setAutore($autore);
        $this->dataPub = $this->setDataPub($dataPub);
        $this->upVotes = $this->setUpVotes($upVotes);
        $this->downVotes = $this->setDownVotes($downVotes);
        $this->imgPath = $this->setImgPath($imgPath);
        $this->altImg = $this->setAltImg($altImg);
    }

    public function setImgPath($value)
    {
        (ctype_alnum($value) && strlen($value) <= 255) ? $this->imgPath = $value : $this->imgPath = null;
    }
    public function getImgPath()
    {
        return $this->imgPath;
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

    function getDescrizione() {
        return $this->descrizione;
    }

    function setDescrizione($value) {
        (ctype_alpha($value) && strlen($value) <= 300) ? $this->descrizione = $value : $this->descrizione = "";
    }

    public function getTesto()
    {
        return $this->testo;
    }

    public function setTesto($value)
    {
        (ctype_alnum($value) && strlen($value) <= 10000) ? $this->testo = $value : $this->testo = "";
    }

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

    public function setAltImg($value) {
        (ctype_alpha($value) && strlen($value) <= 255) ? $this->altImg = $value : $this->altImg = "";
    }

    public function getAltImg() {
        return $this->altImg;
    }

    //

    public static function getArticoli($category, $connection)
    {
        if ($category != null)
            $querySelect = "SELECT * FROM articolo, cat_art
                            WHERE  cat_art.nome_cat = '$category' AND articolo.ID = cat_art.ID_art
                            ORDER BY ID ASC";
        else
            $querySelect = "SELECT * FROM articolo ORDER BY ID ASC";
        $queryResult = mysqli_query($connection, $querySelect);
        printf("Error: %s\n", mysqli_error($connection));
        if (mysqli_num_rows($queryResult) == 0) {
            return null;
        }
        else { // ritorno la lista degli articoli all'interno del db
            $listaArticoli = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singoloArticolo = new static($riga['ID'], $riga['titolo'], $riga['descrizione'],$riga['testo'], $riga['autore'], $riga['data_pub'], $riga['upvotes'], $riga['downvotes'], $riga['img_path'], $riga['alt_img']);
                array_push($listaArticoli, $singoloArticolo);
                echo "dio merda ";
                echo get_class($singoloArticolo->getTesto());  
            }
        }
        return $listaArticoli;
    }

    public static function getAutoreArticolo($id_articolo, $connection) {
        $querySelect = "SELECT * FROM utente INNER JOIN articolo on (utente.ID = articolo.autore) WHERE articolo.ID = '. $id_articolo . '";
        $queryResult = mysqli_query($connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
        return null;
        else { // ritorno la lista degli articoli all'interno del db
            $riga = mysqli_fetch_assoc($queryResult);
            $autore = new User($riga['ID'], $riga['nome'], $riga['cognome'], $riga['email'],$riga['password'],$riga['permesso'], $riga['img_path']);
            return $autore;
        }
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

    //

    //
    public static function getCategorie()
    {
        $querySelect = "SELECT * FROM categoria";
        $queryResult = mysql_query($this->connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else { // ritorno la lista delle categorie all'interno del db
            $listaCategorie = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singolaCategoria = new Categoria($riga['nome'], $riga['descrizione']);
                array_push($listaCategorie, $singolaCategoria);
            }
        }
        return $listaCategorie;
    }
}

?>