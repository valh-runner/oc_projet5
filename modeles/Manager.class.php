<?php
class Manager
{
    private static $_db = false;
    
    public function __construct()
    {
    }
    
    protected static function dbConnect()
    {
        $dbConn = new PDO('mysql:host=localhost;dbname=mvc_blog;charset=UTF8', 'root', '');
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Enable display of requests errors
        return $dbConn;
    }
    
    public static function getDb()
    {
        //if no connection
        if (self::$_db == false) {
            self::$_db = self::dbConnect(); //database connection
        }
        return self::$_db;
    }
}
