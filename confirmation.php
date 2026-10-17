<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/data.php';

$bookingId = sanitize($_GET['booking_id'] ?? '');
$booking = getBookingById($bookingId);

if (!$booking) {
    $allBookings = getAllBookings();
    if (!empty($allBookings)) {
        $booking = $allBookings[0];
    } else {
        header("Location: index.php");
        exit;
    }
}

$pageTitle = "Yatra Booking Confirmed - " . $booking['booking_id'];
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-breadcrumb no-print">
    <div class="container">
        <a href="index.php">Home</a> &nbsp;/&nbsp;
        <a href="my-bookings.php">My Bookings</a> &nbsp;/&nbsp;
        <span>Yatra Confirmation Voucher</span>
    </div>
</div>

<div class="container">
    <div class="confirmation-card">
        <!-- Top Celebration Header -->
        <div class="confirmation-header">
            <div class="confirmation-icon">✓</div>
            <h1 style="font-size: 2.25rem; color: #ffffff; margin-bottom: 0.5rem;">Yatra Booking Successfully Confirmed!</h1>
            <p style="font-size: 1.05rem; color: #e0f2fe; max-width: 600px; margin: 0 auto;">
                Shubh Yatra, <strong><?php echo htmlspecialchars($booking['customer']['full_name']); ?></strong>! Your holiday reservation is confirmed. Your official Indian travel voucher is ready below.
            </p>
        </div>

        <!-- Electronic Travel Voucher / Boarding Pass -->
        <div class="ticket-container">
            <div class="ticket-pass">
                <!-- Voucher Top Row -->
                <div class="ticket-header-row">
                    <div>
                        <div style="font-size: 0.8rem; font-weight: 700; text-transform: uppercase; color: var(--muted);">Official Bharat Yatra Voucher</div>
                        <div style="font-size: 1.4rem; font-weight: 800; color: var(--dark);"><?php echo htmlspecialchars($booking['package_title']); ?></div>
                        <div style="font-size: 0.875rem; color: var(--muted);">📍 <?php echo htmlspecialchars($booking['location']); ?>, India</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--muted); margin-bottom: 0.25rem;">Booking Reference (PNR)</div>
                        <div class="ticket-ref-code"><?php echo htmlspecialchars($booking['booking_id']); ?></div>
                    </div>
                </div>

                <!-- Voucher Data Grid -->
                <div class="ticket-grid">
                    <div>
                        <div class="ticket-cell-label">Primary Yatri (Traveler)</div>
                        <div class="ticket-cell-val"><?php echo htmlspecialchars($booking['customer']['full_name']); ?></div>
                        <div style="font-size: 0.8rem; color: var(--muted);"><?php echo htmlspecialchars($booking['customer']['phone']); ?> • <?php echo htmlspecialchars($booking['customer']['email']); ?></div>
                    </div>

                    <div>
                        <div class="ticket-cell-label">Selected Travel Plan</div>
                        <div class="ticket-cell-val" style="color: var(--primary);"><?php echo htmlspecialchars($booking['plan_name']); ?></div>
                        <div style="font-size: 0.8rem; color: var(--slate);">₹<?php echo number_format($booking['plan_price']); ?> / person</div>
                    </div>

                    <div>
                        <div class="ticket-cell-label">Departure Date</div>
                        <div class="ticket-cell-val"><?php echo date('d M, Y', strtotime($booking['travel_date'])); ?></div>
                        <div style="font-size: 0.8rem; color: var(--muted);"><?php echo htmlspecialchars($booking['duration']); ?></div>
                    </div>

                    <div>
                        <div class="ticket-cell-label">Guests Count</div>
                        <div class="ticket-cell-val"><?php echo $booking['adults']; ?> Adults <?php if ($booking['children'] > 0) echo ', ' . $booking['children'] . ' Children'; ?></div>
                        <div style="font-size: 0.8rem; color: var(--muted);">Total: <?php echo $booking['total_guests']; ?> Yatris</div>
                    </div>

                    <div>
                        <div class="ticket-cell-label">Accommodation</div>
                        <div class="ticket-cell-val" style="font-size: 0.92rem;"><?php echo htmlspecialchars($booking['hotel']); ?></div>
                    </div>

                    <div>
                        <div class="ticket-cell-label">Transportation</div>
                        <div class="ticket-cell-val" style="font-size: 0.92rem;"><?php echo htmlspecialchars($booking['transport']); ?></div>
                    </div>
                </div>

                <!-- Addons and Pricing Details in INR -->
                <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 1.25rem; margin-bottom: 1.5rem;">
                    <h4 style="font-size: 0.9rem; font-weight: 700; text-transform: uppercase; color: var(--muted); margin-bottom: 0.75rem;">Payment & Charges Breakdown (INR)</h4>
                    
                    <div style="display: flex; justify-content: space-between; font-size: 0.9rem; margin-bottom: 0.4rem;">
                        <span>Base Plan Charges (<?php echo $booking['adults']; ?> Adults<?php if ($booking['children'] > 0) echo ', ' . $booking['children'] . ' Children'; ?>):</span>
                        <span>₹<?php echo number_format($booking['base_total']); ?></span>
                    </div>

                    <?php if (!empty($booking['addons'])): ?>
                        <?php foreach ($booking['addons'] as $add): ?>
                            <div style="display: flex; justify-content: space-between; font-size: 0.9rem; margin-bottom: 0.4rem; color: var(--slate);">
                                <span>+ <?php echo htmlspecialchars($add['name']); ?>:</span>
                                <span>₹<?php echo number_format($add['cost']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div style="display: flex; justify-content: space-between; font-size: 0.85rem; color: #16a34a; margin-top: 0.4rem;">
                        <span>GST (5% Integrated Tax):</span>
                        <span>Included in Total (₹0 extra)</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; font-size: 1.25rem; font-weight: 800; color: var(--dark); border-top: 1px solid var(--border); padding-top: 0.75rem; margin-top: 0.5rem;">
                        <span>Total Amount Paid:</span>
                        <span style="color: var(--primary);">₹<?php echo number_format($booking['grand_total']); ?> INR</span>
                    </div>

                    <div style="display: flex; align-items: center; justify-content: space-between; margin-top: 0.75rem; font-size: 0.85rem;">
                        <span style="color: var(--muted);">Payment Method: <strong><?php echo htmlspecialchars($booking['payment']['method']); ?></strong></span>
                        <span class="badge badge-success">✓ <?php echo htmlspecialchars($booking['payment']['status']); ?></span>
                    </div>
                </div>

                <!-- Simulated Barcode & Verification -->
                <div class="ticket-barcode-wrap">
                    <div class="simulated-barcode"></div>
                    <div style="font-family: monospace; font-size: 0.8rem; color: var(--muted); letter-spacing: 0.1em;">
                        VERIFY PNR: <?php echo md5($booking['booking_id']); ?>
                    </div>
                    <div style="font-size: 0.75rem; color: var(--muted); margin-top: 0.25rem;">
                        Please present this digital or printed voucher along with your Govt ID (Aadhaar / Voter ID / Passport) during hotel check-in.
                    </div>
                </div>
            </div>

            <!-- Action Buttons (Hidden on Print) -->
            <div class="no-print" style="display: flex; gap: 1rem; justify-content: center; margin-top: 2rem; flex-wrap: wrap;">
                <button onclick="window.print()" class="btn btn-secondary btn-lg">
                    <span>🖨️ Print Voucher / Save PDF</span>
                </button>
                <a href="my-bookings.php" class="btn btn-primary btn-lg">
                    <span>📋 View All My Bookings</span>
                </a>
                <a href="packages.php" class="btn btn-outline btn-lg">
                    <span>🇮🇳 Explore More Indian Packages</span>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
