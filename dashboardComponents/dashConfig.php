<div class="container">
	<h4 class="text-center">Changement du mot de passe</h4>

	<br>
	<form method="post">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<label for="password1" class="form-label">Mot de passe actuel</label>
				<input type="password" class="form-control input-c" name="password1" id="password1" placeholder="Votre mot de passe..." value="<?= isset($_POST['password1']) ? $_POST['password1'] : "" ?>" >
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<label for="password2" class="form-label">Nouveau mot de passe</label>
				<input type="password" class="form-control input-c" name="password2" id="password2" placeholder="Nouveau mot de passe..." value="<?= isset($_POST['password2']) ? $_POST['password2'] : "" ?>">
			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<label for="password3" class="form-label">Confirmation du mot de passe</label>
				<input type="password" class="form-control input-c" name="password3" id="password3" placeholder="Confirmation du mot de passe..." value="<?= isset($_POST['password3']) ? $_POST['password3'] : "" ?>">
			</div>
		</div>

		<br>
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<input type="submit" class="form-control btn btn-color" name="update_password" value="Modifier">
			</div>
		</div>

	</form>

</div>
