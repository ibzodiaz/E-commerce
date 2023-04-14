<?php

class SubCategory{



	private $_sub_category_id;
	private $_sub_category_name;


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

	public function setSub_category_id($id){
		$id = (int) $id;

		if($id > 0)
			$this->_sub_category_id = $id;
	}

	public function setSub_category_name($name){
		if(is_string($name))
			$this->_sub_category_name = $name;
	}

	public function getSub_category_id(){
		return $this->_sub_category_id;
	}

	public function getSub_category_name(){
		return $this->_sub_category_name;
	}


}


?>