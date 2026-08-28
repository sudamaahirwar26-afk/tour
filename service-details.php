<?php
/**
 * SERENITY PLANNERS - DYNAMIC SERVICE DETAILS
 */

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';

$slug = isset($_GET['slug']) ? trim($_GET['slug']) : 'wedding-planning';

$db = getDB();
$stmt = $db->prepare("SELECT * FROM services WHERE slug = :slug AND status = 'active' LIMIT 1");
$stmt->execute([':slug' => $slug]);
$service = $stmt->fetch();

if (!$service) {
    // If not found by slug, grab the first available active service
    $stmt = $db->query("SELECT * FROM services WHERE status = 'active' ORDER BY id ASC LIMIT 1");
    $service = $stmt->fetch();
}

if (!$service) {
    header('Location: services.php');
    exit;
}

$pageTitle = $service['title'] . " | Serenity Planners";
$metaDesc = $service['short_description'];

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/navbar.php';

// Other services for sidebar
$otherServices = $db->prepare("SELECT * FROM services WHERE id != :id AND status = 'active' LIMIT 4");
$otherServices->execute([':id' => $service['id']]);
$relatedServices = $otherServices->fetchAll();
?>

<!-- Service Header Banner -->
<section class="section section-dark" style="padding-top: 130px; padding-bottom: 4rem;">
    <div class="container" style="text-align: center;">
        <div class="eyebrow" style="color: var(--color-accent);">SERVICE SPECIALIZATION</div>
        <h1 style="font-size: clamp(2.4rem, 4vw, 3.5rem); color: #FFF; margin-bottom: 1rem;"><?= e($service['title']); ?></h1>
        <p style="color: #94A3B8; max-width: 700px; margin: 0 auto; font-size: 1.1rem;"><?= e($service['short_description']); ?></p>
    </div>
</section>

<!-- Main Service Details Content -->
<section class="section">
    <div class="container">
        <div class="about-grid" style="align-items: flex-start; gap: 3.5rem;">
            <!-- Main Content -->
            <div>
                <div style="border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 2.5rem; box-shadow: var(--shadow-lg);">
                    <img src="<?= e($service['image'] ?: 'assets/images/service-wedding.jpg'); ?>" alt="<?= e($service['title']); ?>" style="width: 100%; height: 440px; object-fit: cover;">
                </div>

                <h2 style="font-size: 2.2rem; margin-bottom: 1.25rem;">Executive Overview & Execution</h2>
                <div style="color: var(--color-text); font-size: 1.05rem; line-height: 1.8; margin-bottom: 2rem;">
                    <p style="margin-bottom: 1.25rem;"><?= nl2br(e($service['description'])); ?></p>
                </div>

                <div class="feature-card" style="background: #F8FAFC; border: 1px solid var(--color-border); margin-bottom: 2.5rem;">
                    <h3 style="color: var(--color-primary); margin-bottom: 1.25rem;">What is Included in this Service:</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-dark); font-weight: 500;">
                            <i class="fas fa-check-circle" style="color: var(--color-accent);"></i> Dedicated Senior Lead Planner
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-dark); font-weight: 500;">
                            <i class="fas fa-check-circle" style="color: var(--color-accent);"></i> Custom 3D Moodboards & Staging
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-dark); font-weight: 500;">
                            <i class="fas fa-check-circle" style="color: var(--color-accent);"></i> VIP Hospitality & Concierge
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-dark); font-weight: 500;">
                            <i class="fas fa-check-circle" style="color: var(--color-accent);"></i> Comprehensive Vendor Management
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-dark); font-weight: 500;">
                            <i class="fas fa-check-circle" style="color: var(--color-accent);"></i> Sound, Lighting & AV Production
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.75rem; color: var(--color-text-dark); font-weight: 500;">
                            <i class="fas fa-check-circle" style="color: var(--color-accent);"></i> Minute-by-Minute Run-of-Show
                        </div>
                    </div>
                </div>

                <div style="background: var(--color-primary); color: #FFF; padding: 2.5rem; border-radius: var(--radius-lg); border: 1px solid var(--color-border-gold); text-align: center;">
                    <h3 style="color: #FFF; font-size: 1.6rem; margin-bottom: 0.75rem;">Ready to Plan Your <?= e($service['title']); ?>?</h3>
                    <p style="color: #CBD5E1; margin-bottom: 1.5rem;">Speak with our master event designers to curate your proposal.</p>
                    <a href="enquiry.php?service=<?= urlencode($service['title']); ?>" class="btn btn-accent btn-lg">
                        <i class="fas fa-calendar-check"></i> Book Consultation for This Service
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Other Services Card -->
                <div class="form-card" style="padding: 2rem; margin-bottom: 2rem;">
                    <h3 style="font-size: 1.25rem; margin-bottom: 1.25rem; color: var(--color-primary);">All Specializations</h3>
                    <div style="display: flex; flex-direction: column; gap: 0.75rem;">
                        <?php foreach ($relatedServices as $rel): ?>
                            <a href="service-details.php?slug=<?= urlencode($rel['slug']); ?>" style="display: flex; align-items: center; justify-content: space-between; padding: 0.85rem 1rem; border-radius: var(--radius-sm); border: 1px solid var(--color-border); font-weight: 600; color: var(--color-text-dark);">
                                <span><?= e($rel['title']); ?></span>
                                <i class="fas fa-chevron-right" style="color: var(--color-accent); font-size: 0.85rem;"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Assistance Card -->
                <div style="background: var(--color-secondary); color: #FFF; padding: 2rem; border-radius: var(--radius-lg); text-align: center;">
                    <div style="width: 50px; height: 50px; border-radius: 50%; background: rgba(201, 162, 39, 0.15); color: var(--color-accent); display: flex; align-items: center; justify-content: center; margin: 0 auto 1.25rem auto; font-size: 1.3rem;">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 style="color: #FFF; font-size: 1.2rem; margin-bottom: 0.5rem;">Direct Concierge Desk</h4>
                    <p style="color: #94A3B8; font-size: 0.9rem; margin-bottom: 1.25rem;">Prefer discussing your requirements directly with our senior director?</p>
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', $settings['phone']); ?>" class="btn btn-outline-gold btn-sm" style="width: 100%;">
                        <i class="fas fa-phone-alt"></i> <?= e($settings['phone']); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
