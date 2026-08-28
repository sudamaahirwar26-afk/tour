<?php
/**
 * SERENITY PLANNERS - FULL PROJECT ARCHITECTURE & DOCUMENTATION
 */

$adminPageTitle = "Project Guide & Architecture Documentation";

require_once __DIR__ . '/includes/admin-header.php';
?>

<!-- Header Info Banner -->
<div class="doc-header-banner">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <span class="badge" style="background: rgba(201, 162, 39, 0.2); border: 1px solid var(--adm-accent); color: #E6CA65; margin-bottom: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">Full Stack Evaluation Dossier</span>
            <h2 style="font-size: 1.6rem; font-family: 'Manrope', sans-serif; color: #FFF; margin-bottom: 0.5rem;">Serenity Planners & Parth Trip Platform Architecture</h2>
            <p style="color: #94A3B8; font-size: 0.92rem; max-width: 800px; line-height: 1.6;">
                A production-ready, bespoke luxury tour booking and royal event planning web application built completely in <strong>Core PHP 8.2+, MySQL 8+, HTML5, Custom CSS3, Vanilla JavaScript, and PDO</strong> with zero third-party UI/backend frameworks.
            </p>
        </div>
        <div style="background: rgba(255, 255, 255, 0.05); padding: 0.75rem 1.25rem; border-radius: 8px; border: 1px solid rgba(255, 255, 255, 0.1); text-align: center;">
            <div style="font-size: 0.75rem; color: var(--adm-accent); font-weight: 700; text-transform: uppercase;">Stack Compliance</div>
            <div style="font-size: 1.15rem; font-weight: 800; color: #FFF; margin-top: 0.2rem;">100% Core PHP</div>
        </div>
    </div>
</div>

