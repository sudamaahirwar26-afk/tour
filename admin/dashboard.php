<?php
/**
 * SERENITY PLANNERS - ADMIN DASHBOARD
 */

$adminPageTitle = "Dashboard Overview";

require_once __DIR__ . '/includes/admin-header.php';

$db = getDB();

// Fetch KPI Metrics
$totalEnquiries = (int)$db->query("SELECT COUNT(*) FROM enquiries")->fetchColumn();
$newEnquiries   = (int)$db->query("SELECT COUNT(*) FROM enquiries WHERE status = 'new'")->fetchColumn();
$totalPackages  = (int)$db->query("SELECT COUNT(*) FROM packages")->fetchColumn();
$totalMessages  = (int)$db->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
$totalServices  = (int)$db->query("SELECT COUNT(*) FROM services")->fetchColumn();
$totalPortfolio = (int)$db->query("SELECT COUNT(*) FROM portfolio")->fetchColumn();
$totalReviews   = (int)$db->query("SELECT COUNT(*) FROM testimonials")->fetchColumn();

// Fetch 5 Most Recent Enquiries
$stmtRecentEnquiries = $db->query("SELECT * FROM enquiries ORDER BY id DESC LIMIT 5");
$recentEnquiries = $stmtRecentEnquiries->fetchAll();

// Fetch 5 Most Recent Contact Messages
$stmtRecentMsgs = $db->query("SELECT * FROM contact_messages ORDER BY id DESC LIMIT 5");
$recentMsgs = $stmtRecentMsgs->fetchAll();
?>

<!-- KPI Overview Cards -->
<div class="kpi-grid">
    <div class="kpi-card">
        <div>
            <div class="kpi-title">Total Enquiries</div>
            <div class="kpi-value"><?= $totalEnquiries; ?></div>
        </div>
        <div class="kpi-icon gold"><i class="fas fa-calendar-check"></i></div>
    </div>

    <div class="kpi-card">
        <div>
            <div class="kpi-title">New Inquiries</div>
            <div class="kpi-value" style="color: #EF4444;"><?= $newEnquiries; ?></div>
        </div>
        <div class="kpi-icon blue"><i class="fas fa-inbox"></i></div>
    </div>

    <div class="kpi-card">
        <div>
            <div class="kpi-title">Tour Packages</div>
            <div class="kpi-value"><?= $totalPackages; ?></div>
        </div>
        <div class="kpi-icon green"><i class="fas fa-map-marked-alt"></i></div>
    </div>

    <div class="kpi-card">
        <div>
            <div class="kpi-title">Services & Moments</div>
            <div class="kpi-value"><?= $totalServices + $totalPortfolio; ?></div>
        </div>
        <div class="kpi-icon purple"><i class="fas fa-layer-group"></i></div>
    </div>
</div>

<!-- Quick Action Bar -->
<div style="display: flex; gap: 0.75rem; margin-bottom: 2rem; flex-wrap: wrap;">
    <a href="enquiries.php" class="btn btn-accent btn-sm"><i class="fas fa-calendar-alt"></i> View All Enquiries</a>
    <a href="packages.php" class="btn btn-outline-dark btn-sm"><i class="fas fa-plus"></i> Manage Tour Packages</a>
    <a href="services.php" class="btn btn-outline-dark btn-sm"><i class="fas fa-concierge-bell"></i> Services</a>
    <a href="portfolio.php" class="btn btn-outline-dark btn-sm"><i class="fas fa-upload"></i> Portfolio Moments</a>
    <a href="documentation.php" class="btn btn-outline-dark btn-sm"><i class="fas fa-book"></i> Project Guide</a>
</div>

<!-- Recent Event Enquiries -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><i class="fas fa-calendar-check" style="color: var(--adm-accent);"></i> Recent Event Consultation Enquiries</h3>
        <a href="enquiries.php" style="font-size: 0.85rem; color: var(--adm-accent); font-weight: 600;">View All Enquiries &rarr;</a>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">S.No.</th>
                    <th>Client Name</th>
                    <th>Event Category</th>
                    <th>Event Date</th>
                    <th>Guests</th>
                    <th>Budget</th>
                    <th>Status</th>
                    <th>Received</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($recentEnquiries)): ?>
                    <tr>
                        <td colspan="9" style="text-align: center; color: var(--adm-muted); padding: 2rem;">No enquiries recorded yet.</td>
                    </tr>
                <?php else: ?>
                    <?php $snoEnq = 1; foreach ($recentEnquiries as $enq): ?>
                        <tr>
                            <td style="font-weight: 700; color: var(--adm-muted);"><?= $snoEnq++; ?></td>
                            <td>
                                <strong><?= e($enq['full_name']); ?></strong><br>
                                <small style="color: var(--adm-muted);"><?= e($enq['email']); ?> | <?= e($enq['phone']); ?></small>
                            </td>
                            <td><?= e($enq['event_type']); ?></td>
                            <td><?= $enq['event_date'] ? date('M d, Y', strtotime($enq['event_date'])) : '<span style="color:#94A3B8;">TBD</span>'; ?></td>
                            <td><?= $enq['guest_count'] ? e($enq['guest_count']) . ' Guests' : '-'; ?></td>
                            <td><?= e($enq['budget_range'] ?: '-'); ?></td>
                            <td>
                                <span class="badge badge-<?= e($enq['status']); ?>"><?= str_replace('_', ' ', e($enq['status'])); ?></span>
                            </td>
                            <td><small><?= date('M d, Y H:i', strtotime($enq['created_at'])); ?></small></td>
                            <td>
                                <a href="enquiries.php?view=<?= $enq['id']; ?>" class="btn-action" title="View & Update"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Recent Messages -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><i class="fas fa-envelope" style="color: var(--adm-info);"></i> Recent Contact Messages</h3>
        <a href="messages.php" style="font-size: 0.85rem; color: var(--adm-accent); font-weight: 600;">View All Messages &rarr;</a>
    </div>

    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th style="width: 70px;">S.No.</th>
                    <th>Sender</th>
                    <th>Subject</th>
                    <th>Message Snippet</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($recentMsgs)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: var(--adm-muted); padding: 2rem;">No contact messages received yet.</td>
                    </tr>
                <?php else: ?>
                    <?php $snoMsg = 1; foreach ($recentMsgs as $msg): ?>
                        <tr>
                            <td style="font-weight: 700; color: var(--adm-muted);"><?= $snoMsg++; ?></td>
                            <td>
                                <strong><?= e($msg['name']); ?></strong><br>
                                <small style="color: var(--adm-muted);"><?= e($msg['email']); ?></small>
                            </td>
                            <td><?= e($msg['subject']); ?></td>
                            <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?= e($msg['message']); ?></td>
                            <td>
                                <span class="badge <?= ($msg['status'] === 'unread') ? 'badge-inactive' : 'badge-active'; ?>"><?= e($msg['status']); ?></span>
                            </td>
                            <td><small><?= date('M d, Y', strtotime($msg['created_at'])); ?></small></td>
                            <td>
                                <a href="messages.php?view=<?= $msg['id']; ?>" class="btn-action" title="Read"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
