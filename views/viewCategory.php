<?php $this->_t = "Catégorie"?>
<?php require_once "includes/availableCategories.php"; ?>
<div class="container">

	<?php if($article == ""): ?>
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
	<?php else:?>


		<div class="row">
			<?php foreach ($sub_categories_section as $sub_category_name => $products):?>
				<h5 class="label text-center"><?= $sub_category_name ?></h5>
				<div class="row slider">
					<?php foreach ($products as $product): ?>
						<div class="col-md-2 col-sm-6">
			
							<div class="card">
								<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>">
									<div class="image-wrapper">
										<img src="<?= json_decode($product->getProduct_image(),true) != null ? json_decode($product->getProduct_image(),true)[0] : $product->getProduct_image() ?>" alt="produit">
									</div>
									<div class="card-body">
									  	<p class="card-text card-name"><?= strlen($product->getProduct_name())>11 ? substr($product->getProduct_name(),0,12).".." : $product->getProduct_name()?></p>
									  	<p class="card-text card-price"><?= strlen($product->getProduct_price()) < 7 ? $product->getProduct_price() : substr($product->getProduct_price(),0,6).".."?> Fcfa</p>
			
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
						<?php $count = count($products); ?>
					<?php endforeach; ?>
				</div>
			<?php endforeach; ?>
		</div>


		<br>
		<?php if(isset($count) && $count != 0): ?>
			<div class="row">
				<div class="col-md-8 offset-md-4">
					<nav class="pagination-center" aria-label="Page navigation example">
					  <ul class="pagination">

					  	<?php if(isset($_GET['page'])): ?>
					  		<?php if($_GET['page'] <= 1): ?>
							    <li class="page-item">
							      <a class="page-link" href="index.php?url=category&article=<?= $article ?>&page=1" aria-label="Previous">
							        <span aria-hidden="true">&laquo;</span>
							      </a>
							    </li>
							<?php else:?>
								<li class="page-item">
							      <a class="page-link" href="index.php?url=category&article=<?= $article ?>&page=<?= $_GET['page']-1 ?>" aria-label="Previous">
							        <span aria-hidden="true">&laquo;</span>
							      </a>
							    </li>
							<?php endif; ?>
						<?php endif;?>

					    <?php for($i = 0 ; $i < $totalProducts/$limit ; $i++ ): ?>
						    <li class="page-item <?= isset($_GET['page']) && $_GET['page'] == $i+1 ? 'active' : '' ?>"><a class="page-link" href="index.php?url=category&article=<?= $article ?>&page=<?= $i+1 ?>"><?= $i+1 ?></a></li>
						<?php endfor; ?>

						<?php if(isset($_GET['page']) && $_GET['page'] > 1): ?>
							<?php if($_GET['page'] < $totalProducts/$limit): ?>
							    <li class="page-item">
							      <a class="page-link" href="index.php?url=category&article=<?= $article ?>&page=<?=$_GET['page']+1 ?>" aria-label="Next">
							        <span aria-hidden="true">&raquo;</span>
							      </a>
							    </li>
							<?php endif; ?>
						<?php endif; ?>

					  </ul>
					</nav>			
				</div>
			</div>
		<?php else:?>
			<h1 class="text-center" style="color: #102447;">Pas de produits pour l'instant!</h1>
		<?php endif; ?>
	<?php endif;?>

</div>