<?php
require_once "views/View.php";
class ControllerProductdetails
{
	private $_productManager;
	private $_categoryManager;
	private $_noticeManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 3){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_productManager = new ProductManager;
			$this->_categoryManager = new CategoryManager;
			$this->_noticeManager = new NoticeManager;

			$this->productDetails();
		}

	}

	private function productDetails(){

		extract($_POST);

		$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';

		$oneProduct = $this->_productManager->getProductInfoById($id);
		$categoryProducts = $this->_productManager->getProductCategory();
		$allCategories = $this->_categoryManager->getAllCategories();

		$fontawsome = array(
		    'fa-mobile-screen-button',
		    'fa-microscope',
		    'fa-blender-phone',
		    'fa-laptop',
		    'fa-kit-medical',
		    'fa-shirt',
		    'fa-house',
		    'fa-dumbbell',
		    'fa-gamepad',
		    'fa-baby',
		    'fa-car-side',
		    'fa-book',
		    'fa-clapperboard',
		    'fa-film'
		);



		$customerNotices = $this->_noticeManager->getAllNotices($id);

		/*if (isset($_GET['action']) && $_GET['action']=='addshopping') {
			
			$data = $oneProduct[0]->getProduct_id();
			setCookieAction($data);
			//redirectTo('index.php?url=productdetails&id='.$data);
		}*/

		

		if (isset($submit_notice)) {
			if (!empty($notice_message)) {

				$obj = array(
					"notice_message"=>$notice_message,
					"notice_rate"=>$rate,
					"product_id"=>$id,
					"customer_id"=>$_SESSION['customer_id']
					);
				$this->_noticeManager->insertNotice($obj);

				$_SESSION['success'] = "Votre commentaire est posté avec succès !";
				header("Location:index.php?url=productdetails&id=$id");
				exit;

			}else{

				$_SESSION['error'] = "Veuillez écrire quelque chose avant de soumettre !";

			}
		}

		$n = 0;
		$rate = 0;
		foreach ($customerNotices as $notice) {
			$n++;
			$rate += $notice->getNotice_rate();
		}

		if ($n != 0) {
			$meanRate = $rate/$n;
		}else{
			$meanRate = 0;
		}

		$this->_view = new View('Productdetails');
		$this->_view->generate(array('oneProduct' => $oneProduct,
									'categoryProducts' => $categoryProducts,
									'allCategories'=>$allCategories,
									'fontawsome'=>$fontawsome,
									'customerNotices'=>$customerNotices,
									'meanRate'=>$meanRate
								));
	}

}

?>