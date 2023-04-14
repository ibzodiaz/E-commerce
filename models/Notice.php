<?php

class Notice
{
	private $_notice_message;
	private $_notice_rate;
	private $_customer_id;
	private $_product_id;

	private $_customer_firstname;
	private $_customer_lastname	;
	
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

	public function setNotice_message($msg){
		if (is_string($msg)) {
			$this->_notice_message = $msg;
		}
	}

	public function setNotice_rate($rate){
		$rate = (int) $rate;
		if ($rate > 0 && $rate <= 5) {
			$this->_notice_rate = $rate;
		}
	}

	public function setProduct_id($id){
		$id = (int) $id;

		if($id > 0)
			$this->_product_id = $id;
	}

	public function setCustomer_id($id){
		$id = (int) $id;

		if($id > 0)
			$this->_customer_id = $id;
	}

	public function getCustomer_firstname(){

		return $this->_customer_firstname;

	}

	public function getCustomer_lastname(){

		return $this->_customer_lastname;
	}

	public function getProduct_id(){
		return $this->_product_id;
	}

	public function getCustomer_id(){
		return $this->_customer_id;
	}

	public function getNotice_message(){
		return $this->_notice_message;
		
	}

	public function getNotice_rate(){
		return $this->_notice_rate;
		
	}
}

?>