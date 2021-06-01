<?php

require_once __DIR__.'/CheckValues.php';
require_once __DIR__.'/dBConnection.php';

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
        $querySelect = 'INSERT INTO `cat_art` values(' . $article_id . ',"' . $category . '") ';
        return mysqli_query($connection, $querySelect);
    }
}

?>
