<!-- Créer une boîte de dialogue modale personnalisée -->
<div id="custom-confirm" class="dialog">
  <h3 class="text-center">Infos client</h3>
  <span class="exit"><i class="fa-solid fa-xmark"></i></span>
  <div class="dialog-body">
  	<span class="rs"></span>
  	<?php if(isset($_GET['i'])): ?>
		<p><b>Pénom: </b><?= $order[$_GET['i']]->getCustomer_firstname() ?></p>
		<p><b>Nom: </b><?= $order[$_GET['i']]->getCustomer_lastname() ?></p>
		<p><b>Téléphone: </b><?= $order[$_GET['i']]->getCustomer_phone() ?></p>
		<p><b>Email: </b><?= $order[$_GET['i']]->getCustomer_email() ?></p>
		<p class="text-center"><b style="color:red;">Point de livraison</b></p>
		<p><b>Pays: </b><?= $order[$_GET['i']]->getLocation_customer_country() ?></p>
		<p><b>Region: </b><?= $order[$_GET['i']]->getLocation_customer_region() ?></p>
		<p><b>localité: </b><?= $order[$_GET['i']]->getLocation_customer_street() ?></p>
	<?php endif; ?>
  </div>
</div>
