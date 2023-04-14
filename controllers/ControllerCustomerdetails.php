<?php
require_once "views/View.php";
class ControllerCustomerdetails
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
			
			$this->Customerdetails();
			
		}

	}

	private function Customerdetails(){

		if (!isset($_SESSION['customer_id'])) {
			header("Location:index.php?url=form");
		}

		if (!empty($this->_customerManager->getCustomerAllInfoById($_SESSION['customer_id']))) {
			$customer = $this->_customerManager->getCustomerAllInfoById($_SESSION['customer_id']);
		}else{
			$customer = $this->_customerManager->getCustomerById($_SESSION['customer_id']);
		}

		extract($_POST);

		if (isset($submit_customer)) {
			if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($telephone)) {

				if (empty($customer)) {

					if (!empty($pays) || !empty($region) || !empty($localite)) {

						$obj = array(
								"location_customer_country"=>$pays,	
								"location_customer_region"=>$region,
								"location_customer_street"=>$localite,
								"customer_id"=>$_SESSION['customer_id']	
								);
						
						$this->_customerManager->insertLocationCustomer($obj);
						$_SESSION['success'] = "Opération réussie !";

					}
					
				}else{

					$obj1 = array(
							"customer_firstname"=>$prenom,
							"customer_lastname"=>$nom,
							"customer_sexe"=>$sexe,
							"customer_email"=>$email,
							"customer_phone"=>$telephone
							);

					$obj2 = array(
								"location_customer_country"=>$pays,	
								"location_customer_region"=>$region,
								"location_customer_street"=>$localite
								);
					$this->_customerManager->updateCustomer($obj1,$_SESSION['customer_id']);
					$this->_customerManager->updateLocation_customer($obj2,$_SESSION['customer_id']);

					

					if (is_null($customer[0]->getLocation_customer_id())){

						$obj = array(
							"location_customer_country"=>$pays,	
							"location_customer_region"=>$region,
							"location_customer_street"=>$localite,
							"customer_id"=>$_SESSION['customer_id']	
							);
					
						$this->_customerManager->insertLocationCustomer($obj);

					}else{
						$obj = array(
									"location_customer_country"=>$pays,	
									"location_customer_region"=>$region,
									"location_customer_street"=>$localite
									);
						$this->_customerManager->updateLocation_customer($obj,$_SESSION['customer_id']);
					}
					$_SESSION['success'] = "Modification réussie !";
				}

				header('Location:index.php?url=customerdetails');
				exit;

			}else{
				$error = "Les champs prénom,nom,email et téléphone sont obligatoires!";
			}
			
		}


		$data = array("customer"=>$customer);
		
		if (isset($error)) 
		{	
			$_SESSION['error'] = $error;
		}
		

		$this->_view = new View('Customerdetails');
		$this->_view->generate($data);
	}


}

?>