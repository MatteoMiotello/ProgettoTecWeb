<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/modello.php';

class VoteHandler {
    private $Article;


    public function __construct($article) {
        $this->Article = $article;
    }


    public function addUpVote(User $user) {
        $db = DBAccess::openDBConnection();

        $validateQuery = 'SELECT * FROM voto WHERE utente="' . $user->getID() . '"and articolo = "' . $this->Article->getID() . '" and up = 1';

        if ($db->query($validateQuery)->fetch_assoc()) {
            return false;
        }

        $this->deleteDownVote( $user );

        $query = 'INSERT INTO voto (utente, articolo, up, down) VALUES( "' . $user->getID() . '" , "' . $this->Article->getID() . '", 1, 0 )';
        $result = $db->query($query);

        if (!$result) {
            throw new Exception('not insert');
        }
    }


    public function addDownVote(User $user) {
        $db = DBAccess::openDBConnection();

        $validateQuery = 'SELECT * FROM voto WHERE utente="' . $user->getID() . '"and articolo = "' . $this->Article->getID() . '" and down = 1';

        if ($db->query($validateQuery)->fetch_assoc()) {
            return false;
        }

        $this->deleteUpVote( $user );

        $query = 'INSERT INTO voto (utente, articolo, up, down) VALUES( "' . $user->getID() . '" , "' . $this->Article->getID() . '", 0, 1 )';


        $result = $db->query($query);

        if (!$result) {
            throw new Exception('not insert');
        }
    }


    public function getVotes(User $user): ?bool {
        $db = DBAccess::openDBConnection();
        $result = $db->query('SELECT * FROM voto WHERE utente = ' . $user->getID() . ' AND articolo = ' . $this->Article->getID())->fetch_assoc();

        if(!$result)
            return null;
        
        if ($result['up'] == 1) {
            return true;
        }

        if ($result['down'] == 1) {
            return false;
        }

        return null;
    }

    private function deleteUpVote( User $user ) {
        $db = DBAccess::openDBConnection();

        $upQuery = 'SELECT * FROM voto WHERE utente =' . $user->getID() . ' AND articolo = ' . $this->Article->getID() . ' and up = 1 and down = 0';


        if ( $db->query( $upQuery )->fetch_assoc() ) {
            return $db->query( 'DELETE FROM voto WHERE utente =' . $user->getID() . ' AND articolo = ' . $this->Article->getID() . ' and up = 1 and down = 0' );
        }
    }

    private function deleteDownVote( User $user ) {
        $db = DBAccess::openDBConnection();

        $upQuery = 'SELECT * FROM voto WHERE utente =' . $user->getID() . ' AND articolo = ' . $this->Article->getID() . ' and up = 0 and down = 1';


        if ( $db->query( $upQuery )->fetch_assoc() ) {
            return $db->query( 'DELETE FROM voto WHERE utente =' . $user->getID() . ' AND articolo = ' . $this->Article->getID() . ' and up = 0 and down = 1' );
        }
    }
}