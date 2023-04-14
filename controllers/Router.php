<?php
session_start();
require_once("views/View.php");
class Router
{
	private $_ctrl;
	private $_view;

	public function routeReq(){
		try {


			require('vendor/autoload.php');

			//CHARGEMENT AUTOMATIQUE DES CLASSES DANS LE FICHIER MODELS
			spl_autoload_register(function($class){

				require_once('models/'.$class.'.php');

			});



			$url = '';

			//LE CONTROLLER EST INCLU SELON L'ACTION DE L'UTILISATEUR
			if (isset($_GET['url'])) {

				$url = explode("/", filter_var(($_GET['url']),FILTER_SANITIZE_URL));

				$controller = ucfirst(strtolower($url[0]));
				$controllerClass = "Controller".$controller;
				$controllerFile = "controllers/".$controllerClass.".php";

				if(file_exists($controllerFile)){
					require_once($controllerFile);
					$this->ctrl = new $controllerClass($url);
				}
				else{
					throw new Exception("Page introuvable !");
				}

			}
			else{
				require_once("controllers/ControllerHome.php");
				$this->ctrl = new ControllerHome($url);
			}
			//GESTION DES ERREURS
		} catch (Exception $e) {

			$errorMsg = $e->getMessage();
			$this->_view = new View('Error');
			$this->_view->generate(array("errorMsg" => $errorMsg));
			
		}
	}
}
?>