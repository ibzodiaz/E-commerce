<?php
require_once "views/View.php";
class ControllerAjaxorder
{
	private $_subCategoryManager;
	private $_orderManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{
			$this->_orderManager = new OrderManager;
			$this->_subCategoryManager = new SubCategoryManager;
			$this->AjaxOrder();
			
		}

	}


	public function AjaxOrder(){

		$id = $_SESSION['seller_id'];
		extract($_POST);
		$order = $this->_orderManager->getOrderBySeller($id);

		$count = 0;

        for ($i=0; $i < count($order) ; $i++){

          if($order[$i]->getOrder_delivery_date() != null){

            $count++;

          }

      	}
		

		echo abs(count($order)-$count);

		
	}

}

?>