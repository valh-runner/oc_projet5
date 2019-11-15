<?php
class Controller
{
    private $vars = array();
    public $noView = false;
    public $safePost = array();
    
    public function __construct(array $url)
    {
        $this->setSafePost();
        
        $deducedMethodName = lcfirst(implode(array_map('ucfirst', explode('_', $url['action']))));
        call_user_func_array(array($this, $deducedMethodName), $url['params']); //call of controller object method
        $this->callView($url['page'], $url['action']);
    }
	
    function set($varname, $var)
    {
		$this->vars[$varname] = $var;
    }
    
    public function callView($page, $view)
    {
        $oView = new View($page, $view, $this->vars, $this->noView);
    }
    
    public static function redirect(array $url)
    {
        header('HTTP/1.1 301 Moved Permanently');
        //header('Location: /mymvc/'.$url['page'].'html', 301);
        header('Location: '.URLROOT.$url['page'].'/'.$url['action']);
        exit();
    }
    
    public static function redirectSmart(string $urlPage, string $urlAction)
    {
        header('HTTP/1.1 301 Moved Permanently');
        //header('Location: /mymvc/'.$url['page'].'html', 301);
        header('Location: '.URLROOT.$urlPage.'/'.$urlAction);
        exit();
    }
    
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
