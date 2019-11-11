<?php
require_once("modeles/Manager.class.php");
require_once("modeles/Comment.class.php");

class CommentManager extends Manager
{
    private $_db;
    
    public function __construct(){
        $this->_db = $this->dbConnect(); //database connection from manager
    }
    
    public function add(Comment $comment){
        $req = $this->_db->prepare('
            INSERT INTO comment (content, validated, creation_time, id_post, id_user)
            VALUES (:content, :validated, :creation_time, :id_post, :id_user);
        ');
        $success = $req->execute(array(
            'content' => $comment->content(),
            'validated' => $comment->validated(),
            'creation_time' => $comment->creationTime(),
            'id_post' => $comment->idPost(),
            'id_user' => $comment->idUser()
        ));
        $comment->hydrate([
            'id' => $this->_db->lastInsertId()
        ]);
        $req->closeCursor();
        return $success; //boolean success return
    }
    
    public function update(Comment $comment){
        $req = $this->_db->prepare('
            UPDATE comment 
            SET content = :content, validated = :validated, creation_time = :creation_time, 
                id_post = :id_post, id_user = :id_user
            WHERE id_comment = :id_comment;
        ');
        $success = $req->execute(array(
            'id_comment' => $comment->idComment(),
            'content' => $comment->content(),
            'validated' => $comment->validated(),
            'creation_time' => $comment->creationTime(),
            'id_post' => $comment->idPost(),
            'id_user' => $comment->idUser()
        ));
        $req->closeCursor();
        return $success; //boolean success return
    }
    
    public function del($id){
        $req = $this->_db->prepare('DELETE FROM comment WHERE id_comment = :id_comment;');
        $req->bindValue('id_comment', $id);
        $success = $req->execute();
        return $success; //boolean success return
    }
    
    public function get($id){
        $req = $this->_db->prepare('SELECT * FROM comment WHERE id_comment = :id;');
        $req->bindValue('id', $id);
        $req->execute();
        $row = $req->fetch();
        $req->closeCursor();
        //if comment not found
        if($row == false){
            return false;
        }else{
            return new Comment($row);
        }
    }
    
    public function getAllValidatedForPost($idPost){
        $req = $this->_db->prepare('
            SELECT * FROM comment 
            WHERE id_post = :id_post 
            AND validated = 1 
            ORDER BY creation_time DESC;
        ');
        $req->bindValue('id_post', $idPost);
        $req->execute();
        $comments = array();
        while($row = $req->fetch()){
            $comments[] = new Comment($row);
        }
        $req->closeCursor();
        return $comments;
    }
    
    public function getAllWaitingForPost($idPost){
        $req = $this->_db->prepare('
            SELECT * FROM comment 
            WHERE id_post = :id_post 
            AND validated = 0 
            ORDER BY creation_time DESC;
        ');
        $req->bindValue('id_post', $idPost);
        $req->execute();
        $comments = array();
        while($row = $req->fetch()){
            $comments[] = new Comment($row);
        }
        $req->closeCursor();
        return $comments;
    }
}