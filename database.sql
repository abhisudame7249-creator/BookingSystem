-- ==============================================================
-- WanderBharat Travel Booking - MySQL Database Schema
-- Database Name: travel_booking
-- ==============================================================

CREATE DATABASE IF NOT EXISTS `travel_booking` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `travel_booking`;

-- -------------------------------------------------------------
-- 1. Table structure for `bookings`
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `booking_id` VARCHAR(50) NOT NULL UNIQUE,
  `package_id` VARCHAR(100) NOT NULL,
  `package_title` VARCHAR(255) NOT NULL,
  `location` VARCHAR(255) NOT NULL,
  `country` VARCHAR(100) NOT NULL DEFAULT 'India',
  `duration` VARCHAR(50) NOT NULL,
  `hero_image` VARCHAR(500) DEFAULT NULL,
  `plan_key` VARCHAR(50) NOT NULL,
  `plan_name` VARCHAR(100) NOT NULL,
  `plan_price` DECIMAL(10,2) NOT NULL,
  `hotel` VARCHAR(255) NOT NULL,
  `transport` VARCHAR(255) NOT NULL,
  `travel_date` DATE NOT NULL,
  `adults` INT NOT NULL DEFAULT 1,
  `children` INT NOT NULL DEFAULT 0,
  `total_guests` INT NOT NULL DEFAULT 1,
  `addons_json` TEXT DEFAULT NULL,
  `base_total` DECIMAL(10,2) NOT NULL,
  `addons_total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `grand_total` DECIMAL(10,2) NOT NULL,
  `customer_name` VARCHAR(255) NOT NULL,
  `customer_email` VARCHAR(255) NOT NULL,
  `customer_phone` VARCHAR(50) NOT NULL,
  `customer_nationality` VARCHAR(100) DEFAULT NULL,
  `customer_passport` VARCHAR(100) DEFAULT NULL,
  `special_requests` TEXT DEFAULT NULL,
  `payment_method` VARCHAR(50) NOT NULL DEFAULT 'UPI',
  `payment_status` VARCHAR(50) NOT NULL DEFAULT 'Confirmed',
  `status` ENUM('Confirmed', 'Cancelled') NOT NULL DEFAULT 'Confirmed',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------
-- 2. Table structure for `inquiries` (Contact Form)
-- -------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `inquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `destination` VARCHAR(255) DEFAULT NULL,
  `preferred_plan` VARCHAR(100) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------------
-- 3. Initial Sample Booking (INR / ₹)
-- -------------------------------------------------------------
INSERT IGNORE INTO `bookings` (
  `booking_id`, `package_id`, `package_title`, `location`, `country`,
  `duration`, `hero_image`, `plan_key`, `plan_name`, `plan_price`,
  `hotel`, `transport`, `travel_date`, `adults`, `children`,
  `total_guests`, `addons_json`, `base_total`, `addons_total`,
  `grand_total`, `customer_name`, `customer_email`, `customer_phone`,
  `customer_nationality`, `customer_passport`, `special_requests`,
  `payment_method`, `payment_status`, `status`
) VALUES (
  'WW-84920A',
  'kashmir-paradise',
  'Kashmir Paradise: Srinagar, Gulmarg & Pahalgam',
  'Jammu & Kashmir (Srinagar, Gulmarg, Pahalgam & Sonamarg)',
  'India',
  '6 Days / 5 Nights',
  'https://images.unsplash.com/photo-1595815771614-ade9d652a65d?auto=format&fit=crop&w=1200&q=80',
  'comfort',
  'Comfort Plan',
  24999.00,
  '4-Star Luxury Resort in Gulmarg & Super Deluxe Carved Wooden Houseboat',
  'Dedicated Private AC Sedan (Dzire / Etios) with private chauffeur',
  '2026-11-20',
  2,
  0,
  2,
  '[{\"id\":\"insurance\",\"name\":\"Comprehensive Domestic Travel & Medical Insurance\",\"cost\":1998}]',
  49998.00,
  1998.00,
  51996.00,
  'Rahul Sharma',
  'rahul.sharma@example.com',
  '+91 98765 43210',
  'Mumbai, Maharashtra',
  'Aadhaar: •••• •••• 4821',
  'Dal lake view houseboat with central heating',
  'UPI (Google Pay)',
  'Paid / Confirmed',
  'Confirmed'
);
