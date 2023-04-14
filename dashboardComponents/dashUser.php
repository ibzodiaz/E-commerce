<div class="home-content">
	<div class="container">
		<h4 class="text-center">Mes informations</h4>

		<br>
		<form method="post">
			<div class="row">
				<div class="col">
					<label for="prenom" class="form-label">Prénom</label>
					<input type="text" class="form-control input-c" name="prenom" id="prenom" placeholder="Votre prénom..." value="<?= !empty($seller) ? $seller[0]->getSeller_firstname() : "" ?>" >
				</div>
				<div class="col">
					<label for="nom" class="form-label">Nom</label>
					<input type="text" class="form-control input-c" name="nom" id="nom" placeholder="Votre nom..." value="<?= !empty($seller) ? $seller[0]->getSeller_lastname() : "" ?>">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col">
					<label for="email" class="form-label">Email</label>
					<input type="text" class="form-control input-c" name="email" id="email" placeholder="Votre email..." value="<?= !empty($seller) ? $seller[0]->getSeller_email() : "" ?>">
				</div>
				<div class="col">
					<label for="telephone" class="form-label">Téléphone</label>
					<input type="text" class="form-control input-c" name="telephone" id="telephone" placeholder="Votre téléphone..." value="<?= !empty($seller) ? $seller[0]->getSeller_phone() : "" ?>">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col">
					<label for="pays" class="form-label">Pays</label>
					<input type="text" class="form-control input-c" name="pays" id="pays" placeholder="Votre pays..." value="<?= !empty($seller) && !empty($seller[0]->getLocation_Seller_country()) ? $seller[0]->getLocation_Seller_country() : "" ?>">
				</div>
				<div class="col">
					<label for="region" class="form-label">Région</label>
					<input type="text" class="form-control input-c" name="region" id="region" placeholder="Votre région..." value="<?= !empty($seller) && !empty($seller[0]->getLocation_Seller_region()) ? $seller[0]->getLocation_Seller_region() : "" ?>">
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col">
					<label for="localite" class="form-label">Localité</label>
					<input type="text" class="form-control input-c" name="localite" id="localite" placeholder="Votre localité..." value="<?= !empty($seller) && !empty($seller[0]->getLocation_Seller_street()) ? $seller[0]->getLocation_Seller_street() : "" ?>">
				</div>
				<div class="col">
					<label for="sexe" class="form-label">Sexe</label>
					<select class="form-select select-c" id="sexe" name="sexe">
						<option value="H" <?= !empty($seller) && $seller[0]->getSeller_sexe() == 'H' ? 'selected' : '' ?> >Homme</option>
						<option value="F" <?= !empty($seller) && $seller[0]->getSeller_sexe() == 'F' ? 'selected' : '' ?> >Femme</option>
					</select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col">
					<input type="submit" class="form-control btn btn-color" name="submit_Seller" value="Modifier">
				</div>
			</div>

		</form>

	</div>



</div>