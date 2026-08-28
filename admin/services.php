<?php
/**
 * SERENITY PLANNERS - SERVICES MANAGEMENT
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdminAuth();

$db = getDB();

// Handle Service Creation / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_service'])) {
    if (validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $serviceId = !empty($_POST['service_id']) ? (int)$_POST['service_id'] : null;
        $title     = sanitizeInput($_POST['title']);
        $slug      = !empty($_POST['slug']) ? slugify($_POST['slug']) : slugify($title);
        $shortDesc = sanitizeInput($_POST['short_description']);
        $desc      = sanitizeInput($_POST['description']);
        $icon      = sanitizeInput($_POST['icon'] ?? 'sparkles');
        $status    = sanitizeInput($_POST['status'] ?? 'active');

        // Handle Image Upload if provided
        $imagePath = $_POST['current_image'] ?? 'assets/images/service-wedding.jpg';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadRes = uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = $uploadRes['path'];
            } else {
                setFlash('error', $uploadRes['error']);
            }
        }

        if ($serviceId) {
            // Update
            $stmt = $db->prepare("UPDATE services SET title = :title, slug = :slug, short_description = :shortDesc, description = :desc, icon = :icon, status = :status, image = :image WHERE id = :id");
            $stmt->execute([
                ':title'     => $title,
                ':slug'      => $slug,
                ':shortDesc' => $shortDesc,
                ':desc'      => $desc,
                ':icon'      => $icon,
                ':status'    => $status,
                ':image'     => $imagePath,
                ':id'        => $serviceId
            ]);
            setFlash('success', "Service '{$title}' updated successfully.");
        } else {
            // Insert
            $stmt = $db->prepare("INSERT INTO services (title, slug, short_description, description, image, icon, status, created_at) VALUES (:title, :slug, :shortDesc, :desc, :image, :icon, :status, NOW())");
            $stmt->execute([
                ':title'     => $title,
                ':slug'      => $slug,
                ':shortDesc' => $shortDesc,
                ':desc'      => $desc,
                ':image'     => $imagePath,
                ':icon'      => $icon,
                ':status'    => $status
            ]);
            setFlash('success', "Service '{$title}' created successfully.");
        }

        header('Location: services.php');
        exit;
    }
}

// Handle Status Toggle
if (isset($_GET['toggle'])) {
    $toggleId = (int)$_GET['toggle'];
    $stmt = $db->prepare("UPDATE services SET status = IF(status = 'active', 'inactive', 'active') WHERE id = :id");
    $stmt->execute([':id' => $toggleId]);
    setFlash('success', "Service status toggled successfully.");
    header('Location: services.php');
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM services WHERE id = :id");
    $stmt->execute([':id' => $delId]);
    setFlash('success', "Service deleted successfully.");
    header('Location: services.php');
    exit;
}

// Fetch Services
$services = $db->query("SELECT * FROM services ORDER BY sort_order ASC, id ASC")->fetchAll();

// Edit Item lookup
$editService = null;
if (isset($_GET['edit'])) {
    $eId = (int)$_GET['edit'];
    $eStmt = $db->prepare("SELECT * FROM services WHERE id = :id");
    $eStmt->execute([':id' => $eId]);
    $editService = $eStmt->fetch();
}

$adminPageTitle = "Services Management";
require_once __DIR__ . '/includes/admin-header.php';
?>

<!-- Header Actions -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <p style="color: var(--adm-muted); font-size: 0.95rem;">Manage, create, and update bespoke event offerings.</p>
    </div>
    <button class="btn btn-accent btn-sm" data-modal="serviceModal">
        <i class="fas fa-plus"></i> Add New Service
    </button>
</div>

<!-- Services Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Services Directory (<?= count($services); ?> items)</h3>
        <input type="text" class="table-search-input form-control" style="max-width: 250px; padding: 0.4rem 0.75rem; font-size: 0.85rem;" placeholder="Quick search..." data-target-table="servicesTable">
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="servicesTable">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Service Title</th>
                    <th>Slug</th>
                    <th>Short Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $srv): ?>
                    <tr>
                        <td style="width: 80px;">
                            <img src="../<?= e($srv['image'] ?: 'assets/images/service-wedding.jpg'); ?>" alt="" style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;">
                        </td>
                        <td>
                            <strong><?= e($srv['title']); ?></strong>
                        </td>
                        <td><code><?= e($srv['slug']); ?></code></td>
                        <td style="max-width: 300px; color: var(--adm-muted); font-size: 0.85rem;"><?= e($srv['short_description']); ?></td>
                        <td>
                            <a href="services.php?toggle=<?= $srv['id']; ?>" title="Click to Toggle">
                                <span class="badge badge-<?= e($srv['status']); ?>"><?= e($srv['status']); ?></span>
                            </a>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.4rem;">
                                <a href="services.php?edit=<?= $srv['id']; ?>" class="btn-action" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="services.php?delete=<?= $srv['id']; ?>" class="btn-action delete" title="Delete" onclick="return confirm('Delete this service permanently?');"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Service Add/Edit Modal -->
<div class="admin-modal <?= $editService ? 'show' : ''; ?>" id="serviceModal">
    <div class="admin-modal-box">
        <div class="modal-header">
            <h3><i class="fas fa-concierge-bell" style="color: var(--adm-accent); margin-right: 0.5rem;"></i> <?= $editService ? 'Edit Service' : 'Add New Service'; ?></h3>
            <a href="services.php" class="modal-close-btn" title="Close Modal">&times;</a>
        </div>

        <form method="POST" action="services.php" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= e(generateCSRFToken()); ?>">
            <input type="hidden" name="save_service" value="1">
            <?php if ($editService): ?>
                <input type="hidden" name="service_id" value="<?= $editService['id']; ?>">
                <input type="hidden" name="current_image" value="<?= e($editService['image']); ?>">
            <?php endif; ?>

            <div class="form-group">
                <label class="form-label">Service Title <span class="req">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="e.g. Royal Wedding Planning" required value="<?= e($editService['title'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Slug (URL identifier)</label>
                <input type="text" name="slug" class="form-control" placeholder="e.g. royal-wedding-planning" value="<?= e($editService['slug'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label class="form-label">Short Description <span class="req">*</span></label>
                <textarea name="short_description" rows="2" class="form-control" required placeholder="Brief 1-2 sentence overview for cards..."><?= e($editService['short_description'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Full Service Description <span class="req">*</span></label>
                <textarea name="description" rows="4" class="form-control" required placeholder="Detailed methodology and offerings..."><?= e($editService['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" <?= ($editService && $editService['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?= ($editService && $editService['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Upload New Cover Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem; border-top: 1px solid #F1F5F9; padding-top: 1.25rem;">
                <a href="services.php" class="btn btn-outline-dark">Cancel</a>
                <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Save Service</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
