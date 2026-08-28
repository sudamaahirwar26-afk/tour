/**
 * SERENITY PLANNERS - ADMIN PANEL SCRIPT
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Modal Trigger Handlers
    const modalTriggers = document.querySelectorAll('[data-modal]');
    const closeTriggers = document.querySelectorAll('[data-modal-close]');

    modalTriggers.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-modal');
            const targetModal = document.getElementById(targetId);
            if (targetModal) {
                targetModal.classList.add('show');
            }
        });
    });

    closeTriggers.forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.admin-modal');
            if (modal) modal.classList.remove('show');
        });
    });

    window.addEventListener('click', (e) => {
        if (e.target.classList.contains('admin-modal')) {
            e.target.classList.remove('show');
        }
    });

    // 2. Table Quick Search Filter
    const searchInputs = document.querySelectorAll('.table-search-input');
    searchInputs.forEach(input => {
        input.addEventListener('keyup', () => {
            const query = input.value.toLowerCase();
            const tableId = input.getAttribute('data-target-table');
            const table = document.getElementById(tableId);
            if (!table) return;

            const rows = table.querySelectorAll('tbody tr');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    });

    // 3. Mobile Sidebar Drawer Toggle & Responsive Controls
    const sidebarToggle = document.getElementById('adminSidebarToggle');
    const sidebarClose = document.getElementById('adminSidebarClose');
    const adminSidebar = document.getElementById('adminSidebar');
    const sidebarOverlay = document.getElementById('adminSidebarOverlay');

    const openAdminSidebar = () => {
        if (adminSidebar) adminSidebar.classList.add('open');
        if (sidebarOverlay) sidebarOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    };

    const closeAdminSidebar = () => {
        if (adminSidebar) adminSidebar.classList.remove('open');
        if (sidebarOverlay) sidebarOverlay.classList.remove('active');
        document.body.style.overflow = '';
    };

    const toggleAdminSidebar = (e) => {
        if (e) e.stopPropagation();
        if (!adminSidebar) return;
        const isOpen = adminSidebar.classList.contains('open');
        if (isOpen) {
            closeAdminSidebar();
        } else {
            openAdminSidebar();
        }
    };

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', toggleAdminSidebar);
    }

    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeAdminSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeAdminSidebar);
    }

    // Close on ESC key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && adminSidebar && adminSidebar.classList.contains('open')) {
            closeAdminSidebar();
        }
    });

    // Close sidebar when clicking any navigation link on mobile
    const adminNavLinks = document.querySelectorAll('.admin-nav-link');
    adminNavLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (window.innerWidth <= 992) {
                closeAdminSidebar();
            }
        });
    });
});

