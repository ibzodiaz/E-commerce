function nLastValues(array,n_last){
  var start = array.length - n_last;
  var tab = [];
  for (var i =start ; i < array.length ; i++) {
      tab.push(array[i]);
  }
  return tab;
}

function tabSum(tab) {
  var somme = 0;
  for (var i = 0; i < tab.length; i++) {
    somme += tab[i];
  }
  return somme;
}


function addCookieValue(name, value) {
  var cookie = getCookie(name); // récupérer le cookie existant
  var values = []; // initialiser un tableau pour stocker les valeurs

  if (cookie) {
    values = cookie.split(","); // séparer les valeurs en utilisant le séparateur |
  }

  values.push(value); // ajouter la nouvelle valeur à la fin du tableau

  // définir le cookie avec les nouvelles valeurs
  document.cookie = name + "=" + values.join(",") + ";expires=" + getExpiryDate() + ";path=/";
}

function addCookieOneValue(name, value) {
  //créer un cookie qui ne prenne qu'une seule valeur
  document.cookie = name + "=" + value + ";expires=" + getExpiryDate() + ";path=/";
}

function getCookie(name) {
  var cookie = document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)');

  if (cookie) {
    return cookie.pop().replace(/\|/g, ','); // Remplace toutes les occurrences de "|" par ","
  }
}


function getExpiryDate() {
  var date = new Date();
  date.setTime(date.getTime() + (60 * 60 * 1000)); // 1 heure à partir de maintenant
  return date.toUTCString();
}

function numberOfOccurences(myArray,elementToCount){

  var count = 0;

  for (var i = 0; i < myArray.length; i++) {
    if (myArray[i] === elementToCount) {
      count++;
    }
  }

  return count;
}

function deleteCookie(name,value) {
  // séparer les différents éléments du cookie
  var cookieItems = getCookie(name).split(",");

  var values = []; // initialiser un tableau pour stocker les valeurs

  // parcourir les éléments du cookie
  for (var i = 0; i < cookieItems.length; i++) {

    var cookieItem = cookieItems[i].trim();

    // vérifier si la valeur correspond à l'élément
    if (cookieItem != value) {

      values.push(cookieItem); // ajouter la nouvelle valeur à la fin du tableau

    }
  }

  document.cookie = name + "=" + values.join(",") + ";expires=" + getExpiryDate() + ";path=/";

}

function deleteAllCookies(name,value) {

  document.cookie = name + "=" + value + ";expires=" + getExpiryDate() + ";path=/";

}

