<?php require_once "includes/esnotifs.php"; ?>
<div class="container">

	<div class="row">
		<div class="col-md-8">
			<div class="encapsulate">
				<div class="facture">
					<h4 class="text-center text-decoration-underline" style="color: red;">Résumé</h4>
					<br>
					<div class="row">
						<div class="col">
							<h5 class="text-center">Vos informations</h5>
							<table class="table">
							  <tbody>
								<tr>
									<th scope="col">Prénom</th><td><?= $customer[0]->getCustomer_firstname() ?></td>
								</tr>
								<tr>
									<th scope="col">Nom</th><td><?= $customer[0]->getCustomer_lastname() ?></td>
								</tr>

								<tr>
									<th scope="col">Sexe</th><td><?= $customer[0]->getCustomer_sexe()=='H' ? 'Homme' : 'Femme' ?></td>
								</tr>
							  </tbody>
							</table>
						</div>
					</div>

					<br>
					<div class="row">
						<div class="col">
							<h5 class="text-center">Vos coordonnées</h5>
							<table class="table">
			
							  <tbody>
								<tr>
									<th scope="col">Pays</th><td><?= $customer[0]->getLocation_customer_country() ?></td>
								</tr>
								<tr>
									<th scope="col">Ville</th><td><?= $customer[0]->getLocation_customer_region() ?></td>
								</tr>
								<tr>
									<th scope="col">Localité</th><td><?= $customer[0]->getLocation_customer_street() ?></td>
								</tr>
								<tr>
									<th scope="col">Téléphone</th><td><?= $customer[0]->getCustomer_phone() ?></td>
								</tr>
							  </tbody>
							</table>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col">
							<h5 class="text-center">Vos commandes</h5>
							<table class="table">
							  <thead>
							    <tr>
								    <th scope="col">Produit</th>
								    <th scope="col">Prix Unitaire</th>
								    <th scope="col">Quantité</th>
								    <th scope="col">T/P</th>  
							    </tr>
							  </thead>
							  <tbody>
							  	<?php if(isset($ListProductSelected) && !is_null($ListProductSelected)): ?>
								  	<?php foreach(removeDuplicateProducts($ListProductSelected) as $key=>$value): ?>
								  		<th scope="col">
								  
								  			<span>Vendeur: </span><?= $value['infos'][0]->getSeller_firstname()." ".$value['infos'][0]->getSeller_lastname() ?>

								  		</th>
									    <tr>
									      <td><?= $value['infos'][0]->getProduct_name() ?></td>
									    
									      <td><?= $value['infos'][0]->getProduct_price() ?> Fcfa</td>
									      <td><?= isset($value['size']) ? $countOccurences[$value['id']." ".$value['size']] : $countOccurences[$value['infos'][0]->getProduct_id()] ?></td>
								
									      <?php if(isset($value['size'])): ?>
									      	<td><?= $value['size'] ?></td>
									      <?php endif; ?>

									    </tr>
								    <?php endforeach; ?>
							    <?php endif; ?>
							  </tbody>
							</table>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col">
							<h5 class="text-center">Résumé de la facture</h5>
							<table class="table">
							  <thead>
							    <tr>
							      <th scope="col">Somme totale</th>
							      <th scope="col">Nombre total d'articles</th>
							      <th scope="col">Réduction</th>
							    </tr>
							  </thead>
							  <tbody>
							    <tr>
							      <td><?= $sum ?> Fcfa</td>
							      <td><?= $count ?></td>
							      <td>0%</td>
							    </tr>
							  </tbody>
							</table>
						</div>
					</div>
		
				</div>
			</div>
		</div>

		<div class="col-md-4">
			<div class="confirmation">
				<h5 class="text-center">Procèder au paiement</h5>

			  	<form method="post">
					
					<input type="radio" id="option1" name="option1" value="option1">&nbsp;
					<label for="option1">Paiement à la livraison</label><br>
					<br>
					<input type="radio" id="option2" name="option2" value="option2" disabled>&nbsp;
					<label for="option2"><del>Paiement en ligne</del></label><br>
				    <br>
				    <input type="submit" type="button" class="al" name="soumettre" value="Confirmer">
				      
			  	</form>
			</div>
		</div>

	</div>
</div>