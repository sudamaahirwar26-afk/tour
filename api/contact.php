<?php
/**
 * API Endpoint: Contact Message Form Handler
 * Serenity Planners
 */

header('Content-Type: application/json; charset=UTF-8');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed.']);
    exit;
}

$token = $_POST['csrf_token'] ?? '';
if (!validateCSRFToken($token)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Security token invalid or expired. Please refresh the page.']);
    exit;
}

$name    = sanitizeInput($_POST['name'] ?? '');
$email   = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone   = sanitizeInput($_POST['phone'] ?? '');
$subject = sanitizeInput($_POST['subject'] ?? '');
$message = sanitizeInput($_POST['message'] ?? '');

$errors = [];

if (empty($name) || strlen($name) < 2) {
    $errors['name'] = 'Please enter your name.';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}

if (empty($subject) || strlen($subject) < 3) {
    $errors['subject'] = 'Please enter a subject.';
}

if (empty($message) || strlen($message) < 10) {
    $errors['message'] = 'Please write your message (minimum 10 characters).';
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all required fields accurately.',
        'errors'  => $errors
    ]);
    exit;
}

try {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO contact_messages (name, email, phone, subject, message, status, created_at) VALUES (:name, :email, :phone, :subject, :message, 'unread', NOW())");
    $stmt->execute([
        ':name'    => $name,
        ':email'   => $email,
        ':phone'   => $phone,
        ':subject' => $subject,
        ':message' => $message
    ]);

    unset($_SESSION['csrf_token']);
    $newCsrf = generateCSRFToken();

    echo json_encode([
        'success' => true,
        'message' => 'Thank you for your message! Our team at Serenity Planners will respond to you promptly.',
        'csrf_token' => $newCsrf
    ]);
} catch (Exception $e) {
    error_log("Contact Insert Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An unexpected server error occurred. Please try again.'
    ]);
}
