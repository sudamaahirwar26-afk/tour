<?php
/**
 * SERENITY PLANNERS - SITE SETTINGS & CONFIGURATION
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdminAuth();

$db = getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    if (validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $allowedKeys = [
            'company_name', 'tagline', 'phone', 'alt_phone', 'email', 'address', 'business_hours',
            'hero_headline', 'hero_subtitle', 'about_heading', 'about_text',
            'stat_events', 'stat_corporate', 'stat_clients', 'stat_years',
            'facebook_url', 'instagram_url', 'linkedin_url', 'pinterest_url', 'footer_text'
        ];

        $stmt = $db->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (:key, :val) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");

        foreach ($allowedKeys as $key) {
            if (isset($_POST[$key])) {
                $stmt->execute([
                    ':key' => $key,
                    ':val' => sanitizeInput($_POST[$key])
                ]);
            }
        }

        setFlash('success', 'Site settings updated successfully.');
        header('Location: settings.php');
        exit;
    }
}

$settings = getSiteSettings();

$adminPageTitle = "Site Settings & Configuration";
require_once __DIR__ . '/includes/admin-header.php';
?>

<div class="admin-card">
    <form method="POST" action="settings.php">
        <input type="hidden" name="csrf_token" value="<?= e(generateCSRFToken()); ?>">
        <input type="hidden" name="save_settings" value="1">

        <!-- 1. Brand Identity & Contact -->
        <h3 style="font-size: 1.2rem; color: var(--adm-text-dark); margin-bottom: 1.25rem; border-bottom: 1px solid var(--adm-border); padding-bottom: 0.5rem;">
            <i class="fas fa-building" style="color: var(--adm-accent);"></i> Company Identity & Concierge Contact
        </h3>
        
        <div class="form-grid" style="margin-bottom: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-control" value="<?= e($settings['company_name']); ?>" required>
            </div>
            <div class="form-group">
                <label class="form-label">Brand Tagline</label>
                <input type="text" name="tagline" class="form-control" value="<?= e($settings['tagline']); ?>">
            </div>
        </div>

        <div class="form-grid" style="margin-bottom: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Primary Concierge Phone</label>
                <input type="text" name="phone" class="form-control" value="<?= e($settings['phone']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Secondary / WhatsApp Phone</label>
                <input type="text" name="alt_phone" class="form-control" value="<?= e($settings['alt_phone']); ?>">
            </div>
        </div>

        <div class="form-grid" style="margin-bottom: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Inquiry Email</label>
                <input type="email" name="email" class="form-control" value="<?= e($settings['email']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Operating / Concierge Hours</label>
                <input type="text" name="business_hours" class="form-control" value="<?= e($settings['business_hours']); ?>">
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 2.5rem;">
            <label class="form-label">Studio Physical Address</label>
            <input type="text" name="address" class="form-control" value="<?= e($settings['address']); ?>">
        </div>

        <!-- 2. Homepage Hero & About Copy -->
        <h3 style="font-size: 1.2rem; color: var(--adm-text-dark); margin-bottom: 1.25rem; border-bottom: 1px solid var(--adm-border); padding-bottom: 0.5rem;">
            <i class="fas fa-home" style="color: var(--adm-accent);"></i> Homepage Hero & About Copy
        </h3>

        <div class="form-grid" style="margin-bottom: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Hero Main Headline</label>
                <input type="text" name="hero_headline" class="form-control" value="<?= e($settings['hero_headline']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">About Section Heading</label>
                <input type="text" name="about_heading" class="form-control" value="<?= e($settings['about_heading']); ?>">
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label">Hero Supporting Subtitle</label>
            <textarea name="hero_subtitle" rows="2" class="form-control"><?= e($settings['hero_subtitle']); ?></textarea>
        </div>

        <div class="form-group" style="margin-bottom: 2.5rem;">
            <label class="form-label">About Us Story Text</label>
            <textarea name="about_text" rows="3" class="form-control"><?= e($settings['about_text']); ?></textarea>
        </div>

        <!-- 3. Statistics Counters -->
        <h3 style="font-size: 1.2rem; color: var(--adm-text-dark); margin-bottom: 1.25rem; border-bottom: 1px solid var(--adm-border); padding-bottom: 0.5rem;">
            <i class="fas fa-chart-pie" style="color: var(--adm-accent);"></i> Live Trust Counters
        </h3>

        <div class="form-grid" style="margin-bottom: 2.5rem;">
            <div class="form-group">
                <label class="form-label">Events Delivered Counter</label>
                <input type="text" name="stat_events" class="form-control" value="<?= e($settings['stat_events']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Corporate Summits Counter</label>
                <input type="text" name="stat_corporate" class="form-control" value="<?= e($settings['stat_corporate']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Happy Clients Counter</label>
                <input type="text" name="stat_clients" class="form-control" value="<?= e($settings['stat_clients']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Years of Distinction Counter</label>
                <input type="text" name="stat_years" class="form-control" value="<?= e($settings['stat_years']); ?>">
            </div>
        </div>

        <!-- 4. Social Media & Footer -->
        <h3 style="font-size: 1.2rem; color: var(--adm-text-dark); margin-bottom: 1.25rem; border-bottom: 1px solid var(--adm-border); padding-bottom: 0.5rem;">
            <i class="fas fa-share-alt" style="color: var(--adm-accent);"></i> Social Media & Footer
        </h3>

        <div class="form-grid" style="margin-bottom: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Instagram Profile URL</label>
                <input type="url" name="instagram_url" class="form-control" value="<?= e($settings['instagram_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Facebook Page URL</label>
                <input type="url" name="facebook_url" class="form-control" value="<?= e($settings['facebook_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">LinkedIn URL</label>
                <input type="url" name="linkedin_url" class="form-control" value="<?= e($settings['linkedin_url']); ?>">
            </div>
            <div class="form-group">
                <label class="form-label">Pinterest URL</label>
                <input type="url" name="pinterest_url" class="form-control" value="<?= e($settings['pinterest_url']); ?>">
            </div>
        </div>

        <div class="form-group" style="margin-bottom: 2rem;">
            <label class="form-label">Footer Brief Text</label>
            <textarea name="footer_text" rows="2" class="form-control"><?= e($settings['footer_text']); ?></textarea>
        </div>

        <button type="submit" class="btn btn-accent btn-lg"><i class="fas fa-save"></i> Save All Site Settings</button>
    </form>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
