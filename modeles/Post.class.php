<?php

class Post
{
    private $_idPost,
            $_title,
            $_headnote,
            $_content,
            $_creationTime,
            $_revisionTime,
            $_idUser;
    
    public function __construct(array $datas){
        $this->hydrate($datas);
    }
    
    public function idPost(){
        return $this->_idPost;
    }
    public function title(){
        return $this->_title;
    }
    public function headnote(){
        return $this->_headnote;
    }
    public function content(){
        return $this->_content;
    }
    public function creationTime(){
        return $this->_creationTime;
    }
    public function revisionTime(){
        return $this->_revisionTime;
    }
    public function idUser(){
        return $this->_idUser;
    }    
    
    public function setIdPost($id){
        $this->_idPost = $id;
    }
    public function setTitle($title){
        $this->_title = $title;
    }
    public function setHeadnote($headnote){
        $this->_headnote = $headnote;
    }
    public function setContent($content){
        $this->_content = $content;
    }
    public function setCreationTime($creationTime){
        $this->_creationTime = $creationTime;
    }
    public function setRevisionTime($revisionTime){
        $this->_revisionTime = $revisionTime;
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