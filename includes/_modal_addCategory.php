<!-- Créer une boîte de dialogue confirme personnalisée -->
<div class="confirm_dialog">
  <form method="POST">

  	<div class="row">
  		<div class="col">
  			<input type="text" class="form-control" name="input_sub_category">
  		</div>
  	</div>

  	<br>
  	<div class="row">
  		<div class="col">
  			<select class="form-select" name="select_sub_category">
  				<option selected disabled="">Choisir une catégorie</option>
  				<?php foreach($allCategories as $key=>$category): ?>
  				    <option value="<?= $category->getCategory_id() ?>" <?= !empty($_GET['update']) && isset($oneProduct[0]) && $oneProduct[0]->getCategory_id() == $category->getCategory_id() ? 'selected': '' ?>><?= $category->getCategory_name() ?>    
              </option>
  				<?php endforeach; ?>
  			</select>
  		</div>
  	</div>

  	<div class="row">
  		<div class="col">
  			<div class="confirm_dialog-body d-flex justify-content-between">
  				<button type="submit" name="submit_sub_category" class="btn-style my-color float-start"><i class="fa-solid fa-plus"></i>&nbsp;Ajouter</button>

	  			<button id="cancel" class="btn-style my-color float-end">Annuler</button>	  	
			</div>
  			
  		</div>
  	</div>

  </form>
</div>
