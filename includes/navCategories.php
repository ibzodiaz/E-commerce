<?php
require_once "views/View.php";

$categoryManager = new CategoryManager;

$_allCategories = $categoryManager->getAllCategories();
$_fontawsome =  array(
		    'fa-mobile-screen-button',
		    'fa-microscope',
		    'fa-blender-phone',
		    'fa-laptop',
		    'fa-kit-medical',
		    'fa-shirt',
		    'fa-house',
		    'fa-dumbbell',
		    'fa-gamepad',
		    'fa-baby',
		    'fa-car-side',
		    'fa-book',
		    'fa-clapperboard',
		    'fa-film'
		);
?>