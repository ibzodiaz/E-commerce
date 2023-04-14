<!DOCTYPE html>
<html>
<head>
	<title><?= $t ?></title>

	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">


    <link href="public/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet"/>
	
	<link rel="stylesheet" href="public/assets/css/styles.css" >
	<link rel="stylesheet" href="public/assets/css/style_dashboard.css" >

</head>
<body class="body">
	
	<div class="my-content">
		<?php require_once "includes/navCategories.php"; ?>
		<?php if(!isset($_SESSION['seller']) && ((!isset($_GET['url']) || $_GET['url'] !="form") && (!isset($_GET['url']) || $_GET['url'] !="registration"))):?>
			<?php require_once "nav/navbar.php"; ?>
		<?php endif;?>
		<div class="main">
			<?php require_once "includes/confirmAsked.php"; ?>
			
		

		
		


