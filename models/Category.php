<?php

class Category{



	private $_category_id;
	private $_category_name;


	public function __construct(array $data){
		$this->hydrate($data);
	}

	public function hydrate(array $data){
		foreach ($data as $key => $value) {
			$method = 'set'.ucfirst($key);
			if(method_exists($this, $method)){
				$this->$method($value);
			}
		}
	}

	public function setCategory_id($id){
		$id = (int) $id;

		if($id > 0)
			$this->_category_id = $id;
	}

	public function setCategory_name($name){
		if(is_string($name))
			$this->_category_name = $name;
	}

	public function getCategory_id(){
		return $this->_category_id;
	}

	public function getCategory_name(){
		return $this->_category_name;
	}


}


?>