-- --------------------------------------------------------
-- Máy chủ:                      127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Phiên bản:           12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for my_store
CREATE DATABASE IF NOT EXISTS `my_store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `my_store`;

-- Dumping structure for table my_store.account
CREATE TABLE IF NOT EXISTS `account` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.account: ~0 rows (approximately)
INSERT INTO `account` (`id`, `username`, `fullname`, `password`, `phone`, `address`, `role`) VALUES
	(1, 'bang', 'bangchung', '$2y$10$.qpfwimnkyET41hmn9ANle2CpO5k6vDHwROSYjoZRRWSpAM2WLRPW', '12345678', 'qwertyuiop', 'admin'),
	(2, '123', '1234', '$2y$10$gP8qUDW5wA4ivcqsFXigZOWeyqDSBkdH2E2v/OBqI2/8HDiEpKPAC', '66666', 'dshhj', 'user');

-- Dumping structure for table my_store.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.category: ~5 rows (approximately)
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(2, 'Laptop', 'Danh mục các loại laptop'),
	(3, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(4, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(5, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro'),
	(6, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(7, 'Laptop', 'Danh mục các loại laptop'),
	(8, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(9, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(10, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro'),
	(11, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(12, 'Laptop', 'Danh mục các loại laptop'),
	(13, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(14, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(15, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro'),
	(16, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(17, 'Laptop', 'Danh mục các loại laptop'),
	(18, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(19, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(20, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro'),
	(21, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(22, 'Laptop', 'Danh mục các loại laptop'),
	(23, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(24, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(25, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro');

-- Dumping structure for table my_store.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `account_id` int DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `total` decimal(10,2) DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.orders: ~3 rows (approximately)
INSERT INTO `orders` (`id`, `account_id`, `name`, `phone`, `address`, `total`, `created_at`) VALUES
	(1, 1, 'bangchung', '12345678', 'qwertyuiop', 0.00, '2025-04-08 08:19:31'),
	(2, 1, 'bangchung', '12', 'qwertyuiop', 33333.00, '2025-04-08 09:37:41'),
	(3, 1, 'bangchung', '12345678', 'qwertyuiop', 44444.00, '2025-04-08 09:42:18');

-- Dumping structure for table my_store.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.order_details: ~5 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(2, 2, 1, 3, 445555.00),
	(3, 2, 3, 4, 44000.00),
	(4, 2, 4, 1, 11111.00),
	(5, 1, 4, 1, 11111.00),
	(6, 1, 4, 1, 11111.00),
	(7, 2, 4, 3, 11111.00),
	(8, 3, 4, 4, 11111.00);

-- Dumping structure for table my_store.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.product: ~1 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(4, 'gvghfh', 'agsg', 11111.00, 'uploads/dt.jpg', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
