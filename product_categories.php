<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IT PLUS LIMITED | Product Categories</title>
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
                        <a class="nav-link active" aria-current="page" href="product_categories.php">Product Categories</a>
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
                    <li><a class="dropdown-item theme-option" href="#" data-theme="default">Default (Light)</a></li>
                    <li><a class="dropdown-item theme-option" href="#" data-theme="lavender">Lavender (Purple Light)</a></li>
                    <li><a class="dropdown-item theme-option" href="#" data-theme="gothic">Gothic (Dark Red)</a></li>
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
                document.body.classList.remove('theme-onyx', 'theme-ocean', 'theme-lavender', 'theme-default', 'theme-gothic');
                if (theme === 'default') {
                    // default theme, no class needed
                } else {
                    document.body.classList.add('theme-' + theme);
                }
            }
        });
    </script>
</body>
</html>

    <!-- Page Header -->
    <header class="bg-primary text-white text-center py-5">
        <h1>Product Categories</h1>
        <p>Explore our wide range of IT products</p>
    </header>

    <!-- Categories Section -->
    <section class="container my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="images/msi_gaming_laptop.jpg" class="card-img-top" alt="Laptops">
                    <div class="card-body">
                        <h5 class="card-title">Laptops</h5>
                        <p class="card-text">High performance laptops for gaming, work, and everyday use.</p>
                        <a href="products.php?category=Laptops" class="btn btn-primary">View Laptops</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="images/wireless_mouse.jpg" class="card-img-top" alt="Accessories">
                    <div class="card-body">
                        <h5 class="card-title">Accessories</h5>
                        <p class="card-text">Keyboards, mice, headphones, and other essential accessories.</p>
                        <a href="products.php?category=Accessories" class="btn btn-primary">View Accessories</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="images/4k_gaming_monitor.jpg" class="card-img-top" alt="Monitors">
                    <div class="card-body">
                        <h5 class="card-title">Monitors</h5>
                        <p class="card-text">High refresh rate and high resolution monitors for all needs.</p>
                        <a href="products.php?category=Monitors" class="btn btn-primary">View Monitors</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> IT PLUS LIMITED. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS (for navbar toggle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
