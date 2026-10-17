<?php
$pageTitle = "Incredible India - Curated Travel Packages & 3 Tier Plans";
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section" style="background: linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.8)), url('https://images.unsplash.com/photo-1595815771614-ade9d652a65d?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;">
    <div class="container">
        <div class="hero-content">
            <div class="hero-subtitle">
                <span>🇮🇳 Incredible India • Bharat Darshan Yatra</span>
            </div>
            <h1 class="hero-title">
                Explore Incredible India With <span>3 Curated Travel Plans</span>
            </h1>
            <p class="hero-desc">
                From the snow peaks of <strong>Kashmir</strong> and backwaters of <strong>Kerala</strong> to royal forts of <strong>Rajasthan</strong>. Choose between our budget-friendly <strong>Explorer Plan</strong>, balanced <strong>Comfort Plan</strong>, or royal <strong>Maharaja VIP Plan</strong>.
            </p>

            <!-- Hero Search Filter Bar -->
            <form action="packages.php" method="GET" class="hero-search-box">
                <div class="search-field">
                    <label class="search-label">📍 Destination / Keyword</label>
                    <input type="text" name="search" class="search-input" placeholder="e.g. Kashmir, Goa, Kerala, Rajasthan, Manali...">
                </div>

                <div class="search-field">
                    <label class="search-label">🏷️ Category</label>
                    <select name="category" class="search-select">
                        <option value="all">All Indian Categories</option>
                        <option value="Himalayas">Himalayas & Snow</option>
                        <option value="Beach">Beach & Coastal</option>
                        <option value="Backwaters">Backwaters & Hills</option>
                        <option value="Royal">Royal Heritage</option>
                        <option value="Spiritual">Spiritual & Holy</option>
                    </select>
                </div>

                <div class="search-field">
                    <label class="search-label">💎 Preferred Plan</label>
                    <select name="tier" class="search-select">
                        <option value="all">Any Plan (Compare All 3)</option>
                        <option value="explorer">🎒 Explorer Plan (Budget Friendly)</option>
                        <option value="comfort">🌟 Comfort Plan (Most Popular)</option>
                        <option value="luxury">👑 Royal Maharaja VIP Plan</option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn btn-secondary btn-lg" style="height: 100%; min-height: 48px;">
                        <span>🔍 Search Packages</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<section class="stats-bar">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">🇮🇳</div>
                <div>
                    <div class="stat-number">28+ States</div>
                    <div class="stat-label">Pan-India Network</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">📑</div>
                <div>
                    <div class="stat-number">3 Plans</div>
                    <div class="stat-label">For Every Destination</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">⭐</div>
                <div>
                    <div class="stat-number">4.95 / 5</div>
                    <div class="stat-label">From 18,000+ Yatris</div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">🛡️</div>
                <div>
                    <div class="stat-number">100% Verified</div>
                    <div class="stat-label">GST & Ministry Compliant</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Packages Section -->
<section class="section-padding">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Handcrafted Bharat Tours</span>
            <h2 class="section-title">Popular Indian Destinations</h2>
            <p class="section-desc">
                Every holiday package includes 3 distinct plans tailored to your budget and travel style. Browse our most loved packages below.
            </p>
        </div>

        <div class="package-grid">
            <?php foreach ($packages as $pkg): ?>
                <div class="package-card">
                    <div class="package-thumb-wrap">
                        <img src="<?php echo htmlspecialchars($pkg['hero_image']); ?>" alt="<?php echo htmlspecialchars($pkg['title']); ?>" class="package-thumb" loading="lazy">
                        <div class="package-badge-top">
                            <span class="badge badge-featured"><?php echo htmlspecialchars($pkg['badge']); ?></span>
                        </div>
                        <div class="package-category-tag"><?php echo htmlspecialchars($pkg['category']); ?></div>
                        <div class="package-duration-tag">⏱️ <?php echo htmlspecialchars($pkg['duration']); ?></div>
                    </div>

                    <div class="package-body">
                        <div class="package-meta">
                            <div class="package-location">📍 <?php echo htmlspecialchars($pkg['location']); ?></div>
                            <div class="package-rating">★ <?php echo $pkg['rating']; ?> (<?php echo $pkg['reviews_count']; ?>)</div>
                        </div>

                        <h3 class="package-title">
                            <a href="package-details.php?id=<?php echo urlencode($pkg['id']); ?>">
                                <?php echo htmlspecialchars($pkg['title']); ?>
                            </a>
                        </h3>
                        <p class="package-desc"><?php echo htmlspecialchars($pkg['overview']); ?></p>

                        <!-- Available 3 Plans Badges -->
                        <div class="tier-pills-row">
                            <span class="tier-pill explorer">🎒 Explorer ₹<?php echo number_format($pkg['plans']['explorer']['discount_price']); ?></span>
                            <span class="tier-pill comfort">🌟 Comfort ₹<?php echo number_format($pkg['plans']['comfort']['discount_price']); ?></span>
                            <span class="tier-pill luxury">👑 Maharaja ₹<?php echo number_format($pkg['plans']['luxury']['discount_price']); ?></span>
                        </div>

                        <div class="package-footer">
                            <div class="price-box">
                                <span class="price-label">Starting From</span>
                                <span class="price-amount">₹<?php echo number_format($pkg['plans']['explorer']['discount_price']); ?></span>
                                <span class="price-sub">per person / GST incl.</span>
                            </div>
                            <a href="package-details.php?id=<?php echo urlencode($pkg['id']); ?>" class="btn btn-primary btn-sm">
                                View 3 Plans →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 3rem;">
            <a href="packages.php" class="btn btn-outline btn-lg">Explore All Indian Destinations & Plans →</a>
        </div>
    </div>
</section>

<!-- The 3 Travel Plans Comparison Matrix Section -->
<section class="section-padding plans-overview-section" id="plans">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Choose Your Bharat Travel Tier</span>
            <h2 class="section-title">How Our 3 Indian Travel Plans Work</h2>
            <p class="section-desc">
                Every destination on WanderWise India is available in three distinct, transparent tiers with all GST included.
            </p>
        </div>

        <div class="plans-cards-grid">
            <!-- Plan 1: Explorer -->
            <div class="plan-tier-card">
                <div class="plan-header">
                    <span class="badge badge-tier-explorer" style="margin-bottom: 0.5rem;">Tier 1 • Budget Friendly</span>
                    <h3 class="plan-tier-name">Explorer Plan</h3>
                    <p class="plan-tier-subtitle">Best for smart travelers, backpackers, students, and solo adventurers seeking authentic local discoveries.</p>
                    <div class="plan-tier-price">
                        From ₹8,999 <small>/ traveler</small>
                    </div>
                </div>
                <div class="plan-features-list">
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Accommodation:</strong> Clean 3-Star handpicked boutique hotels & authentic houseboats/homestays</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Transportation:</strong> Modern AC Tempo Traveler / Swift Dzire with experienced local driver</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Meals:</strong> Daily hearty buffet breakfast + 1 traditional regional welcome dinner</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Sightseeing:</strong> Guided group tours of key forts, ghats, and hill points with Hindi/English guide</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Support:</strong> 24/7 Dedicated WhatsApp travel coordinator assistance</span>
                    </div>
                </div>
                <a href="packages.php?tier=explorer" class="btn btn-outline btn-block">Explore Explorer Packages</a>
            </div>

            <!-- Plan 2: Comfort (Featured) -->
            <div class="plan-tier-card featured">
                <div class="plan-card-badge">Most Popular Choice</div>
                <div class="plan-header">
                    <span class="badge badge-tier-comfort" style="margin-bottom: 0.5rem;">Tier 2 • Premium Standard</span>
                    <h3 class="plan-tier-name">Comfort Plan</h3>
                    <p class="plan-tier-subtitle">The ideal balance of comfort, convenience, and value for couples, families, and senior citizens.</p>
                    <div class="plan-tier-price" style="color: var(--primary);">
                        From ₹15,999 <small>/ traveler</small>
                    </div>
                </div>
                <div class="plan-features-list">
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Accommodation:</strong> 4-Star luxury resorts, mountain mist view rooms, or private AC houseboats</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Transportation:</strong> Dedicated private AC Sedan (Dzire/Etios) with personal chauffeur throughout</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Meals:</strong> Daily buffet breakfast + 3 authentic regional lunches + 2 multi-course specialty dinners</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Special Inclusions:</strong> Gondola cable car passes, sunset boat cruises, campfire sessions & water sports</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Perks:</strong> Comprehensive domestic travel insurance + airport meet & greet included</span>
                    </div>
                </div>
                <a href="packages.php?tier=comfort" class="btn btn-primary btn-block">Book Comfort Plan</a>
            </div>

            <!-- Plan 3: Royal Maharaja -->
            <div class="plan-tier-card">
                <div class="plan-header">
                    <span class="badge badge-tier-luxury" style="margin-bottom: 0.5rem;">Tier 3 • VIP All-Inclusive</span>
                    <h3 class="plan-tier-name">Royal Maharaja VIP Plan</h3>
                    <p class="plan-tier-subtitle">The ultimate royal experience with 5-star palace suites, private SUVs, and personal butlers.</p>
                    <div class="plan-tier-price">
                        From ₹32,999 <small>/ traveler</small>
                    </div>
                </div>
                <div class="plan-features-list">
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Accommodation:</strong> 5-Star landmark palace hotels (Taj, Oberoi, Lalit) & presidential villa suites</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Transportation:</strong> Private Toyota Innova Crysta / Fortuner / Mercedes with executive chauffeur</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Meals:</strong> Full Board dining with royal palace banquets, live sitar music & private chef service</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Exclusive VIP:</strong> VIP Darshan temple protocols, private yacht/boat charters & hot air balloon flights</span>
                    </div>
                    <div class="plan-feature-item">
                        <span class="feature-check">✓</span>
                        <span><strong>Service:</strong> 24/7 Dedicated private travel butler, priority baggage handling & executive airport escort</span>
                    </div>
                </div>
                <a href="packages.php?tier=luxury" class="btn btn-outline btn-block">Discover Maharaja VIP</a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section-padding" id="why-us">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Why WanderWise Bharat</span>
            <h2 class="section-title">The Trusted Way to Travel India</h2>
            <p class="section-desc">We eliminate the stress of holiday planning with transparent pricing in Rupees, verified hotels, and flexible options.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1.75rem;">
            <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius); padding: 2rem; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">₹</div>
                <h4 style="font-size: 1.15rem; margin-bottom: 0.5rem;">All Prices in INR with GST</h4>
                <p style="color: var(--muted); font-size: 0.9rem;">100% transparent pricing with zero surprise charges. All toll taxes, permits, and driver allowances are included.</p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius); padding: 2rem; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">🏨</div>
                <h4 style="font-size: 1.15rem; margin-bottom: 0.5rem;">Handpicked Verified Stays</h4>
                <p style="color: var(--muted); font-size: 0.9rem;">From heritage royal Havelis to luxury 5-star mountain resorts, every property is personally inspected for cleanliness and comfort.</p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius); padding: 2rem; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">💳</div>
                <h4 style="font-size: 1.15rem; margin-bottom: 0.5rem;">Instant UPI & RuPay Checkout</h4>
                <p style="color: var(--muted); font-size: 0.9rem;">Pay easily via Google Pay, PhonePe, Paytm, RuPay Debit/Credit Cards, or choose token advance with Pay on Arrival.</p>
            </div>

            <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius); padding: 2rem; text-align: center;">
                <div style="font-size: 2.5rem; margin-bottom: 1rem;">📞</div>
                <h4 style="font-size: 1.15rem; margin-bottom: 0.5rem;">24/7 On-Ground Support</h4>
                <p style="color: var(--muted); font-size: 0.9rem;">Our on-ground local coordinators in every state are available round-the-clock via phone and WhatsApp in Hindi & English.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section-padding" style="background: #ffffff; border-top: 1px solid var(--border);">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Yatri Stories</span>
            <h2 class="section-title">Loved by Travelers Across India</h2>
            <p class="section-desc">Here is what our guests have to say about their experience with our 3-plan Indian travel packages.</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem;">
            <?php foreach ($testimonials as $t): ?>
                <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius); padding: 1.75rem; display: flex; flex-direction: column;">
                    <div style="color: #f59e0b; font-size: 1.1rem; margin-bottom: 0.75rem;">
                        <?php echo str_repeat('★', $t['rating']); ?>
                    </div>
                    <p style="font-size: 0.95rem; color: var(--slate); line-height: 1.6; margin-bottom: 1.5rem; font-style: italic; flex: 1;">
                        "<?php echo htmlspecialchars($t['review']); ?>"
                    </p>
                    <div style="display: flex; align-items: center; gap: 0.85rem; border-top: 1px solid var(--border); padding-top: 1rem;">
                        <img src="<?php echo htmlspecialchars($t['avatar']); ?>" alt="<?php echo htmlspecialchars($t['name']); ?>" style="width: 46px; height: 46px; border-radius: 50%; object-fit: cover;">
                        <div>
                            <div style="font-weight: 700; font-size: 0.95rem;"><?php echo htmlspecialchars($t['name']); ?></div>
                            <div style="font-size: 0.8rem; color: var(--muted);"><?php echo htmlspecialchars($t['location']); ?> • <strong style="color: var(--primary);"><?php echo htmlspecialchars($t['package']); ?></strong></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call to Action Banner -->
<section style="background: linear-gradient(135deg, #0c4a6e, #0284c7); color: #ffffff; padding: 4.5rem 0; text-align: center;">
    <div class="container container-narrow">
        <h2 style="font-size: 2.5rem; color: #ffffff; margin-bottom: 1rem;">Ready For Your Next Bharat Yatra?</h2>
        <p style="font-size: 1.15rem; color: #e0f2fe; margin-bottom: 2rem;">
            Select your dream Indian destination, choose your plan (Explorer, Comfort, or Royal Maharaja), and book with instant confirmation.
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="packages.php" class="btn btn-secondary btn-lg">Browse All Indian Packages</a>
            <a href="contact.php" class="btn btn-white btn-lg">Request Custom Itinerary</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
