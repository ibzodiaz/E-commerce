<?php

class Order
{

	private $_order_id;	
	private $_customer_id;
	private $_seller_id;
	private $_product_id;
	private $_order_size;
	private $_order_date;
	private $_order_delivery_date;
	private $_order_quantity;
	private $_total_price;	

	//CUSTOMERS
	private $_customer_firstname;
	private $_customer_lastname	;
	private $_customer_sexe;
	private $_customer_phone;
	private $_customer_email;
	private $_location_customer_country;
	private $_location_customer_region;	
	private $_location_customer_street;

	//SELLERS
	private $_seller_firstname;
	private $_seller_lastname;
	private $_seller_sexe;
	private $_seller_phone;
	private $_seller_email;	

	//PRODUCTS
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

	public function setOrder_id($id){
		$id = (int) $id;
		if ($id > 0) {
			$this->_order_id = $id;
		}
	}

	public function setCustomer_id($id){
		$id = (int) $id;
		if ($id > 0) {
			$this->_customer_id = $id;
		}
	}

	public function setSeller_id($id){
		$id = (int) $id;
		if ($id > 0) {
			$this->_seller_id = $id;
		}
	}

	public function setProduct_id($id){
		$id = (int) $id;
		if ($id > 0) {
			$this->_product_id = $id;
		}
	}

	public function setOrder_size($size){

		$this->_order_size = $size;
		
	}

	public function setOrder_date($date){
		$this->_order_date = $date;
	}

	public function setOrder_delivery_date($date){
		$this->_order_delivery_date = $date;
	}

	public function setOrder_quantity($quantity){
		$quantity = (int) $quantity;
		if ($quantity > 0) {
			$this->_order_quantity = $quantity;
		}
	}

	public function setOrder_price($price){
		$price = (double) $price;
		if ($price > 0) {
			$this->_total_price = $price;
		}
	}

	public function getOrder_id(){

		return $this->_order_id;
		
	}

	public function getCustomer_id(){

		return $this->_customer_id;
		
	}

	public function getSeller_id(){

		return $this->_seller_id;
		
	}

	public function getProduct_id(){

		return $this->_product_id;
		
	}

	public function getOrder_size(){

		return $this->_order_size;
		
	}

	public function getOrder_date(){
		return $this->_order_date;
	}

	public function getOrder_delivery_date(){
		return $this->_order_delivery_date;
	}

	public function getOrder_quantity(){

		return $this->_order_quantity;
		
	}

	public function getOrder_price(){

		return $this->_total_price;
		
	}

	//CUSTOMERS
	public function setCustomer_firstname($firstname){
		if (is_string($firstname)) {
			$this->_customer_firstname = $firstname;
		}
	}

	public function setCustomer_lastname($lastname){
		if (is_string($lastname)) {
			$this->_customer_lastname = $lastname;
		}
	}

	public function setCustomer_sexe($sexe){
		if (is_string($sexe)) {
			$this->_customer_sexe = $sexe;
		}
	}

	public function setCustomer_phone($phone){
		$this->_customer_phone = $phone;
	}

	public function setCustomer_email($email){
		if (is_string($email)) {
			$this->_customer_email = $email;
		}
	}

	public function setLocation_customer_country($country){
		if (is_string($country)) {
			$this->_location_customer_country = $country;
		}
	}

	public function setLocation_customer_region($region){
		if (is_string($region)) {
			$this->_location_customer_region = $region;
		}
	}

	public function setLocation_customer_street($street){
		if (is_string($street)) {
			$this->_location_customer_street = $street;
		}
	}

	public function getCustomer_firstname(){

		return $this->_customer_firstname;

	}

	public function getCustomer_lastname(){

		return $this->_customer_lastname;
	}

	public function getCustomer_sexe(){

		return $this->_customer_sexe;
	}

	public function getCustomer_phone(){
		return $this->_customer_phone;
	}

	public function getCustomer_email(){
		
		return $this->_customer_email;
		
	}

	public function getLocation_customer_country(){

		return $this->_location_customer_country;
		
	}

	public function getLocation_customer_region(){

		return $this->_location_customer_region;
		
	}

	public function getLocation_customer_street(){

		return $this->_location_customer_street;
		
	}

	//SELLERS

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

	//PRODUCTS

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

}

?>