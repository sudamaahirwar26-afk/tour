<?php
/**
 * SERENITY PLANNERS - TESTIMONIALS MANAGEMENT
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdminAuth();

$db = getDB();

// Handle Testimonial Add / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_testimonial'])) {
    if (validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $testId     = !empty($_POST['testimonial_id']) ? (int)$_POST['testimonial_id'] : null;
        $clientName = sanitizeInput($_POST['client_name']);
        $clientRole = sanitizeInput($_POST['client_role'] ?? '');
        $eventType  = sanitizeInput($_POST['event_type']);
        $rating     = (int)($_POST['rating'] ?? 5);
        $message    = sanitizeInput($_POST['message']);
        $status     = sanitizeInput($_POST['status'] ?? 'published');

        $imagePath = $_POST['current_image'] ?? 'assets/images/testimonial-1.jpg';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadRes = uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = $uploadRes['path'];
            } else {
                setFlash('error', $uploadRes['error']);
            }
        }

        if ($testId) {
            $stmt = $db->prepare("UPDATE testimonials SET client_name = :name, client_role = :role, event_type = :event_type, rating = :rating, message = :message, status = :status, image = :image WHERE id = :id");
            $stmt->execute([
                ':name'       => $clientName,
                ':role'       => $clientRole,
                ':event_type' => $eventType,
                ':rating'     => $rating,
                ':message'    => $message,
                ':status'     => $status,
                ':image'      => $imagePath,
                ':id'         => $testId
            ]);
            setFlash('success', "Testimonial from '{$clientName}' updated.");
        } else {
            $stmt = $db->prepare("INSERT INTO testimonials (client_name, client_role, event_type, rating, message, image, status, created_at) VALUES (:name, :role, :event_type, :rating, :message, :image, :status, NOW())");
            $stmt->execute([
                ':name'       => $clientName,
                ':role'       => $clientRole,
                ':event_type' => $eventType,
                ':rating'     => $rating,
                ':message'    => $message,
                ':image'      => $imagePath,
                ':status'     => $status
            ]);
            setFlash('success', "Testimonial from '{$clientName}' added.");
        }

        header('Location: testimonials.php');
        exit;
    }
}

// Handle Status Toggle
if (isset($_GET['toggle'])) {
    $toggleId = (int)$_GET['toggle'];
    $stmt = $db->prepare("UPDATE testimonials SET status = IF(status = 'published', 'draft', 'published') WHERE id = :id");
    $stmt->execute([':id' => $toggleId]);
    setFlash('success', "Testimonial status toggled.");
    header('Location: testimonials.php');
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM testimonials WHERE id = :id");
    $stmt->execute([':id' => $delId]);
    setFlash('success', "Testimonial deleted.");
    header('Location: testimonials.php');
    exit;
}

// Fetch Testimonials
$testimonials = $db->query("SELECT * FROM testimonials ORDER BY id DESC")->fetchAll();

// Edit Item Lookup
$editTest = null;
if (isset($_GET['edit'])) {
    $eId = (int)$_GET['edit'];
    $eStmt = $db->prepare("SELECT * FROM testimonials WHERE id = :id");
    $eStmt->execute([':id' => $eId]);
    $editTest = $eStmt->fetch();
}

$adminPageTitle = "Client Testimonials Management";
require_once __DIR__ . '/includes/admin-header.php';
?>

<!-- Header Actions -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <p style="color: var(--adm-muted); font-size: 0.95rem;">Manage client feedback, ratings, and endorsements.</p>
    </div>
    <button class="btn btn-accent btn-sm" data-modal="testimonialModal">
        <i class="fas fa-plus"></i> Add New Review
    </button>
</div>

<!-- Testimonials Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">All Testimonials (<?= count($testimonials); ?> reviews)</h3>
        <input type="text" class="table-search-input form-control" style="max-width: 250px; padding: 0.4rem 0.75rem; font-size: 0.85rem;" placeholder="Search reviews..." data-target-table="testimonialsTable">
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="testimonialsTable">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Client Name</th>
                    <th>Role / Event</th>
                    <th>Rating</th>
                    <th>Message Quote</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonials as $item): ?>
                    <tr>
                        <td style="width: 70px;">
                            <img src="../<?= e($item['image'] ?: 'assets/images/testimonial-1.jpg'); ?>" alt="" style="width: 44px; height: 44px; object-fit: cover; border-radius: 50%;">
                        </td>
                        <td>
                            <strong><?= e($item['client_name']); ?></strong>
                        </td>
                        <td>
                            <?= e($item['client_role']); ?><br>
                            <small style="color: var(--adm-accent); font-weight: 600;"><?= e($item['event_type']); ?></small>
                        </td>
                        <td>
                            <div style="color: var(--adm-accent);">
                                <?php for ($s = 0; $s < (int)$item['rating']; $s++): ?>
                                    <i class="fas fa-star" style="font-size: 0.8rem;"></i>
                                <?php endfor; ?>
                            </div>
                        </td>
                        <td style="max-width: 320px; font-size: 0.85rem; color: var(--adm-muted);">
                            "<?= e($item['message']); ?>"
                        </td>
                        <td>
                            <a href="testimonials.php?toggle=<?= $item['id']; ?>" title="Click to Toggle">
                                <span class="badge badge-<?= ($item['status'] === 'published') ? 'active' : 'inactive'; ?>"><?= e($item['status']); ?></span>
                            </a>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.4rem;">
                                <a href="testimonials.php?edit=<?= $item['id']; ?>" class="btn-action" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="testimonials.php?delete=<?= $item['id']; ?>" class="btn-action delete" title="Delete" onclick="return confirm('Delete this review?');"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Testimonial Modal -->
<div class="admin-modal <?= $editTest ? 'show' : ''; ?>" id="testimonialModal">
    <div class="admin-modal-box">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; border-bottom: 1px solid var(--adm-border); padding-bottom: 0.75rem;">
            <h3 style="font-size: 1.3rem;"><?= $editTest ? 'Edit Review' : 'Add Client Testimonial'; ?></h3>
            <a href="testimonials.php" class="btn-action" style="border: none; font-size: 1.3rem;">&times;</a>
        </div>

        <form method="POST" action="testimonials.php" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= e(generateCSRFToken()); ?>">
            <input type="hidden" name="save_testimonial" value="1">
            <?php if ($editTest): ?>
                <input type="hidden" name="testimonial_id" value="<?= $editTest['id']; ?>">
                <input type="hidden" name="current_image" value="<?= e($editTest['image']); ?>">
            <?php endif; ?>

            <div class="form-grid" style="margin-bottom: 1rem;">
                <div class="form-group">
                    <label class="form-label">Client Name <span class="req">*</span></label>
                    <input type="text" name="client_name" class="form-control" placeholder="e.g. Eleanor & Marcus Vance" required value="<?= e($editTest['client_name'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Client Role / Designation</label>
                    <input type="text" name="client_role" class="form-control" placeholder="e.g. Bride & Groom" value="<?= e($editTest['client_role'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-grid" style="margin-bottom: 1rem;">
                <div class="form-group">
                    <label class="form-label">Event Category / Title <span class="req">*</span></label>
                    <input type="text" name="event_type" class="form-control" placeholder="e.g. Lake Como Destination Wedding" required value="<?= e($editTest['event_type'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Rating (Stars)</label>
                    <select name="rating" class="form-control">
                        <option value="5" <?= ($editTest && (int)$editTest['rating'] === 5) ? 'selected' : ''; ?>>5 Stars - Outstanding</option>
                        <option value="4" <?= ($editTest && (int)$editTest['rating'] === 4) ? 'selected' : ''; ?>>4 Stars - Excellent</option>
                        <option value="3" <?= ($editTest && (int)$editTest['rating'] === 3) ? 'selected' : ''; ?>>3 Stars - Good</option>
                    </select>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">Client Message / Endorsement <span class="req">*</span></label>
                <textarea name="message" rows="4" class="form-control" required placeholder="The client's quote and review..."><?= e($editTest['message'] ?? ''); ?></textarea>
            </div>

            <div class="form-grid" style="margin-bottom: 1rem;">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="published" <?= ($editTest && $editTest['status'] === 'published') ? 'selected' : ''; ?>>Published</option>
                        <option value="draft" <?= ($editTest && $editTest['status'] === 'draft') ? 'selected' : ''; ?>>Draft (Hidden)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Upload Client Avatar</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <a href="testimonials.php" class="btn btn-outline-dark btn-sm">Cancel</a>
                <button type="submit" class="btn btn-accent btn-sm"><i class="fas fa-save"></i> Save Testimonial</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
