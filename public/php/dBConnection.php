<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/php/library/DotEnv.php';

class DBAccess
{

    private static $connection;
    private static $access;

    public static function openDBConnection()
    {
        (new DotEnv($_SERVER['DOCUMENT_ROOT'] . '/../envirorment/.env'))->load();

        if (!DBAccess::$access) {
            DBAccess::$access = new DBAccess();

            DBAccess::$connection = mysqli_connect(
                getenv('DB_HOST'),
                getenv('DB_USARNAME'),
                getenv('DB_PASSWORD'),
                getenv('DB_NAME')
            );
        }

        mysqli_select_db(DBAccess::$connection, getenv('DB_NAME')) or die("no database");

        if (!DBAccess::$connection) {
            return null;
        } else {
            return DBAccess::$connection;
        }
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
