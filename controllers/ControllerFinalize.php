<?php
require_once "views/View.php";
class ControllerFinalize
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

			$this->finalizeOrder();

			
		}

	}

	private function finalizeOrder(){
		
		if (!isset($_SESSION['customer_id'])) {
			header("Location:index.php?url=form");
		}

		$count = 0;

		if(isset($_COOKIE['pln'])) {

			$ListProductSelected = stringToArray($_COOKIE['pln']);
			$countOccurences = countOccurrences(stringToArray($_COOKIE['pln']));
			

			$sum  = 0;
			$count = count($ListProductSelected);

			for ($i=0; $i < $count; $i++) {

				if (!empty($ListProductSelected[$i])) {
					$id = $ListProductSelected[$i]['id']; 
					$sum += floatval($ListProductSelected[$i]['price']);
					$ListProductSelected[$i]['infos'] = $this->_productManager->getProductInfoById($id);
				}
				
			}

			$customer = $this->_customerManager->getCustomerAllInfoById($_SESSION['customer_id']);
			/*ON PASSE LES VARIABLES DANS L'ARRAY $data POUR QU'ELLES SOIENT DISPONIBLES DANS LA VUE DE viewFinalize*/
			$data = array(
						"count"=> $count,
						"sum"=>$sum,
						"customer"=>$customer,
						"countOccurences"=>$countOccurences,
						"ListProductSelected"=>$ListProductSelected
					);

			extract($_POST);

			if (isset($soumettre)) {

				if (isset($option1)) {
					foreach (removeDuplicateProducts($ListProductSelected) as $key => $value) {

					$obj = array(
							"customer_id"=>$_SESSION['customer_id'],
							"seller_id"=>$value['infos'][0]->getSeller_id(),
							"product_id"=>$value['infos'][0]->getProduct_id(),
							"order_size"=>isset($value['size']) ? $value['size'] : "",	
							"order_quantity"=>isset($value['size']) ? $countOccurences[$value['id']." ".$value['size']] : $countOccurences[$value['infos'][0]->getProduct_id()],
							"order_reduction"=>0,
							"order_price"=>$value['price']
						);
				
					$this->_orderManager->insertOrder($obj);
					}
					setcookie("pln","", time()-3600);
					header("Location:index.php?url=orderconfirmation");
					exit;
				}

				if (isset($option2)) {
					echo "<script>alert('Service Orange Money !')</script>";
				}

				if(!isset($option1) && !isset($option2)){
					$error = "Veuillez d'abord choisir le mode de paiement avant de poursuivre !";
				}

				unset($_POST);

			}

		}else{
			$data = array(""=>"");
		}

		if (isset($error)) 
		{	
			$_SESSION['error'] = $error;
		}
		
		$this->_view = new View('Finalize');
		$this->_view->generate($data);
	}


}

?>