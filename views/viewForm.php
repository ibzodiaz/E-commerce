<?php $this->_t = "Connexion"?>
<!--LES NOTIFICATIONS ERREUR OU SUCCES-->
<?php require_once "includes/esnotifs.php"; ?>
<?php require_once "includes/_navbar.php"; ?>


<div class="container">
<!-- FORMULAIRE DE CONNEXION -->
	<div class="row">
		<div class="col-md-6 offset-md-3">
			<div class="connexion">
			    <form method="post">
			    	<fieldset class="border p-2">
					   <legend  class="float-none w-auto p-2">Connexion</legend>

					   <div class="mb-3">
						  <label for="email" class="form-label">Email</label>
						  <input type="text" class="form-control input-c" name="email" id="email" placeholder="Votre email..." value="<?= isset($_POST['email']) ? $_POST['email'] : "" ?>">
						</div>

						<div class="mb-3">
						  <label for="password" class="form-label">Mot de passe</label>
						  <input type="password" class="form-control input-c" name="password" id="password" placeholder="Mot de passe...">
						</div>

						<div class="mb-3">
							<label for="mode" class="form-label">Se connecter en tant que</label>
							<select class="form-select select-c" id="mode" name="customertype">
							    <option value="1" selected>Acheteur</option>
							    <option value="2">Marchand</option>
							</select>
						</div>

						<div class="mb-3">
							<div class="row">
								<div class="col">
									<a href="#">Mot de passe oublié ?</a>
								</div>
							</div>
							
						</div>

						<br>
						<div class="mb-3">
						  <input type="submit" class="form-control btn btn-color" name="connexion" value="Connexion">
						</div>
					</fieldset>
					
				</form>
			</div>
		</div>
	</div>


</div>


