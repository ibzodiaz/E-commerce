<?php
require_once "views/View.php";
class ControllerDeconnexion
{
	private $_productManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{
			$this->deconnexion();
		}

	}

	private function deconnexion(){

		unset($_SESSION);

		session_destroy();
		
		// Rediriger l'utilisateur vers la page de connexion
		header('Location:index.php?url=form');
		
	}
}

?>