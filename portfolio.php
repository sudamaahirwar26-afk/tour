<?php
/**
 * SERENITY PLANNERS - PORTFOLIO & GALLERY
 */

$pageTitle = "Portfolio & Gallery | Serenity Planners";
$metaDesc = "Explore our gallery of luxury weddings, private galas, international destination celebrations, and high-profile summits.";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$allPortfolio = getActivePortfolio('all');
?>

<!-- Portfolio Header Banner -->
<section class="section section-dark" style="padding-top: 130px; padding-bottom: 4rem; text-align: center;">
    <div class="container">
        <div class="eyebrow" style="color: var(--color-accent);">VISUAL RETROSPECTIVE</div>
        <h1 style="font-size: clamp(2.4rem, 4vw, 3.5rem); color: #FFF; margin-bottom: 1rem;">Curated Event Gallery</h1>
        <p style="color: #94A3B8; max-width: 650px; margin: 0 auto; font-size: 1.1rem;">A glimpse into our royal weddings, international summits, and unforgettable private celebrations.</p>
    </div>
</section>

<!-- Portfolio Section with Interactive Filter -->
<section class="section">
    <div class="container">
        <div class="portfolio-filters">
            <button class="filter-btn active" data-filter="all">All Celebrations</button>
            <button class="filter-btn" data-filter="wedding">Royal Weddings</button>
            <button class="filter-btn" data-filter="corporate">Corporate Summits</button>
            <button class="filter-btn" data-filter="destination">Destination Vows</button>
            <button class="filter-btn" data-filter="private">Private Estates</button>
            <button class="filter-btn" data-filter="social">Social Galas</button>
        </div>

        <div class="portfolio-grid">
            <?php foreach ($allPortfolio as $item): ?>
                <div class="portfolio-item" data-category="<?= e($item['category']); ?>" data-desc="<?= e($item['description']); ?>">
                    <img src="<?= e($item['image']); ?>" alt="<?= e($item['title']); ?>">
                    <div class="portfolio-overlay">
                        <span class="portfolio-tag"><?= strtoupper(e($item['category'])); ?></span>
                        <h4 class="portfolio-title"><?= e($item['title']); ?></h4>
                        <span class="portfolio-loc"><i class="fas fa-map-marker-alt"></i> <?= e($item['location']); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="lightbox-modal" id="portfolioLightbox">
    <div class="lightbox-content">
        <button class="lightbox-close" aria-label="Close Lightbox">&times;</button>
        <div class="lightbox-img-wrap">
            <img src="" alt="" id="lightboxImg">
        </div>
        <div class="lightbox-info">
            <h3 id="lightboxTitle" style="color: #FFF; font-size: 1.3rem; margin-bottom: 0.5rem;"></h3>
            <p id="lightboxDesc" style="color: #CBD5E1; font-size: 0.95rem; line-height: 1.6;"></p>
        </div>
    </div>
</div>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <h2>Want Your Event Featured in Our Portfolio?</h2>
            <p>Let's begin architecting your luxury celebration today.</p>
            <a href="enquiry.php" class="btn btn-accent btn-lg"><i class="fas fa-calendar-check"></i> Plan With Us</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
