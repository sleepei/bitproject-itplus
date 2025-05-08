<?php
require_once 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: my_account.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch cart items with product details and product id
$stmt = $pdo->prepare('
    SELECT ci.id as cart_item_id, ci.quantity, p.id as product_id, p.name, p.price, p.image_url, p.stock
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.id
    WHERE ci.user_id = ?
');
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Shopping Cart - IT PLUS LIMITED</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
    <style>
        .update-quantity-btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
            height: auto;
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
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Theme
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
                            <li><a class="dropdown-item theme-option" href="#" data-theme="onyx">Onyx (Midnight)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="ocean">Ocean (Dark Blue)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="default">Default (Light)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="lavender">Lavender (Purple Light)</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-primary text-white text-center py-5">
        <h1>Your Shopping Cart</h1>
    </header>

    <section class="container my-5">
        <?php if (count($cart_items) > 0): ?>
            <div class="row g-4">
                <?php foreach ($cart_items as $item): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="card-text">
                                    <strong>Quantity:</strong>
                                    <input type="number" min="1" max="<?php echo (int)$item['stock']; ?>" value="<?php echo (int)$item['quantity']; ?>" class="form-control quantity-input" style="width: 80px; display: inline-block;" data-cart-item-id="<?php echo (int)$item['cart_item_id']; ?>" data-product-name="<?php echo htmlspecialchars($item['name']); ?>" data-product-id="<?php echo (int)$item['product_id']; ?>">
                                    <button type="button" class="btn btn-sm btn-primary update-quantity-btn" data-cart-item-id="<?php echo (int)$item['cart_item_id']; ?>" data-product-name="<?php echo htmlspecialchars($item['name']); ?>" data-product-id="<?php echo (int)$item['product_id']; ?>">Update</button>
                                </p>
                                <p class="card-text"><strong>Price per item:</strong> $<?php echo number_format($item['price'], 2); ?></p>
                                <p class="card-text"><strong>Total:</strong> $<?php echo number_format($item['price'] * $item['quantity'], 2); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">Your shopping cart is empty.</p>
        <?php endif; ?>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> IT PLUS LIMITED. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const savedTheme = localStorage.getItem('selectedTheme') || 'default';
            setTheme(savedTheme);

            document.querySelectorAll('.theme-option').forEach(function (el) {
                el.addEventListener('click', function (e) {
                    e.preventDefault();
                    const theme = this.getAttribute('data-theme');
                    setTheme(theme);
                    localStorage.setItem('selectedTheme', theme);
                });
            });

            function setTheme(theme) {
                document.body.classList.remove('theme-onyx', 'theme-ocean', 'theme-lavender', 'theme-default', 'theme-gothic');
                if (theme === 'default') {
                    // default theme, no class needed
                } else {
                    document.body.classList.add('theme-' + theme);
                }
            }
        });

        document.querySelectorAll('.update-quantity-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');
                const quantityInput = this.previousElementSibling;
                const quantity = quantityInput ? quantityInput.value : 1;

                fetch('update_cart_quantity.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Cart updated successfully.');
                        location.reload();
                    } else {
                        alert('Error updating cart: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Error updating cart.');
                });
            });
        });
    </script>
</body>
</html>
