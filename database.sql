-- ==============================================================
-- WanderBharat Travel Booking - Clean & Readable Database Schema
-- Database: travel_booking
-- ==============================================================

CREATE DATABASE IF NOT EXISTS `travel_booking` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `travel_booking`;

-- -------------------------------------------------------------
-- 1. Primary Table: `bookings`
-- Fits cleanly in 1 line on any terminal or tool (SELECT * FROM bookings)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `booking_id` VARCHAR(20) NOT NULL UNIQUE,
  `customer_name` VARCHAR(100) NOT NULL,
  `customer_phone` VARCHAR(20) NOT NULL,
  `customer_email` VARCHAR(100) NOT NULL,
  `package_title` VARCHAR(120) NOT NULL,
  `plan_name` VARCHAR(50) NOT NULL,
  `travel_date` DATE NOT NULL,
  `guests` INT NOT NULL DEFAULT 1,
  `total_amount` DECIMAL(10,2) NOT NULL,
  `payment_mode` VARCHAR(50) NOT NULL DEFAULT 'UPI',
  `status` VARCHAR(20) NOT NULL DEFAULT 'Confirmed',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------
-- 2. Extended Table: `booking_details` (Normalized)
-- Stores secondary traveler info, guest breakdown, and requests
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `booking_details` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `booking_id` VARCHAR(20) NOT NULL,
  `package_id` VARCHAR(50) NOT NULL,
  `adults` INT NOT NULL DEFAULT 1,
  `children` INT NOT NULL DEFAULT 0,
  `base_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `addons_price` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `addons_summary` VARCHAR(255) DEFAULT NULL,
  `city_state` VARCHAR(100) DEFAULT NULL,
  `id_proof` VARCHAR(50) DEFAULT NULL,
  `special_requests` TEXT DEFAULT NULL,
  CONSTRAINT `fk_booking_details` FOREIGN KEY (`booking_id`) REFERENCES `bookings`(`booking_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------
-- 3. Inquiries Table: `inquiries` (Contact Form)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `phone` VARCHAR(20) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `destination` VARCHAR(100) DEFAULT NULL,
  `preferred_plan` VARCHAR(50) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------
-- Initial Sample Booking Records
-- -------------------------------------------------------------
INSERT INTO `bookings` (`booking_id`, `customer_name`, `customer_phone`, `customer_email`, `package_title`, `plan_name`, `travel_date`, `guests`, `total_amount`, `payment_mode`, `status`) VALUES
('WW-84920A', 'Rahul Sharma', '+91 98765 43210', 'rahul.sharma@example.com', 'Kashmir Paradise: Srinagar & Gulmarg', 'Comfort Plan', '2026-11-20', 2, 51996.00, 'UPI (Google Pay)', 'Confirmed'),
('WW-40977F', 'Abhishek Sudame', '7249606221', 'abhisudame7249@gmail.com', 'Kashmir Paradise: Srinagar & Gulmarg', 'Comfort Plan', '2026-10-24', 2, 51996.00, 'UPI (PhonePe)', 'Confirmed');

INSERT INTO `booking_details` (`booking_id`, `package_id`, `adults`, `children`, `base_price`, `addons_price`, `addons_summary`, `city_state`, `id_proof`, `special_requests`) VALUES
('WW-84920A', 'kashmir-paradise', 2, 0, 49998.00, 1998.00, 'Travel Insurance', 'Mumbai, Maharashtra', 'Aadhaar: •••• 4821', 'Dal lake view houseboat'),
('WW-40977F', 'kashmir-paradise', 2, 0, 49998.00, 1998.00, 'Travel Insurance', 'Barshi, Maharashtra', 'ID: 372955713910', 'Early check-in requested');
