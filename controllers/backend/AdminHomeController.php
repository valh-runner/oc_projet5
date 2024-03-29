<?php
/**
 * Administration functionalities
 */
class AdminHomeController extends Controller
{
    /**
     * Retrieve all posts
     */
    public function index()
    {
        $postManager = new PostManager();
        $this->set('posts', $postManager->getAll());
    }
    
    /**
     * Retrieve a post and user who created it
     * @param int $idPost
     */
    public function post(int $idPost)
    {
        //retrieve concerned post
        $postManager = new PostManager();
        $post = $postManager->get($idPost);
        $this->set('post', $post);
        
        //retrieve user who created post
        $userManager = new UserManager();
        $user = $userManager->get($post->idUser());
        $this->set('user', $user);
    }
    
    /**
     * Add a post with posted form datas
     */
    public function addPost()
    {
        $feedback = '';
        //if form submited
        if (!empty($this->safePost)) {
            $fieldNames = array('title', 'headnote', 'content');
            $fields = array();
            
            $pass = true;
            //check user inputs
            foreach ($fieldNames as $fieldName) {
                //if field is filled
                if (!empty($this->safePost[$fieldName])) {
                    $fields[$fieldName] = $this->safePost[$fieldName]; //set pacified user input
                } else {
                    $fields[$fieldName] = ''; //set as empty
                    $pass = false;
                }
            }
            
            if (!$pass) {
                $feedback = 'Un champ est manquant!';
            } else {
                //add post in database
                $datas = array(
                    'title' => $fields['title'],
                    'headnote' => $fields['headnote'],
                    'content' => $fields['content'],
                    'creationTime' => date('Y-m-d H:i:s'),
                    'revisionTime' => date('Y-m-d H:i:s'),
                    'idUser' => $this->session->getSession('userId')
                );
                $post = new Post($datas);
                $postManager = new PostManager();
                $success = $postManager->add($post);
                
                if (!$success) { //if post not added
                    $feedback = 'Une erreur s\'est produite!';
                } else {
                    $feedback = 'Post ajouté';
                }
            }
        }
        $this->set('feedback', $feedback);
    }
    
    /**
     * Retrieve a post and update it with posted form datas
     * @param int $idPost
     */
    public function updatePost(int $idPost)
    {
        $postManager = new PostManager();
        $post = $postManager->get($idPost); //retrieve concerned post
        
        $feedback = '';
        //if form submited
        if (!empty($this->safePost)) {
            $fieldNames = array('title', 'headnote', 'content');
            $fields = array();
            
            $pass = true;
            //check user inputs
            foreach ($fieldNames as $fieldName) {
                //if field is filled
                if (!empty($this->safePost[$fieldName])) {
                    $fields[$fieldName] = $this->safePost[$fieldName]; //set pacified user input
                } else {
                    $fields[$fieldName] = ''; //set as empty
                    $pass = false;
                }
            }
            
            if (!$pass) {
                $feedback = 'Un champ est manquant!';
            } else {
                //make updates on a copy of the post
                $updatedPost = clone $post;
                $updatedPost->setTitle($fields['title']);
                $updatedPost->setHeadnote($fields['headnote']);
                $updatedPost->setContent($fields['content']);
                $updatedPost->setRevisionTime(date('Y-m-d H:i:s'));
                $updatedPost->setIdUser($this->session->getSession('userId'));
                
                $success = $postManager->update($updatedPost); //update in database
                if (!$success) { //if post not updated
                    $feedback = 'Une erreur s\'est produite!';
                } else {
                    $feedback = 'Post modifié';
                    $post = $updatedPost; //update the post with the copy
                }
            }
        }
        $this->set('post', $post); //used to fill form fields
        $this->set('feedback', $feedback);
    }
    
    /**
     * Delete a post
     * @param int $idPost
     */
    public function deletePost(int $idPost)
    {
        $postManager = new PostManager();
        $success = $postManager->del($idPost);
        if (!$success) { //if post not deleted
            $this->set('feedback', 'Une erreur s\'est produite!');
        } else {
            $this->set('feedback', 'Post supprimé');
        }
    }
    
    /**
     * Retrieve validated comments and related users.
     * Validated comment can be unvalidated.
     * @param int $idPost
     */
    public function validatedComments(int $idPost)
    {
        $commentManager = new CommentManager();
        
        //if form submited
        if (!empty($this->safePost)) {
            //if isset id_comment
            if (isset($this->safePost['id_comment'])) {
                //retrieve concerned comment
                $comment = $commentManager->get($this->safePost['id_comment']);
                //if action is unvalidate
                if (isset($this->safePost['action_unvalidate'])) {
                    $comment->setValidated(0);
                    $commentManager->update($comment);
                }
            }
        }
        
        //retrieve all validated comments of post
        $comments = $commentManager->getAllValidatedForPost($idPost);
        $this->set('comments', $comments);
        
        //retrieve array of each users who commented the post, indexed by id_user
        $userManager = new UserManager();
        $usersWhoCommented = $userManager->getAllWhoDidValidatedCommentForPost($idPost);
        $this->set('usersWhoCommented', $usersWhoCommented);
    }
    
    /**
     * Retrieve waiting comments and related users.
     * Waiting comment can be validated or deleted.
     * @param int $idPost
     */
    public function waitingComments(int $idPost)
    {
        $commentManager = new CommentManager();
        
        //if form submited
        if (!empty($this->safePost)) {
            //if isset id_comment
            if (isset($this->safePost['id_comment'])) {
                //retrieve concerned comment
                $comment = $commentManager->get($this->safePost['id_comment']);
                
                if (isset($this->safePost['action_validate'])) { //if action is validate
                    $comment->setValidated(1);
                    $commentManager->update($comment);
                } elseif (isset($this->safePost['action_delete'])) { //if action is delete
                    $commentManager->del($comment->idComment());
                }
            }
        }
        
        //retrieve all validated comments of post
        $comments = $commentManager->getAllWaitingForPost($idPost);
        $this->set('comments', $comments);
        
        //retrieve array of each users who commented the post, indexed by id_user
        $userManager = new UserManager();
        $usersWhoCommented = $userManager->getAllWhoDidWaitingCommentForPost($idPost);
        $this->set('usersWhoCommented', $usersWhoCommented);
    }
    
    /**
     * Retrieve users informations.
     * Admin right can be granted or revoked.
     */
    public function accounts()
    {
        $userManager = new UserManager();
        
        //if form submited
        if (!empty($this->safePost)) {
            //if isset id_user
            if (isset($this->safePost['id_user'])) {
                //retrieve concerned user
                $user = $userManager->get($this->safePost['id_user']);
                
                if (isset($this->safePost['action_grant'])) { //if action is grant
                    $user->setAdminGranted(1);
                    $userManager->update($user);
                } elseif (isset($this->safePost['action_revoke'])) { //if action is revoke
                    $user->setAdminGranted(0);
                    $userManager->update($user);
                }
            }
        }
        
        //retrieve users
        $users = $userManager->getAll();
        $this->set('users', $users);
    }
}
