<?php
/**
 * SERENITY PLANNERS - CLIENT TESTIMONIALS
 */

$pageTitle = "Client Testimonials & Reviews | Serenity Planners";
$metaDesc = "Read authentic reviews and experiences from couples, corporate executives, and hosts who partnered with Serenity Planners.";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$allTestimonials = getPublishedTestimonials();
?>

<!-- Testimonials Header Banner -->
<section class="section section-dark" style="padding-top: 130px; padding-bottom: 4rem; text-align: center;">
    <div class="container">
        <div class="eyebrow" style="color: var(--color-accent);">CLIENT PRAISE</div>
        <h1 style="font-size: clamp(2.4rem, 4vw, 3.5rem); color: #FFF; margin-bottom: 1rem;">Client Experiences</h1>
        <p style="color: #94A3B8; max-width: 650px; margin: 0 auto; font-size: 1.1rem;">Authentic words of appreciation from brides, grooms, and global corporate leaders.</p>
    </div>
</section>

<!-- Testimonials Grid Section -->
<section class="section">
    <div class="container">
        <div class="services-grid">
            <?php foreach ($allTestimonials as $t): ?>
                <div class="service-card" style="padding: 2.5rem; justify-content: space-between;">
                    <div>
                        <div class="testimonial-stars" style="justify-content: flex-start; margin-bottom: 1.25rem;">
                            <?php for ($s = 0; $s < (int)$t['rating']; $s++): ?>
                                <i class="fas fa-star" style="color: var(--color-accent);"></i>
                            <?php endfor; ?>
                        </div>
                        <p style="font-size: 1rem; color: var(--color-text); line-height: 1.7; font-style: italic; margin-bottom: 2rem;">
                            "<?= e($t['message']); ?>"
                        </p>
                    </div>
                    <div style="display: flex; align-items: center; gap: 1rem; border-top: 1px solid var(--color-border); padding-top: 1.25rem;">
                        <img src="<?= e($t['image'] ?: 'assets/images/testimonial-1.jpg'); ?>" alt="<?= e($t['client_name']); ?>" style="width: 52px; height: 52px; border-radius: 50%; object-fit: cover; border: 2px solid var(--color-accent);">
                        <div>
                            <strong style="color: var(--color-text-dark); display: block; font-size: 1.05rem;"><?= e($t['client_name']); ?></strong>
                            <span style="color: var(--color-muted); font-size: 0.85rem;"><?= e($t['client_role']); ?> &bull; <?= e($t['event_type']); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <h2>Experience the Serenity Magic Firsthand</h2>
            <p>Let us make your upcoming milestone an extraordinary occasion.</p>
            <a href="enquiry.php" class="btn btn-accent btn-lg"><i class="fas fa-paper-plane"></i> Start Your Consultation</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
