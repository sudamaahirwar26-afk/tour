<?php
/**
 * SERENITY PLANNERS / PARTH TRIP - TOUR PLANNING & LUXURY EVENTS
 * Full-Stack Production Implementation
 */

$pageTitle = "Serenity Planners | Luxury Tour Packages, Destination Planning & Royal Events";
$metaDesc = "Serenity Planners (Parth Planner Group) offers customized domestic & international tour packages, luxury vacations, honeymoon escapes, pilgrimage tours, and destination celebrations.";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$packages = getActivePackages(6);
$services = getActiveServices(6);
$destinations = getActiveDestinations(6);
$portfolioItems = getActivePortfolio('all', 8);
$testimonials = getPublishedTestimonials(6);
?>

<!-- 1. Hero Banner with Quick Search -->
<section class="hero-section">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fas fa-compass"></i> Tour & Travel &bull; Since 2016
            </div>
            <h1 class="hero-title">
                Explore The World With<br>
                <span>Bespoke Journeys.</span>
            </h1>
            <p class="hero-subtitle">
                Customized domestic & international tour packages with premium stays, verified local guides, and 24/7 on-ground concierge support.
            </p>

            <!-- Quick Tour & Event Consultation Search Bar -->
            <div class="hero-search-wrap">
                <form action="enquiry.php" method="GET" class="hero-search-grid">
                    <div>
                        <label style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--color-accent); display: block; margin-bottom: 0.35rem;">Destination / City</label>
                        <select name="destination" class="form-control" style="background: #FFF; font-size: 0.9rem;">
                            <option value="">Where to?</option>
                            <option value="Thailand">Thailand (Bangkok & Phuket)</option>
                            <option value="India">India (Rajasthan & Goa)</option>
                            <option value="Switzerland">Switzerland & Lake Como</option>
                            <option value="Dubai">Dubai & UAE</option>
                            <option value="Bali">Bali & Indonesia</option>
                            <option value="Europe">Europe & Paris</option>
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--color-accent); display: block; margin-bottom: 0.35rem;">Category & Service</label>
                        <select name="service" class="form-control" style="background: #FFF; font-size: 0.9rem;">
                            <optgroup label="🌍 Tour & Travel">
                                <option value="Customized Tour Packages">Customized Tours</option>
                                <option value="Holiday Packages">Holiday Packages</option>
                                <option value="Honeymoon Packages">Honeymoon Escapes</option>
                                <option value="Luxury Travel">Luxury & Royal Travel</option>
                                <option value="Pilgrimage Tours">Pilgrimage Tours</option>
                                <option value="Family Vacations">Family Vacations</option>
                            </optgroup>
                            <optgroup label="👑 Luxury Events">
                                <option value="Royal Wedding Planning">Royal Wedding</option>
                                <option value="Destination Wedding">Destination Wedding</option>
                                <option value="Corporate Events">Corporate & MICE</option>
                                <option value="Private Events">Private Soirée</option>
                            </optgroup>
                            <optgroup label="🛎️ Concierge">
                                <option value="Hotel & Palace Bookings">5-Star Hotel Stays</option>
                                <option value="Private Yacht & Jet Charter">Yacht & Jet Charter</option>
                            </optgroup>
                        </select>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--color-accent); display: block; margin-bottom: 0.35rem;">Departure Date</label>
                        <input type="date" name="date" class="form-control" style="background: #FFF; font-size: 0.9rem;" min="<?= date('Y-m-d'); ?>">
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; text-transform: uppercase; font-weight: 700; color: var(--color-accent); display: block; margin-bottom: 0.35rem;">Guests / Travelers</label>
                        <input type="number" name="guests" class="form-control" style="background: #FFF; font-size: 0.9rem;" placeholder="e.g. 2" min="1">
                    </div>
                    <div class="search-btn-col">
                        <button type="submit" class="btn btn-accent" style="height: 44px; padding: 0 1.5rem; width: 100%;">
                            <i class="fas fa-search"></i> Plan Trip / Event
                        </button>
                    </div>
                </form>
            </div>

            <div class="hero-features">
                <div class="hero-feature-item">
                    <i class="fas fa-check-circle"></i> 100% Customized Itineraries
                </div>
                <div class="hero-feature-item">
                    <i class="fas fa-shield-alt"></i> Best Price Guarantee
                </div>
                <div class="hero-feature-item">
                    <i class="fas fa-headset"></i> 24/7 On-Ground Concierge
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Trust Statistics Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number" data-target="5000+">5000+</div>
                <div class="stat-label">Happy Travelers</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-target="15+">15+</div>
                <div class="stat-label">Years of Experience</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-target="50+">50+</div>
                <div class="stat-label">Global Destinations</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" data-target="24/7">24/7</div>
                <div class="stat-label">On-Ground Support</div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Latest Travel Packages Section (Fresh Picks) -->
