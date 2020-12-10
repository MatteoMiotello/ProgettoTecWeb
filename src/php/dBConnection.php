<?php

class DBAccess
{
    // 4 info per colegarsi al db
    private const HOST_DB = "localhost";
    private const USARNAME = "gicalgar";
    private const PASSWORD = "";
    private const DATABASE_NAME = "gicalgar";
    private $connection;

    public static function openDBConnection()
    {
        $access = new DBAccess();
        $access->setConnection(mysqli_connect(DBAccess::HOST_DB, DBAccess::USARNAME, DBAccess::PASSWORD, DBAccess::DATABASE_NAME));
        if (!$access->getConnection())
            return null;
        else return $access;
    }

    //
    public function getArticoli($category): ?Articolo
    {
        if ($category)
            $querySelect = "SELECT * FROM articolo, cat_art
                            WHERE  cat_art.nome_cat = '$category' AND articolo.ID = cat_art.ID_art
                            ORDER BY ID ASC";
        else
            $querySelect = "SELECT * FROM articolo ORDER BY ID ASC";
            $queryResult = mysql_query($this->connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else { // ritorno la lista degli articoli all'interno del db
            $listaArticoli = array();
            while ($riga = mysqli_fetch_assoc($queryResult)) {
                $singoloArticolo = new Articolo($riga['ID'], $riga['titolo'], $riga['testo'], $riga['autore'], $riga['data_pub'], $riga['upvotes'], $riga['downvotes'], $riga['img_path']);
                array_push($listaArticoli, $singoloArticolo);
            }
        }
        return $listaArticoli;
    }

    //
    public function getCategorie()
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


    public function getConnection() {
        return $this->connection;
    }

    public function setConnection($connection) {
        $this->connection = $connection;
    }
}

?>