  </div>
</div>
<script src="public/assets/bootstrap/js/jquery.js"></script>
<script src="public/assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="public/assets/js/slick.js"></script>
<script src="public/assets/js/function.js"></script>
<script src="public/assets/js/script.js"></script>

</body>
<!-- Footer -->
<?php if((!isset($_GET['url']) || $_GET['url'] !="form") && (!isset($_GET['url']) || $_GET['url'] !="registration") ):?>
<footer class="text-center text-lg-start my-content">
  <!-- Section: Social media -->
  <section
    class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom"
  >
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span class="text-color">Vous pouvez nous suivre sur nos différentes plateformes</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-color">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-color">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-color">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-color">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-color">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-color">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4 text-color">
            <i class="fas fa-gem me-3"></i>entreprise
          </h6>
          <p class="text-color">
           I-SHOP 
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 text-color">
            Catégories
          </h6>

          <?php for($i = 0 ; $i < count($_allCategories); $i++ ): ?>
              <div class="text-color">
                  <p><a href="index.php?url=category&article=<?= $_allCategories[$i]->getCategory_name() ?>"><?= $_allCategories[$i]->getCategory_name() ?></a></p>
              </div>
          <?php endfor;?>
        
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 text-color">
            Qui sommes nous?
          </h6>
          <p>
            <a href="#!" class="text-color">Biographie</a>
          </p>
          <p>
            <a href="#!" class="text-color">Histoire</a>
          </p>
          <p>
            <a href="#!" class="text-color">Activité</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 text-color">
            Contacts
          </h6>
          <p class="text-color"><i class="fas fa-home me-3"></i> Sénégal, Dakar</p>
          <p class="text-color">
            <i class="fas fa-envelope me-3"></i>
            ibzodiaz32@gmail.com
          </p>
          <p class="text-color"><i class="fas fa-phone me-3"></i> +221 77 784 37 55</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4 text-color" style="background-color: rgba(0, 0, 0, 0.05);">
    Copyright©2023
  </div>
  <!-- Copyright -->
</footer>
<?php endif; ?>
<!-- Footer -->
</html>