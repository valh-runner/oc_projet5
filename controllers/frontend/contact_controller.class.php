<?php
class Contact_controller extends Controller{
	
	function index(){
		$paths = array();
		
		$paths[] = array('DS', DS);
		$paths[] = array('WEBROOT', WEBROOT);
		$paths[] = array('URLROOT', URLROOT);
		$paths[] = array('ROOT', ROOT);
		$paths[] = array('', '');
		$paths[] = array('PATHMODELS', PATHMODELS);
		$paths[] = array('PATHCONTROLLERS', PATHCONTROLLERS);
		$paths[] = array('PATHVIEWS', PATHVIEWS);
		
		$this->set('paths', $paths);
	}
	
	function paths(){
		$oEnvironment = new Environment();
		$content = $oEnvironment->printPaths();
		
		$this->noView = $content;
	}
	
	function phpGlobalEnv(){
		ob_start();
		echo '<pre>';
		var_dump($_SERVER);
		echo '</pre>';
		
		echo '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
		
		echo '<pre>';
		print_r($_SERVER);
		echo '</pre>';
		$content = ob_get_clean();
		
		
		$this->noView = $content;
	}
	
	function phpInfo(){
		$content =  phpinfo();
		
		$this->noView = $content;
	}
}
