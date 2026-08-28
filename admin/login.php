<?php
/**
 * SERENITY PLANNERS - ADMIN AUTHENTICATION
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions.php';

// Redirect if already logged in
if (isAdminLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';
$settings = getSiteSettings();

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $token = $_POST['csrf_token'] ?? '';
    if (!validateCSRFToken($token)) {
        $error = 'Security session expired. Please refresh the page and try again.';
    } else {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $result = loginAdmin($email, $password);
        if ($result['success']) {
            setFlash('success', 'Welcome back, ' . $result['admin']['name'] . '!');
            header('Location: dashboard.php');
            exit;
        } else {
            $error = $result['error'];
        }
    }
}

$csrfToken = generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Login | <?= e($settings['company_name']); ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        body {
            background-color: var(--color-primary);
            background-image: radial-gradient(circle at center, #1E293B 0%, #0F172A 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        .login-card {
            background: #FFFFFF;
            border-radius: var(--radius-lg);
            padding: 3rem 2.5rem;
            max-width: 440px;
            width: 100%;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
            border: 1px solid var(--color-border-gold);
        }
        .login-brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-brand img {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            border: 2px solid var(--color-accent);
            margin: 0 auto 1rem auto;
        }
        .login-brand h2 {
            font-size: 1.4rem;
            color: var(--color-primary);
        }
        .login-brand p {
            color: var(--color-muted);
            font-size: 0.88rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-brand">
            <img src="../assets/images/logo.jpg" alt="Logo">
            <h2>Serenity Planners</h2>
            <p>Executive Administration Portal</p>
        </div>

        <?php if (!empty($error)): ?>
            <div style="background: #FEE2E2; color: #991B1B; padding: 0.85rem 1rem; border-radius: 8px; font-size: 0.88rem; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.6rem; border: 1px solid #FECACA;">
                <i class="fas fa-exclamation-circle"></i>
                <div><?= e($error); ?></div>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <input type="hidden" name="csrf_token" value="<?= e($csrfToken); ?>">

            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" style="font-size: 0.88rem;">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="admin@serenityplanners.com" required value="<?= e($_POST['email'] ?? ''); ?>">
            </div>

            <div class="form-group" style="margin-bottom: 1.75rem;">
                <label class="form-label" style="font-size: 0.88rem;">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••••••" required>
            </div>

            <button type="submit" class="btn btn-accent" style="width: 100%; border-radius: 8px; padding: 0.9rem;">
                <i class="fas fa-lock"></i> Secure Sign In
            </button>
        </form>

        <div style="margin-top: 2rem; text-align: center; border-top: 1px solid var(--color-border); padding-top: 1.25rem;">
            <a href="../index.php" style="color: var(--color-muted); font-size: 0.85rem;">
                <i class="fas fa-arrow-left"></i> Back to Public Website
            </a>
        </div>
    </div>
</body>
</html>
