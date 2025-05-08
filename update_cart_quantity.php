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
$new_quantity = $_POST['quantity'] ?? null;

if (!$product_id || !is_numeric($new_quantity) || $new_quantity < 1) {
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

// Check if new quantity exceeds stock
if ($new_quantity > $product['stock']) {
    echo json_encode(['success' => false, 'message' => 'Cannot set quantity more than available stock.']);
    exit;
}

// Check if item exists in cart
$stmt = $pdo->prepare('SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?');
$stmt->execute([$user_id, $product_id]);
$cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cart_item) {
    echo json_encode(['success' => false, 'message' => 'Product not in cart']);
    exit;
}

// Update quantity
$stmt = $pdo->prepare('UPDATE cart_items SET quantity = ? WHERE id = ?');
if ($stmt->execute([$new_quantity, $cart_item['id']])) {
    echo json_encode(['success' => true, 'message' => 'Cart updated successfully']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update cart']);
}
?>
