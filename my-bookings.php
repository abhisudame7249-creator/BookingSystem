<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/data.php';

$cancelMessage = '';

// Handle cancel booking action
if (isset($_GET['action']) && $_GET['action'] === 'cancel' && !empty($_GET['id'])) {
    $cancelId = sanitize($_GET['id']);
    cancelBooking($cancelId);
    $cancelMessage = "Booking " . htmlspecialchars($cancelId) . " was successfully cancelled.";
}

$allBookings = getAllBookings();

$pageTitle = "My Bookings & Reservations";
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-breadcrumb">
    <div class="container">
        <a href="index.php">Home</a> &nbsp;/&nbsp; <span>My Bookings</span>
    </div>
</div>

<section class="section-padding">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span class="section-badge">Customer Portal</span>
                <h1 style="font-size: 2.25rem; letter-spacing: -0.02em;">My Travel Bookings</h1>
                <p style="color: var(--muted);">View your upcoming vacations, download travel vouchers, or manage your reservations.</p>
            </div>
            <div>
                <a href="packages.php" class="btn btn-primary">+ Book Another Trip</a>
            </div>
        </div>

        <?php if (!empty($cancelMessage)): ?>
            <div style="background: #fffbeb; border: 1px solid #fcd34d; color: #92400e; padding: 1rem 1.25rem; border-radius: var(--radius-sm); margin-bottom: 2rem;">
                ⚠️ <?php echo $cancelMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($allBookings)): ?>
            <!-- Empty state -->
            <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 4rem 2rem; text-align: center; max-width: 680px; margin: 0 auto; box-shadow: var(--shadow-sm);">
                <div style="font-size: 3.5rem; margin-bottom: 1.25rem;">✈️</div>
                <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">No Active Bookings Found</h3>
                <p style="color: var(--muted); margin-bottom: 2rem; font-size: 0.95rem;">
                    You haven't made any travel reservations yet. Explore our packages to choose your destination and plan tier!
                </p>
                <a href="packages.php" class="btn btn-secondary btn-lg">Explore Travel Packages & Plans →</a>
            </div>
        <?php else: ?>
            <!-- Bookings Table -->
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Ref Code</th>
                            <th>Destination Package</th>
                            <th>Plan Tier</th>
                            <th>Travel Date</th>
                            <th>Guests</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allBookings as $b): ?>
                            <tr>
                                <td>
                                    <strong style="font-family: monospace; color: var(--primary); font-size: 0.95rem;">
                                        <?php echo htmlspecialchars($b['booking_id']); ?>
                                    </strong>
                                </td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.85rem;">
                                        <img src="<?php echo htmlspecialchars($b['hero_image']); ?>" alt="Destination" style="width: 50px; height: 50px; border-radius: 8px; object-fit: cover;">
                                        <div>
                                            <div style="font-weight: 700; color: var(--dark);"><?php echo htmlspecialchars($b['package_title']); ?></div>
                                            <div style="font-size: 0.8rem; color: var(--muted);">📍 <?php echo htmlspecialchars($b['location']); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                        $tierBadgeClass = 'badge-tier-comfort';
                                        if ($b['plan_key'] === 'luxury') $tierBadgeClass = 'badge-tier-luxury';
                                        if ($b['plan_key'] === 'explorer') $tierBadgeClass = 'badge-tier-explorer';
                                    ?>
                                    <span class="badge <?php echo $tierBadgeClass; ?>">
                                        <?php echo htmlspecialchars($b['plan_name']); ?>
                                    </span>
                                </td>
                                <td>
                                    <strong><?php echo date('M d, Y', strtotime($b['travel_date'])); ?></strong>
                                    <div style="font-size: 0.75rem; color: var(--muted);"><?php echo htmlspecialchars($b['duration']); ?></div>
                                </td>
                                <td>
                                    <?php echo $b['total_guests']; ?> Travelers
                                </td>
                                <td>
                                    <strong style="color: var(--primary); font-size: 1.1rem;">
                                        ₹<?php echo number_format($b['grand_total']); ?>
                                    </strong>
                                </td>
                                <td>
                                    <?php if ($b['status'] === 'Confirmed'): ?>
                                        <span class="badge badge-success">✓ Confirmed</span>
                                    <?php else: ?>
                                        <span class="badge" style="background: #fee2e2; color: #b91c1c;">✗ Cancelled</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                                        <a href="confirmation.php?booking_id=<?php echo urlencode($b['booking_id']); ?>" class="btn btn-outline btn-sm" title="View & Print Voucher">
                                            📄 Voucher
                                        </a>
                                        <?php if ($b['status'] === 'Confirmed'): ?>
                                            <a href="my-bookings.php?action=cancel&id=<?php echo urlencode($b['booking_id']); ?>" class="btn btn-sm" style="background: #fef2f2; color: #dc2626; border: 1px solid #fecaca;" onclick="return confirm('Are you sure you want to cancel this booking?');">
                                                Cancel
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
