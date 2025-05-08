<!-- ensure to use a database as well for soem information -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IT PLUS LIMITED | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
<a class="navbar-brand" href="index.php">
    IT PLUS LIMITED
</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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

    <!-- Hero Section -->
    <header class="header-gradient d-flex flex-column justify-content-center align-items-center" style="height: 40vh;">
    <img src="images/itpluslogo_new3.jpg" alt="IT PLUS LIMITED Logo" style="height: 210px; width: auto; margin-top: -35px;">
    <br>
    <br>
    <h2>Welcome to I.T. Plus Limited!</h2>
    <br>
    <h4 style="font-style: oblique;">Your One-Stop Shop for all I.T. Retail Products</h4>
    </header>

    <!-- Product Section -->
    <section class="container my-5">
        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="row">
            <!-- Product 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/msi_gaming_laptop.jpg" class="card-img-top" alt="MSI Gaming Laptop">
                    <div class="card-body">
                        <h5 class="card-title">MSI Gaming Laptop</h5>
                        <p class="card-text">High performance gaming laptop with a sleek design.</p>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <a href="products.php?category=Laptops" class="btn btn-sm btn-primary">Show More in Laptops</a>
                </div>
            </div>
            <!-- Product 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/mechanical_keyboard.jpg" class="card-img-top" alt="Mechanical Keyboard">
                    <div class="card-body">
                        <h5 class="card-title">Mechanical Keyboard</h5>
                        <p class="card-text">RGB backlit, tactile switches, perfect for work and play.</p>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <a href="products.php?category=Accessories" class="btn btn-sm btn-primary">Show More in Accessories</a>
                </div>
            </div>
            <!-- Product 3 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="images/gaming_monitor_144hz.jpg" class="card-img-top" alt="144hz Gaming Monitor">
                    <div class="card-body">
                        <h5 class="card-title">144hz Gaming Monitor</h5>
                        <p class="card-text">Smooth and crisp visuals with ultra-low response time.</p>
                    </div>
                </div>
                <div class="text-center mt-2">
                    <a href="products.php?category=Monitors" class="btn btn-sm btn-primary">Show More in Monitors</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us-section py-5">
        <div class="container">
            <div class="about-us-box p-4 rounded shadow mx-auto" style="max-width: 800px; background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333;">
                <h2 class="text-center mb-4" style="font-weight: 500; font-family: 'Georgia', serif;">About Us</h2>
                <p class="fs-5 text-center mb-3;">At IT Plus Limited, we’re more than just your go-to tech store – we’re a family that cares. Located in the heart of Trinidad and Tobago, we’re dedicated to bringing you the best in IT products with a personal touch. Our mission is to make every customer feel valued, supported, and equipped to succeed.</p>
                <p class="fs-5 text-center quotation" style="font-style: italic;">"Where technology meets care, and customers are family."</p>
            </div>
        </div>
    </section>

    <!-- Store Information Section -->
    <section class="store-location-section py-5">
        <div class="container text-center">
            <h2 class="mb-4">Our Store Location</h2>
            <div class="map-wrapper mx-auto" style="max-width: 690px; position: relative; border-radius: 12px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1);">
                <img src="images/store_location_image_2.jpg" alt="Map of Trinidad and Tobago" class="img-fluid rounded" style="border-radius: 12px; max-height: 400px; width: 100%; object-fit: cover; box-shadow: 0 8px 16px rgba(0,0,0,0.2); transition: box-shadow 0.3s ease-in-out; border: none !important;">
            </div>
            <p class="mt-3 fs-5">Visit our store located in the heart of Port of Spain, Trinidad and Tobago.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> IT PLUS LIMITED. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS (for navbar toggle) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Apply saved theme on page load
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
