<?php

class SubCategoryManager extends Model
{

	public function getAllSubCategories(){
		$this->getBdd();
		return $this->getAll('sub_categories_products','SubCategory');
	}

	public function getSubCategoriesById($id){
		$this->getBdd();
		return $this->getObjectById('sub_categories_products', 'SubCategory','category_id',$id);
	}

	public function insertCategory($objet){
		$this->getBdd();
		$this->insertObject('sub_categories_products',$objet);
	}
}

?>