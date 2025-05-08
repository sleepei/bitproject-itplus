<?php
require_once 'db.php';
session_start();

$product_id = $_GET['product_id'] ?? null;

if (!$product_id || !is_numeric($product_id)) {
    die('Invalid product specified.');
}

// Fetch product details
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die('Product not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store Information - IT PLUS LIMITED</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <style>
        .store-info {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .store-info h2 {
            margin-bottom: 20px;
        }
        .store-info p {
            font-size: 1.1rem;
        }
        .product-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">IT PLUS LIMITED</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="product_categories.php">Product Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact_us.php">Contact Us</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="myAccountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="myAccountDropdown">
                            <li><a class="dropdown-item" href="account_dashboard.php">Account Dashboard</a></li>
                            <li><a class="dropdown-item" href="view_cart.php">View Cart</a></li>
                            <li><a class="dropdown-item" href="view_wishlist.php">View Wish List</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="my_account.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="store-info text-center">
        <h2>Store Information</h2>
        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
        <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
        <p><strong>Location:</strong> Trinidad and Tobago, Port of Spain</p>
        <p>This is the store location where you can purchase this product. More details will be added later.</p>
    </div>

    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; <?php echo date("Y"); ?> IT PLUS LIMITED. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
