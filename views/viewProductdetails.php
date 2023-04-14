<?php $this->_t = "Les détails du produit"?>

<?php require_once "includes/esnotifs.php"; ?>
<?php require_once "includes/availableCategories.php"; ?>

<div id="productdetails" class="container">
	<div class="row">
		<div class="col-md-6 details-center">
			<h5><?= str_replace("\n", " ", $oneProduct[0]->getProduct_name()) ?></h5>
		</div>

	</div>

	<div class="row">
		<div class="col-md-6">

			<div class="slider-for">
				<?php if(json_decode($oneProduct[0]->getProduct_image(),true) != null): ?>

					<?php for ($i = 0; $i < count(json_decode($oneProduct[0]->getProduct_image(),true)); $i++):?>
						<div>
							<img src="<?= json_decode($oneProduct[0]->getProduct_image(),true)[$i] ?>">
						</div>
					<?php endfor; ?>

				<?php else: ?>

					<?php for ($i=0; $i < 3; $i++):?>
						<div>
							<img src="<?= $oneProduct[0]->getProduct_image() ?>">
						</div>
					<?php endfor; ?>	

				<?php endif; ?>
			</div>

			<div class="slider-nav">
				<?php if(json_decode($oneProduct[0]->getProduct_image(),true) != null): ?>
					
					<?php for ($i = 0; $i < count(json_decode($oneProduct[0]->getProduct_image(),true)); $i++):?>
						<div>
							<img src="<?= json_decode($oneProduct[0]->getProduct_image(),true)[$i] ?>">
						</div>
					<?php endfor; ?>

				<?php else: ?>

					<?php for ($i=0; $i < 3; $i++):?>
						<div>
							<img src="<?= $oneProduct[0]->getProduct_image() ?>">
						</div>
					<?php endfor; ?>	

				<?php endif; ?>
			</div>

		</div>

		<div class="col-md-6">
			<div class="describe">

				<div class="describe-in">
					<div class="row">
						<div class="col">
							<?php for ($i=1; $i <= 5; $i++):?>
								<?php if($i <= $meanRate): ?>
									<i class="fa-solid fa-star big yellow"></i>
								<?php else: ?>
									<i class="fa-regular fa-star big yellow"></i>
								<?php endif; ?>
							<?php endfor; ?>
						</div>
					</div>
					<div class="row">
						<div class="col-md-9">
							<h2><?= $oneProduct[0]->getProduct_name() ?></h2>
						</div>
						<div class="col-md-3">
							<p>Vendeur : <?= $oneProduct[0]->getSeller_firstname() ?>&nbsp;<?= $oneProduct[0]->getSeller_lastname() ?></p>
							<a href="https://wa.me/<?= $oneProduct[0]->getSeller_phone() ?>?text=Depuis I-SHOP"><i class="fa-brands fa-whatsapp fs-1" style="color: green;"></i></a>
						</div>
					</div>
					
				</div>
				
				<div class="describe-in">
					<h1><?=$oneProduct[0]->getProduct_price() ?> FCFA</h1>
				</div>
				<p>Description:</p>
				<div class="describe-in the-description">
					<p><?= nl2br($oneProduct[0]->getProduct_description()) ?></p>
				</div>
				<?php if($oneProduct[0]->getProduct_size() != null): ?>

					<div class="describe-in">
						<select id="mySelect" class="form-control">
							<?php for ($i = 0; $i < count(json_decode($oneProduct[0]->getProduct_size(),true)); $i++):?>
								<option value="<?= json_decode($oneProduct[0]->getProduct_size(),true)[$i]  ?>"><?= json_decode($oneProduct[0]->getProduct_size(),true)[$i]  ?></option>
							<?php endfor; ?>
						</select>
					</div>
				<?php endif; ?>
				<div class="describe-in">
					<h4>Disponibilité <?= $oneProduct[0]->getProduct_qty() != 0 ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-xmark"></i>'?></h4>
				</div>
				<?php if(!isset($_SESSION['seller'])): ?>
					<?php if($oneProduct[0]->getProduct_qty() != 0): ?>

						<button data-sig="1" data-id="<?= $oneProduct[0]->getProduct_id() ?>" data-price="<?= $oneProduct[0]->getProduct_price() ?>" class="btn btn-add-cart shop-btn-desc w-100"><i class="fa-sharp fa-solid fa-cart-shopping"></i>Panier</button>

					<?php else: ?>
						<h3 style="color: red;">Non disponible !</h3>
					<?php endif; ?>
				<?php else: ?>
					<a href="index.php?url=seller&c=products" class="btn btn-danger">Retour</a>
				<?php endif; ?>
			</div>
			
		</div>
	</div>

	<div class="row" id="notices">
		<div class="col-md-6">
			<h5>Laissez votre avis ci-dessous.</h5>
			<br>
			<div class="notices">
				<?php if(!empty($customerNotices)): ?>
					<?php foreach ($customerNotices as $cpt=>$notice) : ?>

						<?php if(isset($_GET['see'])): ?>
							<i class="fa-sharp fa-solid fa-circle-user"></i>&nbsp;<span><?= $notice->getCustomer_firstname() ?></span>
							<?php for ($i=1; $i <= 5; $i++):?>
								<?php if($i <= $notice->getNotice_rate()): ?>
									<i class="fa-solid fa-star fs-6 yellow"></i>
								<?php else: ?>
									<i class="fa-regular fa-star fs-6 yellow"></i>
								<?php endif; ?>
							<?php endfor; ?>
							<p class="underline"><?= $notice->getNotice_message() ?></p>

						<?php else: ?>

							<?php if($cpt > 1): ?>

								<a href="index.php?url=productdetails&id=<?= htmlspecialchars($_GET['id'])?>&see=all#notices" class="client">voir plus</a>
								<?php break; ?>
							<?php else: ?>

								<i class="fa-sharp fa-solid fa-circle-user"></i>&nbsp;<span><?= $notice->getCustomer_firstname() ?></span>
								<?php for ($i=1; $i <= 5; $i++):?>
									<?php if($i <= $notice->getNotice_rate()): ?>
										<i class="fa-solid fa-star fs-6 yellow"></i>
									<?php else: ?>
										<i class="fa-regular fa-star fs-6 yellow"></i>
									<?php endif; ?>
								<?php endfor; ?>
								<p class="underline"><?= $notice->getNotice_message() ?></p>

							<?php endif; ?>

						<?php endif; ?>

					<?php endforeach; ?>

					<?php if(isset($_GET['see'])): ?>
						<a href="index.php?url=productdetails&id=<?= htmlspecialchars($_GET['id'])?>#notices" class="client">voir moins</a>
					<?php endif; ?>
				<?php else: ?>
					<p>0 avis pour le moment!</p>
				<?php endif; ?>
			</div>

			<?php if(isset($_SESSION['customer_id'])): ?>
				<form method="post">
					<textarea rows="2" cols="50" name="notice_message" class="form-control input-c" placeholder="Votre avis..."></textarea>
					<label for="rate">Nombre d'étoile</label><br>
					<select id="rate" class="form-control w-25" name="rate">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
					<button type="submit" class="btn-style my-color float-end mt-2" name="submit_notice"><i class="fa-regular fa-comment"></i>&nbsp;Commenter</button>
				</form>
			<?php else: ?>
					<?php if(!isset($_SESSION['seller_id'])): ?>
						<a href="index.php?url=form" class="btn-style my-color float-end pt-2"><i class="fa-regular fa-comment"></i>&nbsp;Commenter</a>
					<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
	<br>

	<div class="row">

		<br><br>
		<h5 class="label text-center">PRODUITS SIMILAIRES</h5>

		<?php foreach($categoryProducts as $category_name => $sub_categories): ?>
			<?php foreach($sub_categories as $sub_category_name => $products): ?>
				<?php if($oneProduct[0]->getSub_category_name() ==  $sub_category_name): ?>
					<div class="row slider">
						<?php foreach($products as $product): ?>
							<div class="col-md-2 col-sm-6">
								
								<div class="card">
									<a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>">
										<div class="image-wrapper">
											<img src="<?= json_decode($product->getProduct_image(),true) != null ? json_decode($product->getProduct_image(),true)[0] : $product->getProduct_image() ?>" alt="produit">
										</div>
										<div class="card-body">
										  	<p class="card-name"><?= strlen($product->getProduct_name()) > 11 ? substr($product->getProduct_name(),0,12).".." : $product->getProduct_name() ?></p>
										  	<p class="card-price"><?= strlen($product->getProduct_price()) < 7 ? $product->getProduct_price() : substr($product->getProduct_price(),0,6).".."?> FCFA
										  	</p>
										 
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
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endforeach; ?>
	
	</div>
</div>
