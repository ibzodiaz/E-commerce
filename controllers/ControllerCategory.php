<?php
require_once "views/View.php";

class ControllerCategory
{
	private $_productManager;
	private $_categoryManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{
			$this->_productManager = new ProductManager;
			$this->_categoryManager = new CategoryManager;

			$this->category();
		}

	}

	private function category(){

		$article = isset($_GET['article']) ? htmlspecialchars($_GET['article']) : "";

		$limit = 30;
		$page = isset($_GET['page']) ? $_GET['page'] : 1;
		$start = ($page-1)*$limit;

		$products = $this->_productManager->getProductsByPage($start,$limit);
		$totalProducts = $this->_productManager->getCountProducts();

		$categoryProducts = $this->_productManager->getProductCategory();
		$allCategories = $this->_categoryManager->getAllCategories();

		if (isset($_GET['page']) && ($_GET['page'] < 1 || $_GET['page'] > $totalProducts/$limit + 1)){
			header('Location:index.php?url=category&article=<?= $article ?>&page=1');
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


		//ON RECUPERE TOUTES LES CATEGORIES,SOUS-CATEGORIES ET PRODUITS LIES
      	$available_sub_categories = array();
      	foreach ($categoryProducts as $category => $sub_categories){
			foreach ($sub_categories as $sub_category => $objects){
				foreach ($objects as $index => $object){
					$available_sub_categories[$object->getCategory_name()][$object->getSub_category_name()]=$objects;
				}
			}
		}

		$sub_categories_section = [];
		foreach($available_sub_categories as $category_name => $sub_category_names){
			if($category_name == $article){
				$sub_categories_section = $sub_category_names;
			}
		}

		$products_by_global_categories = array();
		foreach($available_sub_categories as $category_name => $sub_category_names){
	
			foreach ($sub_category_names as $sub_category_name => $products){
				foreach ($products as $product){
					$products_by_global_categories[$category_name] = $products;
				}
				
			}
			
			
		}

		/*var_dump($available_sub_categories);
		die();*/

		$this->_view = new View('Category');
		$this->_view->generate(array(
									'categoryProducts' => $categoryProducts,
									'allCategories' => $allCategories,
									'fontawsome'=>$fontawsome,
									'article'=>$article,
									'products'=>$products,
									'limit'=>$limit,
									'start'=>$start,
									'totalProducts'=>$totalProducts,
									'available_sub_categories'=>$available_sub_categories,
									'sub_categories_section'=>$sub_categories_section
								));
		
	}
}

?>