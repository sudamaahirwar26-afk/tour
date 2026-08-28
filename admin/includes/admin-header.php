<?php
/**
 * Admin Topbar & Header Component
 * Serenity Planners
 */

if (ob_get_level() === 0) {
    ob_start();
}

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/functions.php';

requireAdminAuth();

$settings = getSiteSettings();
$adminName = $_SESSION['admin_name'] ?? 'Administrator';
$adminEmail = $_SESSION['admin_email'] ?? '';
$adminRole = $_SESSION['admin_role'] ?? 'Admin';

// Count new enquiries & unread messages for notification
$db = getDB();
$newEnquiriesCount = (int)$db->query("SELECT COUNT(*) FROM enquiries WHERE status = 'new'")->fetchColumn();
$unreadMessagesCount = (int)$db->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'unread'")->fetchColumn();
$totalNotifsCount = $newEnquiriesCount + $unreadMessagesCount;
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($adminPageTitle ?? 'Admin Dashboard'); ?> | Serenity Planners Portal</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Manrope:wght@500;600;700;800&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body class="admin-body">
    <div class="admin-layout">
        <!-- Include Sidebar -->
        <?php require_once __DIR__ . '/admin-sidebar.php'; ?>

        <!-- Main Content Wrapper -->
        <main class="admin-main">
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <button class="admin-mobile-toggle" id="adminSidebarToggle" aria-label="Toggle Sidebar">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="admin-page-title"><?= e($adminPageTitle ?? 'Dashboard'); ?></h1>
                </div>
                
                <div class="admin-topbar-actions">
                    <a href="../index.php" target="_blank" class="btn-action" style="width: auto; padding: 0.4rem 0.85rem; font-size: 0.85rem; text-decoration: none;" title="View Live Public Website">
                        <i class="fas fa-external-link-alt"></i> &nbsp;<span class="hide-mobile">View Site</span>
                    </a>
                    
                    <a href="enquiries.php?mark_read=all" class="admin-notif-btn" title="<?= ($totalNotifsCount > 0) ? $totalNotifsCount . ' New Notifications (Click to Mark All Read)' : 'No New Notifications'; ?>">
                        <i class="fas fa-bell"></i>
                        <?php if ($totalNotifsCount > 0): ?>
                            <span class="notif-badge"><?= $totalNotifsCount; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
            </header>

            <div class="admin-content">
                <?php if ($flash): ?>
                    <div style="padding: 1rem 1.25rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem; background: <?= ($flash['type'] === 'success') ? '#D1FAE5' : '#FEE2E2'; ?>; color: <?= ($flash['type'] === 'success') ? '#065F46' : '#991B1B'; ?>; border: 1px solid <?= ($flash['type'] === 'success') ? '#A7F3D0' : '#FECACA'; ?>;">
                        <i class="fas <?= ($flash['type'] === 'success') ? 'fa-check-circle' : 'fa-exclamation-circle'; ?>"></i>
                        <div><?= e($flash['message']); ?></div>
                    </div>
                <?php endif; ?>
