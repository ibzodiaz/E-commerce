<!-- un routeur   -->
<?php
if(isset($_GET['c'])){

  $param2 = htmlspecialchars($_GET['c']);
  $param3 = isset($_GET['update']) ? htmlspecialchars($_GET['update']) : '';

  if ($param2 == 'products') {

    require_once "dashboardComponents/dashProducts.php";

  }else if ($param2 == 'orders'){

    require_once "dashboardComponents/dashOrders.php";

  }else if($param2 == 'stock'){

    require_once "dashboardComponents/dashStock.php";

  }else if($param2 == 'analyze'){

    require_once "dashboardComponents/dashAnalyze.php";

  }else if($param2 == 'operations'){

    if ($param3 == 'update') {

      require_once "dashboardComponents/dashOperations.php";

    }

    require_once "dashboardComponents/dashOperations.php";

  }
  else if($param2 == 'allproducts'){

    require_once "dashboardComponents/dashAllproducts.php";

  }else if($param2 == 'user'){

    require_once "dashboardComponents/dashUser.php";

  }else if($param2 == 'config'){

    require_once "dashboardComponents/dashConfig.php"; 

  } 
  else{

    require_once "dashboardComponents/dashMain.php"; 

  }

}else{

  require_once "dashboardComponents/dashMain.php"; 

}
  
?>