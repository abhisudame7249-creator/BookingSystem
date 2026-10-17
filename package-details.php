<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/data.php';

$pkgId = sanitize($_GET['id'] ?? 'kashmir-paradise');
$package = getPackageById($pkgId, $packages);

if (!$package) {
    $package = $packages[0];
}

$pageTitle = $package['title'] . " (3 Plans Available)";
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-breadcrumb">
    <div class="container">
        <a href="index.php">Home</a> &nbsp;/&nbsp;
        <a href="packages.php">Packages</a> &nbsp;/&nbsp;
        <span><?php echo htmlspecialchars($package['title']); ?></span>
    </div>
</div>

<div class="details-hero">
    <div class="container">
        <div class="details-header">
            <div>
                <div style="display: flex; gap: 0.5rem; margin-bottom: 0.65rem; flex-wrap: wrap;">
                    <span class="badge badge-featured"><?php echo htmlspecialchars($package['badge']); ?></span>
                    <span class="badge badge-tier"><?php echo htmlspecialchars($package['category']); ?></span>
                </div>
                <h1 class="details-title"><?php echo htmlspecialchars($package['title']); ?></h1>
                <div class="details-submeta">
                    <span>📍 <?php echo htmlspecialchars($package['location']); ?></span>
                    <span>⏱️ <?php echo htmlspecialchars($package['duration']); ?></span>
                    <span>👥 Group: <?php echo htmlspecialchars($package['group_size']); ?></span>
                    <span>🌤️ Best Season: <?php echo htmlspecialchars($package['best_season']); ?></span>
                    <span style="color: #d97706; font-weight: 700;">★ <?php echo $package['rating']; ?> (<?php echo $package['reviews_count']; ?> reviews)</span>
                </div>
            </div>

            <div>
                <a href="#booking-section" class="btn btn-secondary btn-lg">Book This Yatra →</a>
            </div>
        </div>

        <!-- Photo Gallery Mosaic -->
        <div class="gallery-mosaic">
            <div class="gallery-mosaic-main">
                <img id="mainGalleryImg" src="<?php echo htmlspecialchars($package['hero_image']); ?>" alt="<?php echo htmlspecialchars($package['title']); ?>" style="cursor: zoom-in;">
            </div>
            <?php foreach (array_slice($package['gallery'], 1, 3) as $index => $img): ?>
                <div style="overflow: hidden; cursor: pointer;">
                    <img src="<?php echo htmlspecialchars($img); ?>" alt="Gallery Image <?php echo $index + 1; ?>" class="gallery-thumb-item" data-full="<?php echo htmlspecialchars($img); ?>" loading="lazy">
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Main Details Layout (2 Columns: Information + Interactive Booking Calculator) -->
        <div class="details-layout" id="booking-section">
            <!-- Left Column: Details, Plans, Itinerary -->
            <div class="details-left">
                <!-- Overview Card -->
                <div class="details-content-card">
                    <h2 class="content-heading">📖 Destination Overview</h2>
                    <p style="font-size: 1.05rem; color: var(--slate); line-height: 1.7; margin-bottom: 1.5rem;">
                        <?php echo htmlspecialchars($package['overview']); ?>
                    </p>

                    <h4 style="font-size: 1.1rem; margin-bottom: 0.85rem;">✨ Key Experience Highlights:</h4>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 0.75rem;">
                        <?php foreach ($package['highlights'] as $highlight): ?>
                            <div style="display: flex; align-items: flex-start; gap: 0.5rem; font-size: 0.95rem; color: var(--slate);">
                                <span style="color: var(--primary); font-weight: 800;">✓</span>
                                <span><?php echo htmlspecialchars($highlight); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- 3 PLANS SELECTION SECTION -->
                <div class="details-content-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 0.5rem;">
                        <h2 class="content-heading" style="margin: 0; padding: 0; border: none;">💎 Select Your Travel Plan (3 Available)</h2>
                        <span style="font-size: 0.85rem; color: var(--primary); font-weight: 700;">Click a plan to view specifications</span>
                    </div>

                    <!-- Plan Selection Tabs/Cards -->
                    <div class="plan-tabs-container">
                        <!-- Plan 1: Explorer -->
                        <div class="plan-select-card" data-plan="explorer">
                            <div class="plan-select-badge">Budget Friendly</div>
                            <div class="plan-select-name">🎒 Explorer Plan</div>
                            <div class="plan-select-price">
                                ₹<?php echo number_format($package['plans']['explorer']['discount_price']); ?>
                                <small>/ person</small>
                            </div>
                        </div>

                        <!-- Plan 2: Comfort (Default Active) -->
                        <div class="plan-select-card active" data-plan="comfort">
                            <div class="plan-select-badge" style="color: #0284c7;">Most Popular</div>
                            <div class="plan-select-name">🌟 Comfort Plan</div>
                            <div class="plan-select-price">
                                ₹<?php echo number_format($package['plans']['comfort']['discount_price']); ?>
                                <small>/ person</small>
                            </div>
                        </div>

                        <!-- Plan 3: Royal Maharaja VIP -->
                        <div class="plan-select-card" data-plan="luxury">
                            <div class="plan-select-badge" style="color: #b45309;">VIP Royal Living</div>
                            <div class="plan-select-name">👑 Maharaja VIP</div>
                            <div class="plan-select-price">
                                ₹<?php echo number_format($package['plans']['luxury']['discount_price']); ?>
                                <small>/ person</small>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Plan Specification Box -->
                    <div class="selected-plan-breakdown">
                        <div class="plan-spec-grid">
                            <div class="spec-box">
                                <div class="spec-title">🏨 Accommodation</div>
                                <div class="spec-val" id="specHotel"><?php echo htmlspecialchars($package['plans']['comfort']['hotel']); ?></div>
                            </div>
                            <div class="spec-box">
                                <div class="spec-title">🚗 Transportation</div>
                                <div class="spec-val" id="specTransport"><?php echo htmlspecialchars($package['plans']['comfort']['transport']); ?></div>
                            </div>
                            <div class="spec-box">
                                <div class="spec-title">🍽️ Meals Included</div>
                                <div class="spec-val" id="specMeals"><?php echo htmlspecialchars($package['plans']['comfort']['meals']); ?></div>
                            </div>
                            <div class="spec-box">
                                <div class="spec-title">🧭 Tour Guide & Escort</div>
                                <div class="spec-val" id="specGuide"><?php echo htmlspecialchars($package['plans']['comfort']['guide']); ?></div>
                            </div>
                        </div>

                        <h4 style="font-size: 0.95rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--muted); margin-bottom: 0.75rem;">
                            Included in this plan tier:
                        </h4>
                        <ul class="plan-features-list" id="dynamicInclusionsList" style="margin-bottom: 0;">
                            <?php foreach ($package['plans']['comfort']['features'] as $feat): ?>
                                <li class="plan-feature-item">
                                    <span class="feature-check">✓</span>
                                    <span><?php echo htmlspecialchars($feat); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <!-- Day-by-Day Itinerary -->
                <div class="details-content-card">
                    <h2 class="content-heading">🗓️ Day-by-Day Itinerary (<?php echo htmlspecialchars($package['duration']); ?>)</h2>
                    <div class="itinerary-list">
                        <?php foreach ($package['itinerary'] as $item): ?>
                            <div class="itinerary-item">
                                <div class="itinerary-day-badge"><?php echo $item['day']; ?></div>
                                <div class="itinerary-content">
                                    <h4 class="itinerary-title">Day <?php echo $item['day']; ?>: <?php echo htmlspecialchars($item['title']); ?></h4>
                                    <p class="itinerary-desc"><?php echo htmlspecialchars($item['desc']); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Inclusions & Exclusions Checklist -->
                <div class="details-content-card">
                    <h2 class="content-heading">📋 What's Included & Excluded</h2>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                        <div>
                            <h4 style="color: #15803d; font-size: 1.05rem; margin-bottom: 0.85rem;">✓ Standard Inclusions</h4>
                            <ul style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.92rem; color: var(--slate);">
                                <li>✓ All hotel nights according to selected plan</li>
                                <li>✓ Daily fresh breakfast at all accommodations</li>
                                <li>✓ Designated transfers (airport, station & tours)</li>
                                <li>✓ Toll taxes, interstate permits & parking fees</li>
                                <li>✓ 5% GST and driver night allowances included</li>
                            </ul>
                        </div>
                        <div>
                            <h4 style="color: #b91c1c; font-size: 1.05rem; margin-bottom: 0.85rem;">✗ Exclusions</h4>
                            <ul style="display: flex; flex-direction: column; gap: 0.5rem; font-size: 0.92rem; color: var(--slate);">
                                <li>✗ Flight / Train tickets to destination</li>
                                <li>✗ Personal shopping, laundry & minibar</li>
                                <li>✗ Optional adventure rides (paragliding, rafting, snowmobiles unless in plan)</li>
                                <li>✗ Monument camera/drone fees</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sticky Real-time Booking Calculator Box -->
            <div class="details-right">
                <div class="sticky-booking-card">
                    <div class="booking-price-header">
                        <span style="font-size: 0.8rem; text-transform: uppercase; font-weight: 700; color: var(--muted); letter-spacing: 0.05em;">Selected Plan & Rate</span>
                        <div style="display: flex; align-items: baseline; justify-content: space-between; margin-top: 0.25rem;">
                            <h3 id="calcPlanName" style="font-size: 1.35rem; color: var(--dark);">Comfort Plan</h3>
                            <span id="calcPlanRate" style="font-size: 1.4rem; font-weight: 800; color: var(--primary);">
                                ₹<?php echo number_format($package['plans']['comfort']['discount_price']); ?> <small style="font-size: 0.8rem; font-weight: 500; color: var(--muted);">/ person</small>
                            </span>
                        </div>
                    </div>

                    <!-- Direct Booking Form -->
                    <form action="booking.php" method="GET" id="packageBookingForm">
                        <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package['id']); ?>">
                        <input type="hidden" name="plan" id="selectedPlanInput" value="comfort">

                        <!-- Travel Date -->
                        <div class="booking-form-group">
                            <label class="booking-form-label">📅 Travel Date</label>
                            <input type="date" name="travel_date" id="travelDate" class="booking-form-control" value="<?php echo date('Y-m-d', strtotime('+7 days')); ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                        </div>

                        <!-- Guests Counts -->
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.75rem;" class="booking-form-group">
                            <div>
                                <label class="booking-form-label">Adults (12+)</label>
                                <input type="number" name="adults" id="adultsCount" class="booking-form-control" value="2" min="1" max="15" required>
                            </div>
                            <div>
                                <label class="booking-form-label">Children (2-11)</label>
                                <input type="number" name="children" id="childrenCount" class="booking-form-control" value="0" min="0" max="10">
                            </div>
                        </div>

                        <!-- Optional Add-ons -->
                        <div class="booking-form-group" style="margin-top: 1.25rem;">
                            <label class="booking-form-label">🎁 Optional Travel Add-ons</label>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <?php foreach ($available_addons as $addon): ?>
                                    <label style="display: flex; align-items: center; justify-content: space-between; font-size: 0.85rem; padding: 0.5rem; background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-sm); cursor: pointer;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <input type="checkbox" name="addons[]" value="<?php echo $addon['id']; ?>" class="addon-checkbox" data-price="<?php echo $addon['price']; ?>" <?php echo $addon['id'] === 'insurance' ? 'checked' : ''; ?>>
                                            <span><?php echo htmlspecialchars($addon['name']); ?></span>
                                        </div>
                                        <span style="font-weight: 700; color: var(--primary);">+₹<?php echo number_format($addon['price']); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Live Calculation Summary Box -->
                        <div class="price-breakdown-box">
                            <div class="breakdown-row">
                                <span>Guests Count:</span>
                                <span id="calcGuestsDisplay" style="font-weight: 600;">2 Adults</span>
                            </div>
                            <div class="breakdown-row">
                                <span>Plan Base Subtotal:</span>
                                <span id="calcBaseSubtotal" style="font-weight: 600;">₹0</span>
                            </div>
                            <div class="breakdown-row">
                                <span>Add-ons Subtotal:</span>
                                <span id="calcAddonsSubtotal" style="font-weight: 600;">₹0</span>
                            </div>
                            <div class="breakdown-row total-row">
                                <span>Total Price:</span>
                                <span id="calcTotalAmount">₹0</span>
                            </div>
                            <div style="font-size: 0.75rem; color: #15803d; text-align: right; margin-top: 0.25rem;">
                                ✓ 5% GST and all state road taxes included
                            </div>
                        </div>

                        <button type="submit" id="submitBookingBtn" class="btn btn-secondary btn-block btn-lg">
                            Proceed to Booking →
                        </button>
                    </form>

                    <div style="margin-top: 1.25rem; font-size: 0.8rem; color: var(--muted); text-align: center; display: flex; flex-direction: column; gap: 0.35rem;">
                        <span>🔒 Instant Confirmation • UPI & Cards Accepted</span>
                        <span>🔄 Free date modification up to 10 days before trip</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Embed PHP package data for JavaScript client calculations -->
<script>
    window.currentPackagePlans = <?php echo json_encode($package['plans']); ?>;
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
