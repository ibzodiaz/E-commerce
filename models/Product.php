<?php

class Product{

	private $_product_id;
	private $_product_name;	
	private $_production_description;
	private $_product_image;	
	private $_product_price;
	private $_product_qty;
	private $_product_size;

	private $_category_id;
	private $_category_name;

	private $_sub_category_id;
	private $_sub_category_name;
	
	private $_seller_id;
	private $_seller_firstname;
	private $_seller_lastname;
	private $_seller_phone;

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

	public function setProduct_id($id){
		$id = (int) $id;

		if($id > 0)
			$this->_product_id = $id;
	}

	public function setProduct_name($name){
		if(is_string($name))
			$this->_product_name = $name;
	}

	public function setProduct_description($description){
		if(is_string($description))
			$this->_production_description = $description;
	}

	public function setProduct_image($image){
		if(is_string($image))
			$this->_product_image = $image;
	}

	public function setProduct_price($price){
		$price = (double) $price;
		if($price > 0)
			$this->_product_price = $price;
	}

	public function setProduct_qty($qty){
		$qty = (int) $qty;
		if($qty >= 0)
			$this->_product_qty = $qty;
	}

	public function setProduct_size($size){
		if(is_string($size))
			$this->_product_size = $size;
	}

	public function setSeller_id($id){
		$id = (int) $id;

		if($id > 0)
			$this->_seller_id = $id;
	}

	public function setSeller_firstname($firstname){
		if (is_string($firstname)) {
			$this->_seller_firstname = $firstname;
		}
	}

	public function setSeller_lastname($lastname){
		if (is_string($lastname)) {
			$this->_seller_lastname = $lastname;
		}
	}

	public function setSeller_phone($phone){

		$this->_seller_phone = $phone;

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

	public function setSub_category_id($id){
		$id = (int) $id;

		if($id > 0)
			$this->_sub_category_id = $id;
	}

	public function setSub_category_name($name){
		if(is_string($name))
			$this->_sub_category_name = $name;
	}

	public function getProduct_id(){
		return $this->_product_id;
	}

	public function getSeller_id(){
		return $this->_seller_id;
	}

	public function getSeller_firstname(){
		return $this->_seller_firstname;		
	}

	public function getSeller_lastname(){
		return $this->_seller_lastname;		
	}

	public function getSeller_phone(){

		return $this->_seller_phone;

	}

	public function getCategory_id(){
		return $this->_category_id;
	}

	public function getCategory_name(){
		return $this->_category_name;
	}

	public function getProduct_name(){
		return $this->_product_name;
	}

	public function getSub_category_id(){
		return $this->_sub_category_id;
	}

	public function getSub_category_name(){
		return $this->_sub_category_name;
	}


	public function getProduct_description(){
		return $this->_production_description;
	}

	public function getProduct_image(){
		return $this->_product_image;
	}

	public function getProduct_price(){
		return $this->_product_price;
	}

	public function getProduct_qty(){
		return $this->_product_qty;
	}

	public function getProduct_size(){
		return $this->_product_size;
	}

}


?>