<?php

class SellerManager extends Model
{
	public function getSellers(){
		$this->getBdd();
		return $this->getAll('sellers','Seller');
	}

	public function getAllSellersWithProducts(){
		$this->getBdd();
		return $this->getUserInfo('sellers','products','sub_categories_products','Seller');
	}

	public function insertSeller($object){
		$this->getBdd();
		$this->insertObject('sellers', $object);
	}

	public function getMostSold($id){
		$this->getBdd();
		return $this->getGroupBySum($id,'Seller');
	}

	public function sellerEmailExists($email){
		$this->getBdd();
		return $this->emailExists('sellers','seller_email',$email)[0] > 0;
	}

	public function getSellerInfo($email){
		$this->getBdd();
		return $this->emailExists('sellers','seller_email',$email)[1];
	}

	public function getSellerProducts($id){
		$this->getBdd();
		return $this->getUserInfoById('sellers','products','sub_categories_products','Seller', $id);
	}

	public function getNumberProductsCategory($id){
		$this->getBdd();
		return $this->countArticlesByCategory('sellers','products','sub_categories_products','Seller',$id);
	}

	public function getProductSeller($id){
		$this->getBdd();
		return $this->getJoinTablesInfoById('sellers','products','sub_categories_products','Product',$id);
	}

	public function getSellerAllInfoById($id){
		$this->getBdd();
		return $this->getUserAllInfoById('sellers','location_sellers','Seller',$id);
	}

	//****************************************************************

	public function getSellerById($id){
		$this->getBdd();
		return $this->getUserById('sellers','seller',$id);
	}

	public function insertLocationseller($object){
		$this->getBdd();
		$this->insertObject('location_sellers', $object);
	}

	public function updateSeller($objet,$id){
		$this->getBdd();
		$this->updateById('sellers',$objet,$id);
	}

	public function updateLocation_seller($objet,$id){
		$this->getBdd();
		$this->updateDetailsById('sellers','location_sellers',$objet,$id);
	}
}

?>