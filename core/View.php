<?php
class View
{
    private $layout = 'only';
    //protected $elements= array();
    
    public function __construct($page, $view, $vars = array(), $noView = false)
    {
        $this->render($page, $view, $vars, $noView);
    }
    
    public function render($page, $view, $vars = array(), $noView = false)
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
            if (is_file($pathBase.$page.'/'.$view.'.php')) {
                ob_start();
                include ROOT.$pathBase.$page.'/'.$view.'.php';
                $content_for_layout = ob_get_clean();
            } else {
                $content_for_layout = 'NO VIEW';
            }
        }
        
        include ROOT.'views/frontend/common/layout/'.$this->layout.'.php';
    }
    
    public function url($page, $action, $params = array())
    {
        if (empty($params)) {
            return URLROOT.$page.'/'.$action;
        } else {
            return URLROOT.$page.'/'.$action.'/'.implode('/', $params);
        }
    }
}
