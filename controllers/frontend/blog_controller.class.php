<?php

require_once("modeles/PostManager.class.php");
require_once("modeles/UserManager.class.php");
require_once("modeles/CommentManager.class.php");

class Blog_controller extends Controller{
	
	function index(){
        $postManager = new PostManager();
        $this->set('posts', $postManager->getAll());
	}
    
    function post($id){
        
        $postManager = new PostManager();
        $userManager = new UserManager();
        $commentManager = new CommentManager();
        
        #ADD COMMENT FORM PROCESS
        $feedback = '';
        //if user connected
        if(isset($_SESSION['connected'])){
            //if form submited
            if(!empty($this->safePost)){
                
                $fieldNames = array('comment');
                $fields = array();
                
                $pass = true;
                //pacify and check user inputs
                foreach($fieldNames as $fieldName){
                    //if post variable exists
                    if(empty($this->safePost[$fieldName])){
                        $fields[$fieldName] = '';
                        $pass = false;
                    }else{
                        $fields[$fieldName] = $this->safePost[$fieldName];
                    }
                }
                
                if(!$pass){
                    $feedback = 'Un champ est manquant!';
                }else{
                    //add comment in database
                    $datas = array(
                        'content' => $fields['comment'],
                        'validated' => 0,
                        'creation_time' => date('Y-m-d H:i:s'),
                        'idPost' => $id,
                        'idUser' => $_SESSION['userId']
                    );
                    $comment = new Comment($datas);
                    $success = $commentManager->add($comment);
                    
                    if(!$success){ //if comment not added
                        $feedback = 'Une erreur s\'est produite!';
                    }else{
                        $feedback = 'Commentaire ajouté';
                    }
                }
            }
            $this->set('feedback', $feedback);
        }
        
        //retrieve concerned post
        $post = $postManager->get($id);
        $this->set('post', $post);
        
        //retrieve user who created post
        $user = $userManager->get($post->idUser());
        $this->set('user', $user);
        
        //retrieve all validated comments of post
        $comments = $commentManager->getAllValidatedForPost($post->idPost());
        $this->set('comments', $comments);
        
        //retrieve array of each users who commented the post, indexed by id_user
        $usersWhoCommented = $userManager->getAllWhoDidValidatedCommentForPost($post->idPost());
        $this->set('usersWhoCommented', $usersWhoCommented);
    }
}
