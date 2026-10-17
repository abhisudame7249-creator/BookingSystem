<?php
/**
 * WanderWise Travel Booking - MySQL Database Connection & Auto-Setup
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'Abhi7249@1');
define('DB_NAME', 'travel_booking');
define('DB_PORT', 3306);

/**
 * Get PDO Database Connection
 * Automatically creates database and tables if they don't exist yet!
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
        // If connection fails, log error and return null so application falls back gracefully
        error_log("Database Connection Failed: " . $e->getMessage());
        return null;
    }
}

/**
 * Initialize all database tables and seed sample data automatically
 */
function initDatabaseTables($pdo) {
    // Check if bookings table exists
    $tableCheck = $pdo->query("SHOW TABLES LIKE 'bookings'")->rowCount();
    if ($tableCheck > 0) {
        return; // Already initialized
    }

    // 1. Bookings Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `bookings` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `booking_id` VARCHAR(50) NOT NULL UNIQUE,
        `package_id` VARCHAR(100) NOT NULL,
        `package_title` VARCHAR(255) NOT NULL,
        `location` VARCHAR(255) NOT NULL,
        `country` VARCHAR(100) NOT NULL,
        `duration` VARCHAR(50) NOT NULL,
        `hero_image` VARCHAR(500) NULL,
        `plan_key` VARCHAR(50) NOT NULL,
        `plan_name` VARCHAR(100) NOT NULL,
        `plan_price` DECIMAL(10,2) NOT NULL,
        `hotel` VARCHAR(255) NOT NULL,
        `transport` VARCHAR(255) NOT NULL,
        `travel_date` DATE NOT NULL,
        `adults` INT NOT NULL DEFAULT 1,
        `children` INT NOT NULL DEFAULT 0,
        `total_guests` INT NOT NULL DEFAULT 1,
        `addons_json` TEXT NULL,
        `base_total` DECIMAL(10,2) NOT NULL,
        `addons_total` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
        `grand_total` DECIMAL(10,2) NOT NULL,
        `customer_name` VARCHAR(255) NOT NULL,
        `customer_email` VARCHAR(255) NOT NULL,
        `customer_phone` VARCHAR(50) NOT NULL,
        `customer_nationality` VARCHAR(100) NULL,
        `customer_passport` VARCHAR(100) NULL,
        `special_requests` TEXT NULL,
        `payment_method` VARCHAR(50) NOT NULL DEFAULT 'card',
        `payment_status` VARCHAR(50) NOT NULL DEFAULT 'Confirmed',
        `status` ENUM('Confirmed', 'Cancelled') NOT NULL DEFAULT 'Confirmed',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // 2. Contact Inquiries Table
    $pdo->exec("CREATE TABLE IF NOT EXISTS `inquiries` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL,
        `phone` VARCHAR(50) NULL,
        `destination` VARCHAR(255) NULL,
        `preferred_plan` VARCHAR(100) NULL,
        `message` TEXT NOT NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

    // 3. Seed initial booking from JSON if exists
    $sampleJson = __DIR__ . '/../data/bookings.json';
    if (file_exists($sampleJson)) {
        $json = @file_get_contents($sampleJson);
        $seedBookings = json_decode($json, true) ?: [];
        foreach ($seedBookings as $b) {
            $stmt = $pdo->prepare("INSERT IGNORE INTO `bookings` (
                `booking_id`, `package_id`, `package_title`, `location`, `country`,
                `duration`, `hero_image`, `plan_key`, `plan_name`, `plan_price`,
                `hotel`, `transport`, `travel_date`, `adults`, `children`,
                `total_guests`, `addons_json`, `base_total`, `addons_total`,
                `grand_total`, `customer_name`, `customer_email`, `customer_phone`,
                `customer_nationality`, `customer_passport`, `special_requests`,
                `payment_method`, `payment_status`, `status`
            ) VALUES (
                :booking_id, :package_id, :package_title, :location, :country,
                :duration, :hero_image, :plan_key, :plan_name, :plan_price,
                :hotel, :transport, :travel_date, :adults, :children,
                :total_guests, :addons_json, :base_total, :addons_total,
                :grand_total, :customer_name, :customer_email, :customer_phone,
                :customer_nationality, :customer_passport, :special_requests,
                :payment_method, :payment_status, :status
            )");

            $stmt->execute([
                ':booking_id' => $b['booking_id'],
                ':package_id' => $b['package_id'],
                ':package_title' => $b['package_title'],
                ':location' => $b['location'],
                ':country' => $b['country'],
                ':duration' => $b['duration'],
                ':hero_image' => $b['hero_image'] ?? '',
                ':plan_key' => $b['plan_key'],
                ':plan_name' => $b['plan_name'],
                ':plan_price' => $b['plan_price'],
                ':hotel' => $b['hotel'],
                ':transport' => $b['transport'],
                ':travel_date' => $b['travel_date'],
                ':adults' => $b['adults'],
                ':children' => $b['children'] ?? 0,
                ':total_guests' => $b['total_guests'] ?? ($b['adults'] + ($b['children'] ?? 0)),
                ':addons_json' => json_encode($b['addons'] ?? []),
                ':base_total' => $b['base_total'],
                ':addons_total' => $b['addons_total'] ?? 0,
                ':grand_total' => $b['grand_total'],
                ':customer_name' => $b['customer']['full_name'],
                ':customer_email' => $b['customer']['email'],
                ':customer_phone' => $b['customer']['phone'],
                ':customer_nationality' => $b['customer']['nationality'] ?? '',
                ':customer_passport' => $b['customer']['passport_no'] ?? '',
                ':special_requests' => $b['customer']['special_requests'] ?? '',
                ':payment_method' => $b['payment']['method'] ?? 'card',
                ':payment_status' => $b['payment']['status'] ?? 'Paid / Confirmed',
                ':status' => $b['status'] ?? 'Confirmed'
            ]);
        }
    }
}
