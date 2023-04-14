<div class="home-content">

		<div class="container">
			<div class="row">
				<div class="col">
					<?php $number = 0; ?>
					<?php foreach($sellerStock as $category_name => $count): ?>
						<?php $number = $number + $count[1]->count; ?>
					<?php endforeach; ?>

					<h4 class="text-center">Le nombre total d'article dans le stock est de <?= $number ?></h4>
				</div>
			</div>
			<div class="row">
				<?php foreach($sellerStock as $category_name => $count): ?>
				<div class="col-md-6 mb-4">

					<div class="overview-boxes overview-box-max-lg">
						<div class="box box-max-lg">
							<div class="right-side">
								<div class="box-topic"><?= $category_name ?></div>
								<div class="number"><?= $count[1]->count ?> articles</div>
								<div class="indicator">
								  <i class="bx bx-up-arrow-alt"></i>
								  <span class="text">Nombre d'articles disponibles</span>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<?php endforeach; ?>
			</div>
			
		</div>
		
	
</div>
