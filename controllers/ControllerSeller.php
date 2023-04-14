<?php
require_once "views/View.php";
class ControllerSeller
{
	private $_productManager;
	private $_sellerManager;
	private $_categoryManager;
	private $_subCategoryManager;
	private $_orderManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 3){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_productManager = new ProductManager;
			$this->_sellerManager = new SellerManager;
			$this->_categoryManager = new CategoryManager;
			$this->_subCategoryManager = new SubCategoryManager;
			$this->_orderManager = new OrderManager;

			$this->seller();
			$this->insertProducts();
			$this->insertSubCategory();
			$this->deleteProductById();
			$this->updateProductById();
			$this->sellerDetails();
			$this->deleteOrder();
			$this->updatePassword();
			
		}

	}

	private function seller(){

		
		$id = $_SESSION['seller_id'];
		$idProduct = isset($_GET['update']) ? htmlspecialchars($_GET['update']) : '';

		if (!isset($_SESSION['seller_id'])) {
			header("Location:index.php?url=form");
		}

		$products = $this->_productManager->getProducts();
		$categoryProducts = $this->_productManager->getProductCategory();
		$sellerProducts = $this->_sellerManager->getSellerProducts($id);
		$sellerStock = $this->_sellerManager->getNumberProductsCategory($id); 
		$allCategories = $this->_categoryManager->getAllCategories();
		$all_sub_categories = $this->_subCategoryManager->getAllSubCategories();
		$oneProduct = $this->_productManager->getProductInfoById($idProduct);

		if (!empty($this->_sellerManager->getSellerAllInfoById($_SESSION['seller_id']))) {
			$seller = $this->_sellerManager->getSellerAllInfoById($_SESSION['seller_id']);
		}else{
			$seller = $this->_sellerManager->getSellerById($_SESSION['seller_id']);
		}

		$mostSold = $this->_sellerManager->getMostSold($_SESSION['seller_id']);

		$order = $this->_orderManager->getOrderBySeller($id);

		//$index = isset($_POST['indice']) ? $_POST['indice'] : "Pas d'indice";

		$data = [];
		$labels = [];

		foreach($sellerStock as $category_name => $count){
			$data[] = $count[1]->count;
			$labels[] = $category_name;
		}

        $count = 0;

        for ($i=0; $i < count($order) ; $i++){

          if($order[$i]->getOrder_delivery_date() != null){

            $count++;

          }

      	}

      	$labelProducts = [];
      	$dataProduct_Qty = [];
      	$dataProduct_Price = [];

      	$countOrder = 0;
      	$total_price = 0;
      	foreach ($order as $value) {
      		$labelProducts[] = $value->getProduct_name();
      		$dataProduct_Qty[] = $value->getOrder_quantity();
      		$dataProduct_Price[] = $value->getOrder_price();
      		$countOrder += $value->getOrder_quantity();
      		$total_price += $value->getOrder_price();
      	}

      	//ON RECUPERE TOUTES LES CATEGORIES,SOUS-CATEGORIES ET PRODUITS LIES
      	$available_sub_categories = array();
      	foreach ($categoryProducts as $category => $sub_categories){
			foreach ($sub_categories as $sub_category => $objects){
				foreach ($objects as $index => $object){
					$available_sub_categories[$object->getSub_category_id()]=$object->getSub_category_name();
				}
			}
		}

		$this->_view = new View('Seller');
		$this->_view->generate(array(
								'products' => $products,
								'categoryProducts' => $categoryProducts,
								'seller'=>$_SESSION['seller'],
								'sellerProducts'=>$sellerProducts,
								'sellerStock'=>$sellerStock,
								'allCategories'=>$allCategories,
								'oneProduct'=>$oneProduct,
								'seller'=>$seller,
								'order'=>$order,
								'count'=>$count,
								'labels'=>$labels,
								'data'=>$data,
								'countOrder'=>$countOrder,
								'total_price'=>$total_price,
								'labelProducts'=>$labelProducts,
								'dataProduct_Qty'=>$dataProduct_Qty,
								'dataProduct_Price'=>$dataProduct_Price,
								'available_sub_categories'=>$available_sub_categories,
								'all_sub_categories'=>$all_sub_categories,
								'mostSold'=>$mostSold
							));
		
	}

	private function insertProducts(){

		$id = (int) $_SESSION['seller_id'];
		extract($_POST);

		if (isset($add_product)) {

			if(!empty($product_name) && !empty($product_description) && !empty($product_price)){

				if (isset($_FILES)) {

			        $extensions_image_autorisees=array(".jpg",".jpeg",".png",".webp",".avif",".JPG",".AVIF",".JPEG",".PNG",".WEBP");
			        $path = "public/images/".$id;
			        $image = $_FILES['product_image'];

			        $images  = push_images($path,$image,$extensions_image_autorisees);

			        for ($i=0; $i < count($images) ; $i++) { 
			        	 //ON VERIFIE SI LE FICHIER A ETE BIEN CREE DANS LE REPERTOIRE
			        	if ($images[$i][0]) {
			        		//ON RECUPERE LE CHEMIN DE L'IMAGE
			        		$image_destination[] = $images[$i][1];

		        		}else{
			        		throw new Exception("Une erreur est survenue lors de l'importation de l'image !");
			        		
			        	} 
			        }

			        if (!empty($product_size)) {
			        	
			        	$object = array(
									"product_name"=>$product_name,
									"product_description"=>$product_description,
									"product_image"=>json_encode($image_destination),
									"product_price"=>(double)$product_price,
									"product_qty"=>(int)$product_qty,
									"product_size"=> json_encode($product_size),
									"seller_id"=>$id,
									"sub_category_id"=>(int)$sub_category
								);

			        }else{

			        	$object = array(
									"product_name"=>$product_name,
									"product_description"=>$product_description,
									"product_image"=>json_encode($image_destination),
									"product_price"=>(double)$product_price,
									"product_qty"=>(int)$product_qty,
									"seller_id"=>$id,
									"sub_category_id"=>(int)$sub_category
								);

			        }
	        		

	        		$this->_productManager->insertProducts($object);
	        		$_SESSION['success'] = "Le produit a été bien ajouté!";
					$_POST = array();
					unset($_POST);
					redirectTo('index.php?url=seller&c=operations');

				}else{
					$error = "Veuillez entrez une ou des images !";
				}

			}else{
				$error = "Veuillez remplir tous les champs !";
			}

			if (isset($error)) 
			{	
				$_SESSION['error'] = $error;
			}

			$this->_view = new View('Seller');
			$this->_view->generate(array(
									'' => ''
								));
			

		}
	}
	
	private function insertSubCategory(){
		extract($_POST);
		if (isset($submit_sub_category)) {
			if (!empty($input_sub_category) && isset($select_sub_category)){

				$object = array(
							"sub_category_name"=>$input_sub_category,
							"category_id"=>$select_sub_category
						);

				$this->_subCategoryManager->insertCategory($object);

				unset($_POST);
				redirectTo('index.php?url=seller&c=operations');
			}
			else{
				$error = "Le champ est vide !";
			}
		}

		if (isset($error)) 
		{	
			$_SESSION['error'] = $error;
		}

		$this->_view = new View('Seller');
		$this->_view->generate(array(
								'' => ''
							));

	}

	private function deleteProductById(){

		if (isset($_GET['delete'])) {

			extract($_POST);
		
			$idProduct = htmlspecialchars($_GET['delete']);

			$oneProduct = $this->_productManager->getProductInfoById($idProduct);

			$file_existed = [];

			for ($i=0; $i < count(json_decode($oneProduct[0]->getProduct_image(),true)); $i++) { 
				if (file_exists(json_decode($oneProduct[0]->getProduct_image(),true)[$i])) {
					$file_existed[] = json_decode($oneProduct[0]->getProduct_image(),true)[$i];
				}
			}

			if (count($file_existed) == count(json_decode($oneProduct[0]->getProduct_image(),true))) {

				$this->_productManager->deleteproduct($idProduct);
				
				for ($i=0; $i < count(json_decode($oneProduct[0]->getProduct_image(),true)); $i++) { 
					unlink($file_existed[$i]);
				}

				redirectTo('index.php?url=seller&c=allproducts');
				$_SESSION['success'] = "produit supprimé avec succès !";
			}
			else{

				$error = "Erreur lors de la suppression du produit. Si ça continue veuillez contacter l'administrateur du site !";

			}
		

		}
		
		if (isset($error)) 
		{	
			$_SESSION['error'] = $error;
		}

		$this->_view = new View('Seller');
		$this->_view->generate(array(
								'' => ''
							));

	}

	private function updateProductById(){


		$idProduct = isset($_GET['update']) ? htmlspecialchars($_GET['update']) : '';

		$id = (int) $_SESSION['seller_id'];

		$oneProduct = $this->_productManager->getProductInfoById($idProduct);

		extract($_POST);


		if (isset($update_product)) {

			if(!empty($product_name) && !empty($product_description) && !empty($product_price) && isset($product_category) && $product_category != 0 ){

				if ( $_FILES['product_image']['error'][0] == 0 ) {

			        $extensions_image_autorisees=array(".jpg",".jpeg",".png",".webp",".avif",".JPG",".JPEG",".PNG",".WEBP",".AVIF");
			        $path = "public/images/".$id;
			        $image = $_FILES['product_image'];

			        $file_existed = [];

					for ($i=0; $i < count(json_decode($oneProduct[0]->getProduct_image(),true)); $i++) { 
						if (file_exists(json_decode($oneProduct[0]->getProduct_image(),true)[$i])) {
							$file_existed[] = json_decode($oneProduct[0]->getProduct_image(),true)[$i];
						}
					}

					if (count($file_existed) == count(json_decode($oneProduct[0]->getProduct_image(),true)))
					{

						for ($i=0; $i < count(json_decode($oneProduct[0]->getProduct_image(),true)); $i++) { 
							unlink($file_existed[$i]);
						}

		
						$images  = push_images($path,$image,$extensions_image_autorisees);
			
						

				        for ($i=0; $i < count($images) ; $i++) { 
				        	 //ON VERIFIE SI LE FICHIER A ETE BIEN CREE DANS LE REPERTOIRE
				        	if ($images[$i][0]) {
				        		//ON RECUPERE LE CHEMIN DE CHAQUE IMAGE
				        		$image_destination[] = $images[$i][1];

			        		}else{
				        		throw new Exception("Une erreur est survenue lors de l'importation de l'image !");
				        		
				        	} 
				        }

				       	
				        if (!empty($product_size)) {
				        	
				        	$object = array(
										"product_name"=>$product_name,
										"product_description"=>$product_description,
										"product_image"=>json_encode($image_destination),
										"product_price"=>(double)$product_price,
										"product_qty"=>(int)$product_qty,
										"product_size"=> json_encode($product_size),
										"seller_id"=>$id,
										"sub_category_id"=>(int)$sub_category
									);

				        }else{

				        	$object = array(
										"product_name"=>$product_name,
										"product_description"=>$product_description,
										"product_image"=>json_encode($image_destination),
										"product_price"=>(double)$product_price,
										"product_qty"=>(int)$product_qty,
										"seller_id"=>$id,
										"sub_category_id"=>(int)$sub_category
									);

				        }

						$this->_productManager->updateproduct($object,$idProduct);

		        		$_SESSION['success'] = "Le produit a été bien modifié! 8454545541451";

						unset($_POST);
						$_FILES = array();
						redirectTo('index.php?url=seller&c=allproducts');

					}
					else{
						$error = "Une erreur est survenue. Veuillez contacter l'administrateur du site svp!";
					}


				}else{
					
					/******************************************/
					 if (!empty($product_size)) {
				        	
				        	$object = array(
										"product_name"=>$product_name,
										"product_description"=>$product_description,
										"product_price"=>(double)$product_price,
										"product_qty"=>(int)$product_qty,
										"product_size"=> json_encode($product_size),
										"seller_id"=>$id,
										"sub_category_id"=>(int)$sub_category
									);

				        }else{

				        	$object = array(
										"product_name"=>$product_name,
										"product_description"=>$product_description,
										"product_price"=>(double)$product_price,
										"product_qty"=>(int)$product_qty,
										"seller_id"=>$id,
										"sub_category_id"=>(int)$sub_category
									);

				        }

						$this->_productManager->updateproduct($object,$idProduct);

		        		$_SESSION['success'] = "Le produit a été bien modifié!";

						unset($_POST);
						redirectTo('index.php?url=seller&c=allproducts');

				}

			}else{
				$error = "Veuillez remplir tous les champs !";
			}

			
		}

		if (isset($error))
		{	
			$_SESSION['error'] = $error;
		}
		

		$this->_view = new View('Seller');
		$this->_view->generate(array(
								'' => ''
							));

	}

	private function sellerDetails(){

		if (!empty($this->_sellerManager->getSellerAllInfoById($_SESSION['seller_id']))) {
			$seller = $this->_sellerManager->getSellerAllInfoById($_SESSION['seller_id']);
		}else{
			$seller = $this->_sellerManager->getSellerById($_SESSION['seller_id']);
		}

		extract($_POST);

		if (isset($submit_Seller)) {

			if (!empty($prenom) && !empty($nom) && !empty($email) && !empty($telephone)) {

				if (empty($seller)) {

					if (!empty($pays) || !empty($region) || !empty($localite)) {

						$obj = array(
								"location_seller_country"=>$pays,	
								"location_seller_region"=>$region,
								"location_seller_street"=>$localite,
								"seller_id"=>$_SESSION['seller_id']	
								);
						
						$this->_sellerManager->insertLocationseller($obj);
						$_SESSION['success'] = "Opération réussie !";

					}
					
				}else{

					$obj1 = array(
							"seller_firstname"=>$prenom,
							"seller_lastname"=>$nom,
							"seller_sexe"=>$sexe,
							"seller_email"=>$email,
							"seller_phone"=>$telephone
							);

					$obj2 = array(
								"location_seller_country"=>$pays,	
								"location_seller_region"=>$region,
								"location_seller_street"=>$localite
								);
					$this->_sellerManager->updateSeller($obj1,$_SESSION['seller_id']);
					$this->_sellerManager->updateLocation_seller($obj2,$_SESSION['seller_id']);

					

					if (is_null($seller[0]->getLocation_seller_id())){

						$obj = array(
							"location_seller_country"=>$pays,	
							"location_seller_region"=>$region,
							"location_seller_street"=>$localite,
							"seller_id"=>$_SESSION['seller_id']	
							);
					
						$this->_sellerManager->insertLocationseller($obj);

					}else{
						$obj = array(
									"location_seller_country"=>$pays,	
									"location_seller_region"=>$region,
									"location_seller_street"=>$localite
									);
						$this->_sellerManager->updateLocation_seller($obj,$_SESSION['seller_id']);
					}
					$_SESSION['success'] = "Modification réussie !";
				}

				redirectTo('index.php?url=seller&c=user');;

			}else{
				$error = "Les champs prénom,nom,email et téléphone sont obligatoires!";
			}
			
		}


		$data = array("seller"=>$seller);
		
		if (isset($error)) 
		{	
			$_SESSION['error'] = $error;
		}
		

		$this->_view = new View('Seller');
		$this->_view->generate($data);
	}

	private function deleteOrder(){
		$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : "";
		$action = isset($_GET['action']) ? htmlspecialchars($_GET['action']) : "";

		if(isset($action) && isset($id)){

			if ($action == "delete") {
				$this->_orderManager->deleteOrderById($id);
				redirectTo('index.php?url=seller&c=orders');
			}

			if ($action == "validate") {
			
				$obj = array(
							"order_delivery_date"=>date("Y-m-d H:i:s")
							);

				$this->_orderManager->updateOrder($obj,$id);
				redirectTo('index.php?url=seller&c=orders');
			}
		}
	}


	private function updatePassword(){
		
		extract($_POST);

		$seller = $this->_sellerManager->getSellerById($_SESSION['seller_id']);

		if (isset($update_password)) {
			if (!empty($password1) && !empty($password2) && !empty($password3)) {
				if ($password2 == $password3) {
					if (strlen($password2) >= 8) {
						$password_hash = $seller[0]->getSeller_password();
						if (password_verify($password1,$password_hash)) {
							
							$obj = array("seller_password"=>hash_password($password2));
							$this->_sellerManager->updateSeller($obj,$_SESSION['seller_id']);
							unset($_POST);
							$_SESSION['success'] = "Votre mot de passe a été modifié avec succès !";
							redirectTo('index.php?url=seller&c=config');
						}
						else
						{
							$error = "Mot de passe incorrect !";
						}
					}else{
						$error = "Mot de passe doit avoir au moins 8 caracteres ou chiffres!";
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
		
		
		$this->_view = new View('Seller');
		$this->_view->generate($data);
	}

}

?>