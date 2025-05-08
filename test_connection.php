<?php
require_once 'db.php';

try {
    // Check if products table exists
    $result = $pdo->query("SHOW TABLES LIKE 'products'");
    if ($result->rowCount() > 0) {
        echo "Database connection successful and 'products' table exists.";
    } else {
        echo "Database connection successful but 'products' table does not exist.";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
