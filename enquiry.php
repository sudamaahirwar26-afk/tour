<?php
/**
 * SERENITY PLANNERS - TOUR & EVENT BOOKING / CONSULTATION ENQUIRY SYSTEM
 */

$pageTitle = "Book A Tour & Plan Your Event | Serenity Planners";
$metaDesc = "Submit your tour booking or luxury event inquiry to Serenity Planners. Customized holiday packages, destination weddings, and corporate summits.";

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

$preselectedService     = isset($_GET['service']) ? trim($_GET['service']) : '';
$preselectedPackage     = isset($_GET['package']) ? trim($_GET['package']) : '';
$preselectedDestination = isset($_GET['destination']) ? trim($_GET['destination']) : '';
$preselectedDate        = isset($_GET['date']) ? trim($_GET['date']) : '';
$preselectedGuests      = isset($_GET['guests']) ? trim($_GET['guests']) : '';

$defaultSelection = $preselectedPackage ?: $preselectedService;
?>

<!-- Enquiry Header Banner -->
<section class="section section-dark" style="padding-top: 130px; padding-bottom: 4rem; text-align: center;">
    <div class="container">
        <div class="eyebrow" style="color: var(--color-accent);">BESPOKE TRAVEL & EVENTS</div>
        <h1 style="font-size: clamp(2.4rem, 4vw, 3.5rem); color: #FFF; margin-bottom: 1rem;">Book A Tour & Plan Your Event</h1>
        <p style="color: #94A3B8; max-width: 650px; margin: 0 auto; font-size: 1.1rem;">Choose your preferred travel package or event service below to receive a custom day-by-day itinerary and bespoke proposal.</p>
    </div>
</section>

