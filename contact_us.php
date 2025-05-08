<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>IT PLUS LIMITED | Contact Us</title>
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
                    <li class="nav-item active">
                        <a class="nav-link" aria-current="page" href="contact_us.php">Contact Us</a>
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
        <h1>Contact Us</h1>
        <p>We would love to hear from you</p>
    </header>

    <!-- Contact Form Section -->
    <section class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
<?php
require_once 'db.php';

$messageSent = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $subject === '' || $message === '') {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message]);
            $messageSent = true;
        } catch (PDOException $e) {
            $error = 'Failed to send message. Please try again later.';
        }
    }
}
?>

                <form id="contactForm" action="contact_us.php" method="post" novalidate>
                    <?php if ($messageSent): ?>
                        <div class="alert alert-success" role="alert">
                            Your message has been sent successfully.
                        </div>
                    <?php elseif ($error !== ''): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php echo $error && $name === '' ? 'is-invalid' : ''; ?>" id="name" name="name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                        <div class="invalid-feedback">
                            Please enter your name.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control <?php echo $error && $email === '' ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                        <div class="invalid-feedback">
                            Please enter a valid email address.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject<span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php echo $error && $subject === '' ? 'is-invalid' : ''; ?>" id="subject" name="subject" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>" required>
                        <div class="invalid-feedback">
                            Please enter a subject.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message<span class="text-danger">*</span></label>
                        <textarea class="form-control <?php echo $error && $message === '' ? 'is-invalid' : ''; ?>" id="message" name="message" rows="5" required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                        <div class="invalid-feedback">
                            Please enter your message.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

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
            'use strict'
            var forms = document.querySelectorAll('#contactForm')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>
