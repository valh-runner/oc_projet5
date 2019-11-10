<?php

class User
{
    private $_idUser,
            $_username,
            $_email,
            $_passwordHash,
            $_registerDate,
            $_adminGranted;
    
    public function __construct(array $datas){
        $this->hydrate($datas);
    }
    
    public function idUser(){
        return $this->_idUser;
    }
    public function username(){
        return $this->_username;
    }
    public function email(){
        return $this->_email;
    }
    public function passwordHash(){
        return $this->_passwordHash;
    }
    public function registerDate(){
        return $this->_registerDate;
    }
    public function adminGranted(){
        return $this->_adminGranted;
    }
    
    public function setIdUser($id){
        $this->_idUser = $id;
    }
    public function setUsername($username){
        $this->_username = $username;
    }
    public function setEmail($email){
        $this->_email = $email;
    }
    public function setPasswordHash($passwordHash){
        $this->_passwordHash = $passwordHash;
    }
    public function setRegisterDate($registerDate){
        $this->_registerDate = $registerDate;
    }
    public function setAdminGranted($adminGranted){
        $this->_adminGranted = $adminGranted;
    }
    
    public function hydrate(array $datas){
        foreach($datas as $fieldName => $data){
            $fieldNameParts = explode('_', $fieldName);
            $methodName = 'set';
            foreach($fieldNameParts as $fieldNamePart){
                $methodName .= ucfirst($fieldNamePart);
            }
            if(method_exists($this, $methodName)){
                $this->$methodName($data);
            }
        }
    }
}
