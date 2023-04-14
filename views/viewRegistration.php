<?php $this->_t = "Inscription"?>
<?php require_once "includes/esnotifs.php"; ?>
<?php require_once "includes/_navbar.php"; ?>
<!-- FORMULAIRE D'INSCRIPTION -->
<div class="container">
	<div class="row">
		
		<div class="col-md-8 offset-md-2">

			<div class="register">

				<form method="post">
					

			   		<div class="register-1">

			   			<div class="row">
			   				<div class="col">
			   					<div class="mb-3">
								  <label for="prenom" class="form-label">Prénom&nbsp;<span class="required">*</span></label>
								  <input type="text" class="form-control input-c" name="prenom" id="prenom" placeholder="prénom..." value="<?= isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : "" ?>">
								</div>
			   				</div>
			   				<div class="col">
			   					<div class="mb-3">
								  <label for="nom" class="form-label">Nom&nbsp;<span class="required">*</span></label>
								  <input type="text" class="form-control input-c" name="nom" id="nom" placeholder="nom..."
								  value="<?= isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : "" ?>">
								</div>
			   				</div>
			   			</div>

						<div class="mb-3">
						  <label for="telephone" class="form-label">Téléphone&nbsp;<span class="required">*</span></label>
						  <input type="tel" class="form-control input-c" name="telephone" id="telephone" placeholder="Ex:(+221) numéro de téléphone..."
						  value="<?= isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : "+221" ?>">
						</div>

						<div class="mb-3">
						  <label for="email" class="form-label">Email&nbsp;<span class="required">*</span></label>
						  <input type="email" class="form-control input-c" name="email" id="email" placeholder="email..." value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "" ?>">
						</div>

						<div class="row">
							<div class="col">
								<div class="mb-3">
									<button class="next-register-2 btn-style my-color"><i class="fa-solid fa-hand-point-right"></i>Suivant</button>
								</div>
							</div>
							<div class="col">
								<a href="index.php?url=form" class="float-end client">J'ai déjà un compte!</a>
							</div>
						</div>
				
			   		</div>

					

					<div class="register-2">

						<div class="mb-3">
						  <label for="password1" class="form-label">Mot de passe&nbsp;<span class="required">*</span></label>
						  <input type="password" class="form-control input-c" name="password1" id="password1" placeholder="Mot de passe..." value="<?= isset($_POST['password1']) ? htmlspecialchars($_POST['password1']) : "" ?>">
						</div>

						<div class="mb-3">
						  <label for="password2" class="form-label">Confirmation du mot de passe&nbsp;<span class="required">*</span></label>
						  <input type="password" class="form-control input-c" name="password2" id="password2" placeholder="Confirmation..." value="<?= isset($_POST['password2']) ? htmlspecialchars($_POST['password2']) : "" ?>">
						</div>

						<div class="mb-3">
						  <label for="sexe" class="form-label">Sexe&nbsp;<span class="required">*</span></label>
						  <select class="form-select select-c" id="sexe" name="sexe">
						    <option value="H" <?= isset($_POST['sexe']) && $_POST['sexe']=='H' ? 'selected' : 'selected' ?> >Homme</option>
						    <option value="F" <?= isset($_POST['sexe']) && $_POST['sexe']=='F' ? 'selected' : '' ?> >Femme</option>
						  </select>
						</div>

						<div class="row">
							<div class="col">
								<div class="mb-3">
									<button class="next-register-3 btn-style my-color"><i class="fa-solid fa-hand-point-right"></i>Suivant</button>
								</div>
							</div>
							<div class="col">
								<button class="prev-register-1 btn-style my-color float-end">Précédent</button>
							</div>
						</div>

					</div>

					<div class="register-3">

						<div class="mb-3">
							<label for="customertype" class="form-label">Type d'utilisateur&nbsp;<span class="required">*</span></label>
						  <select class="form-select select-c" id="customertype" name="customertype">
						    <option value="1" <?= isset($_POST['customertype']) && $_POST['customertype']==1 ? 'selected' : 'selected' ?> >Acheteur</option>
						    <option value="2" <?= isset($_POST['customertype']) && $_POST['customertype']==2 ? 'selected' : '' ?> >Marchand</option>
						  </select>
						</div>

						<br>

						<div class="mb-3">
							<div class="form-check">
						        <input class="form-check-input" type="checkbox" id="checkbox" name="checkbox" <?= isset($_POST['checkbox']) ? 'checked' : '' ?>>
						        <label class="form-check-label" for="checkbox">
						          J'accepte les termes et les conditions.&nbsp;<span class="required">*</span>
						        </label>
						    </div>

						    
						</div>

						<div class="row">
							<div class="col">
								<div class="mb-3">
									<input type="submit" class="form-control btn-style my-color" name="register" value="Inscription">
								</div>
							</div>
							<div class="col">
								<button class="prev-register-2 btn-style my-color float-end">Précédent</button>
							</div>
						</div>


				   </div>
					
				</form>
			</div>
		</div>
	</div>
</div>
