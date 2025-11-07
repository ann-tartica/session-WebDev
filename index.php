<?php
if (session_status() === PHP_SESSION_NONE) {
session_start();
}
include "misc/database.php";
include "misc/cart_handler.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - Vivace</title>
  <link href="./styles.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js">
  <!-- Your custom styles -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

  <!-- NAVBAR -->
    <?php
      include "misc/readypage.php";

      navbar();
      ?>

  <!-- HERO -->
  <header class="text-center text-white py-5 bg-dark" style="background:url(img/assets/bannernotext.png) center/cover no-repeat;">
    <div class="container">
      <h1 class="display-4" id="display-home">VIVACE</h1>
      <p class="lead">Discover premium instruments for your business and hobbies</p>
      <a href="products.php" class="btn btn-primary btn-lg mt-3">
        <i class="fas fa-shopping-bag"></i> Shop Now
      </a>
    </div>
  </header>

  <!-- FEATURED PRODUCTS -->
  <section class="py-5">
    <div class="container">
      <div class="row g-4" id="featured-products">
        <!-- Products will be loaded here -->
        <?php 
          include "misc/cards_handler.php";
          featuredProducts();
        ?>
      </div>
    </div>
  </section>

  <!-- FEATURES -->
  <section class="py-5 bg-dark">
    <div class="container">
      <div class="row g-4">
        <div class="col-md-4 text-center">
          <div class="card h-100 border-0">
            <div class="card-body">
              <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
              <h5 class="card-title">Free Shipping</h5>
              <p  class="card-text mb-0 fw-semibold"> Free shipping on orders over $50!  </p>
       <p class="card-text fst-italic" id="cardspace"> Worldwide delivery on your orders  
              no extra fees, no hidden charges! We believe great products deserve an equally great shopping experience,
               and that starts with stress-free delivery.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card h-100 border-0">
            <div class="card-body">
              <i class="fas fa-undo fa-3x text-primary mb-3"></i>
              <h5 class="card-title">Easy Returns</h5>
              <p class="card-text mb-0 fw-semibold">30-day return policy</p>
              <p class="card-text fst-italic">We want you to love every purchase you make with us. 
                But if something isn’t quite right, 
                our Easy Return Policy has you covered!</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card h-100 border-0">
            <div class="card-body">
              <i class="fas fa-headset fa-3x text-primary mb-3"></i>
              <h5 class="card-title">24/7 Support</h5>
              <p class="card-text mb-0 fw-semibold">Customer support anytime</p>
              <p class="card-text fst-italic">No matter the time or day, our dedicated support team is ready to help. Whether you have questions about your order, 
                need assistance with a product, or just want expert advice — we’re only a message away.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card h-100 border-0">
            <div class="card-body">
              <i class="fas fa-guitar fa-3x text-primary mb-3"></i>
              <h5 class="card-title">Quality Instruments</h5>
              <p class="card-text mb-0 fw-semibold">Highest Quality of Instruments and Tools</p>
              <p class="card-text fst-italic">At Vivace, we are passionate about providing musicians and enthusiasts with instruments that inspire creativity and elevate performance. 
                Each product in our collection is carefully selected for its craftsmanship, sound quality, and durability.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- FOOTER AND MODALS -->
   <?php

      footer();
      modals();
      ?>
  <!-- Login Modal -->
  <!-- <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="loginModalLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="loginForm" novalidate>
            <div class="mb-3">
              <label for="loginEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="loginEmail" name="loginEmail" required>
              <div class="invalid-feedback"></div>
            </div>
            <div class="mb-3">
              <label for="loginPassword" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
                <button class="btn btn-outline-secondary" type="button" id="toggleLoginPassword">
                  <i class="fas fa-eye" id="loginPasswordIcon"></i>
                </button>
              </div>
              <div class="invalid-feedback"></div>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Login
              </button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <p class="mb-0">No account yet? <a href="signup.php" class="text-primary" data-bs-dismiss="modal">Sign up here</a></p>
        </div>
      </div>
    </div>
  </div> -->
  <!-- jQuery & Validation (local) -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script>

  <!-- Your custom modal script -->
  <script src="./js/modals.js?v=2"></script>
  <script src="./js/cart.js"></script>
  <script src="./js/loginsign.js"></script>

</body>
</html>