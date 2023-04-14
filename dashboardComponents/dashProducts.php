<div class="home-content">
	<div class="container">
	<?php foreach($sellerProducts as $category_name => $products): ?>
		<br><br>
		<h2 class="label"><?= $category_name ?></h2>
		<div class="row slider">
			<?php foreach($products as $product): ?>
				<div class="col-md-2 col-sm-6">
					<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>">
						<div class="card">
							<div class="image-wrapper">
								<img src="<?= json_decode($product->getProduct_image(),true) != null ? json_decode($product->getProduct_image(),true)[0] : $product->getProduct_image() ?>" alt="produit">
							</div>
							<div class="card-body">
							  	<h5 class="card-title"><?= $product->getProduct_name() ?></h5>
								<p class="card-text"><?= substr($product->getProduct_description(),0,25) ?>...</p>
							    
							</div>

							<div class="card-footer">

								<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>" class="btn btn-primary shop-btn"><i class="fa-solid fa-eye"></i>Voir</a>

							</div>

						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endforeach; ?>
</div>
</div>

<?php require_once "includes/extensions.php"; ?>