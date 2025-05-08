-- SQL script to update product image URLs to match actual image filenames in images/ folder

UPDATE products SET image_url = 'images/msi_gaming_laptop.jpg' WHERE name = 'MSI Gaming Laptop';
UPDATE products SET image_url = 'images/dell_inspiron_laptop.jpg' WHERE name = 'Dell Inspiron';
UPDATE products SET image_url = 'images/mechanical_keyboard.jpg' WHERE name = 'Mechanical Keyboard';
UPDATE products SET image_url = 'images/gaming_monitor_144hz.jpg' WHERE name = '144Hz Gaming Monitor';
UPDATE products SET image_url = 'images/4k_gaming_monitor.jpg' WHERE name = '4K UHD Monitor';
UPDATE products SET image_url = 'images/HP_spectre_x360.jpg' WHERE name = 'HP Spectre x360';
UPDATE products SET image_url = 'images/wireless_mouse.jpg' WHERE name = 'Wireless Mouse';
UPDATE products SET image_url = 'images/apple_macbook_air.jpg' WHERE name = 'Apple MacBook Air';

-- End of update script
