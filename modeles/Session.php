<?php
class Session
{
    public function __construct()
    {
        
    }
    
    public function isSession(string $sessionVarName)
    {
        return isset($_SESSION[$sessionVarName]);
    }
    
    public function getSession(string $sessionVarName)
    {
        return $_SESSION[$sessionVarName];
    }
    
    public function setSession(string $sessionVarName, Object $sessionVarValue)
    {
        $_SESSION[$sessionVarName] = $sessionVarValue;
    }
    
    public function unsetSession(string $sessionVarName)
    {
        unset($_SESSION[$sessionVarName]);
    }
}
