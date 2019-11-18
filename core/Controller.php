<?php
/**
 * Core class Controller
 */
class Controller
{
    /**
     * vars to pass to the view
     * @var array
     */
    private $vars = array();
    /**
     * no view option activation
     * @var bool
     */
    public $noView = false;
    /**
     * sanitized post
     * @var array
     */
    public $safePost = array();
    /**
     * object session to manage session vars
     * @var Session
     */
    public $session;
    
    /**
     * Constructor
     * @param array $url
     */
    public function __construct(array $url)
    {
        $this->setSafePost();
        $this->session = new Session();
        // $this->set('session', $this->session);
        
        $deducedMethodName = lcfirst(implode(array_map('ucfirst', explode('_', $url['action']))));
        call_user_func_array(array($this, $deducedMethodName), $url['params']); //call of controller object method
        $this->callView($url['page'], $url['action']);
    }

    /**
     * Set a var to pass to the view
     * @param string $varname 
     * @param object $var
     */
    public function set(string $varname, $var)
    {
        $this->vars[$varname] = $var;
    }
    
    /**
     * Call the specified view of page
     * @param string $page 
     * @param string $view
     */
    public function callView(string $page, string $view)
    {
        $oView = new View($page, $view, $this->vars, $this->noView);
    }
    
    /**
     * Redirection to url
     * @param array $url
     */
    public static function redirect(array $url)
    {
        header('HTTP/1.1 301 Moved Permanently');
        //header('Location: /mymvc/'.$url['page'].'html', 301);
        header('Location: ' . URLROOT . $url['page'] . '/' . $url['action']);
        exit();
    }
    
    /**
     * Redirection to url with more smart parameters
     * @param string $urlPage 
     * @param string $urlAction
     */
    public static function redirectSmart(string $urlPage, string $urlAction)
    {
        header('HTTP/1.1 301 Moved Permanently');
        //header('Location: /mymvc/'.$url['page'].'html', 301);
        header('Location: ' . URLROOT . $urlPage . '/' . $urlAction);
        exit();
    }
    
    /**
     * Use the global post to sanitize and fill safePost attribute
     */
    public function setSafePost()
    {
        //if form submited
        if (!empty($_POST)) {
            //check POST fields
            foreach ($_POST as $key => $field) {
                $key = trim(htmlentities($key)); //pacify post value name
                //if field filled
                if (!empty($field)) {
                    $this->safePost[$key] = trim(htmlentities($_POST[$key])); //set pacified user input
                } else {
                    $this->safePost[$key] = ''; //set as empty
                }
            }
        }
    }
}
