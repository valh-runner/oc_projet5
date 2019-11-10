<?php
require_once("modeles/Manager.class.php");
require_once("modeles/Post.class.php");

class PostManager extends Manager
{
    private $_db;
    
    public function __construct(){
        $this->_db = $this->dbConnect(); //database connection from manager
    }
    
    public function add(Post $post){
        $req = $this->_db->prepare('
            INSERT INTO post (title, headnote, content, revision_date, id_user)
            VALUES (:title, :headnote, :content, :revision_date, :id_user);
        ');
        $req->execute(array(
            'title' => $post->title(),
            'headnote' => $post->headnote(),
            'content' => $post->content(),
            'revision_date' => $post->revisionDate(),
            'id_user' => $post->idUser()
        ));
        return $req; //boolean success return
    }
    
    public function update(Post $post){
        $req = $this->_db->prepare('
            UPDATE post 
            SET title = :title, headnote = :headnote, content = :content, 
                revision_date = :revision_date, id_user = :id_user 
            WHERE id_post = :id_post;
        ');
        $req->execute(array(
            'title' => $post->title(),
            'headnote' => $post->headnote(),
            'content' => $post->content(),
            'revision_date' => $post->revisionDate(),
            'id_user' => $post->idUser(),
            'id_post' => $post->idPost()
        ));
        $post->hydrate([
            'id' => $this->_db->lastInsertId()
        ]);
        return $req; //boolean success return
    }
    
    public function get($id){
        $req = $this->_db->prepare('SELECT * FROM post WHERE id_post = :id;');
        $req->bindValue('id', $id);
        $req->execute();
        $row = $req->fetch();
        $req->closeCursor();
        //if user not found
        if($row == false){
            return false;
        }else{
            return new Post($row);
        }
    }
    
    public function getAll(){
        $req = $this->_db->query('SELECT * FROM post ORDER BY revision_date DESC;');
        $posts = array();
        while($row = $req->fetch()){
            $posts[] = new Post($row);
        }
        $req->closeCursor();
        return $posts;
    }
    
    public function del($id){
        $req = $this->_db->prepare('DELETE FROM post WHERE id_post = :id_post;');
        $req->bindValue('id_post', $id);
        $success = $req->execute();
        return $success; //boolean success return
    }
}