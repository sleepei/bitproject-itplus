-- Add is_admin column to users table if not exists
ALTER TABLE users ADD COLUMN IF NOT EXISTS is_admin TINYINT(1) NOT NULL DEFAULT 0;

-- Insert admin user with username 'admin' and password 'admin123'
-- Password hash generated using PHP password_hash('admin123', PASSWORD_DEFAULT);
INSERT INTO users (username, password_hash, is_admin) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1)
ON DUPLICATE KEY UPDATE password_hash=VALUES(password_hash), is_admin=VALUES(is_admin);
