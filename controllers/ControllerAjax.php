<?php
require_once "views/View.php";
class ControllerAjax
{
	private $_subCategoryManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_subCategoryManager = new SubCategoryManager;
			$this->Ajax();
			
		}

	}

	public function Ajax(){
		extract($_POST);

		$corresponding_sub_category = $this->_subCategoryManager->getSubCategoriesById($idOption);

		$str = "";
		foreach ($corresponding_sub_category as $sub_category) {
			$str .= $sub_category->getSub_category_id().",".$sub_category->getSub_category_name()."/" ;
		}

		echo substr($str, 0,-1);

		/*$this->_view = new View('Seller');
		$this->_view->generate(array("option"=>$option));*/
	}

}

?>