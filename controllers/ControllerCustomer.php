<?php
require_once "views/View.php";
class ControllerCustomer
{
	private $_customerManager;
	private $_productManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_customerManager = new CustomerManager;
			$this->_productManager = new ProductManager;
			
			$this->completInfCustomer();
			
		}

	}

	private function completInfCustomer(){

		if (!isset($_SESSION['customer_id'])) {
			header("Location:index.php?url=form");
		}

		extract($_POST);

		if (!empty($this->_customerManager->getCustomerAllInfoById($_SESSION['customer_id']))) {

			$customer = $this->_customerManager->getCustomerAllInfoById($_SESSION['customer_id']);

		}else{

			$customer = $this->_customerManager->getCustomerById($_SESSION['customer_id']);

		}

		/*var_dump($customer);
		die();*/

		if (isset($sauvegarder)) {

			if (!empty($pays) && !empty($region) && !empty($localite)) {

				if (empty($customer)) {

					$obj = array("location_customer_country"=>$pays,	
								"location_customer_region"=>$region,
								"location_customer_street"=>$localite,
								"customer_id"=>$_SESSION['customer_id']	
								);
					
					$this->_customerManager->insertLocationCustomer($obj);
					header('Location:index.php?url=finalize');
					exit;
				}
				else{
					if (!is_null($customer[0]->getLocation_customer_id())){

						$obj = array("location_customer_country"=>$pays,	
									"location_customer_region"=>$region,
									"location_customer_street"=>$localite
									);
						$this->_customerManager->updateLocation_customer($obj,$_SESSION['customer_id']);
						
					}else{

						$obj = array("location_customer_country"=>$pays,	
								"location_customer_region"=>$region,
								"location_customer_street"=>$localite,
								"customer_id"=>$_SESSION['customer_id']	
								);
					
						$this->_customerManager->insertLocationCustomer($obj);
					}

					header('Location:index.php?url=finalize');
					exit;
				}
				/*$obj = array("location_customer_country"=>$pays,	
									"location_customer_region"=>$region,
									"location_customer_street"=>$localite
									);
							$this->_customerManager->updateLocation_customer($obj,$_SESSION['customer_id']);*/
		
			}
		}
		
		$data = array("customer"=>$customer);
		$this->_view = new View('Customer');
		$this->_view->generate($data);
	}


}

?>