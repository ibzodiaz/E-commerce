<?php
require_once "views/View.php";

class ControllerShop
{
	private $_productManager;
	private $_categoryManager;
	private $_sellerManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_productManager = new ProductManager;
			$this->_categoryManager = new CategoryManager;
			$this->_sellerManager = new SellerManager;

			$this->shop();
		}

	}

	public function shop(){

		$key = "adcsfertfhgondgtlopmxkpn";

		if (isset($_GET['id'])) {

			$id = $_GET['id'];

			$sellerProducts = $this->_sellerManager->getSellerProducts($id);

		}

		$this->_view = new View('Shop');
		$this->_view->generate(array("sellerProducts"=>$sellerProducts));
	}

}