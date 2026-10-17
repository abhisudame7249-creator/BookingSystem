<?php
/**
 * WanderBharat Travel Booking - MySQL Database Connection & Clean Normalized Schema Setup
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Abhi7249@1');
define('DB_NAME', 'travel_booking');
define('DB_PORT', 3306);

/**
 * Get PDO Database Connection
 * Automatically creates database and clean tables if they don't exist yet!
 */
function getDBConnection() {
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    try {
        // Step 1: Connect to MySQL server (without selecting DB first)
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";charset=utf8mb4";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_TIMEOUT            => 3,
        ];
        
        $serverConn = new PDO($dsn, DB_USER, DB_PASS, $options);
        
        // Step 2: Ensure database exists
        $serverConn->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        
        // Step 3: Connect directly to the database
        $dbDsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
        $pdo = new PDO($dbDsn, DB_USER, DB_PASS, $options);
        
        // Step 4: Auto-check and create tables if first time
        initDatabaseTables($pdo);

        return $pdo;
    } catch (PDOException $e) {
        error_log("Database Connection Failed: " . $e->getMessage());
        return null;
    }
}

/**
 * Initialize all clean database tables automatically
 */
function initDatabaseTables($pdo) {
    // Check if bookings table exists
    $tableCheck = $pdo->query("SHOW TABLES LIKE 'bookings'")->rowCount();
    if ($tableCheck > 0) {
        return; // Already initialized
    }

    // 1. Clean Primary 'bookings' Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `bookings` (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // 2. 'booking_details' Table for Secondary/Extended Details
    $pdo->exec("CREATE TABLE IF NOT EXISTS `booking_details` (
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
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // 3. 'inquiries' Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `inquiries` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(100) NOT NULL,
        `phone` VARCHAR(20) NOT NULL,
        `email` VARCHAR(100) NOT NULL,
        `destination` VARCHAR(100) DEFAULT NULL,
        `preferred_plan` VARCHAR(50) DEFAULT NULL,
        `message` TEXT NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");
}
