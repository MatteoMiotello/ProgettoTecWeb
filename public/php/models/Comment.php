<?php

//todo setter

class Comment
{
    /**
     * @var int $IdArticolo
     */
    private $IdArticolo;


    /**
     * @var int $IdCommento
     */
    private $IdCommento;


    /**
     * @var int $IdAutore
     */
    private $IdAutore;


    /**
     * @var string $Testo
     */
    private $Testo;


    /**
     * @var string $DataPubblicazione
     */
    private $DataPubblicazione;

    /**
     * Comment constructor.
     * @param int $IdArticolo
     * @param int $IdCommento
     * @param int $IdAutore
     * @param string $Testo
     * @param string $DataPubblicazione
     */
    public function __construct(int $IdArticolo, int $IdCommento, int $IdAutore, string $Testo, string $DataPubblicazione)
    {
        $this->IdArticolo = $IdArticolo;
        $this->IdCommento = $IdCommento;
        $this->IdAutore = $IdAutore;
        $this->Testo = $Testo;
        $this->DataPubblicazione = $DataPubblicazione;
    }


    /**
     * @return int
     */
    public function getIdArticolo(): int
    {
        return $this->IdArticolo;
    }

    /**
     * @param int $IdArticolo
     */
    public function setIdArticolo(int $IdArticolo): void
    {
        $this->IdArticolo = $IdArticolo;
    }

    /**
     * @return int
     */
    public function getIdCommento(): int
    {
        return $this->IdCommento;
    }

    /**
     * @param int $IdCommento
     */
    public function setIdCommento(int $IdCommento): void
    {
        $this->IdCommento = $IdCommento;
    }

    /**
     * @return int
     */
    public function getIdAutore(): int
    {
        return $this->IdAutore;
    }

    /**
     * @param int $IdAutore
     */
    public function setIdAutore(int $IdAutore): void
    {
        $this->IdAutore = $IdAutore;
    }

    /**
     * @return string
     */
    public function getTesto(): string
    {
        return $this->Testo;
    }

    /**
     * @param string $Testo
     */
    public function setTesto(string $Testo): void
    {
        $this->Testo = $Testo;
    }

    /**
     * @return string
     */
    public function getDataPubblicazione(): string
    {
        return $this->DataPubblicazione;
    }

    /**
     * @param string $DataPubblicazione
     */
    public function setDataPubblicazione(string $DataPubblicazione): void
    {
        $this->DataPubblicazione = $DataPubblicazione;
    }


    public static function getAllComments(): ?Comment {
        $access = DBAccess::openDBConnection();

        $query = 'SELECT * FROM commento';

        $queryResult = mysqli_query( $access->getConnection(), $query );

        if ( !mysqli_num_rows( $queryResult )){
            return null;
        }

        $rows = mysqli_fetch_array( $queryResult );

        $result = [];

        foreach ( $rows as $row ) {
            $comment = new Comment( $row['ID_art'], $row['ID_com'], $row['autore'], $row['testo'], $row['data_pub']);

            array_push( $result, $comment );
        }

        return $result;
    }


    public function getAuthor(): User{
        $access = DBAccess::openDBConnection();

        $query = sprintf( 'SELECT * FROM utente WHERE ID = %s', $this->getIdAutore() );

        $queryResult = mysqli_query( $access->getConnection(), $query );

        $row = mysqli_fetch_row( $queryResult );

        return ( new User( $row['ID'], $row['nome'], $row['cognome'], $row['email'], $row['password'], $row['permesso'], $row['img_row'] ));
    }

    public static function getCommentsFromArticle($Connection, $IdArticolo) {
        $querySelect = "SELECT * FROM commento WHERE commento.ID_art = $IdArticolo";
        $queryResult = mysqli_query($Connection, $querySelect);
        if (mysqli_num_rows($queryResult) == 0)
            return null;
        else { // ritorno la lista delle categorie all'interno del db
            $listaCommenti = array();
            while ($row = mysqli_fetch_assoc($queryResult)) {
                $singoloCommento = new Comment( $row['ID_art'], $row['ID_com'], $row['autore'], $row['testo'], $row['data_pub']);
                array_push($listaCommenti, $singoloCommento);
            }
        }
        return $listaCommenti;
    }
}