<!-- Main Enquiry Form Section -->
<section class="section">
    <div class="container" style="max-width: 920px;">
        <div class="form-card">
            <div style="text-align: center; margin-bottom: 2.5rem;">
                <div class="eyebrow">BOOKING & CONSULTATION BRIEF</div>
                <h2 style="font-size: 2rem; color: var(--color-primary);">Reservation & Consultation Form</h2>
                <p style="color: var(--color-muted); font-size: 0.95rem; margin-top: 0.5rem;">Please fill in the required fields (<span style="color: #E11D48;">*</span>) so our destination specialists can assist you.</p>
            </div>

            <form id="enquiryForm" method="POST" novalidate>
                <input type="hidden" name="csrf_token" value="<?= e($csrfToken); ?>">
                
                <div class="form-grid">
                    <!-- 1. Full Name -->
                    <div class="form-group">
                        <label class="form-label">Full Name <span class="req">*</span></label>
                        <input type="text" name="full_name" class="form-control" placeholder="e.g. Rahul Sharma / Julian Vance" required>
                    </div>

                    <!-- 2. Email Address -->
                    <div class="form-group">
                        <label class="form-label">Email Address <span class="req">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="e.g. rahul@example.com" required>
                    </div>

                    <!-- 3. Phone Number -->
                    <div class="form-group">
                        <label class="form-label">Phone / WhatsApp Number <span class="req">*</span></label>
                        <input type="tel" name="phone" class="form-control" placeholder="+91 98765 43210" required>
                    </div>

                    <!-- 4. Categorized Service / Tour Type Selection -->
                    <div class="form-group">
                        <label class="form-label">Category & Service Type <span class="req">*</span></label>
                        <select name="event_type" class="form-control" required style="font-weight: 500;">
                            <option value="">-- Select Tour or Event Category --</option>
                            
                            <optgroup label="🌍 TOUR & TRAVEL PACKAGES">
                                <option value="Customized Tour Packages" <?= (stripos($defaultSelection, 'Customized') !== false) ? 'selected' : ''; ?>>Customized Tour Packages</option>
                                <option value="Domestic Holiday Packages" <?= (stripos($defaultSelection, 'Holiday') !== false) ? 'selected' : ''; ?>>Domestic & International Holiday Packages</option>
                                <option value="Honeymoon Packages" <?= (stripos($defaultSelection, 'Honeymoon') !== false) ? 'selected' : ''; ?>>Honeymoon & Romantic Escapes</option>
                                <option value="Luxury Travel" <?= (stripos($defaultSelection, 'Luxury') !== false) ? 'selected' : ''; ?>>Luxury & Royal Travel (5-Star)</option>
                                <option value="Pilgrimage Tours" <?= (stripos($defaultSelection, 'Pilgrimage') !== false) ? 'selected' : ''; ?>>Pilgrimage & Spiritual Tours</option>
                                <option value="Family Vacations" <?= (stripos($defaultSelection, 'Family') !== false) ? 'selected' : ''; ?>>Family Vacations & Group Tours</option>
                                <option value="Desert & Adventure Safari" <?= (stripos($defaultSelection, 'Safari') !== false || stripos($defaultSelection, 'Desert') !== false) ? 'selected' : ''; ?>>Desert Safari & Adventure Expeditions</option>
                                <option value="Thailand Tour Package" <?= (stripos($defaultSelection, 'Bangkok') !== false || stripos($defaultSelection, 'Thailand') !== false) ? 'selected' : ''; ?>>Thailand & Island Tour Package</option>
                                <option value="Dubai & UAE Tour Package" <?= (stripos($defaultSelection, 'Dubai') !== false) ? 'selected' : ''; ?>>Dubai City & Dunes Tour Package</option>
                                <option value="Switzerland & Italy Tour Package" <?= (stripos($defaultSelection, 'Switzerland') !== false || stripos($defaultSelection, 'Como') !== false) ? 'selected' : ''; ?>>Switzerland & Lake Como Tour Package</option>
                                <option value="Royal Rajasthan Tour Package" <?= (stripos($defaultSelection, 'Rajasthan') !== false || stripos($defaultSelection, 'Udaipur') !== false) ? 'selected' : ''; ?>>Royal Rajasthan Heritage Palace Tour</option>
                                <option value="Goa Coastal Vacation Package" <?= (stripos($defaultSelection, 'Goa') !== false) ? 'selected' : ''; ?>>Goa Coastal Yacht & Beach Vacation</option>
                            </optgroup>

                            <optgroup label="👑 LUXURY EVENT PLANNING">
                                <option value="Royal Wedding Planning" <?= (stripos($defaultSelection, 'Wedding') !== false) ? 'selected' : ''; ?>>Royal & Bespoke Wedding Planning</option>
                                <option value="Destination Wedding" <?= (stripos($defaultSelection, 'Destination') !== false) ? 'selected' : ''; ?>>Destination Wedding Management</option>
                                <option value="Corporate Events" <?= (stripos($defaultSelection, 'Corporate') !== false || stripos($defaultSelection, 'MICE') !== false) ? 'selected' : ''; ?>>Corporate Summit, MICE & Gala</option>
                                <option value="Private Events" <?= (stripos($defaultSelection, 'Private') !== false) ? 'selected' : ''; ?>>Private & Milestone Soirée</option>
                                <option value="Social Events" <?= (stripos($defaultSelection, 'Social') !== false) ? 'selected' : ''; ?>>Social & Cultural Celebration</option>
                                <option value="Decor & Production Design" <?= (stripos($defaultSelection, 'Decor') !== false) ? 'selected' : ''; ?>>Decor, 3D Stagecraft & Lighting</option>
                            </optgroup>

                            <optgroup label="🛎️ PREMIUM CONCIERGE & BOOKINGS">
                                <option value="Hotel & Palace Bookings">5-Star Hotel & Palace Bookings</option>
                                <option value="Private Yacht & Jet Charter">Private Yacht & Jet Charter</option>
                                <option value="VIP Airport Transfers">VIP Airport Transfers & Chauffeur</option>
                                <option value="Visa & Travel Insurance">Visa Documentation & Travel Insurance</option>
                            </optgroup>
                        </select>
                    </div>

                    <!-- 5. Travel / Event Date -->
                    <div class="form-group">
                        <label class="form-label">Preferred Date / Departure</label>
                        <input type="date" name="event_date" class="form-control" min="<?= date('Y-m-d'); ?>" value="<?= e($preselectedDate); ?>">
                    </div>

                    <!-- 6. Number of Guests / Travelers -->
                    <div class="form-group">
                        <label class="form-label">Number of Travelers / Guests</label>
                        <input type="number" name="guest_count" class="form-control" placeholder="e.g. 2 or 150" min="1" value="<?= e($preselectedGuests); ?>">
                    </div>

                    <!-- 7. Budget Range -->
                    <div class="form-group">
                        <label class="form-label">Estimated Budget Allocation</label>
                        <select name="budget_range" class="form-control">
                            <option value="">Select Budget Range</option>
                            <option value="Under ₹50,000">Under ₹50,000</option>
                            <option value="₹50,000 - ₹1,50,000">₹50,000 - ₹1,50,000</option>
                            <option value="₹1,50,000 - ₹5,00,000">₹1,50,000 - ₹5,00,000</option>
                            <option value="₹5,00,000 - ₹25,00,000 (Luxury Event / Package)">₹5,00,000 - ₹25,00,000 (Luxury Event / Package)</option>
                            <option value="₹25,00,000+ (Grand Royal Celebration)">₹25,00,000+ (Grand Royal Celebration)</option>
                        </select>
                    </div>

                    <!-- 8. Preferred Destination / City -->
                    <div class="form-group">
                        <label class="form-label">Preferred Destination / City</label>
                        <input type="text" name="event_location" class="form-control" placeholder="e.g. Thailand, Switzerland, Udaipur, Dubai" value="<?= e($preselectedDestination); ?>">
                    </div>

                    <!-- 9. Message & Preferences -->
                    <div class="form-group full-width">
                        <label class="form-label">Special Requests, Itinerary Notes or Theme Vision <span class="req">*</span></label>
                        <textarea name="message" rows="4" class="form-control" placeholder="Tell us about your travel pace, hotel preferences (4-star / 5-star / Heritage Villa), dietary requirements, or event theme vision..." required></textarea>
                    </div>

                    <div class="form-group full-width">
                        <button type="submit" class="btn btn-accent btn-lg" style="width: 100%;">
                            <i class="fas fa-paper-plane"></i> Submit Reservation / Consultation Request
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
