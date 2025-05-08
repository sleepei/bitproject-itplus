<?php
require_once 'db.php';
session_start();

$loginError = '';
$registerError = '';
$registerSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // Handle login
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $loginError = 'Please enter both username and password.';
        } else {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password_hash'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['is_admin'] = $user['is_admin'] ?? 0;
    header('Location: index.php');
    exit;
} else {
    $loginError = 'Invalid username or password.';
}
        }
    } elseif (isset($_POST['register'])) {
        // Handle registration
        $username = trim($_POST['reg_username'] ?? '');
        $password = $_POST['reg_password'] ?? '';
        $confirm_password = $_POST['reg_confirm_password'] ?? '';

        if ($username === '' || $password === '' || $confirm_password === '') {
            $registerError = 'Please fill in all registration fields.';
        } elseif ($password !== $confirm_password) {
            $registerError = 'Passwords do not match.';
        } else {
            // Check if username exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $registerError = 'Username already taken.';
            } else {
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username, password_hash) VALUES (?, ?)");
                if ($stmt->execute([$username, $password_hash])) {
                    $registerSuccess = true;
                } else {
                    $registerError = 'Registration failed. Please try again.';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>IT PLUS LIMITED | My Account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="styles.css" rel="stylesheet" />
</head>
<body class="<?php echo isset($_COOKIE['selectedTheme']) ? 'theme-' . htmlspecialchars($_COOKIE['selectedTheme']) : ''; ?>">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">IT PLUS LIMITED</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
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
                        <a
                            class="nav-link dropdown-toggle active"
                            href="#"
                            id="myAccountDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="myAccountDropdown">
                            <li><a class="dropdown-item" href="account_dashboard.php">Account Dashboard</a></li>
                            <li><a class="dropdown-item" href="view_cart.php">View Cart</a></li>
                            <li><a class="dropdown-item" href="view_wishlist.php">View Wish List</a></li>
                            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                                <li><a class="dropdown-item" href="admin_contact_info.php">Customer Contact Info</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider" /></li>
                            <li><a class="dropdown-item" href="my_account.php">Login / Register</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ms-3">
                        <a
                            class="nav-link dropdown-toggle"
                            href="#"
                            id="themeDropdown"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            Theme
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="themeDropdown">
                            <li><a class="dropdown-item theme-option" href="#" data-theme="onyx">Onyx (Midnight)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="ocean">Ocean (Dark Blue)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="gothic">Gothic (Dark Mode)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="default">Default (Light)</a></li>
                            <li><a class="dropdown-item theme-option" href="#" data-theme="lavender">Lavender (Purple Light)</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="bg-primary text-white text-center py-5">
        <h1>My Account</h1>
        <p>Please login to access your account</p>
    </header>

    <!-- Login Form Section -->
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Login</h2>
                <?php if ($loginError): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($loginError); ?></div>
                <?php endif; ?>
                <form id="loginForm" action="my_account.php" method="post" novalidate>
                    <input type="hidden" name="login" value="1" />
                    <div class="mb-3">
                        <label for="username" class="form-label">Username<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="username" name="username" required />
                        <div class="invalid-feedback">Please enter your username.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" required />
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Register</h2>
                <?php if ($registerError): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($registerError); ?></div>
                <?php elseif ($registerSuccess): ?>
                    <div class="alert alert-success">Registration successful. You can now log in.</div>
                <?php endif; ?>
                <form id="registerForm" action="my_account.php" method="post" novalidate>
                    <input type="hidden" name="register" value="1" />
                    <div class="mb-3">
                        <label for="reg_username" class="form-label">Username<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="reg_username" name="reg_username" required />
                        <div class="invalid-feedback">Please enter a username.</div>
                    </div>
                    <div class="mb-3">
                        <label for="reg_password" class="form-label">Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="reg_password" name="reg_password" required />
                        <div class="invalid-feedback">Please enter a password.</div>
                    </div>
                    <div class="mb-3">
                        <label for="reg_confirm_password" class="form-label">Confirm Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="reg_confirm_password" name="reg_confirm_password" required />
                        <div class="invalid-feedback">Please confirm your password.</div>
                    </div>
                    <button type="submit" class="btn btn-success">Register</button>
                </form>
            </div>
        </div>
    </section>


<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> IT PLUS LIMITED. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS (for navbar toggle and form validation) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Bootstrap form validation
        (function () {
            'use strict';
            var forms = document.querySelectorAll('#loginForm');
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener(
                    'submit',
                    function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    },
                    false
                );
            });
        })();

        // Theme toggle script with cookie and updated theme name
        document.addEventListener('DOMContentLoaded', function () {
            function setTheme(theme) {
                document.body.classList.remove('theme-onyx', 'theme-ocean', 'theme-lavender', 'theme-default', 'theme-gothic');
                if (theme === 'default') {
                    // default theme, no class needed
                } else {
                    document.body.classList.add('theme-' + theme);
                }
            }

            document.querySelectorAll('.theme-option').forEach(function (el) {
                el.addEventListener('click', function (e) {
                    e.preventDefault();
                    const theme = this.getAttribute('data-theme');
                    setTheme(theme);
                    document.cookie = "selectedTheme=" + theme + ";path=/;max-age=" + 60*60*24*30;
                    localStorage.setItem('selectedTheme', theme);
                });
            });

            // On page load, set theme from cookie if exists
            const cookieTheme = document.cookie.split('; ').find(row => row.startsWith('selectedTheme='));
            if (cookieTheme) {
                const theme = cookieTheme.split('=')[1];
                setTheme(theme);
            } else {
                setTheme('default');
            }
        });
    </script>
</body>
</html>
