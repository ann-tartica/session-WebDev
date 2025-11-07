<?php

include "database.php";


$sql1 = "SELECT COUNT(*) as total from products";
$result = mysqli_query($conn, $sql1);

$row = mysqli_fetch_assoc($result);
$total_amount_products = $row['total'];

function allProducts(){
global $total_amount_products, $conn;

    echo "<div class=\"container\">";
    echo "<h2 class=\"text-center mb-4\">Featured Products</h2>";
    echo "<div class=\"row g-4\">";

    for ($i = 1; $i <= $total_amount_products; $i++) {
        $query = "SELECT * FROM products WHERE id = {$i}";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            $id = $row['id'];
            $price = number_format($row['price'], 2);
            $prod_name = $row['prod_name'];
            $info = $row['info'];
            $stock = $row['stock'];
            $img = $row['img'];



            echo "<div class=\"col-md-4 mb-4\">
                <div class=\"card h-100 shadow-sm\">
                    <img src=\"img/products/{$img}\"
                        class=\"img-zoom-limit\"
                        alt=\"{$prod_name}\"
                        onerror=\"this.src='img/placeholder.png'; this.alt='Image not available';\">

                    <div class=\"card-body d-flex flex-column\">
                        <div class=\"flex-grow-1\">
                            <h5 class=\"fw-bold fs-3\">{$prod_name}</h5>
                            <p class=\"fs-5 text-truncate\">{$info}</p>
                            <p class=\"fw-bold fs-5\">\${$price}</p>
                            <p class=\"text-muted fs-6\">Stock:{$stock}</p>
                        </div>
                        <a href=\"product.php?id={$id}\" class=\" btn btn-primary w-100 mt-2\">View Details</a>
                    </div>
                </div>
            </div>";
        }
    }
    echo "</div></div>";
}

function featuredProducts()
{
    global $conn;
    $query = "SELECT * FROM products ORDER BY RAND() LIMIT 4";
    $result = mysqli_query($conn, $query);

    echo "<div class=\"container\">";
    echo "<h2 class=\"text-center mb-4\">Featured Products</h2>";
    echo "<div class=\"row g-4\">";

    while ($row = mysqli_fetch_assoc($result)) {
        $prod_name = $row['prod_name'];
        $price = number_format($row['price'], 2);
        $id = $row['id'];
        $info = $row['info'];
        $stock = $row['stock'];
        $img = $row['img'];

        echo "<div class=\"col-md-4 mb-4\">
                <div class=\"card h-100 shadow-sm\">
                    <!-- Placeholder product image -->
                    <img src=\"img/products/{$img}\"
                        class=\"img-zoom-limit\"
                        alt=\"{$prod_name}\">

                    <div class=\"card-body d-flex flex-column\">
                        <h5 class=\"fw-bold fs-3\">{$prod_name}</h5>
                        <p class=\"fs-5 text-truncate\">{$info}</p>
                        <p class=\"fw-bold fs-5\">\${$price}</p>
                        <p class=\"text-muted fs-6\">Stock:{$stock}</p>
                        <a href=\"product.php?id={$id}\" class=\" btn btn-primary w-100 mt-2\">View Details</a>
                    </div>
                </div>
            </div>";
    }

    echo "</div></div>";
}

if (isset($_POST['action']) && $_POST['action'] === 'update_quantity') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $user_id = $_SESSION['user_id'];

    // Update the quantity in the database
    $update = "UPDATE cart SET quantity = '$quantity' WHERE user_id = '$user_id' AND prod_id = '$product_id'";
    mysqli_query($conn, $update);

    // Recalculate totals
    $query = "SELECT SUM(products.price * cart.quantity) AS subtotal FROM cart JOIN products ON cart.prod_id = products.prod_id WHERE cart.user_id = '$user_id'";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
    $subtotal = $result['subtotal'];
    $total = $subtotal; // Add tax/shipping if needed

    echo json_encode(['success' => true, 'subtotal' => $subtotal, 'total' => $total]);
    exit;
}



?>
