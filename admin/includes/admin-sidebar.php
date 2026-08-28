<?php
/**
 * Admin Sidebar Navigation
 * Serenity Planners
 */

$admin_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="admin-sidebar" id="adminSidebar">
    <div>
        <div class="admin-brand">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <img src="../assets/images/logo.jpg" alt="Serenity Logo">
                <div>
                    <h2>Serenity Planners</h2>
                    <span style="font-size: 0.72rem; color: var(--adm-accent); font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Executive Portal</span>
                </div>
            </div>
            <button class="admin-sidebar-close" id="adminSidebarClose" aria-label="Close Sidebar">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <nav class="admin-nav">
            <a href="dashboard.php" class="admin-nav-link <?= ($admin_page === 'dashboard.php') ? 'active' : ''; ?>">
                <div class="admin-nav-link-inner">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </div>
            </a>

            <a href="enquiries.php" class="admin-nav-link <?= ($admin_page === 'enquiries.php') ? 'active' : ''; ?>">
                <div class="admin-nav-link-inner">
                    <i class="fas fa-calendar-check"></i>
                    <span>Tour & Event Enquiries</span>
                </div>
                <?php if ($newEnquiriesCount > 0): ?>
                    <span class="badge-counter"><?= $newEnquiriesCount; ?></span>
                <?php endif; ?>
            </a>

            <a href="packages.php" class="admin-nav-link <?= ($admin_page === 'packages.php') ? 'active' : ''; ?>">
                <div class="admin-nav-link-inner">
                    <i class="fas fa-map-marked-alt"></i>
                    <span>Tour Packages</span>
                </div>
            </a>

            <a href="services.php" class="admin-nav-link <?= ($admin_page === 'services.php') ? 'active' : ''; ?>">
                <div class="admin-nav-link-inner">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Services</span>
                </div>
            </a>

            <a href="portfolio.php" class="admin-nav-link <?= ($admin_page === 'portfolio.php') ? 'active' : ''; ?>">
                <div class="admin-nav-link-inner">
                    <i class="fas fa-images"></i>
                    <span>Portfolio Moments</span>
                </div>
            </a>

            <a href="testimonials.php" class="admin-nav-link <?= ($admin_page === 'testimonials.php') ? 'active' : ''; ?>">
                <div class="admin-nav-link-inner">
                    <i class="fas fa-star"></i>
                    <span>Testimonials</span>
                </div>
            </a>

            <a href="messages.php" class="admin-nav-link <?= ($admin_page === 'messages.php') ? 'active' : ''; ?>">
                <div class="admin-nav-link-inner">
                    <i class="fas fa-envelope"></i>
                    <span>Messages</span>
                </div>
                <?php if ($unreadMessagesCount > 0): ?>
                    <span class="badge-counter"><?= $unreadMessagesCount; ?></span>
                <?php endif; ?>
            </a>

            <a href="settings.php" class="admin-nav-link <?= ($admin_page === 'settings.php') ? 'active' : ''; ?>">
                <div class="admin-nav-link-inner">
                    <i class="fas fa-sliders-h"></i>
                    <span>Site Settings</span>
                </div>
            </a>

            <a href="documentation.php" class="admin-nav-link <?= ($admin_page === 'documentation.php') ? 'active' : ''; ?>" style="border-top: 1px solid rgba(255, 255, 255, 0.08); margin-top: 0.5rem; padding-top: 0.75rem;">
                <div class="admin-nav-link-inner" style="color: var(--adm-accent-light);">
                    <i class="fas fa-book-open" style="color: var(--adm-accent);"></i>
                    <span>Project Guide & Docs</span>
                </div>
            </a>
        </nav>
    </div>

    <div class="admin-user-box">
        <div class="admin-user-info">
            <div class="admin-user-name"><?= e($adminName); ?></div>
            <div class="admin-user-role"><?= e($adminRole); ?></div>
        </div>
        <a href="logout.php" class="admin-logout-btn" title="Sign Out" onclick="return confirm('Are you sure you want to sign out?');">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
</aside>
