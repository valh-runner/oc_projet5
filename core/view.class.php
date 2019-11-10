<?php
class View {
	
	private $layout = 'only';
	//protected $elements= array();
	
	function __construct($page, $view, $vars = array(), $noView = false){
		$this->render($page, $view, $vars, $noView);
	}
	
	#METHODES
	
	function render($page, $view, $vars = array(), $noView = false){
		
		//if no-view mode
		if($noView != false){
			$content_for_layout = $noView; //content to print sended by controller
		}else{
			extract($vars);
			
            //define basePath
			if(substr($page, 0, 6) == 'admin_'){
                $pathBase = 'views/backend/';
			}else{
                $pathBase = 'views/frontend/';
            }
            
            //if view exists
			if(is_file($pathBase.$page.'/'.$view.'.php')){
				ob_start();
				require(ROOT.$pathBase.$page.'/'.$view.'.php');
				$content_for_layout = ob_get_clean();
			}else{
                $content_for_layout = 'NO VIEW';
            }
		}
		
		//require(ROOT.'views/frontend/common/layout/'.self::$layout.'.php');
		require(ROOT.'views/frontend/common/layout/'.$this->layout.'.php');
		exit(); //fin de la réponse
	}
	
	# HELPERS #
	
	function url($page, $action, $params = array()){
		if(empty($params)){
			echo URLROOT.$page.'/'.$action;
		}else{
			echo URLROOT.$page.'/'.$action.'/'.implode('/', $params);
		}
	}
}