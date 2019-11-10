<?php
require_once("modeles/Manager.class.php");
require_once("modeles/User.class.php");

class UserManager extends Manager
{
    private $_db;
    
    public function __construct(){
        $this->_db = $this->dbConnect(); //database connection from manager
    }
    
    public function add(User $user){
        $req = $this->_db->prepare('
            INSERT INTO user (username, email, password_hash, register_date)
            VALUES (:username, :email, :password_hash, :register_date);
        ');
        $req->execute(array(
            'username' => $user->username(),
            'email' => $user->email(),
            'password_hash' => $user->passwordHash(),
            'register_date' => $user->registerDate()
        ));
        $user->hydrate([
            'id' => $this->_db->lastInsertId()
        ]);
        return $req; //boolean success return
    }
    
    public function get($id){
        $req = $this->_db->prepare('SELECT * FROM user WHERE id_user = :id;');
        $req->bindValue('id', $id);
        $req->execute();
        $row = $req->fetch();
        $req->closeCursor();
        //if user not found
        if($row == false){
            return false;
        }else{
            return new User($row);
        }
    }
    
    public function getByEmail($email){
        $req = $this->_db->prepare('SELECT * FROM user WHERE email = :email LIMIT 1;');
        $req->bindValue('email', $email, PDO::PARAM_STR);
        $req->execute();
        $row = $req->fetch();
        
        $req->closeCursor();
        //if user not found
        if($row == false){
            return false;
        }else{
            return new User($row);
        }
    }
    
    public function getAll(){
        $req = $this->_db->query('SELECT * FROM user;');
        $users = array();
        while($row = $req->fetch()){
            $users[] = new User($row);
        }
        $req->closeCursor();
        return $users;
    }
    
    public function getAllWhoCommentedPost($idPost){
        //array of each users who commented the post, indexed by id_user
        $req = $this->_db->prepare('
            SELECT u.* 
            FROM user u, comment c 
            WHERE u.id_user = c.id_user
            AND c.id_post = :id_post;
        ');
        $req->bindValue('id_post', $idPost);
        $req->execute();
        //TODO: ajouter AND c.validated = 1;
        //TODO: ajouter GROUP BY (ou DISTINCT) pour eviter d'avoir plusieurs fois le mm user
        $usersWhoCommented = array();
        while($row = $req->fetch()){
            $usersWhoCommented[$row['id_user']] = new User($row);
        }
        $req->closeCursor();
        return $usersWhoCommented;
    }
    
    public function update(User $user){
        $req = $this->_db->prepare('
            UPDATE user 
            SET username = :username, email = :email, password_hash = :password_hash, 
                register_date = :register_date, admin_granted = :admin_granted
            WHERE id_user = :id_user;
        ');
        $success = $req->execute(array(
            'username' => $user->username(),
            'email' => $user->email(),
            'password_hash' => $user->passwordHash(),
            'register_date' => $user->registerDate(),
            'admin_granted' => $user->adminGranted(),
            'id_user' => $user->idUser()
        ));
        $req->closeCursor();
        return $success; //boolean success return
    }
    
    public function del($idUser){
        $req = $this->_db->prepare('DELETE FROM user WHERE id_user = :id_user;');
        $req->bindValue('id_user', $idUser);
        $success = $req->execute();
        return $success; //boolean success return
    }
}