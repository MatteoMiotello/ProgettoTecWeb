<?php

class DBAccess
{

    private const HOST_DB = "localhost";
    private const USARNAME = "root";
    private const PASSWORD = "password";
    private const DATABASE_NAME = "tec_web";
    private static $connection;

    public static function openDBConnection()
    {
        $access = new DBAccess();
        $access->setConnection(mysqli_connect(DBAccess::HOST_DB, DBAccess::USARNAME, DBAccess::PASSWORD, DBAccess::DATABASE_NAME));
        mysqli_select_db(DBAccess::$connection, "tec_web") or die ("no database");
        if (!$access->getConnection())
            return null;
        else return $access;
    }

    public function getConnection() {
        return DBAccess::$connection;
    }

    public function setConnection($connection) {
        DBAccess::$connection = $connection;
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    public function query( $query ) {
        return mysqli_query( $this->getConnection(), $query );
    }
}

?>