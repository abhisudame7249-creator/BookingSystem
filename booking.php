<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/data.php';

$errors = [];
$successBooking = null;

// Handle POST booking submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $packageId = sanitize($_POST['package_id'] ?? '');
    $planKey = sanitize($_POST['plan'] ?? 'comfort');
    $travelDate = sanitize($_POST['travel_date'] ?? '');
    $adults = max(1, (int)($_POST['adults'] ?? 1));
    $children = max(0, (int)($_POST['children'] ?? 0));
    $selectedAddons = $_POST['addons'] ?? [];

    $fullName = sanitize($_POST['full_name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $stateCity = sanitize($_POST['state_city'] ?? '');
    $idProof = sanitize($_POST['id_proof'] ?? '');
    $specialRequests = sanitize($_POST['special_requests'] ?? '');
    $paymentMethod = sanitize($_POST['payment_method'] ?? 'upi');

    // Validation
    if (empty($fullName)) $errors[] = "Please enter your full name.";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Please provide a valid email address.";
    if (empty($phone)) $errors[] = "Please provide a valid 10-digit mobile number.";
    if (empty($travelDate)) $errors[] = "Please select your travel departure date.";

    $pkg = getPackageById($packageId, $packages);
    if (!$pkg) {
        $errors[] = "Invalid package selected.";
    }

    if (empty($errors)) {
        $plan = $pkg['plans'][$planKey] ?? $pkg['plans']['comfort'];

        // Price calculation
        $adultTotal = $adults * $plan['discount_price'];
        $childTotal = $children * round($plan['discount_price'] * 0.5);
        $baseTotal = $adultTotal + $childTotal;

        $addonsList = [];
        $addonsTotal = 0;
        foreach ($selectedAddons as $addonId) {
            if (isset($available_addons[$addonId])) {
                $a = $available_addons[$addonId];
                $cost = $a['price'] * ($adults + $children);
                $addonsTotal += $cost;
                $addonsList[] = [
                    'id' => $addonId,
                    'name' => $a['name'],
                    'cost' => $cost
                ];
            }
        }

        $grandTotal = $baseTotal + $addonsTotal;

        $bookingRecord = [
            'package_id' => $pkg['id'],
            'package_title' => $pkg['title'],
            'location' => $pkg['location'],
            'country' => 'India',
            'duration' => $pkg['duration'],
            'hero_image' => $pkg['hero_image'],
            'plan_key' => $planKey,
            'plan_name' => $plan['name'],
            'plan_price' => $plan['discount_price'],
            'hotel' => $plan['hotel'],
            'transport' => $plan['transport'],
            'travel_date' => $travelDate,
            'adults' => $adults,
            'children' => $children,
            'total_guests' => $adults + $children,
            'addons' => $addonsList,
            'base_total' => $baseTotal,
            'addons_total' => $addonsTotal,
            'grand_total' => $grandTotal,
            'customer' => [
                'full_name' => $fullName,
                'email' => $email,
                'phone' => $phone,
                'nationality' => $stateCity ?: 'India',
                'passport_no' => $idProof,
                'special_requests' => $specialRequests
            ],
            'payment' => [
                'method' => strtoupper($paymentMethod),
                'status' => 'Paid / Confirmed'
            ]
        ];

        $savedBooking = saveBooking($bookingRecord);
        header("Location: confirmation.php?booking_id=" . urlencode($savedBooking['booking_id']));
        exit;
    }
}

// Handle GET parameters when coming from package details
$packageId = sanitize($_GET['package_id'] ?? 'kashmir-paradise');
$selectedPlanKey = sanitize($_GET['plan'] ?? 'comfort');
$travelDate = sanitize($_GET['travel_date'] ?? date('Y-m-d', strtotime('+7 days')));
$adults = max(1, (int)($_GET['adults'] ?? 2));
$children = max(0, (int)($_GET['children'] ?? 0));
$preselectedAddons = $_GET['addons'] ?? ['insurance'];

$package = getPackageById($packageId, $packages) ?: $packages[0];
$plan = $package['plans'][$selectedPlanKey] ?? $package['plans']['comfort'];

// Base calculations
$adultTotal = $adults * $plan['discount_price'];
$childTotal = $children * round($plan['discount_price'] * 0.5);
$baseTotal = $adultTotal + $childTotal;

$addonsTotal = 0;
foreach ($preselectedAddons as $aId) {
    if (isset($available_addons[$aId])) {
        $addonsTotal += $available_addons[$aId]['price'] * ($adults + $children);
    }
}
$grandTotal = $baseTotal + $addonsTotal;

$pageTitle = "Checkout & Booking - " . $package['title'];
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-breadcrumb">
    <div class="container">
        <a href="index.php">Home</a> &nbsp;/&nbsp;
        <a href="packages.php">Packages</a> &nbsp;/&nbsp;
        <a href="package-details.php?id=<?php echo urlencode($package['id']); ?>"><?php echo htmlspecialchars($package['title']); ?></a> &nbsp;/&nbsp;
        <span>Checkout & Reservation</span>
    </div>
</div>

<section class="section-padding" style="padding-top: 2rem;">
    <div class="container">
        <div style="margin-bottom: 2rem;">
            <span class="section-badge">Secure Booking</span>
            <h1 style="font-size: 2.25rem; letter-spacing: -0.02em;">Complete Your Bharat Yatra Booking</h1>
            <p style="color: var(--muted);">Review your selected plan, enter traveler details, and confirm your reservation with instant confirmation.</p>
        </div>

        <?php if (!empty($errors)): ?>
            <div style="background: #fef2f2; border: 1px solid #f87171; color: #b91c1c; padding: 1rem 1.25rem; border-radius: var(--radius-sm); margin-bottom: 2rem;">
                <ul style="margin-left: 1.25rem; list-style-type: disc;">
                    <?php foreach ($errors as $err): ?>
                        <li><?php echo htmlspecialchars($err); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="booking.php" method="POST" id="checkoutForm">
            <input type="hidden" name="package_id" value="<?php echo htmlspecialchars($package['id']); ?>">
            <input type="hidden" name="plan" value="<?php echo htmlspecialchars($selectedPlanKey); ?>">
            <input type="hidden" name="payment_method" id="paymentMethodInput" value="upi">

            <div class="checkout-grid">
                <!-- Left Column: Forms -->
                <div>
                    <!-- Step 1: Traveler Information -->
                    <div class="form-section-card">
                        <h2 class="content-heading">👤 Primary Yatri (Traveler) Details</h2>
                        
                        <div class="form-grid-2" style="margin-bottom: 1.25rem;">
                            <div>
                                <label class="booking-form-label">Full Name (As on Govt ID) *</label>
                                <input type="text" name="full_name" class="booking-form-control" placeholder="e.g. Rahul Sharma" value="<?php echo htmlspecialchars($_POST['full_name'] ?? ''); ?>" required>
                            </div>
                            <div>
                                <label class="booking-form-label">Email Address *</label>
                                <input type="email" name="email" class="booking-form-control" placeholder="rahul.sharma@example.com" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                            </div>
                        </div>

                        <div class="form-grid-2" style="margin-bottom: 1.25rem;">
                            <div>
                                <label class="booking-form-label">Mobile Number (WhatsApp) *</label>
                                <input type="tel" name="phone" class="booking-form-control" placeholder="+91 98765 43210" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" required>
                            </div>
                            <div>
                                <label class="booking-form-label">City & State</label>
                                <input type="text" name="state_city" class="booking-form-control" placeholder="e.g. Mumbai, Maharashtra" value="<?php echo htmlspecialchars($_POST['state_city'] ?? ''); ?>">
                            </div>
                        </div>

                        <div class="form-grid-2">
                            <div>
                                <label class="booking-form-label">Aadhaar / Voter ID / Passport Number</label>
                                <input type="text" name="id_proof" class="booking-form-control" placeholder="Optional for hotel check-in" value="<?php echo htmlspecialchars($_POST['id_proof'] ?? ''); ?>">
                            </div>
                            <div>
                                <label class="booking-form-label">Meal Preference / Special Requests</label>
                                <input type="text" name="special_requests" class="booking-form-control" placeholder="Pure Veg, Jain Meal, Ground floor room..." value="<?php echo htmlspecialchars($_POST['special_requests'] ?? ''); ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Trip Customization & Add-ons -->
                    <div class="form-section-card">
                        <h2 class="content-heading">🎁 Travel Add-ons & Insurance (INR)</h2>
                        <p style="font-size: 0.9rem; color: var(--muted); margin-bottom: 1.25rem;">Select optional add-ons to enhance your travel experience.</p>

                        <div class="addon-selection-list">
                            <?php foreach ($available_addons as $addon): 
                                $isChecked = in_array($addon['id'], $preselectedAddons);
                            ?>
                                <label class="addon-card-label">
                                    <input type="checkbox" name="addons[]" value="<?php echo $addon['id']; ?>" class="checkout-addon-cb" data-price="<?php echo $addon['price']; ?>" <?php echo $isChecked ? 'checked' : ''; ?>>
                                    <div class="addon-info">
                                        <div class="addon-name"><?php echo htmlspecialchars($addon['name']); ?></div>
                                        <div class="addon-desc"><?php echo htmlspecialchars($addon['desc']); ?></div>
                                    </div>
                                    <div class="addon-price">+₹<?php echo number_format($addon['price']); ?> <small>/ person</small></div>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Step 3: Payment Method -->
                    <div class="form-section-card">
                        <h2 class="content-heading">💳 Payment Method (Instant / Simulated)</h2>
                        <p style="font-size: 0.9rem; color: var(--muted); margin-bottom: 1.25rem;">Select your preferred Indian payment mode. (Simulation mode: Generates confirmed voucher immediately).</p>

                        <div class="payment-methods-grid">
                            <div class="payment-method-card active" data-method="upi">
                                <span style="font-size: 1.5rem;">📱</span>
                                <span style="font-size: 0.85rem; font-weight: 700;">UPI (GPay / PhonePe)</span>
                            </div>
                            <div class="payment-method-card" data-method="card">
                                <span style="font-size: 1.5rem;">💳</span>
                                <span style="font-size: 0.85rem; font-weight: 700;">RuPay / Debit / Card</span>
                            </div>
                            <div class="payment-method-card" data-method="netbanking">
                                <span style="font-size: 1.5rem;">🏦</span>
                                <span style="font-size: 0.85rem; font-weight: 700;">Net Banking</span>
                            </div>
                            <div class="payment-method-card" data-method="arrival">
                                <span style="font-size: 1.5rem;">🏨</span>
                                <span style="font-size: 0.85rem; font-weight: 700;">Pay on Arrival</span>
                            </div>
                        </div>

                        <!-- UPI Fields -->
                        <div id="upiFields" style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 1.25rem;">
                            <label class="booking-form-label">Enter UPI ID (VPA)</label>
                            <input type="text" class="booking-form-control" placeholder="e.g. rahul@okaxis or 9876543210@paytm" value="traveler@oksbi" style="margin-bottom: 0.75rem;">
                            <div style="display: flex; gap: 0.75rem; align-items: center; font-size: 0.85rem; color: var(--muted);">
                                <span>Accepted: <strong>Google Pay</strong>, <strong>PhonePe</strong>, <strong>Paytm</strong>, <strong>BHIM UPI</strong></span>
                            </div>
                        </div>

                        <!-- Card Fields -->
                        <div id="creditCardFields" style="display: none;">
                            <div style="margin-bottom: 1rem;">
                                <label class="booking-form-label">Name on Card</label>
                                <input type="text" class="booking-form-control" placeholder="Rahul Sharma" value="Rahul Sharma">
                            </div>
                            <div style="margin-bottom: 1rem;">
                                <label class="booking-form-label">RuPay / Visa / Mastercard Number</label>
                                <input type="text" class="booking-form-control" placeholder="6075 •••• •••• 8921" value="6075 8901 2345 8921">
                            </div>
                            <div class="form-grid-2">
                                <div>
                                    <label class="booking-form-label">Expiry (MM/YY)</label>
                                    <input type="text" class="booking-form-control" placeholder="12/28" value="12/28">
                                </div>
                                <div>
                                    <label class="booking-form-label">CVV</label>
                                    <input type="password" class="booking-form-control" placeholder="894" value="894">
                                </div>
                            </div>
                        </div>

                        <!-- Net Banking Fields -->
                        <div id="netbankingFields" style="display: none; padding: 1rem; background: #f8fafc; border-radius: var(--radius-sm); border: 1px solid var(--border);">
                            <label class="booking-form-label">Select Your Bank</label>
                            <select class="booking-form-control">
                                <option>State Bank of India (SBI)</option>
                                <option>HDFC Bank</option>
                                <option>ICICI Bank</option>
                                <option>Axis Bank</option>
                                <option>Punjab National Bank (PNB)</option>
                                <option>Bank of Baroda</option>
                            </select>
                        </div>

                        <!-- Pay on Arrival -->
                        <div id="arrivalFields" style="display: none; padding: 1rem; background: #f8fafc; border-radius: var(--radius-sm); border: 1px solid var(--border);">
                            <p style="font-size: 0.9rem; color: var(--slate); margin-bottom: 0.5rem;"><strong>Token Advance:</strong> Pay ₹2,000 online token now, and balance upon arrival at hotel/cab.</p>
                            <p style="font-size: 0.85rem; color: var(--muted);">Full voucher will be generated instantly for check-in.</p>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Booking Summary Card -->
                <div>
                    <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 1.75rem; box-shadow: var(--shadow-md); position: sticky; top: 90px;">
                        <h3 style="font-size: 1.25rem; margin-bottom: 1rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border);">
                            Yatra Summary
                        </h3>

                        <!-- Package Preview -->
                        <div style="display: flex; gap: 1rem; margin-bottom: 1.25rem;">
                            <img src="<?php echo htmlspecialchars($package['hero_image']); ?>" alt="<?php echo htmlspecialchars($package['title']); ?>" style="width: 80px; height: 80px; border-radius: var(--radius-sm); object-fit: cover;">
                            <div>
                                <span class="badge badge-featured" style="font-size: 0.7rem; margin-bottom: 0.25rem;"><?php echo htmlspecialchars($package['location']); ?></span>
                                <h4 style="font-size: 1rem; line-height: 1.3; margin-bottom: 0.25rem;"><?php echo htmlspecialchars($package['title']); ?></h4>
                                <div style="font-size: 0.8rem; color: var(--muted);">⏱️ <?php echo htmlspecialchars($package['duration']); ?></div>
                            </div>
                        </div>

                        <!-- Selected Plan Pill Box -->
                        <div style="background: #f0f9ff; border: 1px solid #bae6fd; border-radius: var(--radius-sm); padding: 0.85rem; margin-bottom: 1.25rem;">
                            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--primary);">Selected Plan Tier:</div>
                            <div style="font-size: 1.05rem; font-weight: 800; color: var(--primary-dark);"><?php echo htmlspecialchars($plan['name']); ?></div>
                            <div style="font-size: 0.8rem; color: var(--slate); margin-top: 0.25rem;">
                                🏨 <?php echo htmlspecialchars($plan['hotel']); ?>
                            </div>
                        </div>

                        <!-- Date & Guests Fields -->
                        <div class="booking-form-group">
                            <label class="booking-form-label">Departure Date</label>
                            <input type="date" name="travel_date" class="booking-form-control" value="<?php echo htmlspecialchars($travelDate); ?>" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;" class="booking-form-group">
                            <div>
                                <label class="booking-form-label">Adults (12+)</label>
                                <input type="number" name="adults" id="checkoutAdults" class="booking-form-control" value="<?php echo $adults; ?>" min="1" max="15" required>
                            </div>
                            <div>
                                <label class="booking-form-label">Children (2-11)</label>
                                <input type="number" name="children" id="checkoutChildren" class="booking-form-control" value="<?php echo $children; ?>" min="0" max="10">
                            </div>
                        </div>

                        <!-- Itemized Breakdown in Rupees -->
                        <div class="price-breakdown-box" style="margin-top: 1rem;">
                            <div class="breakdown-row">
                                <span><?php echo htmlspecialchars($plan['name']); ?>:</span>
                                <span>₹<?php echo number_format($plan['discount_price']); ?> / adult</span>
                            </div>
                            <div class="breakdown-row">
                                <span>Selected Add-ons:</span>
                                <span id="checkoutAddonsTotal">₹<?php echo number_format($addonsTotal); ?></span>
                            </div>
                            <div class="breakdown-row total-row">
                                <span>Grand Total:</span>
                                <span id="checkoutGrandTotal">₹<?php echo number_format($grandTotal); ?></span>
                            </div>
                            <div style="font-size: 0.75rem; color: #15803d; text-align: right; margin-top: 0.25rem;">
                                ✓ 5% GST and all state road permits included
                            </div>
                        </div>

                        <input type="hidden" name="final_amount" id="checkoutFinalAmount" value="<?php echo $grandTotal; ?>">

                        <button type="submit" class="btn btn-secondary btn-block btn-lg" style="margin-top: 1.25rem;">
                            Confirm & Generate Yatra Voucher →
                        </button>

                        <div style="text-align: center; margin-top: 1rem; font-size: 0.75rem; color: var(--muted);">
                            By clicking confirm, you agree to WanderWise India booking guidelines & flexible date change policies.
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Pass base plan price to JavaScript for dynamic calculations -->
<script>
    window.checkoutBasePlanPrice = <?php echo (int)$plan['discount_price']; ?>;
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
