<?php
require_once 'db.php';

$category = isset($_GET['category']) ? $_GET['category'] : '';

if (!$category) {
    die('Category not specified.');
}

// Prepare and execute query to get products by category
$stmt = $pdo->prepare('SELECT * FROM products WHERE category = :category');
$stmt->execute(['category' => $category]);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IT PLUS LIMITED | <?php echo htmlspecialchars($category); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
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
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product_categories.php">Product Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_us.php">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="themeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Theme
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
                            <li><a class="dropdown-item theme-option" href="#" data-theme="onyx">Onyx (Midnight)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="ocean">Ocean (Dark Blue)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="gothic">Gothic</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="default">Default (Light)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="lavender">Lavender (Purple Light)</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="my_account.php">My Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
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
                document.body.classList.remove('theme-onyx', 'theme-ocean', 'theme-lavender', 'theme-default');
                if (theme === 'default') {
                    // default theme, no class needed
                } else {
                    document.body.classList.add('theme-' + theme);
                }
            }
        });
    </script>

    <!-- Page Header -->
    <header class="bg-primary text-white text-center py-5">
        <h1><?php echo htmlspecialchars($category); ?></h1>
        <p>Available products in this category</p>
    </header>

    <!-- Products Section -->
    <section class="container my-5">
        <?php if (count($products) > 0): ?>
            <div class="row g-4">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                <p class="card-text"><strong>Price:</strong> $<?php echo number_format($product['price'], 2); ?></p>
                                <p class="card-text"><strong>Stock:</strong> <?php echo (int)$product['stock']; ?></p>
                                <a href="store_info.php?product_id=<?php echo $product['id']; ?>" class="btn btn-primary <?php echo ((int)$product['stock'] <= 0) ? 'disabled' : ''; ?>">Buy Now</a>
                                <div class="mt-2">
                                    <input type="number" min="1" max="<?php echo (int)$product['stock']; ?>" value="1" class="form-control quantity-input" id="quantity_<?php echo $product['id']; ?>" style="width: 80px; display: inline-block; margin-right: 10px;">
                                    <button class="btn btn-success add-to-cart-btn" data-product-id="<?php echo $product['id']; ?>" <?php echo ((int)$product['stock'] <= 0) ? 'disabled' : ''; ?>>Add to Cart</button>
                                    <button class="btn btn-warning add-to-wishlist-btn" data-product-id="<?php echo $product['id']; ?>" <?php echo ((int)$product['stock'] <= 0) ? 'disabled' : ''; ?>>Add to Wish List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="text-center">No products found in this category.</p>
        <?php endif; ?>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> IT PLUS LIMITED. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS (for navbar toggle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add to Cart button click handler
            document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const quantityInput = document.getElementById('quantity_' + productId);
                    const quantity = quantityInput ? quantityInput.value : 1;

                    fetch('add_to_cart.php', {
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
                            alert('Product added to cart successfully.');
                        } else {
                            alert('Error adding product to cart: ' + data.message);
                        }
                    })
                    .catch(error => {
                        alert('Error adding product to cart.');
                    });
                });
            });

            // Add to Wish List button click handler
            document.querySelectorAll('.add-to-wishlist-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    const quantityInput = document.getElementById('quantity_' + productId);
                    const quantity = quantityInput ? quantityInput.value : 1;

                    fetch('add_to_wishlist.php', {
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
                            alert('Product added to wish list successfully.');
                        } else {
                            alert('Error adding product to wish list: ' + data.message);
                        }
                    })
                    .catch(error => {
                        alert('Error adding product to wish list.');
                    });
                });
            });
        });
    </script>
</body>
</html>
