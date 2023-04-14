<?php $this->_t = "Produits" ?>
<?php require_once "includes/availableCategories.php"; ?>
<div class="container">
	<br><br>
	<h5 class="label text-center">Toutes les boutiques.</h5>

	<div class="row">
		<?php foreach ($uniqueSellerShop as $key => $product):?>
				
					<div class="col-md-4">
						<a href="index.php?url=shop&category=<?= $product->getSub_category_name() ?>&id=<?= $product->getSeller_id() ?>">
							<div class="shop">
								<p class="shop-collage-1"><img src="public/images/bx-purchase-tag.svg" class="bx-cart-download">Boutique</p>
								<p class="shop-collage-2"><?= $product->getSeller_firstname() ?></p>
								<img src="<?= json_decode($product->getProduct_image(),true) != null ? json_decode($product->getProduct_image(),true)[0] : $product->getProduct_image() ?>" class="d-block w-100 h-100" alt="produit">
						
							</div>
						</a>
					</div>

		<?php endforeach; ?>
	</div>

</div>

