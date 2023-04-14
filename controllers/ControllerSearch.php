<?php
require_once "views/View.php";
class ControllerSearch
{
	private $_productManager;
	private $_view;

	public function __construct($url){

		$url = is_array($url) ? $url : str_split($url);

		if(isset($url) && count($url) > 1){
			throw new Exception("Page introuvable !");
		}
		else{

			$this->_productManager = new ProductManager;
			$this->search();
			
		}

	}

	public function search(){
		extract($_POST);



		if (isset($q) && !empty($q)) {
			$results = $this->_productManager->getResultSearch(trim(htmlspecialchars($q)));
			$data = array("results"=>$results);
		}else{
			$data = array("results"=>"");
		}

		
		$this->_view = new View('Search');
		$this->_view->generate($data);

	}


}

?>