<div class="doc-layout-grid">
    <!-- Left Column: Detailed Sections -->
    <div style="display: flex; flex-direction: column; gap: 2rem; width: 100%; min-width: 0;">
        
        <!-- 1. Executive Concept & Business Model -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fas fa-crown" style="color: var(--adm-accent);"></i> &nbsp; 1. Business Concept & Reference Alignment</h3>
            </div>
            <div class="doc-card-body">
                <p style="margin-bottom: 1rem;">
                    Inspired by the reference website (<strong>Parth Trip / Parth Planner Pvt. Ltd.</strong>), the platform represents a high-end luxury travel, tour planning, and royal event management agency.
                </p>
                <div class="doc-inner-grid">
                    <div style="background: #F8FAFC; border: 1px solid var(--adm-border); padding: 1rem; border-radius: 8px;">
                        <strong style="color: var(--adm-text-dark); display: block; margin-bottom: 0.25rem;"><i class="fas fa-plane-departure" style="color: var(--adm-accent);"></i> Tour & Travel Specializations</strong>
                        <span style="font-size: 0.88rem; color: var(--adm-muted);">Customized holiday itineraries, desert safaris, alpine expeditions, pilgrimage routes, honeymoon escapes, and 5-star hotel bookings.</span>
                    </div>
                    <div style="background: #F8FAFC; border: 1px solid var(--adm-border); padding: 1rem; border-radius: 8px;">
                        <strong style="color: var(--adm-text-dark); display: block; margin-bottom: 0.25rem;"><i class="fas fa-glass-cheers" style="color: var(--adm-accent);"></i> Luxury Event Planning</strong>
                        <span style="font-size: 0.88rem; color: var(--adm-muted);">Royal 3-day palace weddings, international destination ceremonies, corporate MICE summits, milestone galas, and 3D stagecraft.</span>
                    </div>
                </div>
                <p>
                    <strong>Group Brands & Network:</strong> Parth Planners, Pathik Planners, Ziva Planner, Ziva Tourism LLC Dubai, and Incubival.
                </p>
            </div>
        </div>

        <!-- 2. Technology Stack & Coding Standards -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fas fa-code" style="color: var(--adm-accent);"></i> &nbsp; 2. Technology Stack & Clean Code Architecture</h3>
            </div>
            <div class="doc-card-body">
                <div class="table-responsive">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Layer</th>
                                <th>Technology Used</th>
                                <th>Implementation Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Backend</strong></td>
                                <td>Core PHP 8.2+</td>
                                <td>Singleton PDO connection handler, strict session authentication, prepared SQL statements, and modular include architecture.</td>
                            </tr>
                            <tr>
                                <td><strong>Database</strong></td>
                                <td>MySQL 8+ (InnoDB)</td>
                                <td>9 optimized tables with UTF8MB4 charset, foreign keys, indexes, timestamps, and automated migration scripts.</td>
                            </tr>
                            <tr>
                                <td><strong>Styling</strong></td>
                                <td>Custom CSS3</td>
                                <td>CSS variables, flexbox, CSS grid, glassmorphic blur filters, zero heavy UI frameworks, and 100% responsive media queries.</td>
                            </tr>
                            <tr>
                                <td><strong>Frontend Scripts</strong></td>
                                <td>Vanilla JavaScript</td>
                                <td>Sticky scroll observer, mobile drawers, filterable gallery, full-screen lightbox modal, testimonial carousel, and AJAX fetch form handling.</td>
                            </tr>
                            <tr>
                                <td><strong>Server Engine</strong></td>
                                <td>Apache (.htaccess)</td>
                                <td>Security headers (X-Frame-Options, X-Content-Type-Options, Referrer-Policy), clean routing, and browser asset caching.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- 3. Database Schema Overview -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fas fa-database" style="color: var(--adm-accent);"></i> &nbsp; 3. Relational Database Schema</h3>
            </div>
            <div class="doc-card-body">
                <div class="doc-inner-grid">
                    <div style="background: #F8FAFC; border: 1px solid var(--adm-border); padding: 1rem; border-radius: 8px;">
                        <strong style="color: #0F172A; display: block;"><i class="fas fa-table" style="color: var(--adm-accent);"></i> `packages`</strong>
                        <span>Stores tour deals: title, slug, destination, duration, group size, price, original discount price, badge tag, reviews count, 4K cover image, status.</span>
                    </div>
                    <div style="background: #F8FAFC; border: 1px solid var(--adm-border); padding: 1rem; border-radius: 8px;">
                        <strong style="color: #0F172A; display: block;"><i class="fas fa-table" style="color: var(--adm-accent);"></i> `enquiries`</strong>
                        <span>Client booking CRM: full name, email, phone, categorized event/tour type, preferred date, travelers/guest count, budget, location, message, and workflow status.</span>
                    </div>
                    <div style="background: #F8FAFC; border: 1px solid var(--adm-border); padding: 1rem; border-radius: 8px;">
                        <strong style="color: #0F172A; display: block;"><i class="fas fa-table" style="color: var(--adm-accent);"></i> `destinations`</strong>
                        <span>Curated destinations: name, slug, tour count, tagline, 4K cover image, sort order, and status.</span>
                    </div>
                    <div style="background: #F8FAFC; border: 1px solid var(--adm-border); padding: 1rem; border-radius: 8px;">
                        <strong style="color: #0F172A; display: block;"><i class="fas fa-table" style="color: var(--adm-accent);"></i> `services` & `portfolio`</strong>
                        <span>Dynamic service offerings with detailed inclusions + filterable photographic retrospectives.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. Security & Defensive Programming -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fas fa-shield-alt" style="color: var(--adm-accent);"></i> &nbsp; 4. Security & Defensive Implementation</h3>
            </div>
            <div class="doc-card-body">
                <ul style="padding-left: 1.25rem; display: flex; flex-direction: column; gap: 0.6rem; color: var(--adm-text);">
                    <li><strong>SQL Injection Immunity:</strong> 100% of all database read/write queries execute through PDO prepared statements with parameterized binds.</li>
                    <li><strong>Cross-Site Request Forgery (CSRF):</strong> Every form generates a per-session cryptographic hash (`generateCSRFToken()`) validated upon submission.</li>
                    <li><strong>Cross-Site Scripting (XSS) Prevention:</strong> All user-facing outputs are escaped with `htmlspecialchars($str, ENT_QUOTES, 'UTF-8')`.</li>
                    <li><strong>Password Hashing:</strong> Admin authentication uses `password_hash($pass, PASSWORD_BCRYPT)` and `password_verify()`.</li>
                    <li><strong>Secure Image Uploads:</strong> Validates MIME types (`image/jpeg`, `image/png`, `image/webp`), enforces size limits, and sanitizes filenames.</li>
                </ul>
            </div>
        </div>

    </div>

    <!-- Right Column: Quick Reference & Credentials -->
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        
        <!-- Credentials Box -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fas fa-key" style="color: var(--adm-accent);"></i> &nbsp; Credentials</h3>
            </div>
            <div style="padding: 1.25rem; font-size: 0.9rem; line-height: 1.6;">
                <div style="margin-bottom: 0.75rem;">
                    <span style="color: var(--adm-muted); display: block; font-size: 0.8rem; text-transform: uppercase;">Admin Email</span>
                    <strong style="color: var(--adm-text-dark); font-family: monospace; font-size: 0.95rem;">admin@serenityplanners.com</strong>
                </div>
                <div style="margin-bottom: 0.75rem;">
                    <span style="color: var(--adm-muted); display: block; font-size: 0.8rem; text-transform: uppercase;">Admin Password</span>
                    <strong style="color: var(--adm-text-dark); font-family: monospace; font-size: 0.95rem;">Admin@12345</strong>
                </div>
                <div>
                    <span style="color: var(--adm-muted); display: block; font-size: 0.8rem; text-transform: uppercase;">Database Name</span>
                    <strong style="color: var(--adm-text-dark); font-family: monospace; font-size: 0.95rem;">serenity_events (MySQL)</strong>
                </div>
            </div>
        </div>

        <!-- Directory Structure -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fas fa-folder-tree" style="color: var(--adm-accent);"></i> &nbsp; Project Structure</h3>
            </div>
            <div style="padding: 1.25rem; font-family: monospace; font-size: 0.85rem; line-height: 1.5; color: var(--adm-text-dark);">
                <div>📁 <strong>tourplaner/</strong></div>
                <div style="padding-left: 1rem;">├── 📁 <strong>admin/</strong> (Executive CMS)</div>
                <div style="padding-left: 2rem;">├── 📄 dashboard.php</div>
                <div style="padding-left: 2rem;">├── 📄 packages.php</div>
                <div style="padding-left: 2rem;">├── 📄 enquiries.php</div>
                <div style="padding-left: 2rem;">├── 📄 services.php</div>
                <div style="padding-left: 2rem;">├── 📄 portfolio.php</div>
                <div style="padding-left: 2rem;">├── 📄 documentation.php</div>
                <div style="padding-left: 1rem;">├── 📁 <strong>api/</strong> (AJAX Endpoints)</div>
                <div style="padding-left: 1rem;">├── 📁 <strong>assets/</strong> (CSS, JS, 4K Images)</div>
                <div style="padding-left: 1rem;">├── 📁 <strong>config/</strong> (DB Singleton)</div>
                <div style="padding-left: 1rem;">├── 📁 <strong>database/</strong> (SQL Schema)</div>
                <div style="padding-left: 1rem;">├── 📁 <strong>includes/</strong> (Nav, Foot, Auth)</div>
                <div style="padding-left: 1rem;">├── 📄 <strong>index.php</strong> (12-section Home)</div>
                <div style="padding-left: 1rem;">├── 📄 <strong>packages.php</strong> (Catalog)</div>
                <div style="padding-left: 1rem;">├── 📄 <strong>about.php</strong> (Heritage)</div>
                <div style="padding-left: 1rem;">├── 📄 <strong>services.php</strong> (Services)</div>
                <div style="padding-left: 1rem;">├── 📄 <strong>enquiry.php</strong> (Booking Form)</div>
                <div style="padding-left: 1rem;">├── 📄 <strong>contact.php</strong> (Contact Desk)</div>
                <div style="padding-left: 1rem;">├── 📄 .htaccess & sitemap.xml</div>
            </div>
        </div>

        <!-- Live Quick Actions -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fas fa-link" style="color: var(--adm-accent);"></i> &nbsp; Quick Links</h3>
            </div>
            <div style="padding: 1.25rem; display: flex; flex-direction: column; gap: 0.6rem;">
                <a href="../index.php" target="_blank" class="btn btn-accent btn-sm" style="width: 100%; text-decoration: none;">
                    <i class="fas fa-globe"></i> View Public Website
                </a>
                <a href="packages.php" class="btn btn-outline-dark btn-sm" style="width: 100%; text-decoration: none;">
                    <i class="fas fa-map-marked-alt"></i> Manage Tour Packages
                </a>
                <a href="enquiries.php" class="btn btn-outline-dark btn-sm" style="width: 100%; text-decoration: none;">
                    <i class="fas fa-calendar-check"></i> View Customer Inquiries
                </a>
            </div>
        </div>

    </div>
</div>

<?php require_once __DIR__ . '/includes/admin-footer.php'; ?>
