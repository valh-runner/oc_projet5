<?php
require __DIR__ . '/vendor/autoload.php';

// PATHS

define('DS', '/');
define(
    'WEBROOT',
    str_replace(DIRECTORY_SEPARATOR, DS, dirname($_SERVER['SCRIPT_NAME']))
);//        /
/* define('WEBROOT',
 *  str_replace(DIRECTORY_SEPARATOR,'/',realpath(dirname(__FILE__))).DS
 * ); */
define('URLROOT', 'http://'.$_SERVER['HTTP_HOST'].DS);//      http://alias/
define('ROOT', dirname($_SERVER['SCRIPT_FILENAME']).DS);//    F:/virtualhosts/alias/
define('PATHMODELS', WEBROOT.'models'.DS);//                    /models/
define('PATHCONTROLLERS', WEBROOT.'controllers'.DS);//            /controllers/
define('PATHVIEWS', WEBROOT.'views'.DS);//                        /views/

// CORE

require ROOT.'/core/Controller.php';
require ROOT.'/core/View.php';
require ROOT.'/core/Model.php';
session_start();
$session = new Session();

// DISPATCHER

$urlParts = explode('/', strtolower($_GET['rewrite'])); //url explosion
//sanitize
foreach ($urlParts as $urlPart) {
    $urlPart = htmlspecialchars(trim($urlPart));
}

$url = array('page' => null, 'action' => null, 'params' => array()); //asked link structuration

if (count($urlParts) > 0) {
    $url['page'] = $urlParts[0];
}
if (count($urlParts) > 1) {
    $url['action'] = $urlParts[1];
}
if (count($urlParts) > 2) {
    $params = array_slice($urlParts, 2);
    foreach ($params as $param) {
        if (!empty($param)) {
            $url['params'][] = $param;
        }
    }
}

// ROUTER

//if page specified
if (!empty($url['page'])) {
    
    //page security level check and access grant verification
    $access = true;
    $basePath = 'controllers/frontend/';
    if (substr($url['page'], 0, 6) == 'admin_') {//if ask admin page
        $access = false;
        $basePath = 'controllers/backend/';
        //if logged and have admin access rights
        if ($session->isSession('connected') && $session->isSession('admin')) {
            $access = true;
        }
    }
    
    //if not access granted
    if (!$access) {
        $url = array('page'=>'common', 'action'=>'access_denied', 'params'=>array());
        Controller::redirect($url);
    } else {
        $controllerName = implode(array_map('ucfirst', explode('_', $url['page']))).'Controller';// controller name deduction
        
        // if page exists
        if (is_file($basePath.$controllerName.'.php')) {
            
            // if action specified
            if (!empty($url['action'])) {
                $methodName = lcfirst(implode(array_map('ucfirst', explode('_', $url['action']))));// method name deduction
                
                // if action exists
                if (method_exists($controllerName, $methodName)) {
                    $url = array('page'=>$url['page'], 'action'=>$url['action'], 'params'=>$url['params']);
                } else {
                    $url = array('page'=>$url['page'], 'action'=>'index', 'params'=>array());
                    Controller::redirect($url);
                }
            } else {
                $url = array('page'=>$url['page'], 'action'=>'index', 'params'=>array());
                Controller::redirect($url);
            }
        } else {
            $url = array('page'=>'common', 'action'=>'error404', 'params'=>array());
            Controller::redirect($url);
        }
    }
    
} else {
    $url = array('page'=>'home', 'action'=>'index', 'params'=>array());
    Controller::redirect($url);
}

// CONTROLLER INVOCATION

$oController = new $controllerName($url); //autoload controller class and instanciate
