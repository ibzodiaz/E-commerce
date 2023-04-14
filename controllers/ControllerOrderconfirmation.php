<?php
require_once "views/View.php";
class ControllerOrderconfirmation
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

			$this->confirmOrder();

			
		}

	}

	private function confirmOrder(){
		
		if (!isset($_SESSION['customer_id'])) {
			header("Location:index.php?url=form");
		}

		$data = array(""=>"");
		$this->_view = new View('Orderconfirmation');
		$this->_view->generate($data);
	}



}

?>