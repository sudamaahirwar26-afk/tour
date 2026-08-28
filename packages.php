<?php
/**
 * SERENITY PLANNERS / PARTH TRIP - TOUR PACKAGES DIRECTORY
 */

$pageTitle = "Tour Packages & Deals | Serenity Planners";
$metaDesc = "Explore all domestic & international tour packages: Thailand, Dubai, Switzerland, Rajasthan, Goa, and customized luxury itineraries.";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$allPackages = getActivePackages();
?>

<!-- Packages Header Banner -->
<section class="section section-dark" style="padding-top: 130px; padding-bottom: 4rem; text-align: center;">
    <div class="container">
        <div class="eyebrow" style="color: var(--color-accent);">FRESH PICKS & DEALS</div>
        <h1 style="font-size: clamp(2.4rem, 4vw, 3.5rem); color: #FFF; margin-bottom: 1rem;">All Tour Packages & Deals</h1>
        <p style="color: #94A3B8; max-width: 650px; margin: 0 auto; font-size: 1.1rem;">Handcrafted vacation itineraries with 5-star stays, private transfers, and 24/7 on-ground assistance.</p>
    </div>
</section>

<!-- Packages Grid -->
<section class="section">
    <div class="container">
        <div class="packages-grid">
            <?php foreach ($allPackages as $pkg): ?>
                <div class="package-card">
                    <div class="package-thumb">
                        <span class="package-badge-tag"><?= e($pkg['badge']); ?></span>
                        <div class="package-rating-badge">
                            <i class="fas fa-star"></i> <?= e($pkg['rating']); ?> (<?= e($pkg['reviews_count']); ?> Reviews)
                        </div>
                        <img src="<?= e($pkg['image']); ?>" alt="<?= e($pkg['title']); ?>">
                    </div>

                    <div class="package-body">
                        <div class="package-dest">
                            <i class="fas fa-map-marker-alt"></i> <?= e($pkg['destination']); ?>
                        </div>
                        <h3 class="package-title"><?= e($pkg['title']); ?></h3>
                        <p class="package-desc"><?= e($pkg['short_description']); ?></p>

                        <div class="package-meta">
                            <span><i class="fas fa-calendar-alt" style="color: var(--color-accent);"></i> <?= e($pkg['duration']); ?></span>
                            <span><i class="fas fa-user-friends" style="color: var(--color-accent);"></i> <?= e($pkg['group_size']); ?></span>
                        </div>
                    </div>

                    <div class="package-footer">
                        <div class="package-price-wrap">
                            <span class="price-label">From</span>
                            <div class="price-amount">
                                <?= e($pkg['price']); ?>
                                <?php if (!empty($pkg['original_price'])): ?>
                                    <span class="price-original"><?= e($pkg['original_price']); ?></span>
                                <?php endif; ?>
                                <small style="font-size: 0.75rem; font-weight: 500; color: var(--color-muted);">/person</small>
                            </div>
                        </div>
                        <a href="enquiry.php?package=<?= urlencode($pkg['title']); ?>" class="btn btn-accent btn-sm">
                            <i class="fas fa-ticket-alt"></i> Book A Tour
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
