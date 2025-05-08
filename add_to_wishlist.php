<?php
require_once 'db.php';
session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'] ?? null;
$quantity = $_POST['quantity'] ?? 1;

if (!$product_id || !is_numeric($quantity) || $quantity < 1) {
    echo json_encode(['success' => false, 'message' => 'Invalid product or quantity']);
    exit;
}

// Check if product exists
$stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo json_encode(['success' => false, 'message' => 'Product not found']);
    exit;
}

// Check if item already in wish list
$stmt = $pdo->prepare('SELECT * FROM wish_list_items WHERE user_id = ? AND product_id = ?');
$stmt->execute([$user_id, $product_id]);
$wish_item = $stmt->fetch(PDO::FETCH_ASSOC);

if ($wish_item) {
    // Check if new quantity exceeds stock
    $new_quantity = $wish_item['quantity'] + $quantity;
    if ($new_quantity > $product['stock']) {
        echo json_encode(['success' => false, 'message' => 'Cannot add more than available stock.']);
        exit;
    }
    // Update quantity
    $stmt = $pdo->prepare('UPDATE wish_list_items SET quantity = ? WHERE id = ?');
    $stmt->execute([$new_quantity, $wish_item['id']]);
} else {
    // Check if quantity exceeds stock
    if ($quantity > $product['stock']) {
        echo json_encode(['success' => false, 'message' => 'Cannot add more than available stock.']);
        exit;
    }
    // Insert new item
    $stmt = $pdo->prepare('INSERT INTO wish_list_items (user_id, product_id, quantity) VALUES (?, ?, ?)');
    $stmt->execute([$user_id, $product_id, $quantity]);
}

echo json_encode(['success' => true, 'message' => 'Product added to wish list']);
