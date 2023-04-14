<div class="home-content">
<?php require_once "includes/_modal_addCategory.php" ?>
	<div class="container">

		<div class="cadre">
			<div class="row">
				<div class="col">
					<div class="step">
						<h5>1</h5>
						<h5>Catégorie</h5>
					</div>
					<i class="fa-solid fa-arrow-right"></i>
				</div>
				<div class="col">
					<div class="step">
						<h5>2</h5>
						<h5>Produit</h5>
					</div>
					<i class="fa-solid fa-arrow-right"></i>
				</div>
				<div class="col">
					<div class="step">
						<h5>3</h5>
						<h5>Finaliser</h5>
					</div>
				</div>
			</div>
		</div>
		<br>

		<div class="row">
			<div class="col">

				<form method="post" enctype="multipart/form-data">
					<!--OPERATION SUR LES CATEGORIES-->
					<div class="insert-category cadre">

						<div class="row">
							<div class="col">
								<button class="add-sub-category btn-style my-color float-end"><i class="fa-solid fa-plus"></i>&nbsp;sous-categorie</button>
							</div>
						</div>

						<br>
						<div class="row">
							<div class="col">
								<label class="lg my-color" for="product_category">CHOISIR UNE CATEGORIE <span class="required">*</span></label>
								<select class="form-select" name="product_category" id="product_category">
									<option selected disabled="">Choisir une catégorie</option>
									<?php foreach($allCategories as $key=>$category): ?>
									    <option value="<?= $category->getCategory_id() ?>" <?= !empty($_GET['update']) && isset($oneProduct[0]) && $oneProduct[0]->getCategory_id() == $category->getCategory_id() ? 'selected': '' ?>><?= $category->getCategory_name() ?></option>
									<?php endforeach; ?>
								</select>

							</div>
						</div>

						<br>
						<div class="row">
							<div class="col">
								<label class="lg my-color" for="sub_category">SOUS-CATEGORIES <span class="required">*</span></label>
								<select class="form-select" name="sub_category" id="sub_category">
									<option selected disabled="">Choisir une sous-catégorie</option>
									<?php foreach ($all_sub_categories as $index => $sub_category):?>	
		
											<option value="<?= $sub_category->getSub_category_id() ?>" <?= !empty($_GET['update']) && isset($oneProduct[0]) && $oneProduct[0]->getSub_category_id() == $sub_category->getSub_category_id() ? 'selected': '' ?> ><?= $sub_category->getSub_category_name() ?></option>

									<?php endforeach; ?>
								</select>
							</div>
						</div>

						<br>
						<div class="row">
							<div class="col">
								<button class="add-category btn-style my-color">Poursuivre</button>
							</div>
						</div>
					</div>

					<!--OPERATION POUR L'INSERTION DES PRODUITS-->
					<div class="insert-product">
						<h4 class="text-center">Insertion de produit ou d'article.</h4>

						<div class="row cadre">
							<div class="col">
								<label for="product_name" class="form-label">NOM DU PRODUIT <span class="required">*</span></label>
						  		<input type="text" class="form-control input-c" name="product_name" id="product_name" placeholder="Nom du produit..." value="<?= !empty($_GET['update']) && isset($oneProduct[0]) ? $oneProduct[0]->getProduct_name() : '' ?>">
							</div>

							<div class="col">
								<label for="product_price" class="form-label">PRIX DU PRODUIT <span class="required">*</span></label>
						  		<input type="text" class="form-control input-c" name="product_price" id="product_price" placeholder="Prix du produit..." value="<?= !empty($_GET['update']) && isset($oneProduct[0]) ? $oneProduct[0]->getProduct_price() : '' ?>">
							</div>
						</div>

						<br>
						<div class="row cadre">
							<div class="col">
								<label>CHOISIR UNE OU DES IMAGE(S) <span class="required">*</span></label><br>
								<label for="file-upload" class="custom-file-upload">
								  <i class="fa fa-cloud-upload"></i>&nbsp;chargement d'image(s)
								</label>
								<input type="file" name="product_image[]" id="file-upload" multiple>
							</div>

							<div class="col">

								<input type="radio" id="dispo" name="dispo" <?= !isset($_GET['update']) ? "" : 'checked' ?> >
								<label for="dispo">Disponible</label>
								&nbsp;&nbsp;&nbsp;
								<input type="radio" id="indispo" name="indispo">
								<label for="indispo">Non disponible</label>
								<span class="required">*</span>
								<br>
								<div class="available">
									<label for="product_qty" class="form-label">QUANTITE DISPONIBLE</label>
						  			<input type="text" class="form-control input-c" name="product_qty" id="product_qty" placeholder="Quantité disponible..." value="<?= !empty($_GET['update']) && isset($oneProduct[0]) ? $oneProduct[0]->getProduct_qty() : "" ?>">
								</div>
							
							</div>
							
						</div>

						<br>
						<div class="row cadre">
							<div class="col">
								<label for="product_description" class="form-label">DESCRIPTION DU PRODUIT <span class="required">*</span></label>
						 		<textarea rows="4" cols="50" class="form-control input-c" aria-label="With textarea" name="product_description" id="product_description" placeholder="Description du produit..."><?= !empty($_GET['update']) && isset($oneProduct[0]) ? nl2br($oneProduct[0]->getProduct_description()) : "" ?></textarea>
						  		<label for="product_description" class="small" class="required">Veuillez ne pas dépasser les 255 caractères permis !</label>
							</div>
						</div>

						<br>
						<div class="row cadre">

							<div class="col">
								<div class="row">
									<div class="col">
						
										<input type="radio" id="mesure1" name="mesure1">&nbsp;
										<label for="mesure1">Appliquer une mesure</label><br>
										<br>
										<input type="radio" id="mesure2" name="mesure2">&nbsp;
										<label for="mesure2">Ne pas appliquer de mesure</label><br>
										      			
									</div>
								</div>
								<br>
								<div class="row size-product">

									<div class="col">

										<div class="row">
											<div class="col">
												<input type="checkbox" id="clothes">
												<label for="clothes">Vêtements</label>
											</div>
											<div class="col">
												<input type="checkbox" id="kg">
												<label for="kg">Kilogrammes</label>
											</div>
											<div class="col">
												<input type="checkbox" id="hg">
												<label for="hg">Hectogrammes</label>
											</div>
											<div class="col">
												<input type="checkbox" id="dag">
												<label for="dag">Décagrammes</label>
											</div>
											<div class="col">
												<input type="checkbox" id="g">
												<label for="g">grammes</label>
											</div>
											
											<div class="col">
												<input type="checkbox" id="shoe_size">
												<label for="shoe_size">Pointures</label>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col">
												<input type="checkbox" id="metre">
												<label for="metre">Mètres</label>
											</div>
											<div class="col">
												<input type="checkbox" id="decimetre">
												<label for="decimetre">Décimètres</label>
											</div>
											<div class="col">
												<input type="checkbox" id="centimetre">
												<label for="centimetre">Centimètres</label>
											</div>
											<div class="col">
												<input type="checkbox" id="milimetre">
												<label for="milimetre">Milimètres</label>
											</div>
										</div>


										<label for="product_size" class="lg my-color">MESURE</label>
										<select  class="custom-select form-control input-c" name="product_size[]" id="product_size" multiple>
											<option selected disabled="">les unités pour vêtements</option>
											<option value="XL" class="clothes-option">XL</option>
											<option value="XXL" class="clothes-option">XXL</option>
											<option value="L" class="clothes-option">L</option>
											<option selected disabled="">les unités en mètres</option>
											<?php for ($i=1; $i <= 100; $i++):?>
												<option value="<?= $i == 1 ? $i.' mètre' : $i.' mètres' ?>" class="metre"><?= $i == 1 ? $i.' mètre' : $i.' mètres' ?></option>
											<?php endfor; ?>
											<?php for ($i=1; $i <= 100; $i++):?>
												<option value="<?= $i == 1 ? $i.' centimètre' : $i.' centimètres' ?>" class="centimetre"><?= $i == 1 ? $i.' centimètre' : $i.' centimètres' ?></option>
											<?php endfor; ?>
											<?php for ($i=1; $i <= 100; $i++):?>
												<option value="<?= $i == 1 ? $i.' décimètre' : $i.' décimètres' ?>" class="decimetre"><?= $i == 1 ? $i.' décimètre' : $i.' décimètres' ?></option>
											<?php endfor; ?>
											<?php for ($i=1; $i <= 100; $i++):?>
												<option value="<?= $i == 1 ? $i.' milimètre' : $i.' milimètres' ?>" class="milimetre"><?= $i == 1 ? $i.' milimètre' : $i.' milimètres' ?></option>
											<?php endfor; ?>
											<option selected disabled="">les unités en grammes</option>
											<?php for ($i=1; $i <= 100; $i++):?>
												<option value="<?= $i == 1 ? $i.' kilogramme' : $i.' kilogrammes' ?>" class="kilogramme"><?= $i == 1 ? $i.' kilogramme' : $i.' kilogrammes' ?></option>
											<?php endfor; ?>
											<?php for ($i=1; $i <= 100; $i++):?>
												<option value="<?= $i == 1 ? $i.' hectogramme' : $i.' hectogrammes' ?>" class="hectogramme"><?= $i == 1 ? $i.' hectogramme' : $i.' hectogrammes' ?></option>
											<?php endfor; ?>
											<?php for ($i=1; $i <= 100; $i++):?>
												<option value="<?= $i == 1 ? $i.' décagramme' : $i.' décagrammes' ?>" class="decagramme"><?= $i == 1 ? $i.' décagramme' : $i.' décagrammes' ?></option>
											<?php endfor; ?>
											<?php for ($i=1; $i <= 100; $i++):?>
												<option value="<?= $i == 1 ? $i.' gramme' : $i.' grammes' ?>" class="gramme"><?= $i == 1 ? $i.' gramme' : $i.' grammes' ?></option>
											<?php endfor; ?>
											<option selected disabled="">les unités pour chaussures</option>
											<?php for($i = 20 ; $i <= 50 ; $i++): ?>
												<option value="<?= $i ?>" class="pointure"><?= $i ?></option>
											<?php endfor; ?>	
										</select>
									</div>
								</div>
							</div>
						</div>

						<br>
						<div class="row cadre">
							<div class="col-md-6 offset-md-3">
								<?php if(!isset($_GET['update'])): ?>
								
									<input type="submit" class="form-control btn-add-product btn my-color" name="add_product" value="Ajouter">
									
								<?php else:?>
									
									<input type="submit" class="form-control btn-add-product btn my-color" name="update_product" value="Modifier">
									
								<?php endif; ?>
							</div>
						</div>
					</div>
				</form>

			</div>
		</div>

		<br>
		<!--<div class="row">
			<div class="col">
				<form method="post">
					<div class="row">
						<div class="col">
							
								<h5 class="my-modal-title">Ajouter une nouvelle catégorie.</h5>
							
						
						</div>
					</div>

					<br>
					<div class="row">
						<div class="col">
			
								<input type="text" class="form-control" name="new_category" placeholder="Nouvelle catégorie...">
						
						</div>
					</div>

					<br>
					<div class="row">
						
						<div class="col">
						
	
								<input type="submit" name="add_category" class="btn btn-primary add-btn w-100" value="Ajouter"/>
		
					
						</div>
					</div>
				</form>
			</div>
		</div>-->

	</div>
</div>