<?php
require_once "views/View.php";
class ControllerHelp
{
	private $_customerManager;
	private $_productManager;
	private $_orderManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_customerManager = new CustomerManager;
			$this->_productManager = new ProductManager;
			$this->_orderManager = new OrderManager;

			$this->help();

			
		}

	}

	private function help(){

		extract($_POST);

		
		$this->_view = new View('Help');
		$this->_view->generate(array(""=>""));
	}



}

?>