<?php
/**
 * SERENITY PLANNERS - SERVICES DIRECTORY
 */

$pageTitle = "Our Services | Serenity Planners";
$metaDesc = "Explore our turnkey luxury event services: Royal Weddings, Corporate Summits, Destination Events, Private Milestone Celebrations, and 3D Production Design.";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$allServices = getActiveServices();
?>

<!-- Services Banner -->
<section class="section section-dark" style="padding-top: 130px; padding-bottom: 4rem; text-align: center;">
    <div class="container">
        <div class="eyebrow" style="color: var(--color-accent);">WHAT WE DO</div>
        <h1 style="font-size: clamp(2.4rem, 4vw, 3.5rem); color: #FFF; margin-bottom: 1rem;">World-Class Event Services</h1>
        <p style="color: #94A3B8; max-width: 650px; margin: 0 auto; font-size: 1.1rem;">Bespoke event planning, spatial design, and flawless production for life’s most prestigious celebrations.</p>
    </div>
</section>

<!-- Services Grid Section -->
<section class="section">
    <div class="container">
        <div class="services-grid">
            <?php 
            $num = 1;
            foreach ($allServices as $s): 
            ?>
                <div class="service-card">
                    <div class="service-image-wrap">
                        <span class="service-card-num">0<?= $num++; ?></span>
                        <img src="<?= e($s['image'] ?: 'assets/images/service-wedding.jpg'); ?>" alt="<?= e($s['title']); ?>">
                    </div>
                    <div class="service-body">
                        <h3 class="service-title"><?= e($s['title']); ?></h3>
                        <p class="service-desc"><?= e($s['short_description']); ?></p>
                        <a href="service-details.php?slug=<?= urlencode($s['slug']); ?>" class="service-link">
                            Discover Details <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="section section-slate">
    <div class="container">
        <div class="section-header">
            <div class="eyebrow">OUR PROMISE</div>
            <h2 class="section-title">The Serenity Difference</h2>
            <p class="section-desc">We deliver stress-free, luxurious planning from concept inception to post-event wrap up.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fas fa-map-marked-alt"></i></div>
                <h3>Exclusive Venue Access</h3>
                <p>Private estates, heritage palaces, luxury yachts, and prestigious ballrooms reserved exclusively for our clients.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fas fa-utensils"></i></div>
                <h3>Couture Catering & Dining</h3>
                <p>Bespoke gastronomy curations with Michelin-star chefs, sommelier wine pairings, and immersive culinary stations.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fas fa-music"></i></div>
                <h3>Global Entertainment</h3>
                <p>Headline live performers, symphony orchestras, international DJs, and acrobatic theatrics curated for your vibe.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <h2>Have a Specific Event in Mind?</h2>
            <p>Our bespoke planners are ready to design a custom proposal that matches your exact ambitions and style.</p>
            <a href="enquiry.php" class="btn btn-accent btn-lg"><i class="fas fa-paper-plane"></i> Request a Proposal</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
