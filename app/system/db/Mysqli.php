<?php
/**
 * MySQLi
 */
class Mysqli_DB
{
    static public $_db;

    /**
     * Database
     */
    final static public function connectDatabase()
    {
        if (!self::$_db) {
            self::$_db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            if (mysqli_connect_errno()) {
                exit('Error DB connection...');
            } else {
                self::$_db->query("SET NAMES 'utf8'");
                self::$_db->query("SET CHARACTER SET 'utf8'");
            }
        }
    }

    final static public function newConnection($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME)
    {
        $db = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

        if (mysqli_connect_errno()) {
            return false; // Error DB connection
        } else {
            $db->query("SET NAMES 'utf8'");
            $db->query("SET CHARACTER SET 'utf8'");
        }

        return $db;
    }
}
/* End of file */