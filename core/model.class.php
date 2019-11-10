<?php
class Model {
	
	function __construct(){
		
	} 
	
	/* execute un fichier sql prédéfini dans \modeles\sql */
	function doFileRequest($fileName){
		//TODO: execute filename.sql
	}
	/* execute directement une requète */
	function doRequest($sql){
		$data= array();
		while ($line = mysql_fetch_assoc( mysql_query($sql) )){
			$data[] = $line;
		}
		return $data;
	}
}