function deleteEntireCookie(cookieName) {
  document.cookie = cookieName + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function deleteCookieOneByOne(name,value) {
  // séparer les différents éléments du cookie
  var cookieItems = getCookie(name).split("],[");

  var values = []; // initialiser un tableau pour stocker les valeurs
  var saveOcc = [];

  // parcourir les éléments du cookie
  for (var i = 0; i < cookieItems.length; i++) {

    var cookieItem = cookieItems[i].trim();

    // vérifier si la valeur correspond à l'élément
    if (cookieItem != value) {

      values.push(cookieItem); // ajouter la nouvelle valeur à la fin du tableau

    }
    else{
      saveOcc.push(cookieItem);
    }
  }

  var occ = numberOfOccurences(saveOcc,value);

  if (occ > 1) {
    var newSaveOcc = saveOcc.slice(1);

    values.push(newSaveOcc.join(","));

    document.cookie = name + "=" + values.join(",") + ";expires=" + getExpiryDate() + ";path=/";
  }

}

function correspondingValues(value, array) {
  return array.forEach(function(item) {
    return item === value;
  });
}

function countValues(arr) {
  let counts = {};
  for (let i = 0; i < arr.length; i++) {
    let num = arr[i];
    counts[num] = counts[num] ? counts[num] + 1 : 1;
  }
  return counts;
}

function countOccurrences(objOrArray, value) {
  let count = 0;
  
  // Check if the input is an object or an array.
  if (Array.isArray(objOrArray)) {
    // Loop through the array and count the occurrences of the value.
    for (let i = 0; i < objOrArray.length; i++) {
      if (objOrArray[i] === value) {
        count++;
      }
    }
  } else if (typeof objOrArray === "object") {
    // Loop through the object and count the occurrences of the value.
    for (let key in objOrArray) {
      if (objOrArray[key] === value) {
        count++;
      }
    }
  }
  
  // Return the count of occurrences.
  return count;
}


function getMaxValuesById(arr) {
  const result = {};
  
  arr.forEach(item => {
    const id = Object.keys(item)[0];
    const value = item[id];
    
    if (!result[id] || value > result[id]) {
      result[id] = value;
    }
  });
  
  return result;
}

function sumMaxValuesById(arr) {
  let sum = 0;
  const result = {};
  
  arr.forEach(item => {
    const id = Object.keys(item)[0];
    const value = item[id];
    
    if (!result[id] || value > result[id]) {
      result[id] = value;
    }
  });
  
  for (let id in result) {
    sum += result[id];
  }
  
  return sum;
}

function transformNestedArray(nestedArray) {
  const flatArray = nestedArray.map(item => item[0]); // récupère le premier élément de chaque tableau imbriqué
  const result = flatArray.reduce((acc, obj) => {
    const key = Object.keys(obj)[0]; // récupère la première clé de l'objet
    acc.push({ [key]: obj[key] }); // ajoute un nouvel objet avec une propriété ayant la clé et la valeur correspondante
    return acc;
  }, []);
  return result;
}

function concatenerString(inputString) {
  // Supprimer les crochets carrés aux extrémités
  const trimmedString = inputString.slice(1, -1);
  
  // Remplacer toutes les occurrences de "]|["
  const replacedString = trimmedString.replace(/\]\,\[/g, ',');
  
  // Ajouter les crochets carrés au début et à la fin de la chaîne
  return '[' + replacedString + ']';
}

function countAllOccurrences(arr) {
  const count = {};
  arr.forEach(subArr => {
    const key = subArr[0];
    count[key] = (count[key] || 0) + 1;
  });
  return count;
}

function sumLastElements(arr) {
  let sum = 0;
  arr.forEach(subArr => {
    sum += subArr[subArr.length - 1];
  });
  return sum;
}

function removeValueFromCookie(cookie, val) {
  var arr = JSON.parse(cookie);
  var newArr = arr.filter(function(item) {
    return item[0][0] !== val;
  });
  return JSON.stringify(newArr);
}

function removeSubArraysByKeyValue(str, key) {
  // Convertir la chaîne de caractères en tableau
  const array = JSON.parse(str);

  // Filtre les sous-tableaux ne contenant pas la valeur de clé
  const filteredArray = array.filter((subArray) => subArray[0] !== key);

  // Convertir le tableau filtré en une chaîne de caractères
  const filteredStr = JSON.stringify(filteredArray);

  return filteredStr;
}

function stringToArray(str) {
  // Supprimez les espaces vides et les accolades aux extrémités de la chaîne
  str = str.trim().slice(1, -1);

  // Séparez la chaîne en un tableau de chaînes d'objet
  const objStrings = str.split('},{');

  // Bouclez à travers chaque chaîne d'objet et la transforme en objet
  const objArray = objStrings.map(objStr => {
    // Ajoutez des accolades pour faire une chaîne JSON valide
    const jsonStr = `{${objStr}}`;

    // Analysez la chaîne JSON pour obtenir l'objet
    return JSON.parse(jsonStr);
  });

  return objArray;
}

function updateProductProperty(productId, property, value) {
  // Récupérer la valeur actuelle du cookie
  var cookieValue = document.cookie.split(';')
      .map(cookie => cookie.trim())
      .find(cookie => cookie.startsWith('pln='))?.split('=')[1];

  // Convertir la valeur du cookie en un tableau d'objets JavaScript
  var products = JSON.parse(cookieValue);

  // Trouver l'objet à modifier
  var productToModify = products.find(product => product.id === productId);

  // Modifier la propriété de l'objet
  productToModify[property] = value;

  // Convertir le tableau d'objets JavaScript en chaîne JSON
  var newCookieValue = JSON.stringify(products);

  // Réécrire le cookie avec la nouvelle valeur
  document.cookie = "pln=" + newCookieValue + ";path=/";
}

function deleteProductByIdAndSize(id, size) {
  const plnCookie = getCookie("pln");
  if (plnCookie) {
    let productList = JSON.parse(plnCookie);
    for (let i = 0; i < productList.length; i++) {
      if (productList[i].id === id && (!size || productList[i].size === size)) {
        productList.splice(i, 1);
        break;
      }
    }
    setCookie("pln", JSON.stringify(productList));
  }
}

function deleteProductById(id) {
  const plnCookie = getCookie("pln");
  if (plnCookie) {
    let productList = JSON.parse(plnCookie);
    for (let i = 0; i < productList.length; i++) {
      if (productList[i].id === id) {
        productList.splice(i, 1);
        break;
      }
    }
    setCookie("pln", JSON.stringify(productList));
  }
}

function removeItemFromArray(arr, item) {
  return arr.filter(function(element) {
    return JSON.stringify(element) !== JSON.stringify(item);
  });
}

function parseJSON(jsonString) {
  try {
    return JSON.parse(`[${jsonString.trim()}]`);
  } catch (error) {
    console.error(error);
    return null;
  }
}

function getFirstIndex(arr, obj) {
  let index = -1; // initialiser l'index à -1 si l'objet n'est pas trouvé
  arr.forEach((elem, i) => {
    if (JSON.stringify(elem) === JSON.stringify(obj)) {
      index = i; // mettre à jour l'index si l'objet est trouvé
      return;
    }
  });
  return index; // retourner l'index trouvé ou -1 si l'objet n'a pas été trouvé
}

function stringifyArrayWithoutBrackets(arr) {
  return arr.map(obj => JSON.stringify(obj)).join(",");
}

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}



