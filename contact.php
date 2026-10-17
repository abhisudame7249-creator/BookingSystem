<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/data.php';

$sentSuccess = false;
$feedbackName = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $feedbackName = sanitize($_POST['name'] ?? '');
    $feedbackEmail = sanitize($_POST['email'] ?? '');
    $feedbackPhone = sanitize($_POST['phone'] ?? '');
    $feedbackDestination = sanitize($_POST['destination'] ?? '');
    $feedbackPlan = sanitize($_POST['preferred_plan'] ?? '');
    $feedbackMessage = sanitize($_POST['message'] ?? '');

    if (!empty($feedbackName) && !empty($feedbackEmail) && !empty($feedbackMessage)) {
        saveInquiry($feedbackName, $feedbackEmail, $feedbackPhone, $feedbackDestination, $feedbackPlan, $feedbackMessage);
        $sentSuccess = true;
    }
}

$pageTitle = "Contact Us & Custom Bharat Yatra";
require_once __DIR__ . '/includes/header.php';
?>

<div class="page-breadcrumb">
    <div class="container">
        <a href="index.php">Home</a> &nbsp;/&nbsp; <span>Contact & Support</span>
    </div>
</div>

<section class="section-padding">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">We're Here To Help</span>
            <h1 class="section-title">Get In Touch With Our Bharat Travel Specialists</h1>
            <p class="section-desc">Have questions about our 3 travel plans, need a customized honeymoon or family yatra package, or want group bookings? We are here 24/7.</p>
        </div>

        <?php if ($sentSuccess): ?>
            <div style="background: #f0fdf4; border: 1px solid #86efac; color: #166534; padding: 1.25rem; border-radius: var(--radius); margin-bottom: 2.5rem; text-align: center;">
                <h3 style="margin-bottom: 0.25rem;">✓ Dhanyawad, <?php echo htmlspecialchars($feedbackName); ?>!</h3>
                <p>Your inquiry has been saved. Our destination coordinator will call or WhatsApp you within 2 hours.</p>
            </div>
        <?php endif; ?>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2.5rem; align-items: start;">
            <!-- Contact Form -->
            <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius); padding: 2.25rem; box-shadow: var(--shadow-sm);">
                <h3 style="font-size: 1.35rem; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 1px solid var(--border);">
                    Send an Inquiry
                </h3>

                <form action="contact.php" method="POST">
                    <div class="form-grid-2" style="margin-bottom: 1rem;">
                        <div>
                            <label class="booking-form-label">Your Full Name *</label>
                            <input type="text" name="name" class="booking-form-control" placeholder="e.g. Rahul Sharma" required>
                        </div>
                        <div>
                            <label class="booking-form-label">Email Address *</label>
                            <input type="email" name="email" class="booking-form-control" placeholder="rahul@example.com" required>
                        </div>
                    </div>

                    <div class="form-grid-2" style="margin-bottom: 1rem;">
                        <div>
                            <label class="booking-form-label">Mobile Number / WhatsApp *</label>
                            <input type="tel" name="phone" class="booking-form-control" placeholder="+91 98765 43210" required>
                        </div>
                        <div>
                            <label class="booking-form-label">Interested Destination</label>
                            <select name="destination" class="booking-form-control">
                                <option value="">Select Destination</option>
                                <?php foreach ($packages as $p): ?>
                                    <option value="<?php echo htmlspecialchars($p['title']); ?>"><?php echo htmlspecialchars($p['title']); ?></option>
                                <?php endforeach; ?>
                                <option value="Custom">Other Custom Destination in India</option>
                            </select>
                        </div>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label class="booking-form-label">Preferred Travel Plan</label>
                        <select name="preferred_plan" class="booking-form-control">
                            <option value="comfort">🌟 Comfort Plan (Most Popular)</option>
                            <option value="explorer">🎒 Explorer Plan (Budget Friendly)</option>
                            <option value="luxury">👑 Royal Maharaja VIP Plan</option>
                            <option value="undecided">Not Sure Yet / Need Advice</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label class="booking-form-label">Message or Specific Requests *</label>
                        <textarea name="message" rows="4" class="booking-form-control" placeholder="Tell us about your travel dates, number of people, preferred pickup city, and any meal requirements..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg">Send Inquiry →</button>
                </form>
            </div>

            <!-- Contact Info & FAQs -->
            <div>
                <!-- Contact Info Card -->
                <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius); padding: 2rem; margin-bottom: 2rem; box-shadow: var(--shadow-sm);">
                    <h3 style="font-size: 1.25rem; margin-bottom: 1.25rem;">Head Office & Contact Details</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem; font-size: 0.95rem;">
                        <div style="display: flex; gap: 0.85rem;">
                            <span style="font-size: 1.25rem;">📍</span>
                            <div>
                                <strong>Delhi Headquarters</strong><br>
                                <span style="color: var(--muted);">Barakhamba Road, Connaught Place, New Delhi - 110001</span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 0.85rem;">
                            <span style="font-size: 1.25rem;">📞</span>
                            <div>
                                <strong>Phone & Hotline (24/7)</strong><br>
                                <span style="color: var(--muted);">Toll-Free: 1800-123-YATRA (92872)<br>WhatsApp Support: +91 98765 43210</span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 0.85rem;">
                            <span style="font-size: 1.25rem;">✉️</span>
                            <div>
                                <strong>Email Support</strong><br>
                                <span style="color: var(--muted);">support@wanderbharat.in<br>bookings@wanderbharat.in</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Frequently Asked Questions -->
                <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius); padding: 2rem; box-shadow: var(--shadow-sm);">
                    <h3 style="font-size: 1.25rem; margin-bottom: 1.25rem;">Frequently Asked Questions</h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div>
                            <h4 style="font-size: 0.95rem; margin-bottom: 0.25rem; color: var(--primary);">How do the 3 plans differ?</h4>
                            <p style="font-size: 0.875rem; color: var(--muted); line-height: 1.5;">
                                The Explorer Plan offers budget 3-star hotels and shared AC tempo/cabs; Comfort Plan includes 4-star private pool resorts/houseboats, dedicated private AC sedan (Dzire/Etios), and special activity tickets; Maharaja VIP offers 5-star palace hotels (Taj/Oberoi), private Innova Crysta / Fortuner, and VIP Darshan.
                            </p>
                        </div>

                        <div>
                            <h4 style="font-size: 0.95rem; margin-bottom: 0.25rem; color: var(--primary);">Are all taxes and GST included?</h4>
                            <p style="font-size: 0.875rem; color: var(--muted); line-height: 1.5;">
                                Yes! All prices are in Indian Rupees (₹) and include 5% GST, toll taxes, state road taxes, parking fees, and driver night charges. Zero hidden fees.
                            </p>
                        </div>

                        <div>
                            <h4 style="font-size: 0.95rem; margin-bottom: 0.25rem; color: var(--primary);">What payment modes are accepted?</h4>
                            <p style="font-size: 0.875rem; color: var(--muted); line-height: 1.5;">
                                We support instant UPI (Google Pay, PhonePe, Paytm), RuPay / Debit / Credit Cards, Net Banking, and a token advance option with Pay on Arrival.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
