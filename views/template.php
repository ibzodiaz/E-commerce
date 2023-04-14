<?php 

require_once "public/partials/header.php";

echo $content;
if (!isset($_SESSION['seller'])) {
?>
<a href="#pubs" class="btn btn-up"><i class="fa-solid fa-chevron-up"></i></a>
<?php
}
if(!isset($_SESSION['seller'])){
	require_once "public/partials/footer.php";
}
else{
	require_once "includes/extensions.php";
}

?>