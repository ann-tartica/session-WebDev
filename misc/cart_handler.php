<?php
// include "database.php";


// $sql6 = "SELECT COUNT(*) as total from cart";
// $result2 = mysqli_query($conn, $sql6);
// $row2 =  mysqli_fetch_assoc($result2);
// $total_cart_num = $row2['total'];

// if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
//     $id = intval($_GET['id']);
//     $user_id = $_SESSION['user_id'] ?? 0;

//     $query = "SELECT * FROM products WHERE id = $id LIMIT 1";
//     $result = mysqli_query($conn, $query);

//     if ($row = mysqli_fetch_assoc($result)) {
//         $prod_name = $row['prod_name'];
//         $price = $row['price'];

//         $checkQuery = "SELECT * FROM cart WHERE prod_name = '$prod_name' AND user_id = $user_id LIMIT 1";
//         $checkResult = mysqli_query($conn, $checkQuery);

//         if (mysqli_num_rows($checkResult) > 0) {
//             $updateQuery = "UPDATE cart SET quantity = quantity + 1 WHERE prod_name = '$prod_name' AND user_id = $user_id";
//             mysqli_query($conn, $updateQuery);
//         } else {
//             $insertQuery = "INSERT INTO cart (user_id, prod_name, quantity, price)
//                             VALUES ($user_id, '$prod_name', 1, '$price')";
//             mysqli_query($conn, $insertQuery);
//         }

//         echo "<script>alert('{$prod_name} added to cart!');</script>";
//     }
// }



// # Remove from cart
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cart_item'])) {
//     $cart_item = filter_input(INPUT_POST, 'cart_item', FILTER_SANITIZE_SPECIAL_CHARS);

//     $delete_query = "DELETE FROM cart WHERE prod_name = '$cart_item' LIMIT 1";
//     if (mysqli_query($conn, $delete_query)) {
//         echo "<script>alert('{$cart_item} removed from cart!');</script>";
//         // Optional: refresh the page to update the cart
//         echo "<script>window.location.href = 'cart.php';</script>";
//     } else {
//         echo "<script>alert('Failed to remove item.');</script>";
//     }
// }

// #Proceed to Checkout
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
//     #$checkout = filter_input(INPUT_POST, 'checkout', FILTER_SANITIZE_SPECIAL_CHARS);
//     $checkout = true;
//     $query = "TRUNCATE TABLE cart";
//     if (mysqli_query($conn, $query) && $checkout) {
//         echo "<script>alert(\"Thank you for shopping with us!\")</script>";
//     } else {
//         echo "<script>Something went wrong!</script>";
//     }
// }

// function showCartTotal ()
// {
//     $carttotal = <<<HTML
//             <div class="text-end mt-4 cart-total">
//                 <h4 id="cart-total">Total: $0.00</h4>
//                 <form action="cart.php" method="post">
//                     <input type="hidden" name="checkout" value="checkout">
//                     <button type="submit" class="btn btn-success"> Proceed to Checkout</button>
//                 </form>
//             </div>
//     HTML;

//     echo $carttotal;
// }

// function getCartCount()
// {
//     global $conn;
//     $query = "SELECT COUNT(*) AS counted FROM cart";
//     $result = mysqli_query($conn, $query);
//     $row = mysqli_fetch_assoc($result);
//     return (int)$row['counted'];
// }



// function showCart()
// {
//     global $conn;

//     $user_id = $_SESSION['user_id'] ?? 0;
//     // $query = "SELECT * FROM cart WHERE user_id = $user_id";

//     $count = "SELECT COUNT(*) as counted FROM cart;";
//     $countres = mysqli_query($conn, $count);
//     $countrow = mysqli_fetch_assoc($countres);
//     $counted = getCartCount();

//     if ($counted == 0)
//     {
//         $html = <<<HTML
//             <div id="empty-cart" class="text-center py-5">
//                 <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
//                 <h3>Cart is empty.</h3>
//                 <p class="text-muted">Add some products to get started!</p>
//                 <a href="products.php" class="btn btn-primary">
//                     <i class="fas fa-shopping-bag">Continue Shopping</i>
//                 </a>
//             </div>
//             <script>
//                 $(".cart").hide();
//             </script>
//         HTML;
//         echo $html;
//     }
//     else
//     {
//         $query = "SELECT cart.id AS cart_id, cart.quantity, products.id AS prod_id, products.prod_name, products.price, products.img
//                 FROM cart
//                 JOIN products ON cart.prod_name = products.prod_name
//                 ";

