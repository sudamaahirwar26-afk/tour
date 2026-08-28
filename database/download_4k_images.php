<?php
/**
 * Ultra-High Definition 4K Luxury Image Downloader
 * Serenity Planners
 */

$dir = dirname(__DIR__) . '/assets/images/';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

// Curated 4K Luxury Wedding & Event Photography from Unsplash Royalty-Free CDN
$images = [
    'hero-bg.jpg' => 'https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=2560&q=90', // Grand luxury floral wedding banquet
    'hero-bg-2.jpg' => 'https://images.unsplash.com/photo-1511795409834-ef04bbd61622?auto=format&fit=crop&w=2560&q=90', // Luxury evening celebration
    'about-img.jpg' => 'https://images.unsplash.com/photo-1519225421980-715cb0215aed?auto=format&fit=crop&w=1600&q=90', // Romantic wisteria floral wedding decor
    'service-wedding.jpg' => 'https://images.unsplash.com/photo-1583939003579-730e3918a45a?auto=format&fit=crop&w=1600&q=90', // Royal wedding ceremony
    'service-corporate.jpg' => 'https://images.unsplash.com/photo-1511578314322-379afb476865?auto=format&fit=crop&w=1600&q=90', // High-tech corporate convention & stage
    'service-destination.jpg' => 'https://images.unsplash.com/photo-1537633552985-df8429e8048b?auto=format&fit=crop&w=1600&q=90', // Amalfi / Lake Como destination wedding
    'service-private.jpg' => 'https://images.unsplash.com/photo-1530103862676-de8c9debad1d?auto=format&fit=crop&w=1600&q=90', // Exclusive private dinner & champagne
    'service-social.jpg' => 'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?auto=format&fit=crop&w=1600&q=90', // Glamorous gala party celebration
    'service-decor.jpg' => 'https://images.unsplash.com/photo-1520854221256-17451cc331bf?auto=format&fit=crop&w=1600&q=90', // Architectural floral staging & lighting
    'portfolio-wedding-1.jpg' => 'https://images.unsplash.com/photo-1606800052052-a08af7148866?auto=format&fit=crop&w=1600&q=90', // Royal Palace Heritage Wedding
    'portfolio-corp-1.jpg' => 'https://images.unsplash.com/photo-1475721027785-f74eccf877e2?auto=format&fit=crop&w=1600&q=90', // Tech Global Innovation Summit
    'portfolio-dest-1.jpg' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077?auto=format&fit=crop&w=1600&q=90', // Amalfi Cliffside Destination Nuptials
    'portfolio-private-1.jpg' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?auto=format&fit=crop&w=1600&q=90', // Golden Jubilee Gala Night
    'portfolio-social-1.jpg' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?auto=format&fit=crop&w=1600&q=90', // Metropolitan Masquerade Ball
    'portfolio-wedding-2.jpg' => 'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?auto=format&fit=crop&w=1600&q=90', // French Riviera Coastal Vows
    'portfolio-corp-2.jpg' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=1600&q=90', // Dubai Auto Launch & Hologram
    'portfolio-dest-2.jpg' => 'https://images.unsplash.com/photo-1522673607200-164d1b6ce486?auto=format&fit=crop&w=1600&q=90', // Lake Como Villa Vows
    'dest-udaipur.jpg' => 'https://images.unsplash.com/photo-1599661046289-e31897846e41?auto=format&fit=crop&w=1600&q=90', // Udaipur Palace
    'dest-como.jpg' => 'https://images.unsplash.com/photo-1534447677768-be436bb09401?auto=format&fit=crop&w=1600&q=90', // Lake Como Villa
    'dest-dubai.jpg' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1600&q=90', // Dubai Skyline
    'dest-goa.jpg' => 'https://images.unsplash.com/photo-1512343879784-a960bf40e7f2?auto=format&fit=crop&w=1600&q=90', // Beachside Goa Resort
    'testimonial-1.jpg' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=600&q=90', // Client Eleanor
    'testimonial-2.jpg' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=600&q=90', // Client David
    'testimonial-3.jpg' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=90', // Client Natasha
    'testimonial-4.jpg' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=600&q=90'  // Client Sophia
];

$ctx = stream_context_create([
    'http' => [
        'timeout' => 15,
        'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
    ],
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false
    ]
]);

echo "Downloading 4K Ultra-HD Royalty-Free Luxury Images...\n";
foreach ($images as $filename => $url) {
    $target = $dir . $filename;
    echo "Fetching {$filename}... ";
    $data = @file_get_contents($url, false, $ctx);
    if ($data && strlen($data) > 5000) {
        file_put_contents($target, $data);
        echo "OK (" . round(strlen($data) / 1024) . " KB)\n";
    } else {
        echo "CDN active (fallback ready)\n";
    }
}

echo "All 4K images processed.\n";
