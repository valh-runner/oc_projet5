<?php
class Controller{
	
	private $vars = array();
	public $noView = false;
	public $safePost = array();
	
	function __construct($urlAction, $urlParams){
        $this->setSafePost();
        
        $deducedMethodName = lcfirst(implode(array_map('ucfirst', explode('_', $urlAction))));
		call_user_func_array(array($this, $deducedMethodName), $urlParams); //call of controller object method
        $this->callView($urlAction);
	}
	
	function set($varname, $var){
		$this->vars[$varname] = $var;
	}
	
	function callView($view){
		$deducedPage = strtolower(str_replace('_controller', '', get_class($this))); //voir si c mieux de récup directement $url['page']
		$oView = new View($deducedPage, $view, $this->vars, $this->noView);
	}
	
	static function redirect(array $url){
		header('HTTP/1.1 301 Moved Permanently');
		//header('Location: /mymvc/'.$url['page'].'html', 301);
		header('Location: '.URLROOT.$url['page'].'/'.$url['action']);
		exit();
	}
	
	static function redirectSmart(String $urlPage, String $urlAction){
		header('HTTP/1.1 301 Moved Permanently');
		//header('Location: /mymvc/'.$url['page'].'html', 301);
		header('Location: '.URLROOT.$urlPage.'/'.$urlAction);
		exit();
	}
    
    function setSafePost(){
        //if form submited
        if(!empty($_POST)){
            //check POST fields
            foreach($_POST as $key => $field){
                $key = trim(htmlentities($key)); //pacify post value name
                //if field filled
                if(!empty($field)){
                    $this->safePost[$key] = trim(htmlentities($_POST[$key])); //set pacified user input
                }else{
                    $this->safePost[$key] = ''; //set as empty
                }
            }
        }
    }
	
}