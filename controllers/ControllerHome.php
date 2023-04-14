<?php
require_once "views/View.php";

class ControllerHome
{
	private $_productManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{
			$this->home();
		}

	}

	private function home(){

		$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';

		$this->_productManager = new ProductManager;
		$this->_categoryManager = new CategoryManager;

		$products = $this->_productManager->getProducts();
		$categoryProducts = $this->_productManager->getProductCategory();
		$allCategories = $this->_categoryManager->getAllCategories();


		$oneProduct = $this->_productManager->getProductInfoById($id);

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



		if (isset($_GET['action']) && $_GET['action']=='addshopping') {
			
			$data = $oneProduct[0]->getProduct_id();
			setCookieAction($data);
	
		}

		//ON RECUPERE TOUTES LES CATEGORIES,SOUS-CATEGORIES ET PRODUITS LIES
      	$available_sub_categories = array();
      	foreach ($categoryProducts as $category => $sub_categories){
			foreach ($sub_categories as $sub_category => $objects){
				foreach ($objects as $index => $object){
					$available_sub_categories[$object->getCategory_name()][$object->getSub_category_name()]=$objects;
				}
			}
		}

		$this->_view = new View('Home');
		$this->_view->generate(array('oneProduct' => $oneProduct,
									'products' => $products,
									'categoryProducts' => $categoryProducts,
									'allCategories' => $allCategories,
									'fontawsome'=>$fontawsome,
									'available_sub_categories'=>$available_sub_categories
								));
	}
}

?>