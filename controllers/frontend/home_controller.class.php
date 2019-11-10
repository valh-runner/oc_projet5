<?php
class Home_controller extends Controller{
	
	function index(){
		// $news = array();
		// $news[] = array('Alpha', 'Etiam elementum facilisis tincidunt. Nam bibendum sagittis dictum. Nam in tellus urna, quis congue metus. Ut erat libero, commodo et semper id, elementum vel leo. Donec rhoncus egestas tempor posuere. ');
		// $news[] = array('Bravo', 'Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...Il n’y a personne qui n’aime la souffrance pour elle-même, qui ne la recherche et qui ne la veuille pour elle-même…');
		// $news[] = array('Delta', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam accumsan suscipit quam, sed pretium turpis dapibus id. Praesent condimentum, erat pharetra congue consectetur, arcu massa pretium enim sed.');
		
		// $this->set('news', $news);
		$this->set('message', 'Hello');
	}
	
}
