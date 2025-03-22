<?php

class Database
{
    private static $dbHost = "localhost";
    private static $dbName = "tarawicmetmati12";
    private static $dbUser = "root";
    private static $dbUserPassword = "";
    
    private static $connection = null;

    public static function connect()
    {
        try {
            self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName . ";charset=UTF8", self::$dbUser,self::$dbUserPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $th) {
            die($th->getMessage());
        }
        return self::$connection;
    }
    
    public static function disconnect()
    {
        self::$connection = null;
    }
}

Database::connect();

?>