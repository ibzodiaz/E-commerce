<?php $this->_t = "Panier"?>
<div class="container">
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<h5 class="text-center">Récaputilatif de mon panier.</h5>
		</div>
	</div>
	<br><br>

	<div class="row">
		<div class="col-md-8 d-flex justify-content-center align-items-center">
			<?php if(isset($ListProductSelected) && !is_null($ListProductSelected)): ?>
		
				<table class="table table-light">
	
				  <tbody>
					  	<?php foreach(removeDuplicateProducts($ListProductSelected) as $key=>$value): ?>

					  		<?php if(!empty($value)): ?>
				
							    <tr data-id="<?= $value['infos'][0]->getProduct_id() ?>">
									<td>
										<div class="row">
											<div class="col-md-3">
												<a href="index.php?url=productdetails&id=<?= $value['infos'][0]->getProduct_id()  ?>">
												<img src="<?= json_decode($value['infos'][0]->getProduct_image(),true) != null ? json_decode($value['infos'][0]->getProduct_image(),true)[0] : $value['infos'][0]->getProduct_image() ?>" class="img-shopping" alt="produit">
												</a>
											</div>
											<div class="col-md-3 to-top">
												<a href="index.php?url=productdetails&id=<?= $value['infos'][0]->getProduct_id()  ?>">
												<h6><?= $value['infos'][0]->getProduct_name() ?></h6>
												</a>
												<h5 data-price="<?= $value['infos'][0]->getProduct_price() ?>"><?= $value['infos'][0]->getProduct_price() ?> FCFA</h5>
												
											</div>
											<div class="col-md-3 to-top">

												<button data-id="<?= $value['infos'][0]->getProduct_id()?>" data-price="<?= $value['infos'][0]->getProduct_price()?>" data-size="<?= isset($value['size']) ? $value['size'] : "" ?>" class="decrement btn btn-warning">-</button>

											    	<span class="p_qty">
											    		<?= isset($_COOKIE['pln']) ? (isset($value['size']) ? countOccurrences($ListProductSelected)[$value['id']." ".$value['size']] : countOccurrences($ListProductSelected)[$value['infos'][0]->getProduct_id()] ) : '1' ?>
											    	</span>

											    <button data-id="<?= $value['infos'][0]->getProduct_id()?>" data-price="<?= $value['infos'][0]->getProduct_price()?>" data-size="<?= isset($value['size']) ? $value['size'] : "" ?>" class="increment btn btn-warning">+</button>

											</div>
											<div class="col-md-3">
												<?php if($value['infos'][0]->getProduct_size() != null): ?>
													<?php if(isset($value['size'])): ?>
													<p><?= $value['size'] ?></p>
													<?php endif; ?>
												<?php endif; ?>
											</div>
										</div>
										
										
									</td>

									<td>
										<button class="btn btn-danger btn-delete" data-id="<?= $value['infos'][0]->getProduct_id()?>" data-price="<?= $value['infos'][0]->getProduct_price()?>" data-size="<?= isset($value['size']) ? $value['size'] : "" ?>"><i class="fa-solid fa-trash-can"></i></button>
									</td>
							    </tr>
							<?php endif; ?>
					  	<?php endforeach; ?>
					
				  </tbody>
				</table>

			<?php else: ?>

				<img src="public/images/panier.jpg" class="img-shop" alt="image">

			<?php endif; ?>
		</div>

		<div class="col-md-4">
			<table class="table table-light">
			  <thead>
			    <tr>
			      <th scope="col">Total</th>
			      <th scope="col">Nombre total d'articles</th>
			    </tr>
			  </thead>
			  <tbody>
			    <tr>
			      <td><h6 id="sumTotal" data-total="<?= isset($_COOKIE['pln']) ? $sum : '0' ?>"><?= isset($_COOKIE['pln']) ? $sum.' FCFA' : '0 FCFA' ?></h6></td>
			      <td><h6 id="countTotal" data-count="<?= $count ?>"><?= $count ?></h6></td>
			    </tr>
			  </tbody>
			</table>
			<div class="row">
				<?php if($count != 0): ?>
					<?php if(isset($_SESSION['customer'])): ?>
	
						<?php if(!empty($customer)): ?>
							<?php if(!is_null($customer[0]->getLocation_customer_country()) && !is_null($customer[0]->getLocation_customer_region()) && !is_null($customer[0]->getLocation_customer_street()) && $customer[0]->getLocation_customer_country() != "" && $customer[0]->getLocation_customer_region() != "" && $customer[0]->getLocation_customer_street() != ""): ?>
								<div class="col">
									<a href="index.php?url=finalize" type="button" class="btn-dim"><i class="fa-solid fa-coins"></i>&nbsp;Finaliser ma commande</a>
								</div>
							<?php else: ?>
								<div class="col">
									<a href="index.php?url=customer" type="button" class="btn-dim"><i class="fa-solid fa-coins"></i>&nbsp;Finaliser ma commande</a>
								</div>
							<?php endif; ?>
						<?php else: ?>

							<div class="col">
								<a href="index.php?url=customer" type="button" class="btn-dim"><i class="fa-solid fa-coins"></i>&nbsp;Finaliser ma commande</a>
							</div>
						<?php endif; ?>
						
						
					<?php else: ?>
						<div class="col">
							<a href="index.php?url=registration" type="button" class="btn-dim"><i class="fa-solid fa-coins"></i>&nbsp;Finaliser ma commande</a>
						</div>
					<?php endif; ?>	
					
				<?php else: ?>
					<div class="col">
						<a href="index.php?url=product" type="button" class="btn-dim">Commencer le shopping</a>
					</div>
				<?php endif; ?>
			</div>
			<br>
			<?php if($count != 0): ?>
				<form method="post">
					<div class="row">
						<div class="col-md-8">
							<input type="text" class="form-control" placeholder="Entrez le code promo..." name="code_promo">
						</div>
						<div class="col-md-4">
							<input type="submit" class="btn btn-primary" name="submit_code" value="Valider">
						</div>
					</div>
				</form>
			<?php endif; ?>
		</div>
		
		
	</div>

</div>