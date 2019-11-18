<?php
/**
 * Manager of User entities
 */
class UserManager extends Manager
{
    /**
     * Add a User in database
     * @param User $user 
     * @return bool
     */
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
    
    /**
     * Get a User in database
     * @param int $idUser 
     * @return User or bool
     */
    public function get(int $idUser)
    {
        $req = self::getDb()->prepare('SELECT * FROM user WHERE id_user = :id_user;');
        $req->bindValue('id_user', $idUser);
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
    
    /**
     * Get a User in database
     * @param string $email 
     * @return User or bool
     */
    public function getByEmail(string $email)
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
    
    /**
     * Get all Users
     * @return array
     */
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
    
    /**
     * Get all users who did validated comment for a post
     * @param int $idPost 
     * @return array
     */
    public function getAllWhoDidValidatedCommentForPost(int $idPost)
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
    
    /**
     * Get all users who did waiting comment for a post
     * @param int $idPost 
     * @return array
     */
    public function getAllWhoDidWaitingCommentForPost(int $idPost)
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
    
    /**
     * Update a user in database
     * @param User $user 
     * @return bool
     */
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
    
    /**
     * Delete a Post in database
     * @param int $idUser 
     * @return bool
     */
    public function del(int $idUser)
    {
        $req = self::getDb()->prepare('DELETE FROM user WHERE id_user = :id_user;');
        $req->bindValue('id_user', $idUser);
        $success = $req->execute();
        return $success; //boolean success return
    }
}
