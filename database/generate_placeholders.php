<?php
/**
 * Image Placeholder Generator for Serenity Planners
 * Generates beautiful, luxury-styled gradient banners and photo placeholders
 */

$dir = dirname(__DIR__) . '/assets/images/';
if (!is_dir($dir)) {
    mkdir($dir, 0755, true);
}

$images = [
    'hero-bg.jpg' => ['title' => 'Serenity Luxury Events', 'sub' => 'Unforgettable Experiences & Royal Weddings', 'color1' => [15, 23, 42], 'color2' => [30, 41, 59], 'w' => 1920, 'h' => 1080],
    'about-img.jpg' => ['title' => 'Turning Ideas Into Reality', 'sub' => 'Bespoke Artistry & Precision', 'color1' => [201, 162, 39], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 900],
    'service-wedding.jpg' => ['title' => 'Royal Wedding Planning', 'sub' => 'Mandap Staging & Couture Hospitality', 'color1' => [180, 83, 9], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 550],
    'service-corporate.jpg' => ['title' => 'Corporate Summits & Galas', 'sub' => 'Executive Keynotes & AV Production', 'color1' => [30, 58, 138], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 550],
    'service-destination.jpg' => ['title' => 'Destination Weddings & Summits', 'sub' => 'Lake Como, Amalfi & Desert Palaces', 'color1' => [13, 148, 136], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 550],
    'service-private.jpg' => ['title' => 'Private & Milestone Celebrations', 'sub' => 'Exclusive Soirées & Chef Dinners', 'color1' => [147, 51, 234], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 550],
    'service-social.jpg' => ['title' => 'Social & Cultural Galas', 'sub' => 'Thematic Red-Carpet Experiences', 'color1' => [225, 29, 72], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 550],
    'service-decor.jpg' => ['title' => 'Decor & Production Design', 'sub' => 'Floral Architecture & 3D Stagecraft', 'color1' => [217, 119, 6], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 550],
    'portfolio-wedding-1.jpg' => ['title' => 'Palace Heritage Wedding', 'sub' => 'Udaipur City Palace', 'color1' => [180, 83, 9], 'color2' => [30, 41, 59], 'w' => 800, 'h' => 600],
    'portfolio-corp-1.jpg' => ['title' => 'Global Tech Summit', 'sub' => 'San Francisco Center', 'color1' => [37, 99, 235], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 600],
    'portfolio-dest-1.jpg' => ['title' => 'Positano Cliffside Nuptials', 'sub' => 'Amalfi Coast, Italy', 'color1' => [14, 165, 233], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 600],
    'portfolio-private-1.jpg' => ['title' => 'Golden Jubilee Soirée', 'sub' => 'Beverly Hills Estate', 'color1' => [202, 138, 4], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 600],
    'portfolio-social-1.jpg' => ['title' => 'Masquerade Charity Ball', 'sub' => 'Grand Ballroom', 'color1' => [190, 24, 93], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 600],
    'portfolio-wedding-2.jpg' => ['title' => 'Riviera Sunset Vows', 'sub' => 'French Riviera', 'color1' => [245, 158, 11], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 600],
    'portfolio-corp-2.jpg' => ['title' => 'Luxury Auto Launch', 'sub' => 'Dubai Trade Center', 'color1' => [79, 70, 229], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 600],
    'portfolio-dest-2.jpg' => ['title' => 'Villa Renaissance Vows', 'sub' => 'Lake Como, Italy', 'color1' => [16, 185, 129], 'color2' => [15, 23, 42], 'w' => 800, 'h' => 600],
    'testimonial-1.jpg' => ['title' => 'Eleanor & Marcus', 'sub' => 'Lake Como Couple', 'color1' => [201, 162, 39], 'color2' => [15, 23, 42], 'w' => 200, 'h' => 200],
    'testimonial-2.jpg' => ['title' => 'David Sterling', 'sub' => 'VP Apex Group', 'color1' => [59, 130, 246], 'color2' => [15, 23, 42], 'w' => 200, 'h' => 200],
    'testimonial-3.jpg' => ['title' => 'Natasha Mehta', 'sub' => 'Heritage Host', 'color1' => [236, 72, 153], 'color2' => [15, 23, 42], 'w' => 200, 'h' => 200],
    'testimonial-4.jpg' => ['title' => 'Sophia Lorenzi', 'sub' => 'Horizon Foundation', 'color1' => [168, 85, 247], 'color2' => [15, 23, 42], 'w' => 200, 'h' => 200]
];

foreach ($images as $filename => $info) {
    $targetPath = $dir . $filename;
    if (file_exists($targetPath)) continue;

    $w = $info['w'];
    $h = $info['h'];
    $im = imagecreatetruecolor($w, $h);

    // Create vertical gradient
    for ($y = 0; $y < $h; $y++) {
        $factor = $y / $h;
        $r = (int)($info['color1'][0] * (1 - $factor) + $info['color2'][0] * $factor);
        $g = (int)($info['color1'][1] * (1 - $factor) + $info['color2'][1] * $factor);
        $b = (int)($info['color1'][2] * (1 - $factor) + $info['color2'][2] * $factor);
        $col = imagecolorallocate($im, $r, $g, $b);
        imageline($im, 0, $y, $w, $y, $col);
    }

    // Gold border line
    $gold = imagecolorallocate($im, 201, 162, 39);
    imagesetthickness($im, 4);
    imagerectangle($im, 20, 20, $w - 20, $h - 20, $gold);

    // Text colors
    $white = imagecolorallocate($im, 255, 255, 255);
    $accent = imagecolorallocate($im, 230, 202, 101);

    // Watermark title
    imagestring($im, 5, 40, $h / 2 - 20, $info['title'], $white);
    imagestring($im, 4, 40, $h / 2 + 10, $info['sub'], $accent);
    imagestring($im, 3, 40, $h - 50, "SERENITY PLANNERS LUXURY CURATION", $gold);

    imagejpeg($im, $targetPath, 90);
    imagedestroy($im);
}

echo "All images generated successfully.\n";
