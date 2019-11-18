<?php
/**
 * Signup functionalities
 */
class SignupController extends Controller
{
    /**
     * Default action
     * Visitor can signup by posting form
     */
    public function index()
    {
        $feedback = '';
        
        if (!empty($this->safePost)) {
            $fieldNames = array('email', 'username', 'password');
            $fields = array();
            
            $pass = true;
            //pacify and check user inputs
            foreach ($fieldNames as $fieldName) {
                if (empty($this->safePost[$fieldName])) {
                    $fields[$fieldName] = '';
                    $pass = false;
                } else {
                    $fields[$fieldName] = $this->safePost[$fieldName];
                }
            }
            
            if (!$pass) {
                $feedback = 'Un champ est manquant!';
            } else {
                //if not email format
                if (!filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
                    $feedback = 'format E-mail invalide';
                } else {
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
                    
                    if ($success) {
                        Controller::redirectSmart('signup', 'confirm');
                    } else {
                        $feedback = 'Une erreur s\'est produite';
                    }
                }
            }
        }
        $this->set('feedback', $feedback);
    }
    
    /**
     * Confirm signup done
     */
    public function confirm()
    {
    }
}
