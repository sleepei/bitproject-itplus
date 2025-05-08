<?php
require_once 'db.php';

// Reset admin password to 'admin123' and set is_admin to 1
$username = 'admin';
$new_password = 'admin123';
$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("UPDATE users SET password_hash = ?, is_admin = 1 WHERE username = ?");
if ($stmt->execute([$password_hash, $username])) {
    echo "Admin password reset successfully.";
} else {
    echo "Failed to reset admin password.";
}
?>
