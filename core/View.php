<?php
/**
 * Core class View
 */
class View
{
    /**
     * Specify the layout to use
     * @var string
     */
    private $layout = 'only';
    /**
     * object session to manage session vars
     * @var Session
     */
    public $session;

    /**
     * Constructor
     * @param string $page 
     * @param string $view 
     * @param array $vars 
     * @param bool $noView 
     */
    public function __construct(string $page, string $view, array $vars, bool $noView = false)
    {
        $this->session = new Session();
        $this->render($page, $view, $vars, $noView);
    }
    
    /**
     * Render the display of page
     * @param string $page 
     * @param string $view 
     * @param array $vars 
     * @param bool $noView
     */
    public function render(string $page, string $view, array $vars, bool $noView = false)
    {
        
        //if no-view mode
        if ($noView != false) {
            $content_for_layout = $noView; //content to print sended by controller
        } else {
            extract($vars);
            
            //define basePath
            if (substr($page, 0, 6) == 'admin_') {
                $pathBase = 'views/backend/';
            } else {
                $pathBase = 'views/frontend/';
            }
            
            //if view exists
            if (is_file($pathBase . $page . '/' . $view . '.php')) {
                ob_start();
                include ROOT . $pathBase . $page . '/' . $view . '.php';
                $content_for_layout = ob_get_clean();
            } else {
                $content_for_layout = 'NO VIEW';
            }
        }
        
        // Construction of response
        if (isset($httpHeader)) {
            if ($httpHeader == '404') {
                header('HTTP/1.1 404 Not Found'); //set header 404 in response
            }
        }
        include ROOT . 'views/frontend/common/layout/' . $this->layout . '.php';
    }
    
    /**
     * Return an url path from page, action and params parameters
     * @param string $page 
     * @param string $action 
     * @param array $params 
     * @return string
     */
    public function url(string $page, string $action, array $params = array())
    {
        if (empty($params)) {
            return URLROOT . $page . '/' . $action;
        } else {
            return URLROOT . $page . '/' . $action . '/' . implode('/', $params);
        }
    }
}
