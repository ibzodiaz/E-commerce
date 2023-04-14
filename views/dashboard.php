<?php require_once "includes/esnotifs.php"; ?>
<div class="sidebar text-light">
  <div class="logo-details">
    <i class="bx bx-grid-alt"></i>
    <span class="logo_name">I-SHOP</span>
  </div>
  <ul class="nav-links">
    <li>
      <a href="index.php?url=seller" class="<?= !isset($_GET['c']) ? 'active' : '' ?>">
        <i class="fa-solid fa-house"></i>
        <span class="links_name">Accueil</span>
      </a>
    </li>
    <li>
      <a href="index.php?url=seller&c=products" class="<?= isset($_GET['c']) && $_GET['c'] == 'products' ? 'active' : '' ?>">
        <i class="fa-regular fa-eye"></i>
        <span class="links_name">Aperçu</span>
      </a>
    </li>
    <li>
      <a href="index.php?url=seller&c=orders" class="<?= isset($_GET['c']) && $_GET['c'] == 'orders' ? 'active' : '' ?>">
        <i class="fa-regular fa-paper-plane"></i>
        <span class="links_name">Commandes&nbsp;<span class="no" data-count="<?= abs(count($order)-$count) ?>" id="notif_counter"><?= abs(count($order)-$count) ?></span></span>
      </a>
    </li>
    <li>
      <a href="index.php?url=seller&c=analyze" class="<?= isset($_GET['c']) && $_GET['c'] == 'analyze' ? 'active' : '' ?>">
        <i class="fa-solid fa-chart-line"></i>
        <span class="links_name">Analyses</span>
      </a>
    </li>
    <li>
      <a href="index.php?url=seller&c=stock" class="<?= isset($_GET['c']) && $_GET['c'] == 'stock' ? 'active' : '' ?>">
        <i class="bx bx-coin-stack"></i>
        <span class="links_name">Stock</span>
      </a>
    </li>
    <li>
      <a href="index.php?url=seller&c=operations" class="<?= isset($_GET['c']) && $_GET['c'] == 'operations' ? 'active' : '' ?>">
        <i class="fa-solid fa-plus"></i>
        <span class="links_name">Produits</span>
      </a>
    </li>

    <li>
      <a href="index.php?url=seller&c=allproducts" class="<?= isset($_GET['c']) && $_GET['c'] == 'allproducts' ? 'active' : '' ?>">
        <i class="bx bx-list-ul"></i>
        <span class="links_name">Liste des produits</span>
      </a>
    </li>

    <li>
      <a href="index.php?url=seller&c=user">
        <i class="bx bx-user"></i>
        <span class="links_name">Utilisateur</span>
      </a>
    </li>

    <li>
      <a href="index.php?url=seller&c=config">
        <i class="fa-solid fa-lock"></i>
        <span class="links_name">Mot de passe</span>
      </a>
    </li>
    
  </ul>
</div>


<section class="home-section">
  <nav>
    <div class="sidebar-button">
      <i class="bx bx-menu sidebarBtn"></i>
      <span class="dashboard">I-Shop</span>
    </div>

    <div class="dropdown d-p-down">
      <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="dash-span"><?= $_SESSION['seller'] ?></span><i class="fa-sharp fa-solid fa-circle-user"></i>
      </button>
      <ul class="dropdown-menu">
        <li></li>
        <li class="log_out">
          <a href="index.php?url=deconnexion">
            <i class="bx bx-log-out"></i>
            <span class="links_name">Déconnexion</span>
          </a>
        </li>
      </ul>
    </div>
      <!--<img src="images/profile.jpg" alt="">-->
      <!--<span class="admin_name"></span>-->

  </nav>

<?php require_once "includes/_loader.php"; ?>
<?php require_once "dashboardComponents/dashRoute.php"; ?>

</section>
<script>
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".sidebarBtn");
  sidebarBtn.onclick = function () {
    sidebar.classList.toggle("active");
    if (sidebar.classList.contains("active")) {
      sidebarBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
  };
</script>