-- Tạo cơ sở dữ liệu và sử dụng nó
CREATE DATABASE IF NOT EXISTS my_store;
USE my_store;
-- Tạo bảng danh mục sản phẩm
CREATE TABLE IF NOT EXISTS category (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
description TEXT
);
-- Tạo bảng sản phẩm
CREATE TABLE IF NOT EXISTS product (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
description TEXT,
price DECIMAL(10,2) NOT NULL,
image VARCHAR(255) DEFAULT NULL,
category_id INT,
FOREIGN KEY (category_id) REFERENCES category(id) ON DELETE CASCADE
);
-- Tạo bản tài khoản
USE `my_store`;
CREATE TABLE account (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL UNIQUE,
fullname VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL,
role ENUM('admin', 'user') DEFAULT 'user'
);
-- Chèn dữ liệu vào bảng category
INSERT INTO category (name, description) VALUES
('Điện thoại', 'Danh mục các loại điện thoại'),
('Laptop', 'Danh mục các loại laptop'),
('Máy tính bảng', 'Danh mục các loại máy tính bảng'),
('Phụ kiện', 'Danh mục phụ kiện điện tử'),
('Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro');
-- Tạo bản đơn hàng
CREATE TABLE orders (
id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
phone VARCHAR(20) NOT NULL,
address TEXT NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Tạo bản chi tiết sản phẩm trong từng đơn hàng
CREATE TABLE order_details (
id INT AUTO_INCREMENT PRIMARY KEY,
order_id INT NOT NULL,
product_id INT NOT NULL,
quantity INT NOT NULL,
price DECIMAL(10, 2) NOT NULL,
FOREIGN KEY (order_id) REFERENCES orders(id)
);
