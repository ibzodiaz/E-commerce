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
			      <th scope="col">Action</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php for ($i=0; $i < count($orderInfos) ; $i++) :?>
				    <tr>
				      <th scope="row">TH<?= $orderInfos[$i]->getOrder_id() ?></th>
				      <td><?= $orderInfos[$i]->getProduct_name() ?></td>
				      <td><img src="<?= json_decode($orderInfos[$i]->getProduct_image(),true) != null ? json_decode($orderInfos[$i]->getProduct_image(),true)[0] : $orderInfos[$i]->getProduct_image() ?>" class="img-summary"></td>
				      <td><?= $orderInfos[$i]->getOrder_price()*$orderInfos[$i]->getOrder_quantity() ?>&nbsp;Fcfa</td>
				      <td><?= $orderInfos[$i]->getOrder_quantity() ?></td>

				      <form method="post">
				      	<?php if($orderInfos[$i]->getOrder_delivery_date() != null): ?>
					      	<td><span class="yes"><i class="fa-solid fa-check"></i></span></td>
					      	<td></td>
					      	
					      <?php else: ?>
					      	<td><span class="no"><i class="fa-solid fa-xmark"></i></span></td>
					      	<td><a href="index.php?url=order&action=cancel&id=<?= $orderInfos[$i]->getOrder_id() ?>" type="button" onclick="return confirm('Êtes-vous sûr de vouloir annuler la commande ?')" class="btn-order-cancel">Annuler</a></td>
					      <?php endif; ?>
				      </form>
				    </tr>
				<?php endfor; ?>
			  </tbody>
			</table>
			</div>
		</div>

	</div>
</div>