<?php
/**
 * SERENITY PLANNERS / PARTH TRIP - ABOUT US
 */

$pageTitle = "About Us | Serenity Planners";
$metaDesc = "Discover the story, creative vision, and leadership behind Serenity Planners - Your trusted travel and luxury event partner since 2016.";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';
?>

<!-- Page Banner -->
<section class="section section-dark" style="padding-top: 130px; padding-bottom: 4rem; text-align: center;">
    <div class="container">
        <div class="eyebrow" style="color: var(--color-accent);">DISCOVER OUR STORY</div>
        <h1 style="font-size: clamp(2.4rem, 4vw, 3.5rem); color: #FFF; margin-bottom: 1rem;">Your Trusted Travel & Event Partner</h1>
        <p style="color: #94A3B8; max-width: 650px; margin: 0 auto; font-size: 1.1rem;">Delivering personalized travel planning, custom itineraries, luxury stays, and seamless on-ground coordination since 2016.</p>
    </div>
</section>

<!-- About Story Section -->
<section class="section">
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
                <div class="eyebrow">OUR HERITAGE</div>
                <h2>Pioneering Luxury Journeys & Landmark Celebrations</h2>
                <p><strong>Parth Planner Pvt. Ltd. (Serenity Planners)</strong> is a leading global travel and bespoke event agency specializing in Inbound, Outbound, and MICE travel services.</p>
                <p>Since 2016, we have curated extraordinary travel experiences, customized holiday packages, sacred pilgrimage routes, romantic honeymoons, and royal destination weddings with complete itinerary management, handpicked 5-star hotels, private transport, and 24/7 on-ground assistance.</p>
                
                <div style="background: #F8FAFC; padding: 1.5rem; border-radius: var(--radius-md); border: 1px solid var(--color-border); margin: 1.75rem 0;">
                    <div style="font-size: 0.8rem; color: var(--color-accent-dark); font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Group Brands & Network</div>
                    <div style="color: var(--color-text-dark); font-size: 0.95rem; font-weight: 600; line-height: 1.6;">
                        Parth Planners &bull; Pathik Planners &bull; Ziva Planner &bull; Ziva Tourism LLC Dubai &bull; Incubival
                    </div>
                </div>

                <div class="about-highlights">
                    <div class="highlight-item"><i class="fas fa-check-circle"></i> 100% Customized Tour Plans</div>
                    <div class="highlight-item"><i class="fas fa-shield-alt"></i> Best Price Guarantee</div>
                    <div class="highlight-item"><i class="fas fa-headset"></i> 24/7 On-Ground Concierge</div>
                    <div class="highlight-item"><i class="fas fa-smile"></i> 5000+ Happy Travelers</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
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

<!-- Core Values Section -->
<section class="section section-slate">
    <div class="container">
        <div class="section-header">
            <div class="eyebrow">OUR CORE PRINCIPLES</div>
            <h2 class="section-title">Why Travelers Trust Serenity Planners</h2>
            <p class="section-desc">We uphold rigorous standards of luxury, integrity, and personalized care.</p>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fas fa-route"></i></div>
                <h3>100% Tailor-Made Itineraries</h3>
                <p>Every trip is customized to your pace, preferences, and group dynamics with flexible booking terms.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fas fa-tag"></i></div>
                <h3>Zero Hidden Costs</h3>
                <p>Direct contracted rates with 5-star resorts, private yachts, and airlines ensuring unbeatable transparent pricing.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon-wrap"><i class="fas fa-hands-helping"></i></div>
                <h3>24/7 Dedicated Support</h3>
                <p>From pre-departure visa assistance to on-trip logistics and airport transfers, our team is always beside you.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="cta-section">
    <div class="container">
        <div class="cta-box">
            <h2>Ready to Begin Your Next Adventure?</h2>
            <p>Connect with our senior destination specialists today to curate your personalized vacation itinerary.</p>
            <a href="enquiry.php" class="btn btn-accent btn-lg"><i class="fas fa-calendar-check"></i> Request a Custom Quote</a>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