<section class="section" id="packages">
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3.5rem; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <div class="eyebrow">FRESH PICKS & DEALS</div>
                <h2 class="section-title" style="margin-bottom: 0.5rem;">Latest Travel Packages</h2>
                <p class="section-desc">Handcrafted holiday packages and guided expeditions with 5-star luxury stays.</p>
            </div>
            <a href="enquiry.php" class="btn btn-outline-dark">
                View All Deals <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="packages-grid">
            <?php foreach ($packages as $pkg): ?>
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

<!-- 4. Premium Travel & Planning Services -->
<section class="section section-dark" id="services">
    <div class="container">
        <div class="section-header">
            <div class="eyebrow">OUR SPECIALIZATIONS</div>
            <h2 class="section-title">Explore Our Premium Travel Services</h2>
            <p class="section-desc">Discover customized travel experiences and turnkey event logistics designed for every type of traveler.</p>
        </div>

        <div class="services-grid">
            <div class="service-card">
                <div class="service-image-wrap">
                    <span class="service-card-num">Popular</span>
                    <img src="assets/images/service-wedding.jpg" alt="Customized Tours">
                </div>
                <div class="service-body">
                    <h3 class="service-title">Customized Tours</h3>
                    <p class="service-desc">Personalized travel plans designed exactly for your comfort, pace, and budget with private chauffeured cars.</p>
                    <a href="enquiry.php?service=Customized+Tours" class="service-link">Explore Service <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="service-card">
                <div class="service-image-wrap">
                    <span class="service-card-num">Trending</span>
                    <img src="assets/images/service-destination.jpg" alt="Holiday Packages">
                </div>
                <div class="service-body">
                    <h3 class="service-title">Holiday Packages</h3>
                    <p class="service-desc">Domestic and international holiday packages with handpicked 4-star and 5-star resort accommodations.</p>
                    <a href="enquiry.php?service=Holiday+Packages" class="service-link">Explore Service <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="service-card">
                <div class="service-image-wrap">
                    <span class="service-card-num">Spiritual</span>
                    <img src="assets/images/about-img.jpg" alt="Pilgrimage Tours">
                </div>
                <div class="service-body">
                    <h3 class="service-title">Pilgrimage Tours</h3>
                    <p class="service-desc">Spiritual journeys covering sacred heritage sanctums, VIP temple darshans, and comfortable elderly care.</p>
                    <a href="enquiry.php?service=Pilgrimage+Tours" class="service-link">Explore Service <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="service-card">
                <div class="service-image-wrap">
                    <span class="service-card-num">Luxury</span>
                    <img src="assets/images/service-private.jpg" alt="Luxury Travel">
                </div>
                <div class="service-body">
                    <h3 class="service-title">Luxury & Royal Travel</h3>
                    <p class="service-desc">Premium luxury travel experiences with world-class comfort, private jets, yachts, and Michelin dining.</p>
                    <a href="enquiry.php?service=Luxury+Travel" class="service-link">Explore Service <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="service-card">
                <div class="service-image-wrap">
                    <span class="service-card-num">Romantic</span>
                    <img src="assets/images/dest-como.jpg" alt="Honeymoon Packages">
                </div>
                <div class="service-body">
                    <h3 class="service-title">Honeymoon Packages</h3>
                    <p class="service-desc">Romantic escapes crafted for unforgettable memories with private pool villas, candlelight dinners, and spa retreats.</p>
                    <a href="enquiry.php?service=Honeymoon+Packages" class="service-link">Explore Service <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="service-card">
                <div class="service-image-wrap">
                    <span class="service-card-num">Family</span>
                    <img src="assets/images/service-social.jpg" alt="Family Vacations">
                </div>
                <div class="service-body">
                    <h3 class="service-title">Family Vacations</h3>
                    <p class="service-desc">Fun-filled family trips with comfortable interconnecting suites, kid-friendly excursions, and theme park passes.</p>
                    <a href="enquiry.php?service=Family+Vacations" class="service-link">Explore Service <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Explore Most Loved Destinations -->
