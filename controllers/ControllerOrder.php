<?php
require_once "views/View.php";
class ControllerOrder
{
	private $_orderManager;
	private $_customerManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{
			$this->_orderManager  = new OrderManager;
			$this->_customerManager = new CustomerManager;
			$this->orders();
			$this->cancelOrder();
		}

	}

	private function orders(){

		$orderInfos = $this->_orderManager->getOrderByCustomer($_SESSION['customer_id']);

		if (!isset($_SESSION['customer_id'])) {
			header("Location:index.php?url=form");
		}

		$data = array("orderInfos"=>$orderInfos);
		$this->_view = new View('order');
		$this->_view->generate($data);
	}

	private function cancelOrder(){

		$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : "";
		$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : "";

		if(isset($action) && isset($id)){

			if ($action == "cancel") {
				$this->_orderManager->deleteOrderById($id);
				redirectTo('index.php?url=order');
			}
		}
	}

}

?>