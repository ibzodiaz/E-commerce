<?php

class Customer
{

	 
	private $_customer_id;
	private $_customer_firstname;
	private $_customer_lastname	;
	private $_customer_sexe;
	private $_customer_phone;
	private $_customer_email;	
	private $_customer_password;

	private $_location_customer_id;
	private $_location_customer_country;
	private $_location_customer_region;	
	private $_location_customer_street;
	
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

	public function setCustomer_id($id){
		$id = (int) $id;
		if ($id > 0) {
			$this->_customer_id = $id;
		}
	}

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

	public function setCustomer_password($password){
		if (is_string($password)) {
			$this->_customer_password = $password;
		}
	}

	public function setLocation_customer_id($id){
		$id = (int) $id;
		$this->_location_customer_id = $id;
		
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

	public function getCustomer_id(){

		return $this->_customer_id;
	
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

	public function getCustomer_password(){
	
		return $this->_customer_password ;
		
	}

	public function getLocation_customer_id(){
		return $this->_location_customer_id;
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

}

?>