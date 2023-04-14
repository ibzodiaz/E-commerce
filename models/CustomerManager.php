<?php

class CustomerManager extends Model
{
	public function getCustomers(){
		$this->getBdd();
		return $this->getAll('customers','Customer');
	}

	public function getCustomerById($id){
		$this->getBdd();
		return $this->getUserById('customers','Customer',$id);
	}

	public function getCustomerAllInfoById($id){
		$this->getBdd();
		return $this->getUserAllInfoById('customers','location_customers','Customer',$id);
	}

	public function insertLocationCustomer($object){
		$this->getBdd();
		$this->insertObject('location_customers', $object);
	}

	public function insertCustomer($object){
		$this->getBdd();
		$this->insertObject('customers', $object);
	}

	public function customerEmailExists($email){
		$this->getBdd();
		return $this->emailExists('customers','customer_email',$email)[0] > 0;
	}

	public function getCustomerInfo($email){
		$this->getBdd();
		return $this->emailExists('customers','customer_email',$email)[1];
	}

	public function updateCustomer($objet,$id){
		$this->getBdd();
		$this->updateById('customers',$objet,$id);
	}

	public function updateLocation_customer($objet,$id){
		$this->getBdd();
		$this->updateDetailsById('customers','location_customers',$objet,$id);
	}
}

?>