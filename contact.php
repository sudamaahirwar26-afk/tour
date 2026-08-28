<?php
/**
 * SERENITY PLANNERS - CONTACT US
 */

$pageTitle = "Contact Us | Serenity Planners";
$metaDesc = "Get in touch with Serenity Planners. Contact our luxury event concierge desk for inquiries, venue scouting, and consultation scheduling.";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- Contact Header Banner -->
<section class="section section-dark" style="padding-top: 130px; padding-bottom: 4rem; text-align: center;">
    <div class="container">
        <div class="eyebrow" style="color: var(--color-accent);">CONNECT WITH US</div>
        <h1 style="font-size: clamp(2.4rem, 4vw, 3.5rem); color: #FFF; margin-bottom: 1rem;">Let's Start a Conversation</h1>
        <p style="color: #94A3B8; max-width: 650px; margin: 0 auto; font-size: 1.1rem;">Whether planning an upcoming celebration or inquiring about our services, our team is at your disposal.</p>
    </div>
</section>

<!-- Contact Info & Form -->
<section class="section">
    <div class="container">
        <div class="about-grid">
            <!-- Details -->
            <div>
                <div class="eyebrow">HEADQUARTERS & CONCIERGE</div>
                <h2 style="font-size: 2.2rem; margin-bottom: 1.25rem;">Reach Our Event Specialists</h2>
                <p style="color: var(--color-muted); margin-bottom: 2.5rem; line-height: 1.7;">We welcome private consultations at our design studio or over private video conference with our executive directors.</p>

                <div style="display: flex; flex-direction: column; gap: 1.75rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(201, 162, 39, 0.12); color: var(--color-accent); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Studio Location</h4>
                            <p style="color: var(--color-muted); font-size: 0.95rem;"><?= e($settings['address']); ?></p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(201, 162, 39, 0.12); color: var(--color-accent); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Direct Telephone</h4>
                            <p style="color: var(--color-muted); font-size: 0.95rem;">
                                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['phone']); ?>" style="color:inherit;"><?= e($settings['phone']); ?></a><br>
                                <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['alt_phone']); ?>" style="color:inherit;"><?= e($settings['alt_phone']); ?></a>
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(201, 162, 39, 0.12); color: var(--color-accent); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-envelope-open-text"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Electronic Mail</h4>
                            <p style="color: var(--color-muted); font-size: 0.95rem;">
                                <a href="mailto:<?= e($settings['email']); ?>" style="color:inherit;"><?= e($settings['email']); ?></a>
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; align-items: flex-start; gap: 1.25rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; background: rgba(201, 162, 39, 0.12); color: var(--color-accent); display: flex; align-items: center; justify-content: center; font-size: 1.2rem; flex-shrink: 0;">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h4 style="font-size: 1.1rem; margin-bottom: 0.25rem;">Concierge Hours</h4>
                            <p style="color: var(--color-muted); font-size: 0.95rem;"><?= e($settings['business_hours']); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Message Form -->
            <div class="form-card">
                <h3 style="font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--color-primary);">Send Us a Message</h3>
                <p style="color: var(--color-muted); font-size: 0.9rem; margin-bottom: 2rem;">Please share your inquiry details below.</p>

                <form id="contactForm" method="POST" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= e($csrfToken); ?>">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Your Name <span class="req">*</span></label>
                            <input type="text" name="name" class="form-control" placeholder="e.g. Marcus Vance" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address <span class="req">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="e.g. marcus@example.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone Number</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+1 (555) 123-4567">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Subject <span class="req">*</span></label>
                            <input type="text" name="subject" class="form-control" placeholder="e.g. Lake Como Wedding Consultation" required>
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Your Message <span class="req">*</span></label>
                            <textarea name="message" rows="4" class="form-control" placeholder="How can we assist you with your celebration?" required></textarea>
                        </div>
                        <div class="form-group full-width">
                            <button type="submit" class="btn btn-accent" style="width: 100%;">
                                <i class="fas fa-paper-plane"></i> Send Message
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
