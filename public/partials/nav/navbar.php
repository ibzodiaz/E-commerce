<div id="pubs">
    <marquee behavior="alternate" direction="right">
        <div class="container">
            
            <div class="row">
                
                <div class="col">
                    <p class="text-center">Pour plus d'infos veuillez contacter ce numero +221 77 784 37 55 ou cette adresse email ibzodiaz32@gmail.com</p>
                    <p class="text-center">I-SHOP sen shop !</p>
                </div>
            </div>
            
        </div>
    </marquee>
</div>

<div class="alert-warning">
    <span><i class="fa-solid fa-triangle-exclamation"></i>&nbsp;Veuillez saisir quelque chose à rechercher !</span>
</div>

<?php require_once "includes/notification.php" ?>
<header id="nav"> 

    <div class="container-fluid">
        
        <div class="navb-logo">
            <a href="<?= URL ?>">
                <!--<img src="public/images/logo/I-Shop.gif" alt="Logo">-->
                <h3>I-Shop</h3>
            </a>
        </div>
        <div class="navb-items d-none d-xl-flex">
     

            <div class="item <?= isset($_GET['url']) && $_GET['url'] == 'product' ? 'activate' :'' ?>">
                <a href="index.php?url=product"><img src="public/images/bx-purchase-tag.svg" class="bx-cart-download">Boutiques</a>
            </div>

            <div class="item <?= isset($_GET['url']) && $_GET['url'] == 'help' ? 'activate' :'' ?>">
                <a href="index.php?url=help">Aide ?</a>
            </div>

            <div class="item-search">
               <span class="search-look"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></span>

               <div class="rs-search">
                    <form method="post" action="index.php?url=search">
                        <input type="text" name="q" placeholder="Recherche par produit,catégorie,description,nom ou prénom du vendeur..." class="form-control input-search">
                        <!--<span class="search-look"><i class="fa-solid fa-xmark"></i></span>-->
                        <input type="submit" type="button" class="btn-search" name="submit_search" value="rechercher">
                    </form>
                    
                </div>
            </div>

            <div class="box-notif">
                <a href="index.php?url=shopping"><img src="public/images/bx-cart-alt.svg" class="bx-cart-download"><span class="notif"><?= isset($_COOKIE['pln']) ? count(stringToArray($_COOKIE['pln'])) : 0 ?></span></i></a>
            </div>

            <?php if(isset($_SESSION['customer'])): ?>
                <div class="user-name">
                    <p><?= $_SESSION['customer'] ?></p>
                </div>
            <?php endif;?>

            <div class="dropdown d-p-down">
                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-sharp fa-solid fa-circle-user"></i>
                </button>
                <?php if(isset($_SESSION['customer'])): ?>
                    <ul class="dropdown-menu">
                        <li class="my-link-item"><a href="index.php?url=customerdetails"><i class="fa-solid fa-user-plus"></i>Mon compte</a></li>
                        <li class="my-link-item"><a href="index.php?url=updatepassword"><i class="fa-solid fa-gear"></i>Changer de mot de passe</a></li>
                        <li class="my-link-item"><a href="index.php?url=order"><i class="fa-solid fa-arrow-up-wide-short"></i>Commandes</a></li>
                        <li class="li-btn"><a class="btn-color-c" href="index.php?url=deconnexion"><i class="bx bx-log-out"></i>Deconnexion</a></li>
                    </ul>
                <?php else: ?>
                    <ul class="dropdown-menu">
                        <li class="li-btn"><a class="btn-color-c" href="index.php?url=form"><i class="fa-solid fa-right-to-bracket"></i>Se connecter</a></li>
                        <li class="my-link-item"><a class="text-center" href="index.php?url=registration"><i class="fa-solid fa-user-plus"></i>S'inscrire</a></li>
                    </ul>
                <?php endif;?>
            </div>
    
        </div>

        <div class="nav-shopping d-lg-none">
            <a href="index.php?url=shopping"><img src="public/images/bx-cart-alt.svg" class="bx-cart-download">&nbsp;<span class="notif"><?= isset($_COOKIE['pln']) ? count(stringToArray($_COOKIE['pln'])) : 0 ?></span></a>
        </div>

        <!-- Button trigger modal -->
        <div class="mobile-toggler d-lg-none">
            <a href="#" data-bs-toggle="modal" data-bs-target="#navbModal">
                <i class="fa-solid fa-bars"></i>
            </a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="navbModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <a href="<?= URL ?>">
                            <!--<img src="public/images/logo/logo-variant.png" alt="Logo">-->
                            <h3 style="color: #fff;">I-Shop</h3>
                        </a>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                        
                    </div>

                    <div class="modal-body">

                        <div class="modal-line">

                            <form method="post" action="index.php?url=search">
                                <input type="text" name="q" placeholder="Recherche..." class="form-control mobile-input-search">
                                <input type="submit" type="button" class="mobile-btn-search" name="submit_search" value="rechercher">
                            </form>
                         
                        </div>
                        

                        <div class="modal-line">
                            <a href="index.php?url=product"><i class="fa-sharp fa-solid fa-shirt"></i>Boutiques</a>
                        </div>


                        <div class="modal-line">
                            <a href="index.php?url=help"><i class="fa-solid fa-info"></i>Aide ?</a>
                        </div>

                        <?php for($i = 0 ; $i < count($_allCategories); $i++ ): ?>
                            <div class="modal-line">
                                <a href="index.php?url=category&article=<?= $_allCategories[$i]->getCategory_name() ?>"><i class="fa-solid <?= $i < count($_fontawsome) ? $_fontawsome[$i] : "" ?>"></i><span class="categories-name"><?= $_allCategories[$i]->getCategory_name() ?></span></a>
                            </div>
                        <?php endfor;?>


                        <?php if(isset($_SESSION['customer'])): ?>
                            <div class="modal-line">
                                <a href="#"><i class="fa-sharp fa-solid fa-circle-user"></i><?= $_SESSION['customer'] ?></a>
                            </div>
                            <div class="modal-line">
                                <a href="index.php?url=updatepassword"><i class="fa-solid fa-gear"></i>Changer de mot de passe</a>
                            </div>
                            <div class="modal-line">
                                <a href="index.php?url=customerdetails"><i class="fa-solid fa-user-plus"></i>Mon compte</a>
                            </div>
                            <div class="modal-line">
                                <a href="index.php?url=order"><i class="fa-solid fa-arrow-up-wide-short"></i>Commandes</a>
                            </div>
                            <a href="index.php?url=deconnexion" class="navb-button" type="button"><i class="fas fa-sign-out-alt"></i>Deconnexion</a>

                        <?php else: ?>
                            <div class="modal-line">
                                <a href="index.php?url=registration"><i class="fa-solid fa-user-plus"></i>S'inscrire</a>
                            </div>

                            <a href="index.php?url=form" class="navb-button" type="button"><i class="fa-sharp fa-solid fa-circle-user"></i>Connexion</a>
                        <?php endif; ?>
                    </div>

                    <div class="mobile-modal-footer">
                        
                        <a target="_blank" href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a target="_blank" href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        <a target="_blank" href="#"><i class="fa-brands fa-youtube"></i></a>
                        <a target="_blank" href="#"><i class="fa-brands fa-facebook"></i></a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</header>
