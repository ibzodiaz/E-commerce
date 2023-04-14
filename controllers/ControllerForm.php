<?php
require_once "views/View.php";
class ControllerForm
{
	private $_customerManager;
	private $_sellerManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_customerManager = new CustomerManager;
			$this->_sellerManager = new SellerManager;
			$this->connexion();
			
		}

	}

	private function connexion(){

		extract($_POST);

		if (isset($connexion)) {
			if (!empty($email) && !empty($password) && isset($customertype)) {

					if ($customertype == 1) {

						$customer = isset($this->_customerManager->getCustomerInfo($email)[0]) ? $this->_customerManager->getCustomerInfo($email)[0] : array();

						$customer_hash = isset($customer->customer_password) ? $customer->customer_password : '' ;
						if (password_verify($password, $customer_hash)) {

							$_SESSION['customer_id'] = $customer->customer_id;
							$_SESSION['customer'] = $customer->customer_firstname;
							$_SESSION['success'] = "Bienvenue ".$_SESSION['customer']." !";
							header('Location:index.php?url=home');
							exit;
						}else{
							$error = "Identifiants incorrects !";
						}
					}
					else{
						$seller = isset($this->_sellerManager->getSellerInfo($email)[0]) ? $this->_sellerManager->getSellerInfo($email)[0] : array();
						$seller_hash = isset($seller->seller_password) ? $seller->seller_password : '';
						if (password_verify($password, $seller_hash)) {

							$_SESSION['seller'] = $seller->seller_firstname;
							$_SESSION['seller_id'] = $seller->seller_id;

							$_SESSION['success'] = "Bienvenue ".$_SESSION['seller']." !";
							header('Location:index.php?url=seller');
							exit;
						}else{
							$error = "Identifiants incorrects !";
						}

					}

			}else{
				$error = "Tous les champs doivent être remplis !";
			}
		}
		$data = array(""=>"");

		if (isset($error)) 
		{	
			$_SESSION['error'] = $error;
		}

		
		$this->_view = new View('Form');
		$this->_view->generate($data);
		
	}

}

?>