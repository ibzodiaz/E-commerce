<?php
require_once "views/View.php";

class ControllerProduct
{
	private $_productManager;
	private $_categoryManager;
	private $_sellerManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_productManager = new ProductManager;
			$this->_categoryManager = new CategoryManager;
			$this->_sellerManager = new SellerManager;

			$this->products();
		}

	}

	private function products(){

		$limit = 30;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = ($page-1)*$limit;

		$products = $this->_productManager->getProductsByPage($start,$limit);
		$totalProducts = $this->_productManager->getCountProducts();
		$categoryProducts = $this->_productManager->getProductCategory();
		$allCategories = $this->_categoryManager->getAllCategories();
		$sellerShop = $this->_sellerManager->getAllSellersWithProducts();
		
		if (isset($_GET['page']) && ($_GET['page'] < 1 || $_GET['page'] > $totalProducts/$limit + 1)){
			header('Location:index.php?url=product&page=1');
		}

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


		$uniqueSellerShop = array();
		$save_sub_category = "";
		foreach ($sellerShop as $category_name => $sub_category_names){
		 	foreach($sub_category_names as $sub_category_name => $product){
		 		

		 		if ($save_sub_category != $product->getSub_category_name()) {

		 			$uniqueSellerShop[] = $product;

		 		}

		 		$save_sub_category = $product->getSub_category_name();
		 	}
		}


		$key = "adcsfertfhgondgtlopmxkpn";

		$this->_view = new View('Product');
		$this->_view->generate(array(
								'categoryProducts'=>$categoryProducts,
								'products' => $products,
								'totalProducts'=>$totalProducts,
								'limit'=>$limit,
								'start'=>$start,
								'allCategories'=>$allCategories,
								'fontawsome'=>$fontawsome,
								'uniqueSellerShop'=>$uniqueSellerShop,
								'key'=>$key
								));
	}
}

?>