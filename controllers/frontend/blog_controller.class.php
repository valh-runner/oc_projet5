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
            if(!empty($_POST)){
                
                $fieldNames = array('comment');
                $fields = array();
                
                $pass = true;
                //pacify and check user inputs
                foreach($fieldNames as $fieldName){
                    $fieldData = htmlentities(trim($_POST[$fieldName]));
                    //TODO: check if each $_POST variable exists
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
                    
                    //add comment in database
                    $datas = array(
                        'content' => $fields['comment'],
                        'validated' => 0,
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
        $usersWhoCommented = $userManager->getAllWhoCommentedPost($post->idPost());
        $this->set('usersWhoCommented', $usersWhoCommented);
    }
}
