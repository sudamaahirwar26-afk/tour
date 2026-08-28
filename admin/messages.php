<?php
/**
 * SERENITY PLANNERS - CONTACT MESSAGES MANAGEMENT
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

requireAdminAuth();

$db = getDB();

// Handle Mark All Read
if (isset($_GET['mark_read'])) {
    $db->query("UPDATE contact_messages SET status = 'read' WHERE status = 'unread'");
    setFlash('success', "All messages marked as read.");
    header('Location: messages.php');
    exit;
}

// Handle status change
if (isset($_GET['status'], $_GET['id'])) {
    $msgId = (int)$_GET['id'];
    $status = sanitizeInput($_GET['status']);
    $stmt = $db->prepare("UPDATE contact_messages SET status = :status WHERE id = :id");
    $stmt->execute([':status' => $status, ':id' => $msgId]);
    setFlash('success', "Message status updated.");
    header('Location: messages.php');
    exit;
}

// Handle delete
if (isset($_GET['delete'])) {
    $delId = (int)$_GET['delete'];
    $stmt = $db->prepare("DELETE FROM contact_messages WHERE id = :id");
    $stmt->execute([':id' => $delId]);
    setFlash('success', "Message deleted.");
    header('Location: messages.php');
    exit;
}

// View modal lookup
$viewMsg = null;
if (isset($_GET['view'])) {
    $vId = (int)$_GET['view'];
    $vStmt = $db->prepare("SELECT * FROM contact_messages WHERE id = :id");
    $vStmt->execute([':id' => $vId]);
    $viewMsg = $vStmt->fetch();
    if ($viewMsg && $viewMsg['status'] === 'unread') {
        $db->prepare("UPDATE contact_messages SET status = 'read' WHERE id = :id")->execute([':id' => $vId]);
    }
}

// Fetch all messages
$messages = $db->query("SELECT * FROM contact_messages ORDER BY id DESC")->fetchAll();

$adminPageTitle = "Contact Messages";
require_once __DIR__ . '/includes/admin-header.php';
?>

<!-- Messages Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Inquiries & Contact Messages (<?= count($messages); ?> messages)</h3>
        <div style="display: flex; gap: 0.75rem; align-items: center;">
            <a href="messages.php?mark_read=all" class="btn btn-outline-dark btn-sm"><i class="fas fa-check-double"></i> Mark All Read</a>
            <input type="text" class="table-search-input form-control" style="max-width: 250px; padding: 0.4rem 0.75rem; font-size: 0.85rem;" placeholder="Search messages..." data-target-table="messagesTable">
        </div>
    </div>

    <div class="table-responsive">
        <table class="admin-table" id="messagesTable">
            <thead>
                <tr>
                    <th style="width: 70px;">S.No.</th>
                    <th>Sender Name</th>
                    <th>Email / Phone</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Date Received</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($messages)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--adm-muted); padding: 3rem;">No contact messages received.</td>
                    </tr>
                <?php else: ?>
                    <?php $snoMsg = 1; foreach ($messages as $item): ?>
                        <tr style="<?= ($item['status'] === 'unread') ? 'font-weight: 600; background: #FEF9C3;' : ''; ?>">
                            <td style="font-weight: 700; color: var(--adm-muted);"><?= $snoMsg++; ?></td>
                            <td><?= e($item['name']); ?></td>
                            <td>
                                <?= e($item['email']); ?><br>
                                <small style="color: var(--adm-muted);"><?= e($item['phone'] ?: '-'); ?></small>
                            </td>
                            <td><?= e($item['subject']); ?></td>
                            <td>
                                <span class="badge <?= ($item['status'] === 'unread') ? 'badge-inactive' : 'badge-active'; ?>"><?= e($item['status']); ?></span>
                            </td>
                            <td><small><?= date('M d, Y H:i', strtotime($item['created_at'])); ?></small></td>
                            <td>
                                <div style="display: flex; gap: 0.4rem;">
                                    <a href="messages.php?view=<?= $item['id']; ?>" class="btn-action" title="View Full Message"><i class="fas fa-eye"></i></a>
                                    <a href="messages.php?delete=<?= $item['id']; ?>" class="btn-action delete" title="Delete" onclick="return confirm('Delete this message?');"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- View Message Modal -->
<?php if ($viewMsg): ?>
<div class="admin-modal show" id="viewMessageModal">
    <div class="admin-modal-box">
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem; border-bottom: 1px solid var(--adm-border); padding-bottom: 0.75rem;">
            <h3 style="font-size: 1.3rem;">Message From <?= e($viewMsg['name']); ?></h3>
            <a href="messages.php" class="btn-action" style="border: none; font-size: 1.3rem;">&times;</a>
        </div>

        <div style="background: #F8FAFC; padding: 1.25rem; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.92rem; line-height: 1.7;">
            <p><strong>From:</strong> <?= e($viewMsg['name']); ?> &lt;<a href="mailto:<?= e($viewMsg['email']); ?>"><?= e($viewMsg['email']); ?></a>&gt;</p>
            <p><strong>Phone:</strong> <?= e($viewMsg['phone'] ?: 'N/A'); ?></p>
            <p><strong>Subject:</strong> <?= e($viewMsg['subject']); ?></p>
            <p><strong>Date:</strong> <?= date('F d, Y H:i:s', strtotime($viewMsg['created_at'])); ?></p>
            
            <p style="margin-top: 1rem;"><strong>Message Content:</strong></p>
            <div style="background: #FFF; padding: 1rem; border-radius: 6px; border: 1px solid #E2E8F0; margin-top: 0.35rem; white-space: pre-wrap;"><?= e($viewMsg['message']); ?></div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <a href="mailto:<?= e($viewMsg['email']); ?>?subject=Re: <?= urlencode($viewMsg['subject']); ?>" class="btn btn-accent btn-sm">
                    <i class="fas fa-reply"></i> Reply via Email
                </a>
            </div>
            <div style="display: flex; gap: 0.5rem;">
                <a href="messages.php?status=replied&id=<?= $viewMsg['id']; ?>" class="btn btn-outline-dark btn-sm"><i class="fas fa-check"></i> Mark Replied</a>
                <a href="messages.php" class="btn btn-outline-dark btn-sm">Close</a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
