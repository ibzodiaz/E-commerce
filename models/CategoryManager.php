<?php

class CategoryManager extends Model
{

	public function getAllCategories(){
		$this->getBdd();
		return $this->getAll('categories_products','Category');
	}

}

?>