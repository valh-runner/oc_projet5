<?php
/**
 * Main Manager
 */
class Manager
{
    /**
     * database PDO connection object
     * @var PDO or bool
     */
    private static $db = false;
    
    /**
     * Constructor
     */
    public function __construct()
    {
    }
    
    /**
     * Connect to the database and return PDO connection object
     * @return PDO
     */
    protected static function dbConnect()
    {
        $dbConn = new PDO('mysql:host=localhost;dbname=mvc_blog;charset=UTF8', 'root', '');
        $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // Enable display of requests errors
        return $dbConn;
    }
    
    /**
     * return PDO connection object.
     * if none, establish connection before.
     * @return PDO
     */
    public static function getDb()
    {
        //if no connection
        if (self::$db == false) {
            self::$db = self::dbConnect(); //database connection
        }
        return self::$db;
    }
}
