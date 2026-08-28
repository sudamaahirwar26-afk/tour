<?php
/**
 * Sticky Glassmorphism Navbar & Dropdown Menu
 * Serenity Planners (Parth Planner Group)
 */

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Executive Top Utility Bar -->
<div class="top-bar">
    <div class="container top-bar-container">
        <div class="top-bar-left">
            <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['phone']); ?>">
                <i class="fas fa-phone-alt"></i> <?= e($settings['phone']); ?>
            </a>
            <a href="mailto:<?= e($settings['email']); ?>" class="hide-mobile">
                <i class="fas fa-envelope"></i> <?= e($settings['email']); ?>
            </a>
            <span class="hide-tablet"><i class="fas fa-clock"></i> <?= e($settings['business_hours']); ?></span>
        </div>
        <div class="top-bar-right">
            <span class="top-bar-tagline hide-mobile"><i class="fas fa-crown"></i> Luxury Tours, Royal Weddings & MICE Planners</span>
            <div class="top-socials">
                <?php if (!empty($settings['instagram_url'])): ?>
                    <a href="<?= e($settings['instagram_url']); ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <?php endif; ?>
                <?php if (!empty($settings['facebook_url'])): ?>
                    <a href="<?= e($settings['facebook_url']); ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <?php endif; ?>
                <?php if (!empty($settings['linkedin_url'])): ?>
                    <a href="<?= e($settings['linkedin_url']); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<header class="site-header">
    <div class="container nav-container">
        <!-- 1. Left: Brand Logo & Company Title -->
        <a href="index.php" class="brand-logo" aria-label="Serenity Planners Homepage">
            <img src="assets/images/logo.jpg" alt="<?= e($settings['company_name']); ?> Logo">
            <span class="brand-name">Serenity <span>Planners</span></span>
        </a>

        <!-- 2. Center/Right: Desktop Navigation Menu with Realistic Dropdowns -->
        <nav class="nav-menu" aria-label="Primary Navigation">
            <!-- Home -->
            <div class="nav-item">
                <a href="index.php" class="nav-link <?= ($current_page === 'index.php') ? 'active' : ''; ?>">Home</a>
            </div>

            <!-- Tour Packages Dropdown -->
            <div class="nav-item has-dropdown">
                <a href="packages.php" class="nav-link <?= in_array($current_page, ['packages.php']) ? 'active' : ''; ?>">
                    Tour Packages <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-inner">
                        <a href="packages.php" class="dropdown-item">
                            <i class="fas fa-th-large"></i>
                            <div>
                                <span class="dropdown-title">All Tour Packages & Deals</span>
                                <span class="dropdown-desc">Explore all domestic & global curated trips</span>
                            </div>
                        </a>
                        <a href="enquiry.php?package=Thailand+Tour" class="dropdown-item">
                            <i class="fas fa-umbrella-beach"></i>
                            <div>
                                <span class="dropdown-title">Thailand Tropical Escape</span>
                                <span class="dropdown-desc">Bangkok, Phuket & island hopping</span>
                            </div>
                        </a>
                        <a href="enquiry.php?package=Dubai+Safari" class="dropdown-item">
                            <i class="fas fa-dune"></i>
                            <div>
                                <span class="dropdown-title">Dubai Desert Safari & Dunes</span>
                                <span class="dropdown-desc">5-star luxury camps & yacht cruise</span>
                            </div>
                        </a>
                        <a href="enquiry.php?package=Switzerland+Alps" class="dropdown-item">
                            <i class="fas fa-mountain"></i>
                            <div>
                                <span class="dropdown-title">Switzerland & Lake Como</span>
                                <span class="dropdown-desc">Alpine scenic trains & lakeside villas</span>
                            </div>
                        </a>
                        <a href="enquiry.php?package=Rajasthan+Heritage" class="dropdown-item">
                            <i class="fas fa-crown"></i>
                            <div>
                                <span class="dropdown-title">Royal Rajasthan Heritage Palaces</span>
                                <span class="dropdown-desc">Udaipur lake palace & amber forts</span>
                            </div>
                        </a>
                        <a href="enquiry.php?package=Goa+Coastal" class="dropdown-item">
                            <i class="fas fa-ship"></i>
                            <div>
                                <span class="dropdown-title">Goa Coastal Yacht Vacation</span>
                                <span class="dropdown-desc">Private catamaran sail & beach resort</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Services Dropdown -->
            <div class="nav-item has-dropdown">
                <a href="services.php" class="nav-link <?= in_array($current_page, ['services.php', 'service-details.php']) ? 'active' : ''; ?>">
                    Services <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-inner">
                        <a href="services.php" class="dropdown-item">
                            <i class="fas fa-concierge-bell"></i>
                            <div>
                                <span class="dropdown-title">All Premium Services</span>
                                <span class="dropdown-desc">End-to-end travel & event management</span>
                            </div>
                        </a>
                        <a href="enquiry.php?service=Customized+Tours" class="dropdown-item">
                            <i class="fas fa-route"></i>
                            <div>
                                <span class="dropdown-title">Customized Tour Plans</span>
                                <span class="dropdown-desc">Tailor-made itineraries built around you</span>
                            </div>
                        </a>
                        <a href="enquiry.php?service=Honeymoon+Packages" class="dropdown-item">
                            <i class="fas fa-heart"></i>
                            <div>
                                <span class="dropdown-title">Honeymoon & Romantic Escapes</span>
                                <span class="dropdown-desc">Private villas & candlelight dinners</span>
                            </div>
                        </a>
                        <a href="enquiry.php?service=Wedding+Planning" class="dropdown-item">
                            <i class="fas fa-gem"></i>
                            <div>
                                <span class="dropdown-title">Royal & Bespoke Weddings</span>
                                <span class="dropdown-desc">Palace mandaps & 3-day luxury celebrations</span>
                            </div>
                        </a>
                        <a href="enquiry.php?service=Corporate+Events" class="dropdown-item">
                            <i class="fas fa-briefcase"></i>
                            <div>
                                <span class="dropdown-title">Corporate & MICE Summits</span>
                                <span class="dropdown-desc">High-tech delegate conferences & galas</span>
                            </div>
                        </a>
                        <a href="enquiry.php?service=Pilgrimage+Tours" class="dropdown-item">
                            <i class="fas fa-om"></i>
                            <div>
                                <span class="dropdown-title">Pilgrimage & Spiritual Tours</span>
                                <span class="dropdown-desc">Sacred sanctums & VIP temple darshans</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Destinations Dropdown -->
            <div class="nav-item has-dropdown">
                <a href="portfolio.php" class="nav-link <?= in_array($current_page, ['portfolio.php']) ? 'active' : ''; ?>">
                    Destinations <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <div class="dropdown-menu" style="min-width: 280px;">
                    <div class="dropdown-inner">
                        <a href="index.php#destinations" class="dropdown-item">
                            <i class="fas fa-globe-asia"></i>
                            <div>
                                <span class="dropdown-title">Thailand & SE Asia</span>
                                <span class="dropdown-desc">07 Active Tour Packages</span>
                            </div>
                        </a>
                        <a href="index.php#destinations" class="dropdown-item">
                            <i class="fas fa-place-of-worship"></i>
                            <div>
                                <span class="dropdown-title">India (Rajasthan & Goa)</span>
                                <span class="dropdown-desc">12 Active Tour Packages</span>
                            </div>
                        </a>
                        <a href="index.php#destinations" class="dropdown-item">
                            <i class="fas fa-city"></i>
                            <div>
                                <span class="dropdown-title">Dubai & UAE</span>
                                <span class="dropdown-desc">05 Active Tour Packages</span>
                            </div>
                        </a>
                        <a href="index.php#destinations" class="dropdown-item">
                            <i class="fas fa-water"></i>
                            <div>
                                <span class="dropdown-title">Switzerland & Italy</span>
                                <span class="dropdown-desc">08 Active Tour Packages</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- About Us Dropdown -->
            <div class="nav-item has-dropdown">
                <a href="about.php" class="nav-link <?= ($current_page === 'about.php') ? 'active' : ''; ?>">
                    About Us <i class="fas fa-chevron-down nav-arrow"></i>
                </a>
                <div class="dropdown-menu" style="min-width: 290px;">
                    <div class="dropdown-inner">
                        <a href="about.php" class="dropdown-item">
                            <i class="fas fa-award"></i>
                            <div>
                                <span class="dropdown-title">Our Story & Heritage</span>
                                <span class="dropdown-desc">Trusted travel partner since 2016</span>
                            </div>
                        </a>
                        <a href="about.php#group-network" class="dropdown-item">
                            <i class="fas fa-building"></i>
                            <div>
                                <span class="dropdown-title">Group Brands & Network</span>
                                <span class="dropdown-desc">Parth Planners, Ziva, Incubival</span>
                            </div>
                        </a>
                        <a href="index.php#faq" class="dropdown-item">
                            <i class="fas fa-question-circle"></i>
                            <div>
                                <span class="dropdown-title">Frequently Asked Questions</span>
                                <span class="dropdown-desc">Visas, booking terms & support</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reviews -->
            <div class="nav-item">
                <a href="testimonials.php" class="nav-link <?= ($current_page === 'testimonials.php') ? 'active' : ''; ?>">Reviews</a>
            </div>

            <!-- Contact -->
            <div class="nav-item">
                <a href="contact.php" class="nav-link <?= ($current_page === 'contact.php') ? 'active' : ''; ?>">Contact</a>
            </div>
        </nav>

        <!-- 3. Right: Action Buttons & Mobile Toggle -->
        <div class="nav-actions">
            <a href="enquiry.php" class="btn btn-accent btn-sm">
                <i class="fas fa-ticket-alt"></i> Book A Tour
            </a>
            <button class="mobile-toggle" aria-label="Open Navigation Menu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<!-- Mobile Navigation Drawer -->
