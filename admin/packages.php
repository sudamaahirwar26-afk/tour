<?php
/**
 * SERENITY PLANNERS - TOUR PACKAGES MANAGEMENT
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdminAuth();

$db = getDB();

// Handle Create / Edit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_package'])) {
    if (validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $pkgId         = !empty($_POST['package_id']) ? (int)$_POST['package_id'] : null;
        $title         = sanitizeInput($_POST['title']);
        $slug          = !empty($_POST['slug']) ? slugify($_POST['slug']) : slugify($title);
        $destination   = sanitizeInput($_POST['destination']);
        $duration      = sanitizeInput($_POST['duration']);
        $groupSize     = sanitizeInput($_POST['group_size'] ?? '1 - 8 People');
        $price         = sanitizeInput($_POST['price']);
        $origPrice     = sanitizeInput($_POST['original_price'] ?? '');
        $badge         = sanitizeInput($_POST['badge'] ?? 'Trending');
        $shortDesc     = sanitizeInput($_POST['short_description']);
        $desc          = sanitizeInput($_POST['description']);
        $status        = sanitizeInput($_POST['status'] ?? 'active');

        $imagePath = $_POST['current_image'] ?? 'assets/images/portfolio-dest-1.jpg';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadRes = uploadImage($_FILES['image']);
            if ($uploadRes['success']) {
                $imagePath = $uploadRes['path'];
            } else {
                setFlash('error', $uploadRes['error']);
            }
        }

        if ($pkgId) {
            $stmt = $db->prepare("UPDATE packages SET title = :title, slug = :slug, destination = :destination, duration = :duration, group_size = :group_size, price = :price, original_price = :original_price, badge = :badge, short_description = :short_description, description = :description, status = :status, image = :image WHERE id = :id");
            $stmt->execute([
                ':title'             => $title,
                ':slug'              => $slug,
                ':destination'       => $destination,
                ':duration'          => $duration,
                ':group_size'        => $groupSize,
                ':price'             => $price,
                ':original_price'    => $origPrice,
                ':badge'             => $badge,
                ':short_description' => $shortDesc,
                ':description'       => $desc,
                ':status'            => $status,
                ':image'             => $imagePath,
                ':id'                => $pkgId
            ]);
            setFlash('success', "Package '{$title}' updated successfully.");
        } else {
            $stmt = $db->prepare("INSERT INTO packages (title, slug, destination, duration, group_size, price, original_price, badge, short_description, description, image, status, created_at) VALUES (:title, :slug, :destination, :duration, :group_size, :price, :original_price, :badge, :short_description, :description, :image, :status, NOW())");
            $stmt->execute([
                ':title'             => $title,
                ':slug'              => $slug,
                ':destination'       => $destination,
                ':duration'          => $duration,
                ':group_size'        => $groupSize,
                ':price'             => $price,
                ':original_price'    => $origPrice,
                ':badge'             => $badge,
                ':short_description' => $shortDesc,
                ':description'       => $desc,
                ':image'             => $imagePath,
                ':status'            => $status
            ]);
            setFlash('success', "Package '{$title}' added successfully.");
        }

        header('Location: packages.php');
        exit;
    }
}

// Handle Status Toggle
if (isset($_GET['toggle'])) {
    $toggleId = (int)$_GET['toggle'];
    $stmt = $db->prepare("UPDATE packages SET status = IF(status = 'active', 'inactive', 'active') WHERE id = :id");
    $stmt->execute([':id' => $toggleId]);
    setFlash('success', "Package status toggled.");
    header('Location: packages.php');
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM packages WHERE id = :id");
    $stmt->execute([':id' => $delId]);
    setFlash('success', "Package deleted.");
    header('Location: packages.php');
    exit;
}

// Fetch Packages & Edit lookup
$packages = $db->query("SELECT * FROM packages ORDER BY id DESC")->fetchAll();

$editPkg = null;
if (isset($_GET['edit'])) {
    $eId = (int)$_GET['edit'];
    $eStmt = $db->prepare("SELECT * FROM packages WHERE id = :id");
    $eStmt->execute([':id' => $eId]);
    $editPkg = $eStmt->fetch();
}

$adminPageTitle = "Tour Packages Management";
require_once __DIR__ . '/includes/admin-header.php';
?>

<!-- Action Bar -->
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <div>
        <p style="color: var(--adm-muted); font-size: 0.95rem;">Manage holiday itineraries, pricing, and 4K cover photos.</p>
    </div>
    <button class="btn btn-accent btn-sm" data-modal="packageModal">
        <i class="fas fa-plus"></i> Add New Package
    </button>
</div>

<!-- Packages Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Tour Packages (<?= count($packages); ?> packages)</h3>
        <input type="text" class="table-search-input form-control" style="max-width: 250px; padding: 0.4rem 0.75rem; font-size: 0.85rem;" placeholder="Search packages..." data-target-table="packagesTable">
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="packagesTable">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Package Title</th>
                    <th>Destination</th>
                    <th>Duration</th>
                    <th>Price</th>
                    <th>Badge</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($packages as $pkg): ?>
                    <tr>
                        <td style="width: 75px;">
                            <img src="../<?= e($pkg['image']); ?>" alt="" style="width: 60px; height: 45px; object-fit: cover; border-radius: 6px;">
                        </td>
                        <td>
                            <strong><?= e($pkg['title']); ?></strong>
                        </td>
                        <td><?= e($pkg['destination']); ?></td>
                        <td><?= e($pkg['duration']); ?></td>
                        <td>
                            <strong><?= e($pkg['price']); ?></strong>
                            <?php if ($pkg['original_price']): ?>
                                <br><small style="color: #94A3B8; text-decoration: line-through;"><?= e($pkg['original_price']); ?></small>
                            <?php endif; ?>
                        </td>
                        <td><span class="badge" style="background: #E2E8F0; color: #1E293B;"><?= e($pkg['badge']); ?></span></td>
                        <td>
                            <a href="packages.php?toggle=<?= $pkg['id']; ?>" title="Click to Toggle">
                                <span class="badge badge-<?= e($pkg['status']); ?>"><?= e($pkg['status']); ?></span>
                            </a>
                        </td>
                        <td>
                            <div style="display: flex; gap: 0.4rem;">
                                <a href="packages.php?edit=<?= $pkg['id']; ?>" class="btn-action" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="packages.php?delete=<?= $pkg['id']; ?>" class="btn-action delete" title="Delete" onclick="return confirm('Delete this tour package?');"><i class="fas fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add / Edit Package Modal -->
<div class="admin-modal <?= $editPkg ? 'show' : ''; ?>" id="packageModal">
    <div class="admin-modal-box">
        <div class="modal-header">
            <h3><i class="fas fa-map-marked-alt" style="color: var(--adm-accent); margin-right: 0.5rem;"></i> <?= $editPkg ? 'Edit Tour Package' : 'Add New Tour Package'; ?></h3>
            <a href="packages.php" class="modal-close-btn" title="Close Modal">&times;</a>
        </div>

        <form method="POST" action="packages.php" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= e(generateCSRFToken()); ?>">
            <input type="hidden" name="save_package" value="1">
            <?php if ($editPkg): ?>
                <input type="hidden" name="package_id" value="<?= $editPkg['id']; ?>">
                <input type="hidden" name="current_image" value="<?= e($editPkg['image']); ?>">
            <?php endif; ?>

            <div class="form-group">
                <label class="form-label">Package Title <span class="req">*</span></label>
                <input type="text" name="title" class="form-control" placeholder="e.g. Jungle Walking Tour with Cultural Lunch" required value="<?= e($editPkg['title'] ?? ''); ?>">
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Destination <span class="req">*</span></label>
                    <input type="text" name="destination" class="form-control" placeholder="e.g. Bangkok, Thailand" required value="<?= e($editPkg['destination'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Duration</label>
                    <input type="text" name="duration" class="form-control" placeholder="e.g. 2 Days / 1 Night" required value="<?= e($editPkg['duration'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Price <span class="req">*</span></label>
                    <input type="text" name="price" class="form-control" placeholder="e.g. ₹52,000" required value="<?= e($editPkg['price'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Original Price (Strikethrough)</label>
                    <input type="text" name="original_price" class="form-control" placeholder="e.g. ₹65,000" value="<?= e($editPkg['original_price'] ?? ''); ?>">
                </div>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Badge Tag</label>
                    <input type="text" name="badge" class="form-control" placeholder="e.g. Trending, -25% Off" value="<?= e($editPkg['badge'] ?? 'Trending'); ?>">
                </div>
                <div class="form-group">
                    <label class="form-label">Group Size</label>
                    <input type="text" name="group_size" class="form-control" placeholder="e.g. 1 - 8 People" value="<?= e($editPkg['group_size'] ?? '1 - 8 People'); ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Short Description <span class="req">*</span></label>
                <textarea name="short_description" rows="2" class="form-control" required placeholder="Brief 1-2 sentence highlight for cards..."><?= e($editPkg['short_description'] ?? ''); ?></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Full Itinerary & Inclusions <span class="req">*</span></label>
                <textarea name="description" rows="4" class="form-control" required placeholder="Day-by-day itinerary and inclusions..."><?= e($editPkg['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="active" <?= ($editPkg && $editPkg['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                        <option value="inactive" <?= ($editPkg && $editPkg['status'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Upload 4K Cover Photo</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem; border-top: 1px solid #F1F5F9; padding-top: 1.25rem;">
                <a href="packages.php" class="btn btn-outline-dark">Cancel</a>
                <button type="submit" class="btn btn-accent"><i class="fas fa-save"></i> Save Tour Package</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
