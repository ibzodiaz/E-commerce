<div class="container">

		<?php if(!empty($sellerProducts)): ?>
			<?php foreach ($sellerProducts as $sub_category_name => $products):?>
				<?php if( isset($_GET['category']) && $sub_category_name == $_GET['category']): ?>
					
					<div class="row">
						<div class="col">

							<div class="contain-h-v">
								<a class="btn-v" href="index.php?url=shop&category=<?= $sub_category_name ?>&id=<?= htmlspecialchars(urlencode($_GET['id'])) ?>&view=all">
								<i class="fa-sharp fa-solid fa-grip-vertical"></i>
								</a>

								&nbsp;<a class="btn-h" href="index.php?url=shop&category=<?= $sub_category_name ?>&id=<?= htmlspecialchars(urlencode($_GET['id'])) ?>">
								<i class="fa-solid fa-grip"></i>
								</a>
							</div>
							
						</div>
					</div>

					<div class="row">
						<div class="col">
							<?php if(!isset($_GET['view']) || $_GET['view'] != 'all'): ?>
								<h5 class="label text-center"><?= $sub_category_name ?></h5>
							<?php else: ?>
								<div class="mt-4">
									
								</div>
							<?php endif; ?>
						</div>
					</div>

					<div class="row <?= isset($_GET['view']) && $_GET['view'] == 'all' ? 'row-cols-md-6 row-cols-sm-6': 'slider' ?>">
						<?php foreach ($products as $product): ?>

							<?php if(!isset($_GET['view']) || $_GET['view'] != 'all'): ?>
								<div class="col-md-2 col-sm-6">
							<?php endif; ?>

								<div class="card">

									<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>">
										<div class="image-wrapper">
											<img src="<?= json_decode($product->getProduct_image(),true) != null ? json_decode($product->getProduct_image(),true)[0] : $product->getProduct_image() ?>" alt="produit">
										</div>
										<div class="card-body">
										  	<p class="card-text card-name"><?= strlen($product->getProduct_name()) > 19 ? substr($product->getProduct_name(),0,20).".." : $product->getProduct_name() ?></p>
										  	<p class="card-text card-price"><?= strlen($product->getProduct_price()) < 7 ? $product->getProduct_price() : substr($product->getProduct_price(),0,6).".."?> Fcfa</p>
				
										</div>
									</a>
									
						
								</div>

							<?php if(!isset($_GET['view']) || $_GET['view'] != 'all'): ?>
								</div>
							<?php endif; ?>
							
							<?php $count = count($products); ?>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php else: ?>
			<h2 class="text-center">Pas de boutique pour l'instant !</h2>
		<?php endif; ?>

</div>