<?php
class Home_controller extends Controller{
	
	function index(){
        $feedback = '';
        //if form submited
        if(!empty($this->safePost)){
            
            $fieldNames = array('email', 'password');
            $fields = array();
            
            $pass = true;
            //pacify and check user inputs
            foreach($fieldNames as $fieldName ){
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
                //TODO: Check email format
                
                $userManager = new UserManager();
                $user = $userManager->getByEmail($fields['email']);
                
                //if user not found
                if($user == false){
                    $feedback = 'E-mail incorrect';
                }else{
                    $success = password_verify($fields['password'], $user->passwordHash());
                    
                    //if password not valid
                    if(!$success){
                        $feedback = 'Mot de passe incorrect';
                    }else{
                        $_SESSION['connected'] = true;
                        $_SESSION['userId'] = $user->idUser();
                        //if admin granted account
                        if($user->adminGranted()){$_SESSION['admin'] = true;}
                        Controller::redirectSmart('home', 'index');
                    }
                }
            }
        }
        $this->set('feedback', $feedback);
	}
	
}
