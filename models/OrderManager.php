<?php

class OrderManager extends Model{

	public function insertOrder($obj){
		$this->getBdd();
		$this->insertObject('orders', $obj);
	}

	public function getOrderByCustomer($id){
		$this->getBdd();
		return $this->getJoinFiveTablesInfoById('orders','sellers','customers','products','location_customers','Order','C.customer_id',$id);
	}

	public function getOrderBySeller($id){
		$this->getBdd();
		return $this->getJoinFiveTablesInfoById('orders','sellers','customers','products','location_customers','Order','S.seller_id',$id);
	}

	public function deleteOrderById($id){
		$this->getBdd();
		$this->deleteById('orders',$id);
	}

	public function updateOrder($objet,$id){
		$this->getBdd();
		$this->updateById('orders',$objet,$id);
	}
}

?>