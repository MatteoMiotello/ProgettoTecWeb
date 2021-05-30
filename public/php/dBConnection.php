<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/DotEnv.php';

class DBAccess
{

    private static $connection;
    private static $access;
    private static $DBName;
    public static function openDBConnection()
    {
        ( new DotEnv() )->load();

        if (!DBAccess::$access) {
            DBAccess::$access = new DBAccess();

            DBAccess::$connection = mysqli_connect(
                getenv('DB_HOST'),
                getenv('DB_USARNAME'),
                getenv('DB_PASSWORD'),
                getenv('DB_NAME')
            );
            DBAccess::$DBName = getenv('DB_NAME');
        }

        mysqli_select_db(DBAccess::$connection, getenv('DB_NAME')) or die("no database");

        if (!DBAccess::$connection) {
            return null;
        } else {
            return DBAccess::$connection;
        }
    }

    /**
     * return the name of the DB
     * @return string
     */
    public static function getDBName() {
        return DBAccess::$DBName;
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    public function query($query)
    {
        return mysqli_query(DBAccess::$connection, $query);
    }
}
