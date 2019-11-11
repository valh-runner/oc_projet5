<?php

class Comment
{
    private $_idComment,
            $_content,
            $_validated,
            $_creationTime,
            $_idPost,
            $_idUser;
    
    public function __construct(array $datas){
        $this->hydrate($datas);
    }
    
    public function idComment(){
        return $this->_idComment;
    }
    public function content(){
        return $this->_content;
    }
    public function validated(){
        return $this->_validated;
    }
    public function creationTime(){
        return $this->_creationTime;
    }
    public function idPost(){
        return $this->_idPost;
    }
    public function idUser(){
        return $this->_idUser;
    }    
    
    public function setIdComment($id){
        $this->_idComment = $id;
    }
    public function setContent($content){
        $this->_content = $content;
    }
    public function setValidated($validated){
        $this->_validated = $validated;
    }
    public function setCreationTime($creationTime){
        $this->_creationTime = $creationTime;
    }
    public function setIdPost($idPost){
        $this->_idPost = $idPost;
    }
    public function setIdUser($idUser){
        $this->_idUser = $idUser;
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

