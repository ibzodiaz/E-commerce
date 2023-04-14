<?php $this->_t = "Espace fournisseurs"?>
<!--LES NOTIFICATIONS ERREUR OU SUCCES-->
<?php require_once "includes/esnotifs.php"; ?>
<?php 
if(isset($_SESSION['seller']))
{ 
	require_once "views/dashboard.php";
}
else{
	header('Location:index.php?url=form');
} 

?>	
