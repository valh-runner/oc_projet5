<?php
class UserManager extends Manager
{
    public function add(User $user)
    {
        $req = self::getDb()->prepare('
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
            'id' => self::getDb()->lastInsertId()
        ]);
        return $req; //boolean success return
    }
    
    public function get($id)
    {
        $req = self::getDb()->prepare('SELECT * FROM user WHERE id_user = :id;');
        $req->bindValue('id', $id);
        $req->execute();
        $row = $req->fetch();
        $req->closeCursor();
        //if user not found
        if ($row == false) {
            return false;
        } else {
            return new User($row);
        }
    }
    
    public function getByEmail($email)
    {
        $req = self::getDb()->prepare('SELECT * FROM user WHERE email = :email LIMIT 1;');
        $req->bindValue('email', $email, PDO::PARAM_STR);
        $req->execute();
        $row = $req->fetch();
        
        $req->closeCursor();
        //if user not found
        if ($row == false) {
            return false;
        } else {
            return new User($row);
        }
    }
    
    public function getAll()
    {
        $req = self::getDb()->query('SELECT * FROM user;');
        $users = array();
        while ($row = $req->fetch()) {
            $users[] = new User($row);
        }
        $req->closeCursor();
        return $users;
    }
    
    public function getAllWhoDidValidatedCommentForPost($idPost)
    {
        //array of each users who commented the post, indexed by id_user
        $req = self::getDb()->prepare('
            SELECT u.* 
            FROM user u, comment c 
            WHERE u.id_user = c.id_user 
            AND c.id_post = :id_post 
            AND c.validated = 1 
            GROUP BY u.id_user;
        ');
        $req->bindValue('id_post', $idPost);
        $req->execute();
        $usersWhoCommented = array();
        while ($row = $req->fetch()) {
            $usersWhoCommented[$row['id_user']] = new User($row);
        }
        $req->closeCursor();
        return $usersWhoCommented;
    }
    
    public function getAllWhoDidWaitingCommentForPost($idPost)
    {
        //array of each users who commented the post, indexed by id_user
        $req = self::getDb()->prepare('
            SELECT u.* 
            FROM user u, comment c 
            WHERE u.id_user = c.id_user 
            AND c.id_post = :id_post 
            AND c.validated = 0 
            GROUP BY u.id_user;
        ');
        $req->bindValue('id_post', $idPost);
        $req->execute();
        $usersWhoCommented = array();
        while ($row = $req->fetch()) {
            $usersWhoCommented[$row['id_user']] = new User($row);
        }
        $req->closeCursor();
        return $usersWhoCommented;
    }
    
    public function update(User $user)
    {
        $req = self::getDb()->prepare('
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
    
    public function del($idUser)
    {
        $req = self::getDb()->prepare('DELETE FROM user WHERE id_user = :id_user;');
        $req->bindValue('id_user', $idUser);
        $success = $req->execute();
        return $success; //boolean success return
    }
}
