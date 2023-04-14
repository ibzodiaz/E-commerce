<?php

class ProductManager extends Model
{
	public function getProducts(){
		$this->getBdd();
		return $this->getAll('products','Product');
	}

	public function getCountProducts(){
		$this->getBdd();
		return $this->getRowsCount('products','Product');
	}

	public function getResultSearch($query){
		$this->getBdd();
		return $this->getResults('sellers','products','sub_categories_products','Product',$query);
	}

	public function getProductsByPage($start,$limit){
		$this->getBdd();
		return $this->getRowsByPage('products','Product',$start,$limit);
	}

	public function getProductInfoById($id){
		$this->getBdd();
		return $this->getJoinTablesInfoById('sellers','products','sub_categories_products','Product',$id);
	}

	public function getOrderByProductId($id){
		$this->getBdd();
		return $this->getJoinTablesInfoById('sellers','products','customers','Order',$id);
	}

	public function getProductCategory(){
		$this->getBdd();
		return $this->getJoinTablesInfo('categories_products','sub_categories_products','products','Product');
	}

	public function insertProducts($objet){
		$this->getBdd();
		$this->insertObject('products',$objet);
	}

	public function deleteproduct($id){
		$this->getBdd();
		$this->deleteById('products',$id);
	}

	public function updateproduct($objet,$idProduct){
		$this->getBdd();
		$this->updateById('products',$objet,$idProduct);
	}

}

?>