//         $result = mysqli_query($conn, $query);
        
//             while ($row = mysqli_fetch_assoc($result)) {
//             $prod_name = $row['prod_name'];
//             $price = $row['price'];
//             $amount = $row['quantity'];
//             $img = $row['img'];

            

//             //TODO: FIX THIS
//             //done
//             $html = <<<HTML
//                     <div class="card mb-3" data-id="{$row['prod_id']}">
//                     <div class="row g-0">
//                         <div class="col-md-2">
//                         <img src="img/{$img}" class="img-fluid rounded-start" alt="{$prod_name}">
//                         </div>
//                         <div class="col-md-6">
//                         <div class="card-body">
//                             <h5 class="card-title">{$prod_name}</h5>
//                             <p class="card-text text-muted">Quantity: {$amount}</p>
//                             <p class="card-text"><strong>₱{$price}</strong></p>
//                         </div>
//                         </div>
//                         <div class="col-md-4">
//                         <div class="card-body d-flex align-items-center justify-content-between">
//                             <div class="input-group" style="width: 120px;">
//                             <button class="btn btn-outline-secondary" type="button">-</button>
//                             <input type="number" class="form-control text-center" value="{$amount}" min="1">
//                             <button class="btn btn-outline-secondary" type="button">+</button>
//                             </div>
//                             <form method="post" action="cart.php">
//                             <input type="hidden" name="cart_item" value="{$prod_name}">
//                             <button class="btn btn-outline-danger" type="submit">
//                                 <i class="fas fa-trash"></i>
//                             </button>
//                             </form>
//                         </div>
//                         </div>
//                     </div>
//                     </div>
//                     HTML;
            
//                 echo $html;
//        }
//     }
// }

// # --- Update cart quantity (AJAX) ---
// if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_cart'])) {
//     $prod_name = mysqli_real_escape_string($conn, $_POST['prod_name']);
//     $quantity = intval($_POST['quantity']);

//     if ($quantity <= 0) {
//         // If quantity becomes 0 or less, delete the item
//         $delete_query = "DELETE FROM cart WHERE prod_name = '$prod_name' LIMIT 1";
//         mysqli_query($conn, $delete_query);
//     } else {
//         // Otherwise, update quantity
//         $update_query = "UPDATE cart SET quantity = $quantity WHERE prod_name = '$prod_name'";
//         mysqli_query($conn, $update_query);
//     }

//     // Return the updated subtotal
//     $subtotal_query = "SELECT SUM(price * quantity) AS subtotal FROM cart";
//     $res = mysqli_query($conn, $subtotal_query);
//     $subtotal = mysqli_fetch_assoc($res)['subtotal'] ?? 0;

//     echo json_encode(["success" => true, "subtotal" => number_format($subtotal, 2)]);
//     exit;
// }
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "database.php";

/* ================================================================
   CART HANDLER (Clean & Organized)
   - Handles add, remove, checkout, and display
   - Supports user-based cart if user_id exists
================================================================ */

// -------------------- CART COUNT --------------------
function getCartCount()
{
    global $conn;
    $query = "SELECT COUNT(*) AS counted FROM cart";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    return (int)$row['counted'];
}

// -------------------- ADD TO CART --------------------
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $user_id = $_SESSION['user_id'] ?? 0;

    // Fetch product info
    $query = "SELECT * FROM products WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $prod_name = mysqli_real_escape_string($conn, $row['prod_name']);
        $price = $row['price'];

        // Check if already in cart
        $checkQuery = "SELECT * FROM cart WHERE prod_name = '$prod_name' AND user_id = $user_id LIMIT 1";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $updateQuery = "UPDATE cart 
                            SET quantity = quantity + 1 
                            WHERE prod_name = '$prod_name' AND user_id = $user_id";
            mysqli_query($conn, $updateQuery);
        } else {
            $insertQuery = "INSERT INTO cart (user_id, prod_name, quantity, price) 
                            VALUES ($user_id, '$prod_name', 1, '$price')";
            mysqli_query($conn, $insertQuery);
        }

        echo "<script>alert('{$prod_name} added to cart!');</script>";
    } else {
        echo "<script>alert('Product not found.'); window.location='products.php';</script>";
    }
    $_SESSION['cart_success'] = "✅ Product added to cart!";
    header("Location: ../cart.php");
    exit();
}


