<?php
class Home_controller extends Controller{
	
	function index(){
        $feedback = '';
        //if form submited
        if(!empty($_POST)){
            
            $fieldNames = array('email', 'password');
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
