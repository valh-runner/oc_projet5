<?php

require_once("modeles/PostManager.class.php");
require_once("modeles/UserManager.class.php");
require_once("modeles/CommentManager.class.php");

class Admin_home_controller extends Controller{
	
	function index(){
        $postManager = new PostManager();
        $this->set('posts', $postManager->getAll());
	}
    
    function post($id){
        //retrieve concerned post
        $postManager = new PostManager();
        $post = $postManager->get($id);
        $this->set('post', $post);
        
        //retrieve user who created post
        $userManager = new UserManager();
        $user = $userManager->get($post->idUser());
        $this->set('user', $user);
    }
    
    function addPost(){
        
        $feedback = '';
        //if form submited
        if(!empty($_POST)){
            
            $fieldNames = array('title', 'headnote', 'content');
            $fields = array();
            
            $pass = true;
            //pacify and check user inputs
            foreach($fieldNames as $fieldName){
                $fieldData = htmlentities(trim($_POST[$fieldName]));
                if(empty($fieldData)){
                    $fields[$fieldName] = '';
                    $pass = false;
                }else{
                    $fields[$fieldName] = $fieldData;
                }
            }
            
            if(!$pass){
                $feedback = 'Un champ est manquant!';
            }else{
                //TODO: Check inputs format
                
                //add post in database
                $datas = array(
                    'title' => $fields['title'],
                    'headnote' => $fields['headnote'],
                    'content' => $fields['content'],
                    'revisionDate' => date('Y-m-d'),
                    'idUser' => $_SESSION['userId']
                );
                $post = new Post($datas);
                $postManager = new PostManager();
                $success = $postManager->add($post);
                
                if(!$success){ //if post not added
                    $feedback = 'Une erreur s\'est produite!';
                }else{
                    $feedback = 'Post ajouté';
                }
            }
        }
        $this->set('feedback', $feedback);
    }
    
    function updatePost($id){
        
        $postManager = new PostManager();
        $post = $postManager->get($id); //retrieve concerned post
        
        $feedback = '';
        //if form submited
        if(!empty($_POST)){
            
            $fieldNames = array('title', 'headnote', 'content');
            $fields = array();
            
            $pass = true;
            //pacify and check user inputs
            foreach($fieldNames as $fieldName){
                $fieldData = htmlentities(trim($_POST[$fieldName]));
                if(empty($fieldData)){
                    $fields[$fieldName] = '';
                    $pass = false;
                }else{
                    $fields[$fieldName] = $fieldData;
                }
            }
            
            if(!$pass){
                $feedback = 'Un champ est manquant!';
            }else{
                //TODO: Check inputs format
                
                //make updates on a copy of the post
                $updatedPost = clone $post;
                $updatedPost->setTitle($fields['title']);
                $updatedPost->setHeadnote($fields['headnote']);
                $updatedPost->setContent($fields['content']);
                $updatedPost->setRevisionDate(date('Y-m-d'));
                $updatedPost->setIdUser($_SESSION['userId']);
                
                $success = $postManager->update($updatedPost); //update in database
                if(!$success){ //if post not updated
                    $feedback = 'Une erreur s\'est produite!';
                }else{
                    $feedback = 'Post modifié';
                    $post = $updatedPost; //update the post with the copy
                }
            }
        }
        $this->set('post', $post); //used to fill form fields
        $this->set('feedback', $feedback);
    }
    
    function deletePost($id){
        $postManager = new PostManager();
        $success = $postManager->del($id);
        if(!$success){ //if post not deleted
            $this->set('feedback', 'Une erreur s\'est produite!');
        }else{
            $this->set('feedback', 'Post supprimé');
        }
    }
    
    function validatedComments($idPost){
        $commentManager = new CommentManager();
        
        //if form submited
        if(!empty($_POST)){
            //TODO: ckeck if isset id_comment
            
            //retrieve concerned comment
            $comment = $commentManager->get($_POST['id_comment']);
            
            if(isset($_POST['action_unvalidate'])){
                $comment->setValidated(0);
                $commentManager->update($comment);
            }
        }
        
        //retrieve all validated comments of post
        $comments = $commentManager->getAllValidatedForPost($idPost);
        $this->set('comments', $comments);
        
        //retrieve array of each users who commented the post, indexed by id_user
        $userManager = new UserManager();
        $usersWhoCommented = $userManager->getAllWhoCommentedPost($idPost); //TODO: just retrieve for validated comments
        $this->set('usersWhoCommented', $usersWhoCommented);
    }
    
    function waitingComments($idPost){
        $commentManager = new CommentManager();
        
        //if form submited
        if(!empty($_POST)){
            //TODO: ckeck if isset id_comment
            
            //retrieve concerned comment
            $comment = $commentManager->get($_POST['id_comment']);
            
            if(isset($_POST['action_validate'])){
                $comment->setValidated(1);
                $commentManager->update($comment);
            }
            elseif(isset($_POST['action_delete'])){
                $commentManager->del($comment->idComment());
            }
        }
        
        //retrieve all validated comments of post
        $comments = $commentManager->getAllWaitingForPost($idPost);
        $this->set('comments', $comments);
        
        //retrieve array of each users who commented the post, indexed by id_user
        $userManager = new UserManager();
        $usersWhoCommented = $userManager->getAllWhoCommentedPost($idPost); //TODO: just retrieve for waiting comments
        $this->set('usersWhoCommented', $usersWhoCommented);
    }
    
    function accounts(){
        $userManager = new UserManager();
        
        //if form submited
        if(!empty($_POST)){
            //TODO: ckeck if isset id_user
            
            //retrieve concerned user
            $user = $userManager->get($_POST['id_user']);
            
            if(isset($_POST['action_grant'])){
                $user->setAdminGranted(1);
                $userManager->update($user);
            }
            elseif(isset($_POST['action_revoke'])){
                $user->setAdminGranted(0);
                $userManager->update($user);
            }
        }
        
        //retrieve users
        $users = $userManager->getAll();
        $this->set('users', $users);
    }
}

