-- SQL schema for products table

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(100) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    stock INT NOT NULL DEFAULT 0,
    image_url VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Sample data insertion

INSERT INTO products (category, name, description, price, stock, image_url) VALUES
('Laptops', 'MSI Gaming Laptop', 'High performance MSI laptop with RTX graphics.', 1200.00, 5, 'https://via.placeholder.com/350x200'),
('Laptops', 'Dell Inspiron', 'Reliable Dell laptop for everyday use.', 800.00, 2, 'https://via.placeholder.com/350x200'),
('Accessories', 'Mechanical Keyboard', 'RGB backlit mechanical keyboard.', 100.00, 10, 'https://via.placeholder.com/350x200'),
('Monitors', '144Hz Gaming Monitor', 'Smooth visuals with ultra-low response time.', 300.00, 3, 'images/gaming_monitor_144hz.jpg');


