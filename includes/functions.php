<?php
/**
 * Core Helper Functions
 * Serenity Planners
 */

if (session_status() === PHP_SESSION_NONE) {
    if (!headers_sent()) {
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.cookie_samesite', 'Lax');
        session_start();
    }
}

/**
 * Generate CSRF Token
 */
function generateCSRFToken(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Validate CSRF Token
 */
function validateCSRFToken(?string $token): bool {
    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Sanitize Output to prevent XSS
 */
function e(?string $string): string {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Sanitize Input String
 */
function sanitizeInput(string $data): string {
    return htmlspecialchars(stripslashes(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Fetch All Site Settings into an Associative Array
 */
function getSiteSettings(): array {
    static $settings = null;
    if ($settings !== null) {
        return $settings;
    }

    try {
        $db = getDB();
        $stmt = $db->query("SELECT setting_key, setting_value FROM site_settings");
        $settings = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    } catch (Exception $e) {
        $settings = [];
    }

    // Default Fallbacks
    $defaults = [
        'company_name'   => 'Serenity Planners',
        'tagline'        => 'Bespoke Luxury Events & Celebrations',
        'email'          => 'concierge@serenityplanners.com',
        'phone'          => '+1 (800) 589-3281',
        'alt_phone'      => '+1 (555) 924-8172',
        'address'        => '742 Luxury Boulevard, Suite 500, Beverly Hills, CA 90210',
        'business_hours' => 'Mon - Sat: 9:00 AM - 7:00 PM | Sun: By Appointment',
        'hero_headline'  => 'Plan. Create. Celebrate.',
        'hero_subtitle'  => 'Creating unforgettable luxury experiences that deserve to be remembered forever.',
        'about_heading'  => 'Turning Ideas Into Unforgettable Experiences',
        'about_text'     => 'At Serenity Planners, we curate extraordinary, tailor-made luxury events across the globe.',
        'stat_events'    => '150+',
        'stat_corporate' => '50+',
        'stat_clients'   => '100+',
        'stat_years'     => '8+',
        'facebook_url'   => 'https://facebook.com/serenityplanners',
        'instagram_url'  => 'https://instagram.com/serenityplanners',
        'linkedin_url'   => 'https://linkedin.com/company/serenityplanners',
        'pinterest_url'  => 'https://pinterest.com/serenityplanners',
        'footer_text'    => 'Serenity Planners is an internationally acclaimed luxury event management agency crafting bespoke weddings, corporate summits, and milestone celebrations worldwide.'
    ];

    return array_merge($defaults, $settings);
}

/**
 * Fetch active services
 */
function getActiveServices(int $limit = 0): array {
    try {
        $db = getDB();
        $sql = "SELECT * FROM services WHERE status = 'active' ORDER BY sort_order ASC, id ASC";
        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }
        return $db->query($sql)->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Fetch active portfolio items
 */
function getActivePortfolio(string $category = 'all', int $limit = 0): array {
    try {
        $db = getDB();
        $params = [];
        $sql = "SELECT * FROM portfolio WHERE status = 'active'";
        if ($category !== 'all') {
            $sql .= " AND category = :category";
            $params[':category'] = $category;
        }
        $sql .= " ORDER BY featured DESC, id DESC";
        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Fetch active tour packages
 */
function getActivePackages(int $limit = 0): array {
    try {
        $db = getDB();
        $sql = "SELECT * FROM packages WHERE status = 'active' ORDER BY featured DESC, id DESC";
        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }
        return $db->query($sql)->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Fetch active tour destinations
 */
function getActiveDestinations(int $limit = 0): array {
    try {
        $db = getDB();
        $sql = "SELECT * FROM destinations WHERE status = 'active' ORDER BY sort_order ASC, id ASC";
        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }
        return $db->query($sql)->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Fetch published testimonials
 */
function getPublishedTestimonials(int $limit = 0): array {
    try {
        $db = getDB();
        $sql = "SELECT * FROM testimonials WHERE status = 'published' ORDER BY sort_order ASC, id DESC";
        if ($limit > 0) {
            $sql .= " LIMIT " . (int)$limit;
        }
        return $db->query($sql)->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

/**
 * Flash Message System
 */
function setFlash(string $type, string $message): void {
    $_SESSION['flash'] = [
        'type' => $type, // success, error, warning, info
        'message' => $message
    ];
}

function getFlash(): ?array {
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    return null;
}

/**
 * Slugify text
 */
function slugify(string $text): string {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    $text = strtolower($text);
    return empty($text) ? 'n-a' : $text;
}

/**
 * Secure File Upload Handler
 */
function uploadImage(array $file, string $targetDir = 'assets/uploads/'): array {
    $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
    $allowedExts  = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $maxSize      = 5 * 1024 * 1024; // 5MB

    if (!isset($file['error']) || is_array($file['error'])) {
        return ['success' => false, 'error' => 'Invalid file parameter.'];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['success' => false, 'error' => 'File upload failed with error code: ' . $file['error']];
    }

    if ($file['size'] > $maxSize) {
        return ['success' => false, 'error' => 'File size exceeds maximum 5MB limit.'];
    }

    // Verify MIME using finfo
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime  = $finfo->file($file['tmp_name']);
    if (!in_array($mime, $allowedMimes, true)) {
        return ['success' => false, 'error' => 'Invalid file format. Only JPG, PNG, and WEBP are allowed.'];
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExts, true)) {
        return ['success' => false, 'error' => 'Invalid file extension.'];
    }

    $absoluteTargetDir = dirname(__DIR__) . '/' . trim($targetDir, '/') . '/';
    if (!is_dir($absoluteTargetDir)) {
        mkdir($absoluteTargetDir, 0755, true);
    }

    $filename = 'img_' . bin2hex(random_bytes(8)) . '_' . time() . '.' . $ext;
    $destination = $absoluteTargetDir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destination)) {
        return ['success' => false, 'error' => 'Failed to save uploaded file to destination.'];
    }

    return [
        'success' => true,
        'path' => trim($targetDir, '/') . '/' . $filename,
        'filename' => $filename
    ];
}
