<?php
/**
 * Login functionalities
 */
class LoginController extends Controller
{
    /**
     * Default action
     * Visitor can login by posting form
     */
    public function index()
    {
        $feedback = '';
        //if form submited
        if (!empty($this->safePost)) {
            $fieldNames = array('email', 'password');
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
                    $userManager = new UserManager();
                    $user = $userManager->getByEmail($fields['email']);
                    
                    //if user not found
                    if ($user == false) {
                        $feedback = 'E-mail incorrect';
                    } else {
                        $success = password_verify($fields['password'], $user->passwordHash());
                        
                        //if password not valid
                        if (!$success) {
                            $feedback = 'Mot de passe incorrect';
                        } else {
                            $this->session->setSession('connected', true);
                            $this->session->setSession('userId', $user->idUser());
                            $this->session->setSession('username', $user->username());
                            //if admin granted account
                            if ($user->adminGranted()) {
                                $this->session->setSession('admin', true);
                            }
                            Controller::redirectSmart('home', 'index');
                        }
                    }
                }
            }
        }
        $this->set('feedback', $feedback);
    }
    
    /**
     * Logout action
     */
    public function logout()
    {
        $this->session->unsetSession('connected');
        $this->session->unsetSession('userId');
        //if admin granted account
        if ($this->session->isSession('admin')) {
            $this->session->unsetSession('admin');
        }
    }
}