// -------------------- REMOVE FROM CART --------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['cart_item'])) {
    $cart_item = mysqli_real_escape_string($conn, $_POST['cart_item']);
    $user_id = $_SESSION['user_id'] ?? 0;

    $delete_query = "DELETE FROM cart WHERE prod_name = '$cart_item' AND user_id = $user_id LIMIT 1";
    if (mysqli_query($conn, $delete_query)) {
        echo "<script>alert('{$cart_item} removed from cart!'); window.location.href = 'cart.php';</script>";
    } else {
        echo "<script>alert('Failed to remove item.');</script>";
    }
}


// -------------------- CHECKOUT --------------------
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['checkout'])) {
    // Server-side check: only logged-in users can checkout
    if (!isset($_SESSION['user_id'])) {
        echo "<script>
            alert('User is not logged in. Please log in to proceed check out');
            window.location.href = 'index.php';
        </script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $query = "DELETE FROM cart WHERE user_id = $user_id";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Thank you for shopping with us!'); window.location.href = 'products.php';</script>";
    } else {
        echo "<script>alert('Something went wrong!');</script>";
    }
}


// -------------------- DISPLAY CART --------------------
function showCart()
{
    global $conn;

    $user_id = $_SESSION['user_id'] ?? 0;
    $counted = getCartCount();

    if ($counted == 0) {
        echo <<<HTML
        <div id="empty-cart" class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
            <h3>Cart is empty.</h3>
            <p class="text-muted">Add some products to get started!</p>
            <a href="products.php" class="btn btn-primary">
                <i class="fas fa-shopping-bag"></i> Continue Shopping
            </a>
        </div>
        <script>$(".cart").hide();</script>
        HTML;
        return;
    }

    $query = "SELECT cart.id AS cart_id, cart.quantity, products.id AS prod_id, 
                     products.prod_name, products.price, products.img
              FROM cart
              JOIN products ON cart.prod_name = products.prod_name
              WHERE cart.user_id = $user_id";

    $result = mysqli_query($conn, $query);
    $subtotal = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $prod_name = htmlspecialchars($row['prod_name']);
        $price = $row['price'];
        $amount = $row['quantity'];
        $img = htmlspecialchars($row['img']);
        $subtotal += $price * $amount;

        echo <<<HTML
        <!-- <div class="card mb-3" data-id="{$row['prod_id']}">
            <div class="row g-0">
                <div class="col-md-2">
                    <img src="img/{$img}" class="img-fluid rounded-start" alt="{$prod_name}">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <h5 class="card-title">{$prod_name}</h5>
                        <p class="card-text text-muted">Quantity: {$amount}</p>
                        <p class="card-text"><strong>₱{$price}</strong></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="input-group" style="width: 120px;">
                            <button class="btn btn-outline-secondary" type="button">-</button>
                            <input type="number" class="form-control text-center" value="{$amount}" min="1">
                            <button class="btn btn-outline-secondary" type="button">+</button>
                        </div>
                        <form method="post" action="cart.php">
                            <input type="hidden" name="cart_item" value="{$prod_name}">
                            <button class="btn btn-outline-danger" type="submit">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-2">
              <img src="img/${img}" class="img-fluid rounded-start" alt="${prod_name}">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title">${prod_name}</h5>
                    <p class="card-text text-muted">Quantity: ${amount}</p>
                    <p class="card-text"><strong>₱${price}</strong></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div class="input-group" style="width: 120px;">
                        <button class="btn btn-outline-secondary" type="button">-</button>
                        <input type="number" class="form-control text-center" value="${amount}" min="1">
                        <button class="btn btn-outline-secondary" type="button">+</button>
                    </div>
                </div>
                <form method="post" action="cart.php">
                    <input type="hidden" name="cart_item" value="{$prod_name}">
                    <button class="btn btn-outline-danger" type="submit">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        </div> -->
        <div class="cart-card p-3">
      <div class="row g-3 align-items-center">
        <div class="col-md-2 text-center">
          <img src="img/products/{$img}" alt="{$prod_name}" class="img-fluid rounded">
        </div>
        <div class="col-md-5">
          <h5 class="mb-1">{$prod_name}</h5>
          <p class="mb-1 text-muted">Quantity: {$amount}</p>
          <p class="mb-0"><strong>₱{$price}</strong></p>
        </div>
        <div class="col-md-3 d-flex justify-content-center">
          <div class="input-group input-group-sm" style="width: 120px;">
            <button class="btn btn-outline-secondary" type="button">-</button>
            <input type="number" class="form-control text-center" value="{$amount}" min="1">
            <button class="btn btn-outline-secondary" type="button">+</button>
          </div>
        </div>
        <div class="col-md-2 text-center">
          <form method="post" action="cart.php">
            <input type="hidden" name="cart_item" value="{$prod_name}">
            <button class="btn btn-outline-danger btn-sm" type="submit">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
    HTML;
    }
    showCartTotal($subtotal);
}


