<?php
require_once("modeles/User.class.php");
require_once("modeles/UserManager.class.php");

class Signup_controller extends Controller{
	
	function index(){
        
        $feedback = '';
        
        if(!empty($_POST)){
            
            $fieldNames = array('email', 'username', 'password');
            $fields = array();
            
            $pass = true;
            //pacify and check user inputs
            foreach($fieldNames as $fieldName ){
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
                
                $passwordHashed = password_hash($fields['password'], PASSWORD_BCRYPT);
                
                $datas = array(
                    'username' => $fields['username'],
                    'email' => $fields['email'],
                    'passwordHash' => $passwordHashed,
                    'registerDate' => date('Y-m-d'),
                    'adminGranted' => false
                );
                
                $user = new User($datas);
                $userManager = new UserManager();
                $success = $userManager->add($user);
                
                if($success){
                    Controller::redirectSmart('signup', 'confirm');
                }else{
                    $feedback = 'Une erreur s\'est produite';
                }
            }
        }
        $this->set('feedback', $feedback);
	}
    
    function confirm(){
        
    }
	
}
