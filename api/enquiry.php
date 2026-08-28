<?php
/**
 * API Endpoint: Event Consultation Enquiry Form Handler
 * Serenity Planners
 */

header('Content-Type: application/json; charset=UTF-8');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';

// Allow only POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed.']);
    exit;
}

// Check CSRF Token
$token = $_POST['csrf_token'] ?? '';
if (!validateCSRFToken($token)) {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Security token invalid or expired. Please refresh the page.']);
    exit;
}

// Retrieve & Sanitize Fields
$fullName    = sanitizeInput($_POST['full_name'] ?? '');
$email       = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$phone       = sanitizeInput($_POST['phone'] ?? '');
$eventType   = sanitizeInput($_POST['event_type'] ?? '');
$eventDate   = sanitizeInput($_POST['event_date'] ?? '');
$guestCount  = !empty($_POST['guest_count']) ? (int)$_POST['guest_count'] : null;
$budgetRange = sanitizeInput($_POST['budget_range'] ?? '');
$location    = sanitizeInput($_POST['event_location'] ?? '');
$message     = sanitizeInput($_POST['message'] ?? '');

$errors = [];

// Validation Rules
if (empty($fullName) || strlen($fullName) < 2) {
    $errors['full_name'] = 'Please enter your full name (minimum 2 characters).';
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Please enter a valid email address.';
}

if (empty($phone) || strlen($phone) < 7) {
    $errors['phone'] = 'Please enter a valid contact phone number.';
}

if (empty($eventType)) {
    $errors['event_type'] = 'Please select an event category.';
}

if (empty($message) || strlen($message) < 10) {
    $errors['message'] = 'Please provide details about your event (minimum 10 characters).';
}

if (!empty($errors)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Please correct the highlighted errors in the form.',
        'errors'  => $errors
    ]);
    exit;
}

// Format event date
$formattedDate = !empty($eventDate) ? date('Y-m-d', strtotime($eventDate)) : null;

try {
    $db = getDB();
    $stmt = $db->prepare("INSERT INTO enquiries 
        (full_name, email, phone, event_type, event_date, guest_count, budget_range, event_location, message, status, created_at)
        VALUES 
        (:full_name, :email, :phone, :event_type, :event_date, :guest_count, :budget_range, :event_location, :message, 'new', NOW())");

    $stmt->execute([
        ':full_name'      => $fullName,
        ':email'          => $email,
        ':phone'          => $phone,
        ':event_type'     => $eventType,
        ':event_date'     => $formattedDate,
        ':guest_count'    => $guestCount,
        ':budget_range'   => $budgetRange,
        ':event_location' => $location,
        ':message'        => $message
    ]);

    // Regenerate CSRF token on success
    unset($_SESSION['csrf_token']);
    $newCsrf = generateCSRFToken();

    echo json_encode([
        'success' => true,
        'message' => 'Thank you for reaching out to Serenity Planners! Our senior travel and event specialist will contact you within 24 hours with your customized itinerary and bespoke proposal.',
        'csrf_token' => $newCsrf
    ]);
} catch (Exception $e) {
    error_log("Enquiry Insert Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An unexpected server error occurred. Please try again or call our concierge desk directly.'
    ]);
}