<div class="mobile-drawer" id="mobileDrawer">
    <div>
        <div class="mobile-drawer-header">
            <div class="brand-logo">
                <img src="assets/images/logo.jpg" alt="Logo" style="height: 38px;">
                <span class="brand-name" style="font-size: 1.1rem;">Serenity <span>Planners</span></span>
            </div>
            <button class="drawer-close" aria-label="Close Menu">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="mobile-nav-links">
            <a href="index.php" class="nav-link <?= ($current_page === 'index.php') ? 'active' : ''; ?>">
                <i class="fas fa-home" style="width: 24px; color: var(--color-accent);"></i> Home
            </a>
            <a href="packages.php" class="nav-link <?= ($current_page === 'packages.php') ? 'active' : ''; ?>">
                <i class="fas fa-map-marked-alt" style="width: 24px; color: var(--color-accent);"></i> Tour Packages
            </a>
            <a href="services.php" class="nav-link <?= in_array($current_page, ['services.php', 'service-details.php']) ? 'active' : ''; ?>">
                <i class="fas fa-concierge-bell" style="width: 24px; color: var(--color-accent);"></i> Premium Services
            </a>
            <a href="portfolio.php" class="nav-link <?= ($current_page === 'portfolio.php') ? 'active' : ''; ?>">
                <i class="fas fa-globe-americas" style="width: 24px; color: var(--color-accent);"></i> Destinations & Moments
            </a>
            <a href="about.php" class="nav-link <?= ($current_page === 'about.php') ? 'active' : ''; ?>">
                <i class="fas fa-gem" style="width: 24px; color: var(--color-accent);"></i> About Us
            </a>
            <a href="testimonials.php" class="nav-link <?= ($current_page === 'testimonials.php') ? 'active' : ''; ?>">
                <i class="fas fa-star" style="width: 24px; color: var(--color-accent);"></i> Traveler Reviews
            </a>
            <a href="contact.php" class="nav-link <?= ($current_page === 'contact.php') ? 'active' : ''; ?>">
                <i class="fas fa-envelope" style="width: 24px; color: var(--color-accent);"></i> Contact Us
            </a>
        </div>
    </div>

    <div>
        <a href="enquiry.php" class="btn btn-accent" style="width: 100%; margin-bottom: 1rem;">
            <i class="fas fa-calendar-check"></i> Book A Tour / Event
        </a>
        <div style="font-size: 0.85rem; color: #94A3B8; text-align: center;">
            <i class="fas fa-phone-alt" style="color: var(--color-accent);"></i> <?= e($settings['phone']); ?>
        </div>
    </div>
</div>

<div class="mobile-drawer-overlay"></div>
