<div class="home-content">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="encapsulate">
					<table class="table">
					  <thead>
					    <tr>
					    	<th scope="col">CATEGORIES</th>
							<th scope="col">NOMS</th>
							<th scope="col">IMAGES</th>
							<th scope="col">PRIX</th>
							<th scope="col">ACTIONS</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php foreach($sellerProducts as $category_name => $products): ?>
		
					  		<?php foreach($products as $product) :?>
							    <tr>
							    	<td><?= $category_name ?></td>
									<td><?= $product->getProduct_name() ?></td>
									<td><a href="index.php?url=productdetails&id=<?= $product->getProduct_id() ?>">
										<img src="<?= json_decode($product->getProduct_image(),true) != null ? json_decode($product->getProduct_image(),true)[0] : $product->getProduct_image() ?>" class="img-summary" alt="produit">
									</a></td>

									<td><?= $product->getProduct_price() ?> FCFA</td>
									<td>
										<div class="container">
											<div class="row">
												<div class="col">
													<a href="index.php?url=seller&c=operations&update=<?= $product->getProduct_id() ?>" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a> 
												</div>
												<div class="col">
													<a href="index.php?url=seller&c=allproducts&delete=<?= $product->getProduct_id() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')" class="btn btn-danger delete"><i class="fa-solid fa-trash-can"></i></a> 
												</div>
											</div>
										</div>
									</td>
							    </tr>
							<?php endforeach;?>
					  	<?php endforeach; ?>	
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="confirmation-modal">
	<div class="container">
		<form method="post">
			<div class="row">
				<div class="col">
					<div class="my-modal-header">
						<h5 class="my-modal-title">Suppression</h5>
						<span class="button"><i class="fa-solid fa-xmark cross-btn-close"></i></span>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="my-modal-body">
						<h5>êtes vous sûr de vouloir supprimer ?</h5>
					</div>
				</div>
			</div>
			<div class="row">
				
				<div class="col">
					<div class="my-modal-footer">
						<button type="button" class="btn btn-secondary close-btn">Fermer</button>

						<input type="submit" name="confirm_delete" class="btn btn-danger add-btn" value="Supprimer"/>

					</div>
				</div>
			</div>
		</form>
	</div>
</div>	