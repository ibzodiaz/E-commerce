<div class="home-content">

  <div class="overview-boxes">
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Commande</div>
        <div class="number"><?= $countOrder ?></div>
      </div>
      <i class="bx bx-cart-alt cart"></i>
    </div>
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Vente</div>
        <div class="number"><?= $total_price > 1000 ? number_format($total_price/1000, 1, '.', '').'K'." F" : $total_price." F" ?></div>
      </div>
      <i class="bx bxs-cart-add cart two"></i>
    </div>
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Profit</div>
        <div class="number">12,876 F</div>
      </div>
      <i class="bx bx-cart cart three"></i>
    </div>
    <div class="box">
      <div class="right-side">
        <div class="box-topic">Revenu</div>
        <div class="number">11,086</div>
      </div>
      <i class="bx bxs-cart-download cart four"></i>
    </div>
  </div>

  <div class="sales-boxes">
    <div class="recent-sales box">
      <div class="title">Ventes recentes</div>
      <div class="sales-details">
        <ul class="details">
          <li class="topic">Date</li>
          <?php foreach ($order as $value):?>
            <li><a href="#"><?= $value->getOrder_delivery_date() != null ? $value->getOrder_delivery_date() : "" ?></a></li>
          <?php endforeach; ?>
        </ul>
        <ul class="details">
          <li class="topic">Client</li>
          <?php foreach ($order as $value):?>
            <li><a href="#"><?= $value->getOrder_delivery_date() != null ? $value->getCustomer_firstname() : "" ?></a></li>
          <?php endforeach; ?>
        </ul>
        <ul class="details">
          <li class="topic">Produit</li>
          <?php foreach ($order as $value):?>
            <li><a href="#"><?= $value->getOrder_delivery_date() != null ? $value->getProduct_name() : "" ?></a></li>
          <?php endforeach; ?>
        </ul>
        <ul class="details">
          <li class="topic">Prix</li>
          <?php foreach ($order as $value):?>
            <li><a href="#"><?= $value->getOrder_delivery_date() != null ? $value->getProduct_price()."FCFA" : "" ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="button">
        <a href="index.php?url=seller&c=orders">Voir Tout</a>
      </div>
    </div>
    <div class="top-sales box">
      <div class="title">Produits les plus vendus</div>
      <ul class="top-sales-details">
        <?php foreach($mostSold as $product): ?>

          <li>
            <a href="#">
              <!--<img src="images/sunglasses.jpg" alt="">-->
              <span class="product"><?= $product->getProduct_name() ?></span>
            </a>
            <span class="price"><?= $product->getProduct_price() ?> F</span>
          </li>

        <?php endforeach; ?>
      </ul>
    </div>
  </div>

</div>