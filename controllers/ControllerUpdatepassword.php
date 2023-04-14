<?php
require_once "views/View.php";
class ControllerUpdatepassword
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

			$this->updatePassword();

			
		}

	}

	private function updatePassword(){

		if (!isset($_SESSION['customer_id'])) {
			header("Location:index.php?url=form");
		}
		
		extract($_POST);

		$customer = $this->_customerManager->getCustomerById($_SESSION['customer_id']);

		if (isset($update_password)) {
			if (!empty($password1) && !empty($password2) && !empty($password3)) {
				if ($password2 == $password3) {
					if (strlen($password2) >= 8) {
						$password_hash = $customer[0]->getCustomer_password();
						if (password_verify($password1,$password_hash)) {
							
							$obj = array("customer_password"=>hash_password($password2));
							$this->_customerManager->updateCustomer($obj,$_SESSION['customer_id']);
							unset($_POST);
							$_SESSION['success'] = "Votre mot de passe a été modifié avec succès !";
							header('Location:index.php?url=updatepassword');
							exit;
						}
						else
						{
							$error = "Mot de passe incorrect !";
						}
					}else{
						$error = "Le mot de passe doit avoir au moins 8 caracteres ou chiffres!";
					}
				}
				else
				{
					$error = "Les mots de passe entrés ne correspondent pas !";
				}
			}else{
				$error = "Les champs doivent être remplis !";
			}
		}

		$data = array(""=>"");

		if (isset($error)) 
		{	
			$_SESSION['error'] = $error;
		}
		
		
		$this->_view = new View('updatepassword');
		$this->_view->generate($data);
	}



}

?>