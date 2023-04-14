<?php $this->_t = "Accueil"?>
<!--LES NOTIFICATIONS ERREUR OU SUCCES-->
<?php require_once "includes/esnotifs.php"; ?>
<?php require_once "includes/availableCategories.php"; ?>

<br>
<div class="container">	

	<div class="row">
		<div class="col-md-6 mb-2">
			<a href="index.php?url=category&article=Smartphone">
				<img src="public/images/presentation/iphone-14.png" class="d-block w-100 img-top-prest" alt="prest2">
			</a>
		</div>
		<div class="col">
			<div class="row mb-3">
				<div class="col">
					 <a href="index.php?url=category&article=Mode">
					 	<img src="public/images/presentation/couture.jpg" class="d-block w-100 img-style" alt="prest3">
					 </a>
				</div>
			</div>
			<div class="row">
				<div class="col">
					 <a href="index.php?url=category&article=CHAUSSURE">
					 	<img src="public/images/presentation/chaussure.jpg" class="d-block w-100 img-style" alt="prest1">
					 </a>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="row mb-3">
				<div class="col">
					 <a href="index.php?url=category&article=Electroménager">
					 	<img src="public/images/presentation/frigo.jpg" class="d-block w-100 img-style" alt="prest3">
					 </a>
				</div>
			</div>
			<div class="row">
				<div class="col">
					 <a href="index.php?url=category&article=Jeux%20vidéos%20et%20consoles">
					 	<img src="public/images/presentation/ps5.jpg" class="d-block w-100 img-style" alt="prest1">
					 </a>
				</div>
			</div>
		</div>
	</div>

	<h5 class="label text-center">Les derniers articles publiés.</h5>
	<div class="row row-cols-md-6 row-cols-sm-6">
		
		<?php foreach($products as $i=>$product):?>
				<?php if($i < 12): ?>
					<div class="card">
						<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>">
							<div class="image-wrapper">
								<img src="<?= json_decode($product->getProduct_image(),true) != null ? json_decode($product->getProduct_image(),true)[0] : $product->getProduct_image() ?>" alt="produit">
							</div>
							<div class="card-body">
							  	<p class="card-name"><?= strlen($product->getProduct_name())>11 ? substr($product->getProduct_name(),0,12).".." : $product->getProduct_name() ?></p>
							  	<p class="card-price"><?= strlen($product->getProduct_price()) < 7 ? $product->getProduct_price() : substr($product->getProduct_price(),0,6).".."?> FCFA</p>
							   
							</div>
						</a>
						
						<div class="card-footer">
							<?php if($product->getProduct_size() == null): ?>
								<?php if($product->getProduct_qty() != 0): ?>

									<button data-id="<?= $product->getProduct_id() ?>" data-price="<?= $product->getProduct_price() ?>" class="btn btn-add-cart shop-btn"><i class="fa-sharp fa-solid fa-cart-shopping"></i>Panier</button>
					
							   	<?php else:?>
							   		<a href="" class="btn btn-danger shop-btn">Indisponible</a>
							    <?php endif; ?>
						    <?php else: ?>
								<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>" class="btn shop-btn"><i class="fa-solid fa-eye"></i>Voir</a>
							<?php endif; ?>
						</div>
						
					</div>
				<?php endif; ?>
		<?php endforeach;?>

	</div>

	<br>

	<div class="row">
		<?php foreach($available_sub_categories as $category_name => $sub_category_names): ?>
			<br><br>
			<h5 class="label text-center"><?= $category_name ?><span class="view-more float-end"><a href="index.php?url=category&article=<?= $category_name ?>">Voir plus</a></span></h5>
			<div class="row slider">
				<?php foreach($sub_category_names as $sub_category_name => $products): ?>
					<?php foreach($products as $product): ?>
						<div class="col-md-2 col-sm-6">
							
							<div class="card">
								<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>">
									<div class="image-wrapper">
										<img src="<?= json_decode($product->getProduct_image(),true) != null ? json_decode($product->getProduct_image(),true)[0] : $product->getProduct_image() ?>" alt="produit">
									</div>
									<div class="card-body">
									  	<p class="card-name"><?= strlen($product->getProduct_name())>11 ? substr($product->getProduct_name(),0,12).".." : $product->getProduct_name()?></p>
									  	<p class="card-price"><?= strlen($product->getProduct_price()) < 7 ? $product->getProduct_price() : substr($product->getProduct_price(),0,6).".."?> FCFA</p>
			
									</div>
								</a>
								
								<div class="card-footer">
									<?php if($product->getProduct_size() == null): ?>
										<?php if($product->getProduct_qty() != 0): ?>
									    	<button data-id="<?= $product->getProduct_id() ?>" data-price="<?= $product->getProduct_price() ?>" class="btn btn-add-cart shop-btn"><i class="fa-sharp fa-solid fa-cart-shopping"></i>Panier</button>
									   	<?php else:?>
									   		<a href="" class="btn btn-danger shop-btn">Indisponible</a>
									    <?php endif; ?>
								    <?php else: ?>
										<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>" class="btn shop-btn"><i class="fa-solid fa-eye"></i>Voir</a>
									<?php endif; ?>
								</div>
					
							</div>
							
						</div>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>




</div>
