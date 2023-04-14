<?php
require_once "views/View.php";
class ControllerShopping
{
	private $_productManager;
	private $_customerManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{
			$this->_productManager = new ProductManager;
			$this->_customerManager = new customerManager;
			$this->shopping();

		}

	}

	private function shopping(){

		$count = 0;
		if (isset($_SESSION['customer_id'])) {
			$customer = $this->_customerManager->getCustomerAllInfoById($_SESSION['customer_id']);
		}
		
		if(isset($_COOKIE['pln'])) {

			$ListProductSelected = stringToArray($_COOKIE['pln']);

			$sum  = 0;
			$count = count($ListProductSelected);

			for ($i=0; $i < $count; $i++) {

				if (!empty($ListProductSelected[$i])) {
					$id = $ListProductSelected[$i]['id']; 
					$sum += floatval($ListProductSelected[$i]['price']);
					$ListProductSelected[$i]['infos'] = $this->_productManager->getProductInfoById($id);
				}
				

			}

			/*ON PASSE LES VARIABLES DANS L'ARRAY $data POUR QU'ELLES SOIENT DISPONIBLES DANS LA VUE DE viewShopping*/
			$data = array(
						"count"=> $count,
						"sum"=>$sum,
						"customer"=>isset($_SESSION['customer_id']) ? $customer : "",
						"ListProductSelected"=>$ListProductSelected
					);


		} else {
			$data = array("count"=> $count);
		}

		$this->_view = new View('Shopping');
	
		$this->_view->generate($data);
		
		
	}

}

?>