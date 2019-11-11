<?php

#PATHS

define('DS', '/');
define('WEBROOT', str_replace(DIRECTORY_SEPARATOR,DS,dirname($_SERVER['SCRIPT_NAME']))); //		/
// define('WEBROOT', str_replace(DIRECTORY_SEPARATOR,'/',realpath(dirname(__FILE__))).DS);
define('URLROOT', 'http://'.$_SERVER['HTTP_HOST'].DS); //      http://alias/
define('ROOT', dirname($_SERVER['SCRIPT_FILENAME']).DS); //	F:/virtualhosts/alias/
define('PATHMODELS', WEBROOT.'models'.DS);//					/models/
define('PATHCONTROLLERS', WEBROOT.'controllers'.DS);//		    /controllers/
define('PATHVIEWS', WEBROOT.'views'.DS);//						/views/

#CORE

require(ROOT.'/core/controller.class.php');
require(ROOT.'/core/view.class.php');
require(ROOT.'/core/model.class.php');
session_start();

#DISPATCHER

$urlParts = explode('/', strtolower($_GET['rewrite'])); //url explosion
//sanitize
foreach($urlParts as $urlPart){
    $urlPart = htmlspecialchars(trim($urlPart));
}

$url = array('page' => null, 'action' => null, 'params' => array()); //asked link structuration

if(count($urlParts) > 0){
    $url['page'] = $urlParts[0];
}
if(count($urlParts) > 1){
    $url['action'] = $urlParts[1];
}
if(count($urlParts) > 2){
	$params = array_slice($urlParts, 2);
    foreach($params as $param){
        if(!empty($param)){
            $url['params'][] = $param;
        }
    }
}

#ROUTER

//if page specified
if(!empty($url['page'])){
    
    //if common page
    if($url['page'] == 'common'){
        //if page error404
        if($url['page'] == 'common' && $url['action'] == 'error404'){
            //Controller::renderStatic('error404');
            echo header('HTTP/1.1 404 Not Found'); //set header 404 in response
            $oView = new VIEW($url['page'], $url['action']); //view instanciation
            exit();
        }
        //if page access_denied
        if($url['page'] == 'common' && $url['action'] == 'access_denied'){
            //Controller::renderStatic('access_denied');
            $oView = new VIEW($url['page'], $url['action']); //view instanciation
            exit();
        }
        else{
            $url = array('page'=>'home', 'action'=>'index', 'params'=>array());
            Controller::redirect($url);
        }
    }
    else{
        $access = false;
        //check if ask admin page
        if(substr($url['page'], 0, 6) == 'admin_'){
            $basePath = 'controllers/backend/';
            //check if logged and have admin access rights
            if(isset($_SESSION['connected'])){
                if(isset($_SESSION['admin'])){
                    $access = true;
                }
            }
        }else{
            $basePath = 'controllers/frontend/';
            $access = true;
        }
        
        //if not access granted
        if(!$access){
            $url = array('page'=>'common', 'action'=>'access_denied', 'params'=>array());
            Controller::redirect($url);
        }else{
            // if page exists
            if(is_file($basePath.$url['page'].'_controller.class.php')){
                require_once($basePath.$url['page'].'_controller.class.php'); //load controller of page
                $controllerName = ucfirst($url['page']).'_controller';
                
                // if action specified
                if(!empty($url['action'])){
                    $methodName = lcfirst(implode(array_map('ucfirst', explode('_', $url['action']))));
                    
                    // if action exists
                    if(method_exists($controllerName, $methodName)){
                        $url = array('page'=>$url['page'], 'action'=>$url['action'], 'params'=>$url['params']);
                    }else{
                        $url = array('page'=>$url['page'], 'action'=>'index', 'params'=>array());
                        Controller::redirect($url);
                    }
                }else{
                    $url = array('page'=>$url['page'], 'action'=>'index', 'params'=>array());
                    Controller::redirect($url);
                }
            }else{
                $url = array('page'=>'common', 'action'=>'error404', 'params'=>array());
                Controller::redirect($url);
            }
        }
    }
}else{ 
	$url = array('page'=>'home', 'action'=>'index', 'params'=>array());
	Controller::redirect($url);
}

#CONTROLLER INVOCATION
$oController = new $controllerName($url['action'], $url['params']); //controller instanciation
