<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/data.php';

$bookingCount = count(getAllBookings());
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | WanderWise Bharat' : 'WanderWise India - Curated Bharat Yatra & Holiday Packages'; ?></title>
    <meta name="description" content="Explore Incredible India with 3 curated travel plans: Explorer, Comfort, and Royal Maharaja. Verified hotels, transparent INR pricing with GST, and guaranteed memories.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header class="site-header">
    <div class="container header-container">
        <a href="index.php" class="brand-logo">
            <div class="logo-icon">🇮🇳</div>
            <span>Wander<span>Bharat</span></span>
        </a>

        <nav class="nav-links" id="navLinks">
            <a href="index.php" class="nav-link <?php echo $currentPage === 'index.php' ? 'active' : ''; ?>">Home</a>
            <a href="packages.php" class="nav-link <?php echo in_array($currentPage, ['packages.php', 'package-details.php']) ? 'active' : ''; ?>">All Indian Packages</a>
            <a href="index.php#plans" class="nav-link">Compare 3 Plans</a>
            <a href="index.php#why-us" class="nav-link">Why Us</a>
            <a href="contact.php" class="nav-link <?php echo $currentPage === 'contact.php' ? 'active' : ''; ?>">Contact</a>
        </nav>

        <div class="header-actions">
            <a href="my-bookings.php" class="btn btn-outline bookings-pill">
                <span>📋 My Bookings</span>
                <?php if ($bookingCount > 0): ?>
                    <span class="badge-count"><?php echo $bookingCount; ?></span>
                <?php endif; ?>
            </a>
            <a href="packages.php" class="btn btn-primary">Book Yatra</a>
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle navigation">☰</button>
        </div>
    </div>
</header>
<main>
