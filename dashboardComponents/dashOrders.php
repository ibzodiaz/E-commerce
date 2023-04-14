<div class="home-content">
	<?php require_once "includes/confirmation.php"; ?>
	<?php if(empty($order)):?>

		<img src="public/images/order2.webp" class="orderImg">

	<?php else: ?>

		<br>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="encapsulate">
					<table class="table">
					  <thead>
					    <tr>
					      <th scope="col">N° commande</th>
					      <th scope="col">Produit</th>
					      <th scope="col">Image</th>
					      <th scope="col">Prix</th>
					      <th scope="col">Quantité</th>
					      <th scope="col">Validée</th>
					      <th scope="col">Fiche client</th>
					      <th scope="col">Action</th>
					    </tr>
					  </thead>
					  <tbody>
					  	<?php for ($i=0; $i < count($order) ; $i++) :?>
				
						    <tr class="show-orders">
						      <th scope="row">TH<?= $order[$i]->getOrder_id() ?></th>
						      <td><?= $order[$i]->getProduct_name() ?></td>
						      <td><img src="<?= json_decode($order[$i]->getProduct_image(),true) != null ? json_decode($order[$i]->getProduct_image(),true)[0] : $order[$i]->getProduct_image() ?>" class="img-summary"></td>
						      <td><?= $order[$i]->getOrder_price()*$order[$i]->getOrder_quantity() ?>&nbsp;Fcfa</td>
						      <td><?= $order[$i]->getOrder_quantity() ?></td>

					
					      	<?php if($order[$i]->getOrder_delivery_date() != null): ?>
						      	<td><span class="yes"><i class="fa-solid fa-check"></i></span></td>
						      	<td>
						      		<a href="index.php?url=seller&c=orders&i=<?= $i ?>" class="client">le client</a>
						      	</td>
						      	<td></td>
						      	
						      <?php else: ?>
						      	<td><span class="no"><i class="fa-solid fa-xmark"></i></span></td>
						      	<td>
						      		<a href="index.php?url=seller&c=orders&i=<?= $i ?>" class="client">le client</a>
						      	</td>
						      	<td>
						      		<a href="index.php?url=seller&c=orders&action=validate&id=<?= $order[$i]->getOrder_id() ?>" type="button" onclick="return confirm('Voulez vous continuer?')" class="btn-order"><i class="fa-solid fa-check-double"></i></a>

						      		<a href="index.php?url=seller&c=orders&action=delete&id=<?= $order[$i]->getOrder_id() ?>" type="button" onclick="return confirm('Êtes-vous sûr de vouloir supprimer la commande ?')" class="btn-order-delete"><i class="fa-sharp fa-solid fa-trash"></i></a>
						      	</td>
						      	
						      <?php endif; ?>
						

						    </tr>
						<?php endfor; ?>
					  </tbody>
					</table>
					</div>
				</div>

			</div>
		</div>

	<?php endif; ?>
</div>
