<?php
/**
 * Global Header Component
 * Serenity Planners
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';

$settings = getSiteSettings();
$pageTitle = isset($pageTitle) ? $pageTitle . " | " . $settings['company_name'] : $settings['company_name'] . " | " . $settings['tagline'];
$metaDesc  = isset($metaDesc) ? $metaDesc : "Serenity Planners crafts extraordinary luxury weddings, high-profile corporate summits, destination celebrations, and bespoke private events worldwide.";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$reqUri = $_SERVER['REQUEST_URI'] ?? '/tourplaner/';
$isHttps = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
$scheme = $isHttps ? "https" : "http";
$canonical = "{$scheme}://{$host}{$reqUri}";
$logoUrl = "{$scheme}://{$host}/tourplaner/assets/images/logo.jpg";
$csrfToken = generateCSRFToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= e($pageTitle); ?></title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?= e($metaDesc); ?>">
    <meta name="keywords" content="Luxury Wedding Planner, Corporate Event Management, Destination Wedding Specialists, Bespoke Private Events, Serenity Planners">
    <meta name="author" content="<?= e($settings['company_name']); ?>">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?= e($canonical); ?>">

    <!-- Open Graph / Social Meta -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($pageTitle); ?>">
    <meta property="og:description" content="<?= e($metaDesc); ?>">
    <meta property="og:url" content="<?= e($canonical); ?>">
    <meta property="og:image" content="<?= e($logoUrl); ?>">
    <meta property="og:site_name" content="<?= e($settings['company_name']); ?>">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/logo.jpg" type="image/jpeg">

    <!-- Google Fonts: Playfair Display, Manrope & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&family=Manrope:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,500;0,600;0,700;0,800;1,400;1,600&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Luxury Stylesheet -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Structured Data: LocalBusiness & EventPlanner JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EventPlanner",
      "name": "<?= e($settings['company_name']); ?>",
      "image": "<?= e($logoUrl); ?>",
      "@id": "<?= e($canonical); ?>",
      "url": "<?= e($canonical); ?>",
      "telephone": "<?= e($settings['phone']); ?>",
      "priceRange": "$$$$",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?= e($settings['address']); ?>",
        "addressCountry": "US"
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "09:00",
        "closes": "19:00"
      },
      "sameAs": [
        "<?= e($settings['facebook_url']); ?>",
        "<?= e($settings['instagram_url']); ?>",
        "<?= e($settings['linkedin_url']); ?>"
      ]
    }
    </script>
</head>
<body>
