<?php
/**
 * SERENITY PLANNERS - ENQUIRIES MANAGEMENT
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdminAuth();

$db = getDB();

// Handle Mark All Read Action (from Notification click)
if (isset($_GET['mark_read'])) {
    $db->query("UPDATE enquiries SET status = 'contacted' WHERE status = 'new'");
    $db->query("UPDATE contact_messages SET status = 'read' WHERE status = 'unread'");
    setFlash('success', "All new notifications and enquiries marked as read.");
    header('Location: enquiries.php');
    exit;
}

// Handle Status Update & Notes Action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    if (validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $enqId  = (int)$_POST['enquiry_id'];
        $status = sanitizeInput($_POST['status']);
        $notes  = sanitizeInput($_POST['admin_notes'] ?? '');

        $stmt = $db->prepare("UPDATE enquiries SET status = :status, admin_notes = :notes WHERE id = :id");
        $stmt->execute([
            ':status' => $status,
            ':notes'  => $notes,
            ':id'     => $enqId
        ]);
        setFlash('success', "Enquiry status updated to " . strtoupper($status) . ".");
        header('Location: enquiries.php');
        exit;
    }
}

// Handle Delete Action
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM enquiries WHERE id = :id");
    $stmt->execute([':id' => $delId]);
    setFlash('success', "Enquiry deleted successfully.");
    header('Location: enquiries.php');
    exit;
}

// Filtering & Search
$statusFilter = isset($_GET['status']) ? sanitizeInput($_GET['status']) : 'all';
$searchQuery  = isset($_GET['q']) ? trim($_GET['q']) : '';

$sql = "SELECT * FROM enquiries WHERE 1=1";
$params = [];

if ($statusFilter !== 'all') {
    $sql .= " AND status = :status";
    $params[':status'] = $statusFilter;
}

if (!empty($searchQuery)) {
    $sql .= " AND (full_name LIKE :q OR email LIKE :q OR phone LIKE :q OR event_type LIKE :q OR event_location LIKE :q)";
    $params[':q'] = "%{$searchQuery}%";
}

$sql .= " ORDER BY id DESC";

$stmt = $db->prepare($sql);
$stmt->execute($params);
$enquiries = $stmt->fetchAll();

// Handle modal view if requested via ?view=ID (automatically mark as read if new)
$viewEnquiry = null;
if (isset($_GET['view'])) {
    $vId = (int)$_GET['view'];
    $vStmt = $db->prepare("SELECT * FROM enquiries WHERE id = :id");
    $vStmt->execute([':id' => $vId]);
    $viewEnquiry = $vStmt->fetch();
    if ($viewEnquiry && $viewEnquiry['status'] === 'new') {
        $db->prepare("UPDATE enquiries SET status = 'contacted' WHERE id = :id")->execute([':id' => $vId]);
        $viewEnquiry['status'] = 'contacted';
    }
}

$adminPageTitle = "Event Consultation Enquiries";
require_once __DIR__ . '/includes/admin-header.php';
?>

<!-- Filter & Search Controls -->
<div class="admin-card" style="padding: 1.25rem;">
    <form method="GET" action="enquiries.php" style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
        <div style="flex-grow: 1; min-width: 250px;">
            <input type="text" name="q" class="form-control" placeholder="Search by name, email, phone, location..." value="<?= e($searchQuery); ?>">
        </div>
        <div>
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="all" <?= ($statusFilter === 'all') ? 'selected' : ''; ?>>All Statuses</option>
                <option value="new" <?= ($statusFilter === 'new') ? 'selected' : ''; ?>>New</option>
                <option value="contacted" <?= ($statusFilter === 'contacted') ? 'selected' : ''; ?>>Contacted</option>
                <option value="in_progress" <?= ($statusFilter === 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                <option value="converted" <?= ($statusFilter === 'converted') ? 'selected' : ''; ?>>Converted</option>
                <option value="closed" <?= ($statusFilter === 'closed') ? 'selected' : ''; ?>>Closed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-accent btn-sm"><i class="fas fa-filter"></i> Apply Filter</button>
        <?php if (!empty($searchQuery) || $statusFilter !== 'all'): ?>
            <a href="enquiries.php" class="btn btn-outline-dark btn-sm"><i class="fas fa-times"></i> Reset</a>
        <?php endif; ?>
        <a href="enquiries.php?mark_read=all" class="btn btn-outline-dark btn-sm" style="margin-left: auto;"><i class="fas fa-check-double"></i> Mark All As Read</a>
    </form>
</div>

<!-- Enquiries Table Card -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Enquiries List (<?= count($enquiries); ?> found)</h3>
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="enquiriesTable">
            <thead>
                <tr>
                    <th style="width: 70px;">S.No.</th>
                    <th>Client Information</th>
                    <th>Event Category</th>
                    <th>Target Date</th>
                    <th>Guests</th>
                    <th>Budget Range</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Date Received</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($enquiries)): ?>
                    <tr>
                        <td colspan="10" style="text-align: center; color: var(--adm-muted); padding: 3rem;">No event enquiries matching your filter criteria.</td>
                    </tr>
                <?php else: ?>
                    <?php $sno = 1; foreach ($enquiries as $item): ?>
                        <tr>
                            <td style="font-weight: 700; color: var(--adm-muted);"><?= $sno++; ?></td>
                            <td>
                                <strong><?= e($item['full_name']); ?></strong><br>
                                <small style="color: var(--adm-muted);"><?= e($item['email']); ?></small><br>
                                <small><i class="fas fa-phone-alt" style="font-size: 0.75rem; color: var(--adm-accent);"></i> <?= e($item['phone']); ?></small>
                            </td>
                            <td><?= e($item['event_type']); ?></td>
                            <td><?= $item['event_date'] ? date('M d, Y', strtotime($item['event_date'])) : '<span style="color:#94A3B8;">TBD</span>'; ?></td>
                            <td><?= $item['guest_count'] ? e($item['guest_count']) . ' guests' : '-'; ?></td>
                            <td><?= e($item['budget_range'] ?: '-'); ?></td>
                            <td><?= e($item['event_location'] ?: '-'); ?></td>
                            <td>
                                <span class="badge badge-<?= e($item['status']); ?>"><?= str_replace('_', ' ', e($item['status'])); ?></span>
                            </td>
                            <td><small><?= date('M d, Y H:i', strtotime($item['created_at'])); ?></small></td>
                            <td>
                                <div style="display: flex; gap: 0.4rem;">
                                    <a href="enquiries.php?view=<?= $item['id']; ?>" class="btn-action" title="View Details & Update"><i class="fas fa-edit"></i></a>
                                    <a href="enquiries.php?delete=<?= $item['id']; ?>" class="btn-action delete" title="Delete Enquiry" onclick="return confirm('Are you sure you want to delete this enquiry? This cannot be undone.');"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal for Viewing & Updating Enquiry Details -->
<?php if ($viewEnquiry): ?>
<div class="admin-modal show" id="viewEnquiryModal">
    <div class="admin-modal-box">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; border-bottom: 1px solid var(--adm-border); padding-bottom: 1rem;">
            <h3 style="font-size: 1.3rem; color: var(--adm-text-dark);">Enquiry #<?= $viewEnquiry['id']; ?> Details</h3>
            <a href="enquiries.php" class="btn-action" style="border: none; font-size: 1.3rem;">&times;</a>
        </div>

        <div style="background: #F8FAFC; padding: 1.25rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.92rem; line-height: 1.7;">
            <p><strong>Full Name:</strong> <?= e($viewEnquiry['full_name']); ?></p>
            <p><strong>Email:</strong> <a href="mailto:<?= e($viewEnquiry['email']); ?>" style="color: var(--adm-accent);"><?= e($viewEnquiry['email']); ?></a></p>
            <p><strong>Phone:</strong> <a href="tel:<?= e($viewEnquiry['phone']); ?>" style="color: var(--adm-accent);"><?= e($viewEnquiry['phone']); ?></a></p>
            <p><strong>Event Category:</strong> <?= e($viewEnquiry['event_type']); ?></p>
            <p><strong>Target Event Date:</strong> <?= $viewEnquiry['event_date'] ? date('F d, Y', strtotime($viewEnquiry['event_date'])) : 'Not specified'; ?></p>
            <p><strong>Guest Count:</strong> <?= $viewEnquiry['guest_count'] ? e($viewEnquiry['guest_count']) . ' estimated guests' : 'Not specified'; ?></p>
            <p><strong>Budget Range:</strong> <?= e($viewEnquiry['budget_range'] ?: 'Not specified'); ?></p>
            <p><strong>Location:</strong> <?= e($viewEnquiry['event_location'] ?: 'Not specified'); ?></p>
            <p style="margin-top: 0.75rem;"><strong>Client Message / Vision:</strong></p>
            <div style="background: #FFF; padding: 0.85rem; border-radius: 6px; border: 1px solid #E2E8F0; margin-top: 0.35rem; white-space: pre-wrap;"><?= e($viewEnquiry['message']); ?></div>
        </div>

        <!-- Update Status & Admin Notes Form -->
        <form method="POST" action="enquiries.php">
            <input type="hidden" name="csrf_token" value="<?= e(generateCSRFToken()); ?>">
            <input type="hidden" name="action" value="update_status">
            <input type="hidden" name="enquiry_id" value="<?= $viewEnquiry['id']; ?>">

            <div class="form-group" style="margin-bottom: 1rem;">
                <label class="form-label">Pipeline Status</label>
                <select name="status" class="form-control" required>
                    <option value="new" <?= ($viewEnquiry['status'] === 'new') ? 'selected' : ''; ?>>New</option>
                    <option value="contacted" <?= ($viewEnquiry['status'] === 'contacted') ? 'selected' : ''; ?>>Contacted</option>
                    <option value="in_progress" <?= ($viewEnquiry['status'] === 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                    <option value="converted" <?= ($viewEnquiry['status'] === 'converted') ? 'selected' : ''; ?>>Converted (Booked)</option>
                    <option value="closed" <?= ($viewEnquiry['status'] === 'closed') ? 'selected' : ''; ?>>Closed (Archived)</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label">Internal Admin Notes</label>
                <textarea name="admin_notes" rows="3" class="form-control" placeholder="Internal communication logs, meeting timestamps, quotation numbers..."><?= e($viewEnquiry['admin_notes'] ?? ''); ?></textarea>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                <a href="enquiries.php" class="btn btn-outline-dark btn-sm">Close</a>
                <button type="submit" class="btn btn-accent btn-sm"><i class="fas fa-save"></i> Save Status & Notes</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
