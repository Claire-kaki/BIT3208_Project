-- Mount Kenya University - DEPARTMENT OF COMPUTING & INFORMATICS
-- UNIT CODE: BIT3208 (Advanced Web Design)
-- Week 6: Product Inventory Database Schema

CREATE DATABASE IF NOT EXISTS studentdb;
USE studentdb;

-- Core Product Inventory Schema Table
CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(150) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;