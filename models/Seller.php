<?php

class Seller
{
	 
	private $_seller_id;
	private $_seller_firstname;
	private $_seller_lastname;
	private $_seller_sexe;
	private $_seller_phone;
	private $_seller_email;	
	private $_seller_password;
	private $_seller_state;

	private $_location_seller_id;
	private $_location_seller_country;	
	private $_location_seller_region;	
	private $_location_seller_street;

	private $_category_id;
	private $_category_name;

	private $_sub_category_id;
	private $_sub_category_name;


	private $_product_id;
	private $_product_name;	
	private $_production_description;
	private $_product_image;	
	private $_product_price;	
	

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

	public function setSeller_id($id){
		$id = (int) $id;
		if ($id > 0) {
			$this->_seller_id = $id;
		}
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

	public function setSeller_sexe($sexe){
		if (is_string($sexe)) {
			$this->_seller_sexe = $sexe;
		}
	}

	public function setSeller_phone($phone){

		$this->_seller_phone = $phone;

	}

	public function setSeller_email($email){
		if (is_string($email)) {
			$this->_seller_email = $email;
		}
	}

	public function setSeller_password($password){
		if (is_string($password)) {
			$this->_seller_password = $password;
		}
	}

	public function setSeller_state($state){
		if ($state == 0 || $state == 1) {
			$this->_seller_state = $state;
		}
	}

	public function setLocation_seller_id($id){
		$id = (int) $id;
		$this->_location_seller_id = $id;
	}

	public function setLocation_seller_country($country){
		if (is_string($country)) {
			$this->_location_seller_country = $country;
		}
	}

	public function setLocation_seller_region($region){
		if (is_string($region)) {
			$this->_location_seller_region = $region;
		}
	}

	public function setLocation_seller_street($street){
		if (is_string($street)) {
			$this->_location_seller_street = $street;
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

	public function getSeller_id(){

		return $this->_seller_id;
	
	}

	public function getProduct_id(){
		return $this->_product_id;
	}

	public function getProduct_name(){
		return $this->_product_name;
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

	public function getCategory_id(){
		return $this->_category_id;
	}

	public function getCategory_name(){
		return $this->_category_name;
	}

	public function getSub_category_id(){
		return $this->_sub_category_id;
	}

	public function getSub_category_name(){
		return $this->_sub_category_name;
	}

	public function getSeller_firstname(){

		return $this->_seller_firstname;

	}

	public function getSeller_lastname(){

		return $this->_seller_lastname;
	}

	public function getSeller_sexe(){

		return $this->_seller_sexe;
	}

	public function getSeller_phone(){

		return $this->_seller_phone;

	}

	public function getSeller_email(){
		
		return $this->_seller_email;
		
	}

	public function getSeller_password(){
	
		return $this->_seller_password;
		
	}

	public function getSeller_state(){
		return $this->_seller_state;
	}

	public function getLocation_seller_id(){
		return $this->_location_seller_id;
	}

	public function getLocation_seller_country(){

		return $this->_location_seller_country;
		
	}

	public function getLocation_seller_region(){

		return $this->_location_seller_region;
		
	}

	public function getLocation_seller_street(){

		return $this->_location_seller_street;
		
	}

}

?>