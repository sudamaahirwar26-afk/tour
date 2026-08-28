<?php
/**
 * Global Footer Component
 * Serenity Planners
 */
$footerServices = getActiveServices(5);
?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="index.php" class="brand-logo">
                    <img src="assets/images/logo.jpg" alt="<?= e($settings['company_name']); ?> Logo" style="height: 48px;">
                    <span class="brand-name" style="color: #FFF;">Serenity <span>Planners</span></span>
                </a>
                <p><?= e($settings['footer_text']); ?></p>
                <div class="footer-socials">
                    <?php if (!empty($settings['facebook_url'])): ?>
                        <a href="<?= e($settings['facebook_url']); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['instagram_url'])): ?>
                        <a href="<?= e($settings['instagram_url']); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['linkedin_url'])): ?>
                        <a href="<?= e($settings['linkedin_url']); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <?php endif; ?>
                    <?php if (!empty($settings['pinterest_url'])): ?>
                        <a href="<?= e($settings['pinterest_url']); ?>" target="_blank" rel="noopener noreferrer" class="social-icon" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="footer-heading">Tour & Travel</h4>
                <div class="footer-links">
                    <a href="index.php">Home</a>
                    <a href="about.php">About Us</a>
                    <a href="packages.php">Tour Packages</a>
                    <a href="services.php">Premium Services</a>
                    <a href="portfolio.php">Curated Moments</a>
                    <a href="testimonials.php">Traveler Reviews</a>
                    <a href="enquiry.php">Book A Tour</a>
                    <a href="contact.php">Contact Us</a>
                </div>
            </div>

            <!-- Group Brands & Services -->
            <div>
                <h4 class="footer-heading">Group Companies</h4>
                <div class="footer-links">
                    <span style="color: #CBD5E1; font-weight: 600;">Parth Planners</span>
                    <span style="color: #CBD5E1; font-weight: 600;">Pathik Planners</span>
                    <span style="color: #CBD5E1; font-weight: 600;">Ziva Planner</span>
                    <span style="color: #CBD5E1; font-weight: 600;">Ziva Tourism LLC Dubai</span>
                    <span style="color: #CBD5E1; font-weight: 600;">Incubival</span>
                </div>
            </div>

            <!-- Concierge & Contact -->
            <div>
                <h4 class="footer-heading">Concierge Desk</h4>
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div><?= e($settings['address']); ?></div>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <div><a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['phone']); ?>" style="color:inherit;"><?= e($settings['phone']); ?></a></div>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <div><a href="mailto:<?= e($settings['email']); ?>" style="color:inherit;"><?= e($settings['email']); ?></a></div>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-clock"></i>
                    <div><?= e($settings['business_hours']); ?></div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div>
                &copy; <?= date('Y'); ?> <?= e($settings['company_name']); ?>. All Rights Reserved. Crafted with Bespoke Elegance.
            </div>
            <div style="display: flex; gap: 1.5rem; align-items: center;">
                <a href="contact.php" style="color: #94A3B8;">Privacy Policy</a>
                <a href="contact.php" style="color: #94A3B8;">Terms of Service</a>
                <a href="admin/login.php" style="color: var(--color-accent); font-weight: 600;"><i class="fas fa-lock"></i> Admin Portal</a>
            </div>
        </div>
    </div>
</footer>

<!-- Floating Concierge Pill -->
<a href="enquiry.php" class="floating-concierge" aria-label="Book Quick Consultation">
    <i class="fas fa-calendar-check" style="color: var(--color-accent);"></i>
    <span>Plan Your Event</span>
</a>

<!-- Vanilla JS Scripts -->
<script src="assets/js/main.js"></script>
<script src="assets/js/ajax-forms.js"></script>
</body>
</html>
