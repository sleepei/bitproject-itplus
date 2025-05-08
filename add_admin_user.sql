-- Add is_admin column to users table
ALTER TABLE users ADD COLUMN is_admin TINYINT(1) NOT NULL DEFAULT 0;

-- Insert admin user with username 'admin' and password 'admin123'
-- Password hash generated using PHP password_hash('admin123', PASSWORD_DEFAULT);
INSERT INTO users (username, password_hash, is_admin) VALUES
('admin', '$2y$10$e0NRzq6q6v6v6v6v6v6v6u6v6v6v6v6v6v6v6v6v6v6v6v6v6v6v6', 1);
