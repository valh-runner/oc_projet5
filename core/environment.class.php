<?php
class Environment {
	
	protected $pathModels; //models path
	protected $pathControllers; //controllers path
	protected $pathViews; //views path
	
	
	function __construct(){
		
		/*
		$this->pathRoot = $this->rootPath();
		$this->pathModels = $this->rootPath().'models/';
		$this->pathControllers = $this->rootPath().'controllers/';
		$this->pathViews = $this->rootPath().'views/';
		*/
	}
	
	#ACCESSEURS
	
	
	#METHODES
	
	
	
	# Vérification environnement local ou server
	function isLocal(){
		$server = $_SERVER['HTTP_HOST'];
		//$server = $server[0];
		// $server = explode(':',$_SERVER['HTTP_HOST']);
		// La ligne ci dessus contient un explode pour les utilisateurs de MAMP sous Mac, où l'adresse locale est localhost:8888 par défaut.
		if($server == 'localhost'){
			$isLocal = true; //server local (site dans sous-dossier)
		}else{
			$isLocal  = false; //server distant (site sur raçine)
		}
		return isLocal ;
	}
	
	function printPaths(){
		$paths = array();
		$paths[] = array('DIRECTORY_SEPARATOR', DIRECTORY_SEPARATOR);
		$paths[] = array('$_SERVER[\'PHP_SELF\']', $_SERVER['PHP_SELF']);
		$paths[] = array('__FILE__', __FILE__);
		$paths[] = array('$_SERVER[\'DOCUMENT_ROOT\']', $_SERVER['DOCUMENT_ROOT']);
		$paths[] = array('$_SERVER[\'SCRIPT_FILENAME\']', $_SERVER['SCRIPT_FILENAME']);
		$paths[] = array('$_SERVER[\'SCRIPT_NAME\']', $_SERVER['SCRIPT_NAME']);
		$paths[] = array('$_SERVER[\'HTTP_HOST\']', $_SERVER['HTTP_HOST']);
		
		//PATH FONCTIONS
		/*
		dirname()
		realpath()
		basename()
		pathinfo()
		*/
		
		
		//ALL WORKS!
		//require('./views/layout/default.php');
		//require('F:/www/myMVC - Base/views/layout/default.php');
		//NOTE:  Toujours utiliser le '/' (cross plateforme)
		
		
		$out = '<table>';
		$out .= '<tr><th>PHP PATH VAR</th><th>VALUE</th></tr>';
		foreach($paths as $path){
			$out .= '<tr><td>'.$path[0].'</td><td>'.$path[1].'</td></tr>';
		}
		$out .= '</table>';
		
		return $out;
	}
	
	function debug($var){
		echo '<pre>';
		print_r($var);
		echo '</pre>';
	}
	
	
	
}