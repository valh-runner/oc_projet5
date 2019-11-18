<?php
/**
 * Allow to use global session vars
 */
class Session
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }
    
    /**
     * Check if session var exists
     * @param string $sessionVarName 
     * @return bool
     */
    public function isSession(string $sessionVarName)
    {
        return isset($_SESSION[$sessionVarName]);
    }

    /**
     * Return session var value
     * @param string $sessionVarName 
     * @return object
     */
    public function getSession(string $sessionVarName)
    {
        return $_SESSION[$sessionVarName];
    }
    
    /**
     * Set session var with value
     * @param string $sessionVarName 
     * @param object $sessionVarValue
     */
    public function setSession(string $sessionVarName, $sessionVarValue)
    {
        $_SESSION[$sessionVarName] = $sessionVarValue;
    }
    
    /**
     * Unset session var
     * @param string $sessionVarName
     */
    public function unsetSession(string $sessionVarName)
    {
        unset($_SESSION[$sessionVarName]);
    }
}
