<?php

abstract class Model
{
	private static $_bdd;

	private static function setBdd(){
		self::$_bdd = new PDO("mysql:host=localhost;dbname=myshop;charset=utf8","root","");
		self::$_bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	}

	protected static function getBdd(){
		if(self::$_bdd == null)
			self::setBdd();
		return self::$_bdd;
	}

	protected static function getAll($table,$obj){
		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table AND ORDINAL_POSITION = 1");
		$first->bindValue(':table', $table, PDO::PARAM_STR);
		$first->execute();
		$primary_key = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$var = [];
		$req = self::$_bdd->prepare('SELECT * FROM '.$table.' ORDER BY '.$primary_key.'');
		$req->execute();
		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			
			$var[] = new $obj($data);

		}
		
		$req->closeCursor();
		return $var;
	}

	protected static function getResults($table1,$table2,$table3,$obj, $query) {

		$var = [];

		// Retrieve the primary keys of the tables
		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table1 AND ORDINAL_POSITION = 1");
		$first->bindValue(':table1', $table1, PDO::PARAM_STR);
		$first->execute();
		$primary_key1 = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$second = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table2 AND ORDINAL_POSITION = 1");
		$second->bindValue(':table2', $table2, PDO::PARAM_STR);
		$second->execute();
		$primary_key2 = $second->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$second->closeCursor();

		$third = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table3 AND ORDINAL_POSITION = 1");
		$third->bindValue(':table3', $table3, PDO::PARAM_STR);
		$third->execute();
		$primary_key3 = $third->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$third->closeCursor();

		// Prepare and execute the query
		$req = self::$_bdd->prepare("SELECT * FROM $table1 AS S
			JOIN $table2 AS P ON P.$primary_key1 = S.$primary_key1
			JOIN $table3 AS C ON C.$primary_key3 = P.$primary_key3 
			WHERE (product_name LIKE :query OR product_description LIKE :query OR sub_category_name LIKE :query OR seller_firstname LIKE :query OR seller_lastname LIKE :query)");
		$search_query = '%'.$query.'%';
	    $req->bindParam(':query',$search_query, PDO::PARAM_STR);
	    $req->execute();

		// Initialisation du tableau associatif
		$products_by_category = array();

		while ($data = $req->fetch(PDO::FETCH_OBJ)) {

			if (!isset($products_by_category[$data->sub_category_name])) {

		        $products_by_category[$data->sub_category_name] = array();
		    }
		    $product_data = get_object_vars($data);
		    $products_by_category[$data->sub_category_name][] = new $obj($product_data);

		}
		$req->closeCursor();
		return $products_by_category;
	}


	protected static function getRowsByPage($table,$obj,$start,$limit){
		$var = [];

		$req = self::$_bdd->prepare("SELECT * FROM $table LIMIT :start, :limit");
		$req->bindParam(':start', $start, PDO::PARAM_INT);
		$req->bindParam(':limit', $limit, PDO::PARAM_INT);
		$req->execute();

		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			
			$var[] = new $obj($data);

		}

		$req->closeCursor();

		return $var;
		
	}

	protected function getRowsCount($table,$obj){

		$req = self::$_bdd->query('SELECT * FROM '.$table);
		$var = $req->rowCount();

		$req->closeCursor();
		return $var;
		
	}

	protected static function getJoinTablesInfoNotice($table1, $table2, $table3, $obj,$id) {
		$var = [];

		$second = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table2 AND ORDINAL_POSITION = 1");
		$second->bindValue(':table2', $table2, PDO::PARAM_STR);
		$second->execute();
		$primary_key2 = $second->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$second->closeCursor();

		$third = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table3 AND ORDINAL_POSITION = 1");
		$third->bindValue(':table3', $table3, PDO::PARAM_STR);
		$third->execute();
		$primary_key3 = $third->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$third->closeCursor();

		// Prepare and execute the query
		$req = self::$_bdd->prepare("SELECT * FROM $table1 AS N
			JOIN $table2 AS P ON P.$primary_key2 = N.$primary_key2
			JOIN $table3 AS C ON C.$primary_key3 = N.$primary_key3 WHERE P.$primary_key2 = :id");
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		$req->execute();

		// Retrieve the data and create objects
		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			$var[] = new $obj($data);
		}

		$req->closeCursor();

		return $var;
	}

	protected static function getJoinTablesInfoById($table1, $table2, $table3, $obj, $id) {
		$var = [];

		// Retrieve the primary keys of the tables
		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table1 AND ORDINAL_POSITION = 1");
		$first->bindValue(':table1', $table1, PDO::PARAM_STR);
		$first->execute();
		$primary_key1 = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$second = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table2 AND ORDINAL_POSITION = 1");
		$second->bindValue(':table2', $table2, PDO::PARAM_STR);
		$second->execute();
		$primary_key2 = $second->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$second->closeCursor();

		$third = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table3 AND ORDINAL_POSITION = 1");
		$third->bindValue(':table3', $table3, PDO::PARAM_STR);
		$third->execute();
		$primary_key3 = $third->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$third->closeCursor();

		// Prepare and execute the query
		$req = self::$_bdd->prepare("SELECT * FROM $table1 AS S
			JOIN $table2 AS P ON P.$primary_key1 = S.$primary_key1
			JOIN $table3 AS C ON C.$primary_key3 = P.$primary_key3 WHERE P.$primary_key2 = :id");
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		$req->execute();

		// Retrieve the data and create objects
		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			$var[] = new $obj($data);
		}

		$req->closeCursor();

		return $var;
	}

	protected static function getJoinFiveTablesInfoById($table1, $table2, $table3,$table4,$table5, $obj,$primary_key,$id) {
		$var = [];

		// Retrieve the primary keys of the tables
		$second = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table2 AND ORDINAL_POSITION = 1");
		$second->bindValue(':table2', $table2, PDO::PARAM_STR);
		$second->execute();
		$primary_key2 = $second->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$second->closeCursor();

		$third = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table3 AND ORDINAL_POSITION = 1");
		$third->bindValue(':table3', $table3, PDO::PARAM_STR);
		$third->execute();
		$primary_key3 = $third->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$third->closeCursor();

		$fourth = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table4 AND ORDINAL_POSITION = 1");
		$fourth->bindValue(':table4', $table4, PDO::PARAM_STR);
		$fourth->execute();
		$primary_key4 = $fourth->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$fourth->closeCursor();

		// Prepare and execute the query
		$req = self::$_bdd->prepare("SELECT * FROM $table1 AS O
			JOIN $table2 AS S ON O.$primary_key2 = S.$primary_key2
			JOIN $table3 AS C ON O.$primary_key3 = C.$primary_key3 
			JOIN $table4 AS P ON O.$primary_key4 = P.$primary_key4 
			JOIN $table5 AS L ON L.$primary_key3 = C.$primary_key3 WHERE ".$primary_key." = :id");
		$req->bindValue(':id',$id, PDO::PARAM_INT);
		$req->execute();

		// Retrieve the data and create objects
		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			$var[] = new $obj($data);
		}

		$req->closeCursor();

		return $var;
	}

	protected static function getUserAllInfoById($table1,$table2,$obj,$id){
		$var = [];

		// Retrieve the primary keys of the tables
		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table1 AND ORDINAL_POSITION = 1");
		$first->bindValue(':table1', $table1, PDO::PARAM_STR);
		$first->execute();
		$primary_key1 = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$second = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table2 AND ORDINAL_POSITION = 1");
		$second->bindValue(':table2', $table2, PDO::PARAM_STR);
		$second->execute();
		$primary_key2 = $second->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$second->closeCursor();

		// Prepare and execute the query
		$req = self::$_bdd->prepare("SELECT * FROM $table1 AS C
			JOIN $table2 AS L ON C.$primary_key1 = L.$primary_key1
			WHERE C.$primary_key1 = :id");
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		$req->execute();

		// Retrieve the data and create objects
		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			$var[] = new $obj($data);
		}

		$req->closeCursor();

		return $var;
	}

	protected static function getGroupBySum($id,$obj){

		$var = [];

		$req = self::$_bdd->prepare("SELECT *,SUM(order_price) as price FROM `orders` as O JOIN products P ON O.product_id=P.product_id GROUP BY O.product_id HAVING O.seller_id = :id AND O.order_delivery_date is not null ORDER BY price DESC;");
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();

		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			
			$var[] = new $obj($data);

		}

		$req->closeCursor();

		return $var;
	}

	protected static function getUserById($table, $obj, $id){
		$var = [];

		// Retrieve the primary keys of the tables
		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table AND ORDINAL_POSITION = 1");
		$first->bindValue(':table', $table, PDO::PARAM_STR);
		$first->execute();
		$primary_key = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$req = self::$_bdd->prepare("SELECT * FROM $table WHERE $primary_key = :id");
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();

		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			
			$var[] = new $obj($data);

		}

		$req->closeCursor();

		return $var;
	}

	protected static function getObjectById($table, $obj, $reference,$id){
		$var = [];

		$req = self::$_bdd->prepare("SELECT * FROM $table WHERE $reference = :id");
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();

		while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
			
			$var[] = new $obj($data);

		}

		$req->closeCursor();

		return $var;
	}

	protected static function getUserInfoById($table1, $table2, $table3, $obj, $id) {
		$var = [];

		// Retrieve the primary keys of the tables
		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table1 AND ORDINAL_POSITION = 1");
		$first->bindValue(':table1', $table1, PDO::PARAM_STR);
		$first->execute();
		$primary_key1 = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$second = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table2 AND ORDINAL_POSITION = 1");
		$second->bindValue(':table2', $table2, PDO::PARAM_STR);
		$second->execute();
		$primary_key2 = $second->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$second->closeCursor();

		$third = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table3 AND ORDINAL_POSITION = 1");
		$third->bindValue(':table3', $table3, PDO::PARAM_STR);
		$third->execute();
		$primary_key3 = $third->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$third->closeCursor();

		// Prepare and execute the query
		$req = self::$_bdd->prepare("SELECT * FROM $table1 AS S
			JOIN $table2 AS P ON P.$primary_key1 = S.$primary_key1
			JOIN $table3 AS C ON C.$primary_key3 = P.$primary_key3 WHERE S.$primary_key1 = :id");
		$req->bindValue(':id', $id, PDO::PARAM_INT);
		$req->execute();

		// Initialisation du tableau associatif
		$seller_products = array();


		while ($data = $req->fetch(PDO::FETCH_OBJ)) {

			if (!isset($seller_products[$data->sub_category_name])) {

		        $seller_products[$data->sub_category_name] = array();
		    }
		    $product_data = get_object_vars($data);
		    $seller_products[$data->sub_category_name][] = new $obj($product_data);

		}
		$req->closeCursor();
		return $seller_products;
	}

	protected static function getUserInfo($table1, $table2, $table3, $obj) {
		$var = [];

		// Retrieve the primary keys of the tables
		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table1 AND ORDINAL_POSITION = 1");
		$first->bindValue(':table1', $table1, PDO::PARAM_STR);
		$first->execute();
		$primary_key1 = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$second = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table2 AND ORDINAL_POSITION = 1");
		$second->bindValue(':table2', $table2, PDO::PARAM_STR);
		$second->execute();
		$primary_key2 = $second->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$second->closeCursor();

		$third = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table3 AND ORDINAL_POSITION = 1");
		$third->bindValue(':table3', $table3, PDO::PARAM_STR);
		$third->execute();
		$primary_key3 = $third->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$third->closeCursor();

		// Prepare and execute the query
		$req = self::$_bdd->prepare("SELECT * FROM $table1 AS S
			JOIN $table2 AS P ON P.$primary_key1 = S.$primary_key1
			JOIN $table3 AS C ON C.$primary_key3 = P.$primary_key3");
		$req->execute();

		// Initialisation du tableau associatif
		$seller_products = array();


		while ($data = $req->fetch(PDO::FETCH_OBJ)) {

			if (!isset($seller_products[$data->sub_category_name])) {

		        $seller_products[$data->sub_category_name] = array();
		    }
		    $product_data = get_object_vars($data);
		    $seller_products[$data->sub_category_name][] = new $obj($product_data);

		}
		$req->closeCursor();
		return $seller_products;
	}

	protected static function getJoinTablesInfo($table1,$table2,$table3,$obj){

		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table1 AND ORDINAL_POSITION = 1");
		$first->bindValue(':table1', $table1, PDO::PARAM_STR);
		$first->execute();
		$primary_key1 = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$second = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table2 AND ORDINAL_POSITION = 1");
		$second->bindValue(':table2', $table2, PDO::PARAM_STR);
		$second->execute();
		$primary_key2 = $second->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$second->closeCursor();

		$req = self::$_bdd->query("SELECT * FROM 
				".$table1." C JOIN ".$table2." SC ON C.$primary_key1 = SC.$primary_key1
				JOIN ".$table3." P ON SC.$primary_key2 = P.$primary_key2
		");

		// Initialisation du tableau associatif
		$products_by_category = array();

		while ($data = $req->fetch(PDO::FETCH_OBJ)) {

			if (!isset($products_by_category[$data->category_name])) {

		        $products_by_category[$data->category_name][$data->sub_category_name] = array();
		    }
		    $product_data = get_object_vars($data);
		    $products_by_category[$data->category_name][$data->sub_category_name][] = new $obj($product_data);

		}
		$req->closeCursor();
		return $products_by_category;

	}


	protected function countArticlesByCategory($table1, $table2,$table3,$obj,$id) {
	   	// Retrieve the primary keys of the tables
		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table1 AND ORDINAL_POSITION = 1");
		$first->bindValue(':table1', $table1, PDO::PARAM_STR);
		$first->execute();
		$primary_key1 = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$second = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table2 AND ORDINAL_POSITION = 1");
		$second->bindValue(':table2', $table2, PDO::PARAM_STR);
		$second->execute();
		$primary_key2 = $second->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$second->closeCursor();

		$third = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table3 AND ORDINAL_POSITION = 1");
		$third->bindValue(':table3', $table3, PDO::PARAM_STR);
		$third->execute();
		$primary_key3 = $third->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$third->closeCursor();

		// Prepare and execute the query
		$req = self::$_bdd->prepare("SELECT sub_category_name, COUNT(*) AS count_by_category FROM $table1 AS S
			JOIN $table2 AS P ON P.$primary_key1 = S.$primary_key1
			JOIN $table3 AS C ON C.$primary_key3 = P.$primary_key3 WHERE S.$primary_key1 = :id GROUP BY C.sub_category_name");
		$req->bindValue(':id', $id, PDO::PARAM_INT);
	    $req->execute();

	    // Initialisation du tableau associatif
	    $products_by_category = array();

	    while ($data = $req->fetch(PDO::FETCH_OBJ)) {

	        if (!isset($products_by_category[$data->sub_category_name])) {
	            $products_by_category[$data->sub_category_name] = array();
	        }

	        $product_data = get_object_vars($data);
	        $products_by_category[$data->sub_category_name][] = new $obj($product_data);
	        $products_by_category[$data->sub_category_name][] = (Object) array('count'=>$data->count_by_category);

	    }

	    $req->closeCursor();
	    return $products_by_category;
	}



	protected function insertObject($table, $object) {

        // Construction de la requête d'insertion
        $columns = "";
        $values = "";
        foreach ($object as $property => $value) {
            $columns .= $property . ",";
            if (is_string($value)) {
            	$values .= "" .self::$_bdd->quote($value). ",";
            }else{
            	$values .= "" . $value . ",";
            }
            
        }
        $columns = rtrim($columns, ",");
        $values = rtrim($values, ",");
        $sql = "INSERT INTO $table($columns) VALUES($values)";
        
        // Préparation de la requête
        $req = self::$_bdd->prepare($sql);
        
        // Exécution de la requête
        $req->execute();
        
        // Fermeture de la connexion
        $req->closeCursor();

	}

	protected function deleteById($table,$id){

		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table AND ORDINAL_POSITION = 1");
		$first->bindValue(':table', $table, PDO::PARAM_STR);
		$first->execute();
		$primary_key = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		$req = self::$_bdd->prepare('DELETE FROM '.$table.' WHERE '.$primary_key.' = :id');
		$req->bindValue(':id',$id,PDO::PARAM_STR);
		$req->execute();

		$req->closeCursor();
	}


	function updateById($table, $objet, $id) {

		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table AND ORDINAL_POSITION = 1");
		$first->bindValue(':table', $table, PDO::PARAM_STR);
		$first->execute();
		$primary_key = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		// Création de la requête SQL
		$sql = "UPDATE " . $table . " SET ";

		// Ajout des colonnes à mettre à jour
		foreach ($objet as $column => $value) {

			$sql .= $column ."="; 

			if(is_string($value)){

				$sql .= self::$_bdd->quote($value).",";

			}else{

				$sql .= $value .",";

			} 
		}

		// Suppression de la virgule finale
		$sql = rtrim($sql, ",");

		// Ajout de la condition WHERE
		$sql .= " WHERE " .$primary_key." = :id";

		// Exécution de la requête
		$req = self::$_bdd->prepare($sql);

		$req->bindParam(':id', $id);

		$req->execute();

		// Fermeture de la connexion à la base de données
		$req->closeCursor();
	}

	function updateDetailsById($table1,$table2,$objet, $id) {

		$first = self::$_bdd->prepare("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = :table1 AND ORDINAL_POSITION = 1");
		$first->bindValue(':table1', $table1, PDO::PARAM_STR);
		$first->execute();
		$primary_key = $first->fetch(PDO::FETCH_OBJ)->COLUMN_NAME;
		$first->closeCursor();

		// Création de la requête SQL
		$sql = "UPDATE " . $table2 . " SET ";

		// Ajout des colonnes à mettre à jour
		foreach ($objet as $column => $value) {

			$sql .= $column ."="; 

			if(is_string($value)){

				$sql .= self::$_bdd->quote($value).",";

			}else{

				$sql .= $value .",";

			} 
		}

		// Suppression de la virgule finale
		$sql = rtrim($sql, ",");

		// Ajout de la condition WHERE
		$sql .= " WHERE " .$primary_key." = :id";

		// Exécution de la requête
		$req = self::$_bdd->prepare($sql);

		$req->bindParam(':id', $id);

		$req->execute();

		// Fermeture de la connexion à la base de données
		$req->closeCursor();
	}
	protected function emailExists($table,$col_email,$email){

		$req = self::$_bdd->prepare('SELECT * FROM '.$table.' WHERE '.$col_email.' = :email');
		$req->bindValue(':email',$email,PDO::PARAM_STR);
		$req->execute();
		$data = $req->fetchAll(PDO::FETCH_OBJ);
		$count = $req->rowCount();
		$req->closeCursor();
		return [$count,$data] ;
	}



}

?>