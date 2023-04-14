<?php


if (!function_exists('hash_password')) {
	function hash_password($password){

		// Utiliser un coût de hachage élevé
		$cout_hachage = 12;

		// Hasher le mot de passe avec le sel et le coût de hachage spécifiés
		$options = [
		    'cost' => $cout_hachage,
		];
		$pwd_hashed = password_hash($password, PASSWORD_BCRYPT, $options);

		return $pwd_hashed;
	}
}

if (!function_exists('redirectTo')) {

	function redirectTo($url) {
		
	    echo "<meta http-equiv='refresh' content='0; URL={$url}'>";
	}

}

if (!function_exists('push_images')) {
	function push_images($path, $images, $allowed_extensions, $existing_image_path = null) {
	    $uploaded_images = [];

	    foreach ($images['name'] as $key => $nom_image) {
	        $taille_image = $images['size'][$key];
	        $tmp_name_image = $images['tmp_name'][$key];

	        $repertoire = $path;

	        if (!file_exists($repertoire)) {
	            mkdir($repertoire, 0777, true);
	        }

	        $extension_image = strrchr($nom_image, ".");
	        $extensions_image_autorisees = $allowed_extensions;

	        if ($existing_image_path && !$tmp_name_image) {
	            // Si un chemin d'image existant est fourni et qu'aucun nouveau fichier n'a été téléchargé
	            $image_destination = $existing_image_path;
	        } else {
	            // Sinon, télécharger le fichier
	            $image_destination = $repertoire."/".$nom_image;

	            if (in_array($extension_image, $extensions_image_autorisees)) {
	                $uploaded_images[] = [move_uploaded_file($tmp_name_image, $image_destination), $image_destination];
	            } else {
	                $_SESSION['error'] = "Veuillez entrez des images en format jpg, jpeg, avif, png ou webp !";
	            }
	        }
	    }

	    return $uploaded_images;
	}


}

if (!function_exists('setCookieAction')) {
	function setCookieAction($data) {
		// Définition d'un cookie avec le nom "product" et la valeur $data pendant 1 heure
		
		if (isset($_COOKIE['product'])) {

			$value = $data;

			$cookies[] = $_COOKIE['product'];

			array_push($cookies,$value);

		}else{
			$cookies[] = $data;
		}

		setcookie("product",implode(",",$cookies), time()+3600);

	}
}


if (!function_exists('encryption')) {
	function encryption($string,$key){

		if (!is_string($string)) {
			throw new Exception('The string to be encrypted must be a string.');
		}

		if (!is_string($key) || !in_array(strlen($key), [16, 24, 32])) {
			throw new Exception('The encryption key must be a string of 16, 24, or 32 characters.');
		}

		if (!function_exists('openssl_encrypt')) {
			throw new Exception('OpenSSL extension is not enabled on this server.');
		}


		// La clé de chiffrement, doit être de 16, 24 ou 32 caractères.
		$iv = random_bytes(16); // Le vecteur d'initialisation, doit être de 16 octets.

		// Chiffrement avec AES-256-CBC
		$encryption_string = openssl_encrypt($string, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

		// Concaténation du vecteur d'initialisation et du texte chiffré
		$result = base64_encode($iv . $encryption_string);

		return $result;
	}
}

if (!function_exists('decryption')) {
	function decryption($string,$key){

		if (!is_string($string) || !preg_match('/^[a-zA-Z0-9\/\+=]+$/', $string)) {
			throw new Exception('The string to be decrypted must be a base64-encoded string.');
		}

		if (!is_string($key) || !in_array(strlen($key), [16, 24, 32])) {
			throw new Exception('The encryption key must be a string of 16, 24, or 32 characters.');
		}

		if (!function_exists('openssl_decrypt')) {
			throw new Exception('OpenSSL extension is not enabled on this server.');
		}

		 // La clé de chiffrement, doit être de 16, 24 ou 32 caractères.
		$data = base64_decode($string); // Les données chiffrées à déchiffrer.

		// Séparation du vecteur d'initialisation et du texte chiffré
		$iv = substr($data, 0, 16);
		$encryption_string = substr($data, 16);

		// Déchiffrement avec AES-256-CBC
		$clear_text = openssl_decrypt($encryption_string, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);

		return $clear_text;

	}
}

if (!function_exists('compareArrays')) {
	
	function compareArrays($array1, $array2) {
	  $common = array();
	  
	  foreach ($array1 as $element1) {
	    foreach ($array2 as $element2) {
	      if ($element1 === $element2) {
	        $common[] = $element1;
	      }
	    }
	  }
	  
	  return $common;
	}

}

if (!function_exists('countIdsOccurrences')) {
	function countIdsOccurrences($objArray) {
	  $occurrences = array();

	  foreach ($objArray as $obj) {
	    $id = $obj['id'];

	    if (!isset($occurrences[$id])) {
	      $occurrences[$id] = 1;
	    } else {
	      $occurrences[$id]++;
	    }
	  }

	  return $occurrences;
	}
}

function countOccurrences($array) {
    $occurrences = [];
    foreach ($array as $item) {
        $id = $item['id'];
        $size = isset($item['size']) ? $item['size'] : null;
        if ($size !== null) {
            $key = $id . ' ' . $size;
            if (!isset($occurrences[$key])) {
                $occurrences[$key] = 0;
            }
            $occurrences[$key]++;
        } else {
            if (!isset($occurrences[$id])) {
                $occurrences[$id] = 0;
            }
            $occurrences[$id]++;
        }
    }
    return $occurrences;
}


function removeDuplicateProducts($products)
{
    $uniqueProducts = [];
    
    foreach ($products as $product) {
    	
    	if (!empty($product['id'])) {
    		$key = $product['id'];
	        if (isset($product['size'])) {
	            $key .= ' ' . $product['size'];
	        }
	        if (!isset($uniqueProducts[$key])) {
	            $uniqueProducts[$key] = $product;
	        }
    	}
        
    }
    
    return array_values($uniqueProducts);
}



if (!function_exists('sumLastElements')) {
	function sumLastElements($arr) {
	  $sum = 0;
	  foreach ($arr as $subArr) {
	    $sum += end($subArr);
	  }
	  return $sum;
	}
}

if (!function_exists('concatenerString')) {
	function concatenerString($inputString) {
	  // Supprimer les crochets carrés aux extrémités
	  $trimmedString = substr($inputString, 1, -1);
	  
	  // Remplacer toutes les occurrences de "]|[" par ","
	  $replacedString = str_replace("],[", ",", $trimmedString);
	  
	  // Ajouter les crochets carrés au début et à la fin de la chaîne
	  return "[" . $replacedString . "]";
	}

}

function stringToArray($str) {
  // Supprimez les espaces vides et les accolades aux extrémités de la chaîne
  $str = trim($str);
  $str = substr($str, 1, -1);

  // Séparez la chaîne en un tableau de chaînes d'objet
  $objStrings = explode('},{', $str);

  // Bouclez à travers chaque chaîne d'objet et la transforme en objet
  $objArray = array_map(function($objStr) {
    // Ajoutez des accolades pour faire une chaîne JSON valide
    $jsonStr = '{' . $objStr . '}';

    // Analysez la chaîne JSON pour obtenir l'objet
    return json_decode($jsonStr, true);
  }, $objStrings);

  return $objArray;
}

function getInfoById($arr, $id) {
  $result = array();
  foreach ($arr as $obj) {
    if ($obj['id'] == $id) {
      $result[] = $obj;
    }
  }
  return $result;
}


?>