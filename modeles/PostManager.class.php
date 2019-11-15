<?php
class PostManager extends Manager
{
    public function add(Post $post)
    {
        $req = self::getDb()->prepare('
            INSERT INTO post (title, headnote, content, creation_time, revision_time, id_user)
            VALUES (:title, :headnote, :content, :creation_time, :revision_time, :id_user);
        ');
        $req->execute(array(
            'title' => $post->title(),
            'headnote' => $post->headnote(),
            'content' => $post->content(),
            'creation_time' => $post->creationTime(),
            'revision_time' => $post->revisionTime(),
            'id_user' => $post->idUser()
        ));
        return $req; //boolean success return
    }
    
    public function update(Post $post)
    {
        $req = self::getDb()->prepare('
            UPDATE post 
            SET title = :title, headnote = :headnote, content = :content, 
                creation_time = :creation_time, revision_time = :revision_time, id_user = :id_user 
            WHERE id_post = :id_post;
        ');
        $req->execute(array(
            'title' => $post->title(),
            'headnote' => $post->headnote(),
            'content' => $post->content(),
            'creation_time' => $post->creationTime(),
            'revision_time' => $post->revisionTime(),
            'id_user' => $post->idUser(),
            'id_post' => $post->idPost()
        ));
        $post->hydrate([
            'id' => self::getDb()->lastInsertId()
        ]);
        return $req; //boolean success return
    }
    
    public function get($id)
    {
        $req = self::getDb()->prepare('SELECT * FROM post WHERE id_post = :id;');
        $req->bindValue('id', $id);
        $req->execute();
        $row = $req->fetch();
        $req->closeCursor();
        //if user not found
        if ($row == false) {
            return false;
        } else {
            return new Post($row);
        }
    }
    
    public function getAll()
    {
        $req = self::getDb()->query('SELECT * FROM post ORDER BY creation_time DESC;');
        $posts = array();
        while ($row = $req->fetch()) {
            $posts[] = new Post($row);
        }
        $req->closeCursor();
        return $posts;
    }
    
    public function del($id)
    {
        $req = self::getDb()->prepare('DELETE FROM post WHERE id_post = :id_post;');
        $req->bindValue('id_post', $id);
        $success = $req->execute();
        return $success; //boolean success return
    }
}
