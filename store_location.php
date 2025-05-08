<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Store Location - IT PLUS LIMITED</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CDN for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .location-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        .location-container h1 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #007bff;
        }
        .map-wrapper {
            position: relative;
            display: inline-block;
            max-width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .map-image {
            width: 100%;
            height: auto;
            display: block;
        }
        .marker {
            position: absolute;
            top: 45%; /* approximate position of Port of Spain */
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            background-color: #dc3545;
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 8px rgba(220, 53, 69, 0.7);
        }
        .marker::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 10px;
            background-color: #dc3545;
        }
        .location-text {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #333;
        }
        footer {
            margin-top: 50px;
            padding: 15px 0;
            background-color: #343a40;
            color: white;
            text-align: center;
        }
    </style>
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
</head>
<body>
    <div class="location-container">
        <h1>Our Store Location</h1>
        <div class="map-wrapper">
            <img src="images/trinidad_tobago_map.jpg" alt="Map of Trinidad and Tobago" class="map-image">
            <div class="marker" title="Port of Spain"></div>
        </div>
        <div class="location-text">
            <p><strong>Port of Spain, Trinidad and Tobago</strong></p>
            <p>Visit our store located in the heart of Port of Spain. We look forward to serving you!</p>
        </div>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> IT PLUS LIMITED. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
