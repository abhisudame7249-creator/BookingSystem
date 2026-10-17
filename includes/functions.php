<?php
/**
 * WanderBharat Travel Booking - Helper Functions & Clean Normalized MySQL Data Access
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/data.php';

/**
 * Format currency amount in Indian Rupees (₹)
 */
function formatPrice($amount) {
    return '₹' . number_format($amount);
}

/**
 * Sanitize user input
 */
function sanitize($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Get package by ID
 */
function getPackageById($id, $packagesList = null) {
    global $packages;
    $list = $packagesList ?: $packages;
    foreach ($list as $pkg) {
        if ($pkg['id'] === $id) {
            return $pkg;
        }
    }
    return null;
}

/**
 * Filter packages by category, tier, or query
 */
function filterPackages($packages, $category = '', $tier = '', $search = '', $maxPrice = null) {
    $filtered = [];

    foreach ($packages as $pkg) {
        // Search filter
        if (!empty($search)) {
            $searchLower = strtolower($search);
            $matchesTitle = strpos(strtolower($pkg['title']), $searchLower) !== false;
            $matchesCountry = strpos(strtolower($pkg['country']), $searchLower) !== false;
            $matchesLoc = strpos(strtolower($pkg['location']), $searchLower) !== false;
            if (!$matchesTitle && !$matchesCountry && !$matchesLoc) {
                continue;
            }
        }

        // Category filter
        if (!empty($category) && $category !== 'all') {
            if (stripos($pkg['category'], $category) === false) {
                continue;
            }
        }

        // Price filter (based on starting / budget plan price)
        if ($maxPrice && $pkg['plans']['explorer']['discount_price'] > $maxPrice) {
            continue;
        }

        // Tier filter
        if (!empty($tier) && $tier !== 'all') {
            if (!isset($pkg['plans'][$tier])) {
                continue;
            }
        }

        $filtered[] = $pkg;
    }

    return $filtered;
}

/**
 * Save booking into Normalized Clean MySQL Database Tables (bookings + booking_details)
 */
function saveBooking($bookingData) {
    global $packages;

    // Generate unique booking reference ID
    $bookingData['booking_id'] = 'WW-' . strtoupper(substr(uniqid(), -6));
    $bookingData['created_at'] = date('Y-m-d H:i:s');
    $bookingData['status'] = 'Confirmed';

    // 1. Save to Clean MySQL Database
    $pdo = getDBConnection();
    if ($pdo) {
        try {
            // A. Insert into clean primary 'bookings' table
            $stmtB = $pdo->prepare("INSERT INTO `bookings` (
                `booking_id`, `customer_name`, `customer_phone`, `customer_email`,
                `package_title`, `plan_name`, `travel_date`, `guests`,
                `total_amount`, `payment_mode`, `status`
            ) VALUES (
                :booking_id, :customer_name, :customer_phone, :customer_email,
                :package_title, :plan_name, :travel_date, :guests,
                :total_amount, :payment_mode, :status
            )");

            $stmtB->execute([
                ':booking_id' => $bookingData['booking_id'],
                ':customer_name' => $bookingData['customer']['full_name'],
                ':customer_phone' => $bookingData['customer']['phone'],
                ':customer_email' => $bookingData['customer']['email'],
                ':package_title' => $bookingData['package_title'],
                ':plan_name' => $bookingData['plan_name'],
                ':travel_date' => $bookingData['travel_date'],
                ':guests' => $bookingData['total_guests'],
                ':total_amount' => $bookingData['grand_total'],
                ':payment_mode' => $bookingData['payment']['method'] ?? 'UPI',
                ':status' => 'Confirmed'
            ]);

            // B. Insert into 'booking_details' table for secondary fields
            $addonsSummary = [];
            if (!empty($bookingData['addons'])) {
                foreach ($bookingData['addons'] as $add) {
                    $addonsSummary[] = $add['name'];
                }
            }

            $stmtD = $pdo->prepare("INSERT INTO `booking_details` (
                `booking_id`, `package_id`, `adults`, `children`,
                `base_price`, `addons_price`, `addons_summary`,
                `city_state`, `id_proof`, `special_requests`
            ) VALUES (
                :booking_id, :package_id, :adults, :children,
                :base_price, :addons_price, :addons_summary,
                :city_state, :id_proof, :special_requests
            )");

            $stmtD->execute([
                ':booking_id' => $bookingData['booking_id'],
                ':package_id' => $bookingData['package_id'],
                ':adults' => $bookingData['adults'],
                ':children' => $bookingData['children'],
                ':base_price' => $bookingData['base_total'],
                ':addons_price' => $bookingData['addons_total'],
                ':addons_summary' => implode(', ', $addonsSummary),
                ':city_state' => $bookingData['customer']['nationality'] ?? '',
                ':id_proof' => $bookingData['customer']['passport_no'] ?? '',
                ':special_requests' => $bookingData['customer']['special_requests'] ?? ''
            ]);

        } catch (PDOException $e) {
            error_log("Failed to insert booking into MySQL: " . $e->getMessage());
        }
    }

    // 2. Save to Session cache
    if (!isset($_SESSION['bookings'])) {
        $_SESSION['bookings'] = [];
    }
    array_unshift($_SESSION['bookings'], $bookingData);

    // 3. Save to JSON backup file
    $dataFile = __DIR__ . '/../data/bookings.json';
    $dataDir = dirname($dataFile);
    if (!is_dir($dataDir)) {
        @mkdir($dataDir, 0777, true);
    }
    $existing = [];
    if (file_exists($dataFile)) {
        $json = @file_get_contents($dataFile);
        if ($json) {
            $existing = json_decode($json, true) ?: [];
        }
    }
    array_unshift($existing, $bookingData);
    @file_put_contents($dataFile, json_encode($existing, JSON_PRETTY_PRINT));

    return $bookingData;
}

/**
 * Format DB row to standard array structure for views
 */
function formatDbBookingRow($row) {
    global $packages;

    $pkgId = $row['package_id'] ?? 'kashmir-paradise';
    $pkg = getPackageById($pkgId, $packages) ?: $packages[0];

    // Determine plan key
    $planName = $row['plan_name'] ?? 'Comfort Plan';
    $planKey = 'comfort';
    if (stripos($planName, 'explorer') !== false) $planKey = 'explorer';
    if (stripos($planName, 'maharaja') !== false || stripos($planName, 'luxury') !== false) $planKey = 'luxury';

    $plan = $pkg['plans'][$planKey] ?? $pkg['plans']['comfort'];

    $addons = [];
    if (!empty($row['addons_summary'])) {
        $addons[] = [
            'name' => $row['addons_summary'],
            'cost' => (float)($row['addons_price'] ?? 0)
        ];
    }

    return [
        'id' => $row['id'] ?? null,
        'booking_id' => $row['booking_id'],
        'created_at' => $row['created_at'],
        'status' => $row['status'],
        'package_id' => $pkg['id'],
        'package_title' => $row['package_title'],
        'location' => $pkg['location'],
        'country' => 'India',
        'duration' => $pkg['duration'],
        'hero_image' => $pkg['hero_image'],
        'plan_key' => $planKey,
        'plan_name' => $row['plan_name'],
        'plan_price' => (float)$plan['discount_price'],
        'hotel' => $plan['hotel'],
        'transport' => $plan['transport'],
        'travel_date' => $row['travel_date'],
        'adults' => (int)($row['adults'] ?? $row['guests'] ?? 1),
        'children' => (int)($row['children'] ?? 0),
        'total_guests' => (int)($row['guests'] ?? 1),
        'addons' => $addons,
        'base_total' => (float)($row['base_price'] ?? ($row['total_amount'] - ($row['addons_price'] ?? 0))),
        'addons_total' => (float)($row['addons_price'] ?? 0),
        'grand_total' => (float)$row['total_amount'],
        'customer' => [
            'full_name' => $row['customer_name'],
            'email' => $row['customer_email'],
            'phone' => $row['customer_phone'],
            'nationality' => $row['city_state'] ?? 'India',
            'passport_no' => $row['id_proof'] ?? '',
            'special_requests' => $row['special_requests'] ?? ''
        ],
        'payment' => [
            'method' => $row['payment_mode'] ?? 'UPI',
            'status' => 'Paid / Confirmed'
        ]
    ];
}

/**
 * Get all user bookings from MySQL (Clean JOIN query)
 */
function getAllBookings() {
    $pdo = getDBConnection();
    if ($pdo) {
        try {
            $sql = "SELECT b.*, 
                           d.package_id, d.adults, d.children, d.base_price, 
                           d.addons_price, d.addons_summary, d.city_state, 
                           d.id_proof, d.special_requests
                    FROM `bookings` b
                    LEFT JOIN `booking_details` d ON b.booking_id = d.booking_id
                    ORDER BY b.id DESC";

            $stmt = $pdo->query($sql);
            $rows = $stmt->fetchAll();
            if (!empty($rows)) {
                $bookings = [];
                foreach ($rows as $r) {
                    $bookings[] = formatDbBookingRow($r);
                }
                $_SESSION['bookings'] = $bookings;
                return $bookings;
            }
        } catch (PDOException $e) {
            error_log("Failed to query bookings from MySQL: " . $e->getMessage());
        }
    }

    // Fallback to session / JSON
    $bookings = $_SESSION['bookings'] ?? [];
    if (empty($bookings)) {
        $dataFile = __DIR__ . '/../data/bookings.json';
        if (file_exists($dataFile)) {
            $json = @file_get_contents($dataFile);
            if ($json) {
                $bookings = json_decode($json, true) ?: [];
                $_SESSION['bookings'] = $bookings;
            }
        }
    }
    
    return $bookings;
}

/**
 * Get single booking by ID
 */
function getBookingById($id) {
    $pdo = getDBConnection();
    if ($pdo) {
        try {
            $sql = "SELECT b.*, 
                           d.package_id, d.adults, d.children, d.base_price, 
                           d.addons_price, d.addons_summary, d.city_state, 
                           d.id_proof, d.special_requests
                    FROM `bookings` b
                    LEFT JOIN `booking_details` d ON b.booking_id = d.booking_id
                    WHERE b.booking_id = :id
                    LIMIT 1";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([':id' => $id]);
            $row = $stmt->fetch();
            if ($row) {
                return formatDbBookingRow($row);
            }
        } catch (PDOException $e) {
            error_log("Failed to get booking by ID from MySQL: " . $e->getMessage());
        }
    }

    $bookings = getAllBookings();
    foreach ($bookings as $b) {
        if ($b['booking_id'] === $id) {
            return $b;
        }
    }
    return null;
}

/**
 * Cancel booking in MySQL, Session & JSON
 */
function cancelBooking($id) {
    $pdo = getDBConnection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("UPDATE `bookings` SET `status` = 'Cancelled' WHERE `booking_id` = :id");
            $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Failed to cancel booking in MySQL: " . $e->getMessage());
        }
    }

    if (isset($_SESSION['bookings'])) {
        foreach ($_SESSION['bookings'] as &$b) {
            if ($b['booking_id'] === $id) {
                $b['status'] = 'Cancelled';
                break;
            }
        }
    }

    $dataFile = __DIR__ . '/../data/bookings.json';
    if (file_exists($dataFile)) {
        $json = @file_get_contents($dataFile);
        if ($json) {
            $existing = json_decode($json, true) ?: [];
            foreach ($existing as &$item) {
                if ($item['booking_id'] === $id) {
                    $item['status'] = 'Cancelled';
                    break;
                }
            }
            @file_put_contents($dataFile, json_encode($existing, JSON_PRETTY_PRINT));
        }
    }
}

/**
 * Save contact inquiry to MySQL database
 */
function saveInquiry($name, $email, $phone, $destination, $preferredPlan, $message) {
    $pdo = getDBConnection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO `inquiries` (`name`, `email`, `phone`, `destination`, `preferred_plan`, `message`) VALUES (:name, :email, :phone, :destination, :preferred_plan, :message)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':destination' => $destination,
                ':preferred_plan' => $preferredPlan,
                ':message' => $message
            ]);
            return true;
        } catch (PDOException $e) {
            error_log("Failed to save inquiry to MySQL: " . $e->getMessage());
        }
    }
    return false;
}