// -------------------- CART TOTAL --------------------
function showCartTotal($subtotal)
{
    $formattedTotal = number_format($subtotal, 2);
    echo <<<HTML
    <div class="text-end mt-4 cart-total">
        <h4 id="cart-total">Total: ₱{$formattedTotal}</h4>
        <form action="cart.php" method="post">
            <input type="hidden" name="checkout" value="checkout">
            <button type="submit" class="btn btn-success">Proceed to Checkout</button>
        </form>
    </div>
    HTML;
}

function showOrderSummary($isLoggedIn = false)
{
    global $subtotal;
    $formattedTotal = number_format($subtotal, 2);

    if ($isLoggedIn) {
        $checkoutBtn = '<button type="submit" class="btn btn-success w-100 mb-2" id="checkout-btn">
                     <i class="fas fa-credit-card"></i> Proceed to Checkout
                 </button>';
    } else {
        // For guests: alert and redirect on click
        $checkoutBtn = '<button type="button" class="btn btn-success w-100 mb-2" onclick="alert(\'User is not logged in. Please log in to proceed check out\'); window.location.href=\'index.php\';">
                     <i class="fas fa-sign-in-alt"></i> Login to Checkout
                 </button>';
    }

    echo <<<HTML
    <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0" id="contact-header">Order Summary</h5>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <span>Subtotal:</span>
              <span id="subtotal">₱{$formattedTotal}</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Shipping:</span>
              <span id="shipping">₱0.00</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Tax:</span>
              <span id="tax">₱0.00</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-3">
              <strong>Total:</strong>
              <strong id="total">₱{$formattedTotal}</strong>
            </div>
            <form action="cart.php" method="post">
                <input type="hidden" name="checkout" value="checkout">
                {$checkoutBtn}
            </form>
            <a href="products.php" class="btn btn-outline-primary w-100">
              <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
          </div>
        </div>
      </div>
    HTML;
}


// -------------------- UPDATE CART (AJAX) --------------------
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_cart'])) {
    $prod_name = mysqli_real_escape_string($conn, $_POST['prod_name']);
    $quantity = intval($_POST['quantity']);
    $user_id = $_SESSION['user_id'] ?? 0;

    if ($quantity <= 0) {
        $delete_query = "DELETE FROM cart WHERE prod_name = '$prod_name' AND user_id = $user_id LIMIT 1";
        mysqli_query($conn, $delete_query);
    } else {
        $update_query = "UPDATE cart SET quantity = $quantity WHERE prod_name = '$prod_name' AND user_id = $user_id";
        mysqli_query($conn, $update_query);
    }

    $subtotal_query = "SELECT SUM(price * quantity) AS subtotal FROM cart WHERE user_id = $user_id";
    $res = mysqli_query($conn, $subtotal_query);
    $subtotal = mysqli_fetch_assoc($res)['subtotal'] ?? 0;

    echo json_encode(["success" => true, "subtotal" => number_format($subtotal, 2)]);
    exit;
}


?>
