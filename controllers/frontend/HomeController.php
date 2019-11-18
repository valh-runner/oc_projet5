<?php
/**
 * Homepage functionalities
 */
class HomeController extends Controller
{
    /**
     * Default action
     * Visitor can send contact message by posting form
     */
    public function index()
    {
        $feedback = '';
        //if form submited for contact
        if (!empty($this->safePost)) {
            $fieldNames = array('name', 'firstname', 'email', 'message');
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
                    //send email
                    $subject = 'contact via IT actuBlog from ' . $fields['name'] . ' ' . $fields['firstname'];
                    $headers = 'From: ' . $fields['email'];
                    $content = nl2br($fields['message']);
                    mail('admin@1and1.com', $subject, $content, $headers);
                }
            }
        }
        $this->set('feedback', $feedback);
    }
}
