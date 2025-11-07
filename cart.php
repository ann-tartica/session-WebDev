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
  <title>Shopping Cart - Vivace</title>
  <link href="./styles.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- Your custom styles -->
  <link rel="stylesheet" href="styles.css">
  <style>
    /* Remove spinner arrows from number input */
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    input[type=number] {
      -moz-appearance: textfield; /* Firefox */
    }

  </style>
</head>
<body>

  <!-- NAVBAR -->
    <?php
      include "misc/readypage.php";

      navbar();
      ?>
  <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <i class="fas fa-store"></i> E-Shop
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <button class="nav-link btn btn-link text-white" data-bs-toggle="modal" data-bs-target="#loginModal">
              <i class="fas fa-sign-in-alt"></i> Login
            </button>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="cart.php">
              <i class="fas fa-shopping-cart">Cart</i>
              <span class="badge bg-primary" id="cart-count">0</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav> -->

  <!-- PAGE HEADER -->
  <div class="bg-secondary text-white py-4">
    <div class="container">
      <h1 class="display-5">Shopping Cart</h1>
      <p class="lead">Review your items before checkout</p>
    </div>
  </div>

  <!-- CART CONTENT -->
  <div class="container py-5">
    <div class="row">
      <div class="col-lg-8">
        <div id="cart-items">
          <!-- Cart items will be loaded here -->
           <?php
                showCart();
            ?>
        </div>
      </div>
      <?php 
      $isLoggedIn = isset($_SESSION['user_id']);
      showOrderSummary($isLoggedIn); 
      ?>
      <!-- <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0"id="contact-header">Order Summary</h5>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <span>Subtotal:</span>
              <span id="subtotal">$0.00</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Shipping:</span>
              <span id="shipping">$0.00</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Tax:</span>
              <span id="tax">$0.00</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-3">
              <strong>Total:</strong>
              <strong id="total">$0.00</strong>
            </div>
            <button class="btn btn-success w-100 mb-2" id="checkout-btn" disabled>
              <i class="fas fa-credit-card"></i> Proceed to Checkout
            </button>
            <a href="products.php" class="btn btn-outline-primary w-100">
              <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
          </div>
        </div>
      </div> -->
    </div>
  </div>

  <!-- FOOTER AND MODALS -->
    <?php
  
        footer();
        modals();
        ?>
  <!-- <footer class="bg-dark text-white text-center py-4">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h5>E-Shop</h5>
          <p>Your trusted online shopping destination</p>
        </div>
        <div class="col-md-6">
          <h5>Follow Us</h5>
          <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <hr>
      <p class="mb-0">&copy; 2025 E-Shop | Designed for demo purposes</p>
    </div>
  </footer> -->

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
          <p class="mb-0">No account yet? <a href="signup.html" class="text-primary" data-bs-dismiss="modal">Sign up here</a></p>
        </div>
      </div>
    </div>
  </div> -->
  <!-- jQuery & Validation (local) -->
  <script src="node_modules/jquery/dist/jquery.min.js"></script>
  <script src="node_modules/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="js/cart.js"></script>
  <!-- Your custom modal script -->
  <script src="./js/modals.js"></script>
  <script src="./js/loginsign.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var guestBtn = document.getElementById('guest-checkout-btn');
        if (guestBtn) {
          guestBtn.addEventListener('click', function(e) {
            // Show alert then redirect to login/index
            alert('User is not logged in. Please log in to proceed check out');
            var redirect = guestBtn.getAttribute('data-redirect') || 'index.php';
            window.location.href = redirect;
          });
        }
      });
    </script>
  <!-- <script src="./js/quantity.js"></script> -->
  
</body>
</html>
