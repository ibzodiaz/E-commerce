<div class="container">
	<div class="row">
		<div class="col">
			<h4 class="text-center">Point de livraison</h4>
		</div>
	</div>
	<div class="row">
		<div class="col">

		    <form method="post">


						<div class="mb-3">
						  <label for="pays" class="form-label">Pays</label>
						  <input type="text" class="form-control input-c" name="pays" id="pays" placeholder="Votre pays..." value="<?= empty($customer[0]->getLocation_customer_country()) ? "" : $customer[0]->getLocation_customer_country() ?>">
						</div>


						<div class="mb-3">
						  <label for="region" class="form-label">Region</label>
						  <input type="region" class="form-control input-c" name="region" id="region" placeholder="Votre region..." value="<?= empty($customer[0]->getLocation_customer_region()) ? "" : $customer[0]->getLocation_customer_region() ?>">
						</div>


						<div class="mb-3">
							<label for="localite" class="form-label">Localité</label>
							<input type="localite" class="form-control input-c" name="localite" id="localite" placeholder="Votre localité..." value="<?= empty($customer[0]->getLocation_customer_street()) ? "" : $customer[0]->getLocation_customer_street() ?>">
						</div>

	
					<br>
					<div class="mb-3">
					  <input type="submit" class="form-control btn btn-color" name="sauvegarder" value="sauvegarder">
					</div>
				
			</form>

		</div>
	</div>


</div>