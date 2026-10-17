<?php
$pageTitle = "All Indian Travel Packages & 3 Tier Plans (INR)";
require_once __DIR__ . '/includes/header.php';

$searchQuery = sanitize($_GET['search'] ?? '');
$selectedCategory = sanitize($_GET['category'] ?? 'all');
$selectedTier = sanitize($_GET['tier'] ?? 'all');
$maxBudget = isset($_GET['max_price']) ? (int)$_GET['max_price'] : null;

$filteredPackages = filterPackages($packages, $selectedCategory, $selectedTier, $searchQuery, $maxBudget);
?>

<div class="page-breadcrumb">
    <div class="container">
        <a href="index.php">Home</a> &nbsp;/&nbsp; <span>Indian Holiday Packages Catalog</span>
    </div>
</div>

<section class="section-padding">
    <div class="container">
        <div class="section-title-wrap">
            <span class="section-badge">Bharat Yatra Destinations</span>
            <h1 class="section-title">Explore All Indian Travel Packages</h1>
            <p class="section-desc">
                Select your holiday destination in India. Each package features 3 curated plans (<strong>Explorer</strong>, <strong>Comfort</strong>, and <strong>Royal Maharaja VIP</strong>) with transparent INR pricing.
            </p>
        </div>

        <!-- Filter & Search Toolbar -->
        <div style="background: #ffffff; border: 1px solid var(--border); border-radius: var(--radius); padding: 1.5rem; margin-bottom: 2.5rem; box-shadow: var(--shadow-sm);">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) auto; gap: 1rem; align-items: flex-end;">
                <div>
                    <label class="booking-form-label">🔍 Live Search</label>
                    <input type="text" id="catalogSearch" value="<?php echo htmlspecialchars($searchQuery); ?>" class="booking-form-control" placeholder="Search Kashmir, Goa, Kerala...">
                </div>

                <div>
                    <label class="booking-form-label">🏷️ Category</label>
                    <select id="catalogCategory" class="booking-form-control">
                        <option value="all" <?php echo $selectedCategory === 'all' ? 'selected' : ''; ?>>All Indian Categories</option>
                        <option value="Himalayas" <?php echo strpos($selectedCategory, 'Himalayas') !== false ? 'selected' : ''; ?>>Himalayas & Snow</option>
                        <option value="Beach" <?php echo strpos($selectedCategory, 'Beach') !== false ? 'selected' : ''; ?>>Beach & Coastal</option>
                        <option value="Backwaters" <?php echo strpos($selectedCategory, 'Backwaters') !== false ? 'selected' : ''; ?>>Backwaters & Hills</option>
                        <option value="Royal" <?php echo strpos($selectedCategory, 'Royal') !== false ? 'selected' : ''; ?>>Royal Heritage</option>
                        <option value="Spiritual" <?php echo strpos($selectedCategory, 'Spiritual') !== false ? 'selected' : ''; ?>>Spiritual & Holy</option>
                    </select>
                </div>

                <div>
                    <label class="booking-form-label">💎 Plan Tier</label>
                    <select id="catalogTier" class="booking-form-control">
                        <option value="all" <?php echo $selectedTier === 'all' ? 'selected' : ''; ?>>All 3 Plans</option>
                        <option value="explorer" <?php echo $selectedTier === 'explorer' ? 'selected' : ''; ?>>🎒 Explorer Plan (Budget)</option>
                        <option value="comfort" <?php echo $selectedTier === 'comfort' ? 'selected' : ''; ?>>🌟 Comfort Plan (Popular)</option>
                        <option value="luxury" <?php echo $selectedTier === 'luxury' ? 'selected' : ''; ?>>👑 Royal Maharaja VIP</option>
                    </select>
                </div>

                <div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.35rem;">
                        <label class="booking-form-label" style="margin: 0;">💵 Max Budget</label>
                        <span id="priceRangeVal" style="font-weight: 700; color: var(--primary); font-size: 0.85rem;">₹1,00,000</span>
                    </div>
                    <input type="range" id="catalogPriceRange" min="5000" max="100000" step="2500" value="100000" style="width: 100%; accent-color: var(--primary); cursor: pointer;">
                </div>

                <div>
                    <a href="packages.php" class="btn btn-outline" style="height: 42px;">Reset Filters</a>
                </div>
            </div>
        </div>

        <!-- Package Grid Display -->
        <div class="package-grid" id="packagesContainer">
            <?php foreach ($packages as $pkg): ?>
                <div class="package-card package-filter-card"
                     data-title="<?php echo htmlspecialchars($pkg['title']); ?>"
                     data-location="<?php echo htmlspecialchars($pkg['location']); ?>"
                     data-category="<?php echo htmlspecialchars($pkg['category']); ?>"
                     data-price="<?php echo $pkg['plans']['explorer']['discount_price']; ?>">
                     
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

                        <!-- The 3 Plans Summary Breakdown -->
                        <div style="background: #f8fafc; border: 1px solid var(--border); border-radius: var(--radius-sm); padding: 0.75rem; margin-bottom: 1.25rem;">
                            <div style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; color: var(--muted); margin-bottom: 0.4rem;">
                                Select from 3 available plans:
                            </div>
                            <div style="display: flex; justify-content: space-between; font-size: 0.825rem;">
                                <span>🎒 Explorer: <strong>₹<?php echo number_format($pkg['plans']['explorer']['discount_price']); ?></strong></span>
                                <span>🌟 Comfort: <strong>₹<?php echo number_format($pkg['plans']['comfort']['discount_price']); ?></strong></span>
                                <span>👑 Maharaja: <strong>₹<?php echo number_format($pkg['plans']['luxury']['discount_price']); ?></strong></span>
                            </div>
                        </div>

                        <div class="package-footer">
                            <div class="price-box">
                                <span class="price-label">Starts at</span>
                                <span class="price-amount">₹<?php echo number_format($pkg['plans']['explorer']['discount_price']); ?></span>
                                <span class="price-sub">per person / all GST incl.</span>
                            </div>
                            <a href="package-details.php?id=<?php echo urlencode($pkg['id']); ?>" class="btn btn-primary">
                                View Details & Book →
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- No Results Fallback -->
        <div id="noPackagesFound" style="display: none; text-align: center; padding: 4rem 1rem; background: #ffffff; border-radius: var(--radius); border: 1px solid var(--border); margin-top: 2rem;">
            <div style="font-size: 3rem; margin-bottom: 1rem;">🔍</div>
            <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem;">No Indian Packages Matched Your Search</h3>
            <p style="color: var(--muted); margin-bottom: 1.5rem;">Try adjusting your keyword or budget slider to find more options.</p>
            <a href="packages.php" class="btn btn-primary">View All Packages</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
