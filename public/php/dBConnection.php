<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/DotEnv.php';

class DBAccess {
    private static $connection;

    public static function openDBConnection() {
        ( new DotEnv( $_SERVER['DOCUMENT_ROOT'] . '/../envirorment/.env' ) )->load();

        $access = new DBAccess();
        $access->setConnection(mysqli_connect(
            getenv( 'DB_HOST' ),
            getenv( 'DB_USARNAME' ),
            getenv( 'DB_PASSWORD' ),
            getenv( 'DB_NAME' )
        ));

        mysqli_select_db(DBAccess::$connection, getenv( 'DB_NAME' ) ) or die ("no database");

        if (!$access->getConnection()) {
            return null;

        } else {
            return $access;
        }
    }

    /**
     * @return mixed
     */
    public function getConnection() {
        return DBAccess::$connection;
    }

    /**
     * @param $connection
     */
    public function setConnection($connection) {
        DBAccess::$connection = $connection;
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    public function query($query) {
        return mysqli_query($this->getConnection(), $query);
    }
}