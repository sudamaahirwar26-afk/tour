<?php
/**
 * Authentication and Admin Security Middleware
 * Serenity Planners
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';

/**
 * Check if admin is currently logged in
 */
function isAdminLoggedIn(): bool {
    return isset($_SESSION['admin_id'], $_SESSION['admin_email'], $_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

/**
 * Require admin authentication; redirect to login if unauthorized
 */
function requireAdminAuth(): void {
    if (!isAdminLoggedIn()) {
        setFlash('warning', 'Please sign in to access the administrator portal.');
        header('Location: login.php');
        exit;
    }
}

/**
 * Authenticate Admin by Email and Password
 */
function loginAdmin(string $email, string $password): array {
    $email = trim(filter_var($email, FILTER_SANITIZE_EMAIL));
    if (empty($email) || empty($password)) {
        return ['success' => false, 'error' => 'Please provide both email and password.'];
    }

    try {
        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM admins WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password_hash'])) {
            // Prevent session fixation
            session_regenerate_id(true);

            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_email'] = $admin['email'];
            $_SESSION['admin_role'] = $admin['role'];
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['last_activity'] = time();

            return ['success' => true, 'admin' => $admin];
        }

        return ['success' => false, 'error' => 'Invalid email or password.'];
    } catch (Exception $e) {
        error_log("Login Exception: " . $e->getMessage());
        return ['success' => false, 'error' => 'An authentication error occurred. Please try again.'];
    }
}

/**
 * Terminate Admin Session
 */
function logoutAdmin(): void {
    $_SESSION = [];
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
}
