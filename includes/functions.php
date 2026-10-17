<?php
/**
 * WanderWise Travel Booking - Helper Functions & MySQL Data Access
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

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
function getPackageById($id, $packages) {
    foreach ($packages as $pkg) {
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
 * Save booking into MySQL Database (with Session & JSON backup)
 */
function saveBooking($bookingData) {
    // Generate unique booking reference ID
    $bookingData['booking_id'] = 'WW-' . strtoupper(substr(uniqid(), -6));
    $bookingData['created_at'] = date('Y-m-d H:i:s');
    $bookingData['status'] = 'Confirmed';

    // 1. Save to MySQL Database
    $pdo = getDBConnection();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO `bookings` (
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
                ':booking_id' => $bookingData['booking_id'],
                ':package_id' => $bookingData['package_id'],
                ':package_title' => $bookingData['package_title'],
                ':location' => $bookingData['location'],
                ':country' => $bookingData['country'],
                ':duration' => $bookingData['duration'],
                ':hero_image' => $bookingData['hero_image'] ?? '',
                ':plan_key' => $bookingData['plan_key'],
                ':plan_name' => $bookingData['plan_name'],
                ':plan_price' => $bookingData['plan_price'],
                ':hotel' => $bookingData['hotel'],
                ':transport' => $bookingData['transport'],
                ':travel_date' => $bookingData['travel_date'],
                ':adults' => $bookingData['adults'],
                ':children' => $bookingData['children'],
                ':total_guests' => $bookingData['total_guests'],
                ':addons_json' => json_encode($bookingData['addons'] ?? []),
                ':base_total' => $bookingData['base_total'],
                ':addons_total' => $bookingData['addons_total'],
                ':grand_total' => $bookingData['grand_total'],
                ':customer_name' => $bookingData['customer']['full_name'],
                ':customer_email' => $bookingData['customer']['email'],
                ':customer_phone' => $bookingData['customer']['phone'],
                ':customer_nationality' => $bookingData['customer']['nationality'] ?? '',
                ':customer_passport' => $bookingData['customer']['passport_no'] ?? '',
                ':special_requests' => $bookingData['customer']['special_requests'] ?? '',
                ':payment_method' => $bookingData['payment']['method'] ?? 'card',
                ':payment_status' => $bookingData['payment']['status'] ?? 'Paid / Confirmed',
                ':status' => 'Confirmed'
            ]);
        } catch (PDOException $e) {
            error_log("Failed to insert booking into MySQL: " . $e->getMessage());
        }
    }

    // 2. Save to Session
    if (!isset($_SESSION['bookings'])) {
        $_SESSION['bookings'] = [];
    }
    array_unshift($_SESSION['bookings'], $bookingData);

    // 3. Save to JSON File
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
 * Format DB row to standard booking array structure
 */
function formatDbBookingRow($row) {
    return [
        'id' => $row['id'] ?? null,
        'booking_id' => $row['booking_id'],
        'created_at' => $row['created_at'],
        'status' => $row['status'],
        'package_id' => $row['package_id'],
        'package_title' => $row['package_title'],
        'location' => $row['location'],
        'country' => $row['country'],
        'duration' => $row['duration'],
        'hero_image' => $row['hero_image'],
        'plan_key' => $row['plan_key'],
        'plan_name' => $row['plan_name'],
        'plan_price' => (float)$row['plan_price'],
        'hotel' => $row['hotel'],
        'transport' => $row['transport'],
        'travel_date' => $row['travel_date'],
        'adults' => (int)$row['adults'],
        'children' => (int)$row['children'],
        'total_guests' => (int)$row['total_guests'],
        'addons' => json_decode($row['addons_json'] ?? '[]', true) ?: [],
        'base_total' => (float)$row['base_total'],
        'addons_total' => (float)$row['addons_total'],
        'grand_total' => (float)$row['grand_total'],
        'customer' => [
            'full_name' => $row['customer_name'],
            'email' => $row['customer_email'],
            'phone' => $row['customer_phone'],
            'nationality' => $row['customer_nationality'],
            'passport_no' => $row['customer_passport'],
            'special_requests' => $row['special_requests']
        ],
        'payment' => [
            'method' => $row['payment_method'],
            'status' => $row['payment_status']
        ]
    ];
}

/**
 * Get all user bookings from MySQL (or fallback to session/JSON)
 */
function getAllBookings() {
    $pdo = getDBConnection();
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM `bookings` ORDER BY `id` DESC");
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

    // Fallback to session
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
            $stmt = $pdo->prepare("SELECT * FROM `bookings` WHERE `booking_id` = :id LIMIT 1");
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
