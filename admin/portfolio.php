<?php
/**
 * SERENITY PLANNERS - PORTFOLIO MANAGEMENT
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdminAuth();

$db = getDB();

// Handle Portfolio Item Create / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_portfolio'])) {
    if (validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $itemId      = !empty($_POST['item_id']) ? (int)$_POST['item_id'] : null;
        $title       = sanitizeInput($_POST['title']);
        $category    = sanitizeInput($_POST['category'] ?? 'wedding');
        $clientName  = sanitizeInput($_POST['client_name'] ?? '');
        $location    = sanitizeInput($_POST['location'] ?? '');
        $eventDate   = !empty($_POST['event_date']) ? sanitizeInput($_POST['event_date']) : null;
        $description = sanitizeInput($_POST['description'] ?? '');
        $status      = sanitizeInput($_POST['status'] ?? 'active');

        $imagePath = $_POST['current_image'] ?? 'assets/images/portfolio-wedding-1.jpg';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadRes = uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = $uploadRes['path'];
            } else {
                setFlash('error', $uploadRes['error']);
            }
        }

        if ($itemId) {
            $stmt = $db->prepare("UPDATE portfolio SET title = :title, category = :category, client_name = :client_name, location = :location, event_date = :event_date, description = :description, status = :status, image = :image WHERE id = :id");
            $stmt->execute([
                ':title'       => $title,
                ':category'    => $category,
                ':client_name' => $clientName,
                ':location'    => $location,
                ':event_date'  => $eventDate,
                ':description' => $description,
                ':status'      => $status,
                ':image'       => $imagePath,
                ':id'          => $itemId
            ]);
            setFlash('success', "Portfolio item '{$title}' updated successfully.");
        } else {
            $stmt = $db->prepare("INSERT INTO portfolio (title, category, client_name, location, event_date, description, image, status, created_at) VALUES (:title, :category, :client_name, :location, :event_date, :description, :image, :status, NOW())");
            $stmt->execute([
                ':title'       => $title,
                ':category'    => $category,
                ':client_name' => $clientName,
                ':location'    => $location,
                ':event_date'  => $eventDate,
                ':description' => $description,
                ':image'       => $imagePath,
                ':status'      => $status
            ]);
            setFlash('success', "Portfolio item '{$title}' added successfully.");
        }

        header('Location: portfolio.php');
        exit;
    }
}

// Handle Status Toggle
if (isset($_GET['toggle'])) {
    $toggleId = (int)$_GET['toggle'];
    $stmt = $db->prepare("UPDATE portfolio SET status = IF(status = 'active', 'inactive', 'active') WHERE id = :id");
    $stmt->execute([':id' => $toggleId]);
    setFlash('success', "Portfolio item status toggled.");
    header('Location: portfolio.php');
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM portfolio WHERE id = :id");
    $stmt->execute([':id' => $delId]);
    setFlash('success', "Portfolio item deleted.");
    header('Location: portfolio.php');
    exit;
}

// Fetch All Portfolio Items
$portfolio = $db->query("SELECT * FROM portfolio ORDER BY id DESC")->fetchAll();

// Edit Item Lookup
$editItem = null;
if (isset($_GET['edit'])) {
    $eId = (int)$_GET['edit'];
    $eStmt = $db->prepare("SELECT * FROM portfolio WHERE id = :id");
    $eStmt->execute([':id' => $eId]);
    $editItem = $eStmt->fetch();
}

$adminPageTitle = "Portfolio Gallery Management";
require_once __DIR__ . '/includes/admin-header.php';
?>

<!-- Action Bar -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <p style="color: var(--adm-muted); font-size: 0.95rem;">Upload, organize, and categorize featured photo exhibits.</p>
    </div>
    <button class="btn btn-accent btn-sm" data-modal="portfolioModal">
        <i class="fas fa-plus"></i> Upload New Portfolio Item
    </button>
</div>

<!-- Portfolio Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Portfolio Items (<?= count($portfolio); ?> items)</h3>
        <input type="text" class="table-search-input form-control" style="max-width: 250px; padding: 0.4rem 0.75rem; font-size: 0.85rem;" placeholder="Search portfolio..." data-target-table="portfolioTable">
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="portfolioTable">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Celebration Title</th>
                    <th>Category</th>
                    <th>Location / Host</th>
                    <th>Event Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($portfolio as $item): ?>
                    <tr>
                        <td style="width: 80px;">
                            <img src="../<?= e($item['image']); ?>" alt="" style="width: 65px; height: 50px; object-fit: cover; border-radius: 6px;">
                        </td>
                        <td>
                            <strong><?= e($item['title']); ?></strong>
                        </td>
                        <td><span class="badge" style="background: #E2E8F0; color: #1E293B;"><?= strtoupper(e($item['category'])); ?></span></td>
                        <td><?= e($item['location'] ?: '-'); ?><br><small style="color: var(--adm-muted);"><?= e($item['client_name']); ?></small></td>
                        <td><?= $item['event_date'] ? date('M d, Y', strtotime($item['event_date'])) : '-'; ?></td>
                        <td>
                            <a href="portfolio.php?toggle=<?= $item['id']; ?>" title="Click to Toggle">
                                <span class="badge badge-<?= e($item['status']); ?>"><?= e($item['status']); ?></span>
                            </a>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.4rem;">
                                <a href="portfolio.php?edit=<?= $item['id']; ?>" class="btn-action" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="portfolio.php?delete=<?= $item['id']; ?>" class="btn-action delete" title="Delete" onclick="return confirm('Delete this gallery item permanently?');"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Portfolio Modal -->
<div class="admin-modal <?= $editItem ? 'show' : ''; ?>" id="portfolioModal">
    <div class="admin-modal-box">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; border-bottom: 1px solid var(--adm-border); padding-bottom: 0.75rem;">
            <h3 style="font-size: 1.3rem;"><?= $editItem ? 'Edit Portfolio Item' : 'Upload New Celebration Photo'; ?></h3>
            <a href="portfolio.php" class="btn-action" style="border: none; font-size: 1.3rem;">&times;</a>
        </div>

        <form method="POST" action="portfolio.php" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= e(generateCSRFToken()); ?>">
            <input type="hidden" name="save_portfolio" value="1">
            <?php if ($editItem): ?>
                <input type="hidden" name="item_id" value="<?= $editItem['id']; ?>">
                <input type="hidden" name="current_image" value="<?= e($editItem['image']); ?>">
            <?php endif; ?>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">Event Title <span class="req">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="e.g. Lake Como Villa Renaissance Vows" required value="<?= e($editItem['title'] ?? ''); ?>">
            </div>

            <div class="form-grid" style="margin-bottom: 1rem;">
                <div class="form-group">
                    <label class="form-label">Category <span class="req">*</span></label>
                    <select name="category" class="form-control" required>
                        <option value="wedding" <?= ($editItem && $editItem['category'] === 'wedding') ? 'selected' : ''; ?>>Wedding</option>
                        <option value="corporate" <?= ($editItem && $editItem['category'] === 'corporate') ? 'selected' : ''; ?>>Corporate</option>
                        <option value="destination" <?= ($editItem && $editItem['category'] === 'destination') ? 'selected' : ''; ?>>Destination</option>
                        <option value="private" <?= ($editItem && $editItem['category'] === 'private') ? 'selected' : ''; ?>>Private</option>
                        <option value="social" <?= ($editItem && $editItem['category'] === 'social') ? 'selected' : ''; ?>>Social</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" placeholder="e.g. Positano, Italy" value="<?= e($editItem['location'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-grid" style="margin-bottom: 1rem;">
                <div class="form-group">
                    <label class="form-label">Client Name / Hosts</label>
                    <input type="text" name="client_name" class="form-control" placeholder="e.g. Julian & Claire" value="<?= e($editItem['client_name'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Event Date</label>
                    <input type="date" name="event_date" class="form-control" value="<?= e($editItem['event_date'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">Description / Highlights</label>
                <textarea name="description" rows="3" class="form-control" placeholder="Brief visual overview and highlight points..."><?= e($editItem['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-grid" style="margin-bottom: 1rem;">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" <?= ($editItem && $editItem['status'] === 'active') ? 'selected' : ''; ?>>Active (Visible)</option>
                        <option value="inactive" <?= ($editItem && $editItem['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive (Hidden)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Upload High-Res Photo</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                <a href="portfolio.php" class="btn btn-outline-dark btn-sm">Cancel</a>
                <button type="submit" class="btn btn-accent btn-sm"><i class="fas fa-save"></i> Save Portfolio Item</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
