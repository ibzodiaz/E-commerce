<?php $this->_t = "Recherche"?>
<div class="container">
	<?php if (isset($results) && !empty($results)):?>
		<?php foreach($results as $category_name => $products): ?>
			<br><br>
			<h5 class="label text-center"><?= $category_name ?></h5>
			<div class="row slider">
				<?php foreach($products as $product): ?>
					<div class="col-md-2 col-sm-6">
						
						<div class="card">
							<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>">
								<div class="image-wrapper">
									<img src="<?= json_decode($product->getProduct_image(),true) != null ? json_decode($product->getProduct_image(),true)[0] : $product->getProduct_image() ?>" alt="produit">
								</div>
								<div class="card-body">
								  	<p class="card-name"><?= substr($product->getProduct_name(),0,12) ?>..</p>
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
			</div>
		<?php endforeach; ?>

	<?php else:?>
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<img src="public/images/noResult.jpg" class="notfoundimage">
			</div>
		</div>
	<?php endif;?>	
</div>