<section class="section" id="destinations">
    <div class="container">
        <div class="section-header">
            <div class="eyebrow">EXPLORE PLACES</div>
            <h2 class="section-title">Explore Our Most Loved Destinations</h2>
            <p class="section-desc">From tropical Thai islands to alpine Swiss peaks and desert palaces, we craft perfection.</p>
        </div>

        <div class="destinations-grid">
            <?php foreach ($destinations as $dst): ?>
                <div class="destination-card">
                    <img src="<?= e($dst['image']); ?>" alt="<?= e($dst['name']); ?>">
                    <div class="destination-overlay">
                        <span class="destination-badge"><?= e($dst['tour_count']); ?></span>
                        <h3 class="destination-title"><?= e($dst['name']); ?></h3>
                        <p class="destination-desc"><?= e($dst['tagline']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- 6. About Us / Your Trusted Travel Partner Since 2016 -->
<section class="section section-slate" id="about">
    <div class="container">
        <div class="about-grid">
            <div class="about-image-wrap">
                <img src="assets/images/about-img.jpg" alt="About Serenity Planners" class="about-image-main">
                <div class="about-image-badge">
                    <div class="about-badge-num">10+</div>
                    <div class="about-badge-text">Years of Excellence</div>
                </div>
            </div>
            <div class="about-content">
                <div class="eyebrow">ABOUT US</div>
                <h2>Your Trusted Travel & Event Partner Since 2016</h2>
                <p><strong>Serenity Planners (Parth Planner Pvt. Ltd.)</strong> is a premier global travel and event management agency specializing in Inbound, Outbound, and MICE travel services.</p>
                <p>Since 2016, we have been delivering personalized travel planning, complete itinerary management, hotel bookings, VIP transport, and 24/7 on-ground support across India, Southeast Asia, Europe, and the Middle East.</p>

                <div style="background: rgba(255, 255, 255, 0.05); padding: 1.25rem; border-radius: var(--radius-md); border: 1px solid rgba(255, 255, 255, 0.1); margin-bottom: 1.75rem;">
                    <div style="font-size: 0.8rem; color: var(--color-accent); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Group Brands & Network</div>
                    <div style="color: #E2E8F0; font-size: 0.88rem; line-height: 1.6;">
                        Parth Planners &bull; Pathik Planners &bull; Ziva Planner &bull; Ziva Tourism LLC Dubai &bull; Incubival
                    </div>
                </div>

                <div class="about-highlights">
                    <div class="highlight-item" style="color: #FFF;"><i class="fas fa-check-circle"></i> 100% Customized Tour Plans</div>
                    <div class="highlight-item" style="color: #FFF;"><i class="fas fa-check-circle"></i> Best Price Guarantee</div>
                    <div class="highlight-item" style="color: #FFF;"><i class="fas fa-check-circle"></i> 24/7 On-Ground Support</div>
                    <div class="highlight-item" style="color: #FFF;"><i class="fas fa-check-circle"></i> 5000+ Happy Travelers</div>
                </div>

                <a href="about.php" class="btn btn-accent">
                    <i class="fas fa-arrow-right"></i> Discover Our Story
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 7. Curated Portfolio Moments -->
<section class="section" id="portfolio">
    <div class="container">
        <div class="section-header">
            <div class="eyebrow">OUR CURATED MOMENTS</div>
            <h2 class="section-title">Visual Tour & Event Retrospective</h2>
            <p class="section-desc">A visual glimpse into the unforgettable journeys and milestone galas orchestrated by our team.</p>
        </div>

        <div class="portfolio-filters">
            <button class="filter-btn active" data-filter="all">All Moments</button>
            <button class="filter-btn" data-filter="wedding">Royal Weddings</button>
            <button class="filter-btn" data-filter="corporate">Corporate & MICE</button>
            <button class="filter-btn" data-filter="destination">Destination Tours</button>
            <button class="filter-btn" data-filter="private">Luxury Private</button>
        </div>

        <div class="portfolio-grid">
            <?php foreach ($portfolioItems as $item): ?>
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

<!-- 8. Testimonials Section -->
<section class="section section-dark" id="testimonials">
    <div class="container">
        <div class="section-header">
            <div class="eyebrow">TRAVELER REVIEWS</div>
            <h2 class="section-title">Words From Our Travelers</h2>
            <p class="section-desc">Read how Serenity Planners transformed journeys into cherished lifetime memories.</p>
        </div>

        <div class="testimonial-slider-wrap">
            <div class="testimonial-track">
                <?php foreach ($testimonials as $t): ?>
                    <div class="testimonial-slide">
                        <div class="testimonial-stars">
                            <?php for ($s = 0; $s < (int)$t['rating']; $s++): ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="testimonial-quote">
                            "<?= e($t['message']); ?>"
                        </div>
                        <div class="testimonial-author">
                            <img src="<?= e($t['image'] ?: 'assets/images/testimonial-1.jpg'); ?>" alt="<?= e($t['client_name']); ?>" class="testimonial-avatar">
                            <div style="text-align: left;">
                                <div class="author-name"><?= e($t['client_name']); ?></div>
                                <div class="author-role"><?= e($t['client_role']); ?> &bull; <?= e($t['event_type']); ?></div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="slider-controls">
                <button class="slider-btn slider-prev" aria-label="Previous Testimonial"><i class="fas fa-chevron-left"></i></button>
                <div class="slider-dots"></div>
                <button class="slider-btn slider-next" aria-label="Next Testimonial"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>
</section>

<!-- 9. Interactive FAQ Accordion -->
<section class="section" id="faq">
    <div class="container">
        <div class="section-header">
            <div class="eyebrow">FREQUENTLY ASKED QUESTIONS</div>
            <h2 class="section-title">Tour Booking & Travel FAQs</h2>
            <p class="section-desc">Got questions about planning your tour? Here are answers to common questions.</p>
        </div>

        <div class="faq-wrap">
            <div class="faq-item active">
                <button class="faq-question">
                    <span>How can I customize my tour package?</span>
                    <div class="faq-icon"><i class="fas fa-chevron-down"></i></div>
                </button>
                <div class="faq-answer">
                    Simply fill out our consultation enquiry form with your preferred destination, estimated travel dates, number of travelers, and accommodation preferences. Our senior destination specialist will curate a custom day-by-day itinerary with verified 4-star/5-star hotels and private transfers within 24 hours.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span>Do you assist with international visas and flights?</span>
                    <div class="faq-icon"><i class="fas fa-chevron-down"></i></div>
                </button>
                <div class="faq-answer">
                    Yes, we provide end-to-end visa documentation guidance, flight reservations, travel insurance policies, and on-ground arrival meet-and-greet services for destinations across Thailand, Dubai, Europe, Bali, and more.
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span>What is your cancellation and refund policy?</span>
                    <div class="faq-icon"><i class="fas fa-chevron-down"></i></div>
                </button>
                <div class="faq-answer">
                    We offer flexible travel terms. In case of unexpected schedule adjustments, our partner hotel networks allow date rescheduling with minimal or zero penalty, provided notice is provided as per standard airline and hotel guidelines.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 10. Contact & Tour Booking Enquiry Form -->
<section class="section section-slate" id="contact">
    <div class="container">
        <div class="about-grid">
            <div>
                <div class="eyebrow">GET IN TOUCH</div>
                <h2 style="font-size: 2.3rem; margin-bottom: 1.25rem;">Start Planning Your Trip</h2>
                <p style="color: #CBD5E1; margin-bottom: 2rem;">Our travel and tour concierge is available to answer all questions, customize tour packages, and provide competitive group rates.</p>

                <div style="display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 2.5rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--color-primary); color: var(--color-accent); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <strong style="color: #FFF; display: block;">Office Address</strong>
                            <span style="color: #94A3B8;"><?= e($settings['address']); ?></span>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--color-primary); color: var(--color-accent); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <div>
                            <strong style="color: #FFF; display: block;">Telephone / WhatsApp</strong>
                            <span style="color: #94A3B8;"><?= e($settings['phone']); ?> | <?= e($settings['alt_phone']); ?></span>
                        </div>
                    </div>
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <div style="width: 44px; height: 44px; border-radius: 50%; background: var(--color-primary); color: var(--color-accent); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <strong style="color: #FFF; display: block;">Email Inquiries</strong>
                            <span style="color: #94A3B8;"><?= e($settings['email']); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Enquiry Form -->
            <div class="form-card">
                <h3 style="font-size: 1.4rem; margin-bottom: 0.5rem; color: var(--color-primary);">Book A Tour / Request Itinerary</h3>
                <p style="color: var(--color-muted); font-size: 0.88rem; margin-bottom: 1.75rem;">Fill out the form below to receive a customized quote.</p>

                <form id="enquiryForm" method="POST" novalidate>
                    <input type="hidden" name="csrf_token" value="<?= e($csrfToken); ?>">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Full Name <span class="req">*</span></label>
                            <input type="text" name="full_name" class="form-control" placeholder="e.g. Rahul Sharma" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Email Address <span class="req">*</span></label>
                            <input type="email" name="email" class="form-control" placeholder="e.g. rahul@example.com" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Phone / WhatsApp <span class="req">*</span></label>
                            <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Service & Package Category <span class="req">*</span></label>
                            <select name="event_type" class="form-control" required>
                                <option value="">Select Tour or Event Category</option>
                                <optgroup label="🌍 Tour & Travel Packages">
                                    <option value="Customized Tour Packages">Customized Tour Packages</option>
                                    <option value="Holiday Packages">Domestic & International Holiday Packages</option>
                                    <option value="Honeymoon Packages">Romantic Honeymoon Packages</option>
                                    <option value="Luxury Travel">Luxury & Royal Travel (5-Star)</option>
                                    <option value="Pilgrimage Tours">Pilgrimage & Spiritual Tours</option>
                                    <option value="Family Vacations">Family Vacations & Group Trips</option>
                                    <option value="Thailand Tour">Thailand Tropical Escape</option>
                                    <option value="Dubai Adventure Safari">Dubai Desert Safari & Dunes</option>
                                    <option value="Switzerland Lake Como">Switzerland & Lake Como Tour</option>
                                    <option value="Rajasthan Royal Palace">Royal Rajasthan Heritage Tour</option>
                                    <option value="Goa Coastal Vacation">Goa Coastal Yacht Vacation</option>
                                </optgroup>
                                <optgroup label="👑 Luxury Event Planning">
                                    <option value="Royal Wedding Planning">Royal & Bespoke Wedding Planning</option>
                                    <option value="Destination Wedding">Destination Wedding Management</option>
                                    <option value="Corporate Events">Corporate Summit, MICE & Gala</option>
                                    <option value="Private Events">Private & Milestone Soirée</option>
                                    <option value="Social Events">Social & Cultural Celebration</option>
                                    <option value="Decor & Production Design">Decor & 3D Stagecraft Production</option>
                                </optgroup>
                                <optgroup label="🛎️ Concierge & Bookings">
                                    <option value="Hotel & Palace Bookings">5-Star Hotel & Palace Bookings</option>
                                    <option value="Private Yacht & Jet Charter">Private Yacht & Jet Charter</option>
                                    <option value="VIP Airport Transfers">VIP Airport Transfers & Chauffeur</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label class="form-label">Travel Notes / Event Vision & Preferences <span class="req">*</span></label>
                            <textarea name="message" rows="3" class="form-control" placeholder="Tell us about your preferred dates, total travelers/guests, destination preferences, and special requests..." required></textarea>
                        </div>
                        <div class="form-group full-width">
                            <button type="submit" class="btn btn-accent" style="width: 100%;">
                                <i class="fas fa-paper-plane"></i> Submit Reservation / Consultation Request
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
