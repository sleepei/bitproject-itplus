<?php
require_once 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: my_account.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$updateSuccess = '';
$updateError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['username'] ?? '');
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($new_username === '') {
        $updateError = 'Username cannot be empty.';
    } else {
        // Check if new username is taken by another user
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ? AND id != ?');
        $stmt->execute([$new_username, $user_id]);
        if ($stmt->fetch()) {
            $updateError = 'Username already taken.';
        }
    }

    if (!$updateError && ($new_password !== '' || $confirm_password !== '')) {
        if ($new_password !== $confirm_password) {
            $updateError = 'New passwords do not match.';
        } else {
            // Verify current password
            $stmt = $pdo->prepare('SELECT password_hash FROM users WHERE id = ?');
            $stmt->execute([$user_id]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$user || !password_verify($current_password, $user['password_hash'])) {
                $updateError = 'Current password is incorrect.';
            }
        }
    }

    if (!$updateError) {
        // Update username
        $stmt = $pdo->prepare('UPDATE users SET username = ? WHERE id = ?');
        $stmt->execute([$new_username, $user_id]);
        $_SESSION['username'] = $new_username;

        // Update password if provided
        if ($new_password !== '') {
            $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
            $stmt->execute([$new_password_hash, $user_id]);
        }

        $updateSuccess = 'Account updated successfully.';
        $username = $new_username;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Dashboard - IT PLUS LIMITED</title>
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

    <header class="bg-primary text-white text-center py-5">
        <h1>Account Dashboard</h1>
        <p>Manage your account details</p>
    </header>

    <section class="container my-5">
        <?php if ($updateError): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($updateError); ?></div>
        <?php elseif ($updateSuccess): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($updateSuccess); ?></div>
        <?php endif; ?>
        <form action="account_dashboard.php" method="post" novalidate>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
            </div>
            <hr>
            <h4>Change Password</h4>
            <div class="mb-3">
                <label for="current_password" class="form-label">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="off">
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm New Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="off">
            </div>
            <button type="submit" class="btn btn-primary">Update Account</button>
        </form>
        <hr>
        <div class="store-info-link mt-4">
            <h4>Store Information</h4>
            <p>View store information for products available.</p>
            <a href="store_info.php" class="btn btn-info">View Store Info</a>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; <?php echo date("Y"); ?> IT PLUS LIMITED. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
