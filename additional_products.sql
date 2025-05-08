-- Additional products with prices in British pounds (£)

INSERT INTO products (category, name, description, price, stock, image_url) VALUES
('Laptops', 'HP Spectre x360', 'Convertible laptop with touchscreen.', 999.99, 4, 'images/hp_spectre_x360.jpg'),
('Accessories', 'Wireless Mouse', 'Ergonomic wireless mouse with long battery life.', 45.50, 15, 'images/wireless_mouse.jpg'),
('Monitors', '4K UHD Monitor', 'Ultra HD monitor with vibrant colors.', 399.99, 6, 'images/4k_uhd_monitor.jpg'),
('Laptops', 'Apple MacBook Air', 'Lightweight laptop with M1 chip.', 1099.00, 3, 'images/apple_macbook_air.jpg');

DELETE FROM products WHERE name = 'HP Spectre x360' AND id NOT IN (
    SELECT MIN(id) FROM products WHERE name = 'HP Spectre x360'
);

DELETE FROM products WHERE name = 'Wireless Mouse' AND id NOT IN (
    SELECT MIN(id) FROM products WHERE name = 'Wireless Mouse'
);

DELETE FROM products WHERE name = '4K UHD Monitor' AND id NOT IN (
    SELECT MIN(id) FROM products WHERE name = '4K UHD Monitor'
);

DELETE FROM products WHERE name = 'Apple MacBook Air' AND id NOT IN (
    SELECT MIN(id) FROM products WHERE name = 'Apple MacBook Air'
);
