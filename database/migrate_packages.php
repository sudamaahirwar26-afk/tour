<?php
/**
 * Database Migration: Packages and Destinations for Serenity Planners / Parth Trip
 */

require_once 'c:/xampp/htdocs/tourplaner/config/database.php';

$db = getDB();

// 1. Create Packages Table
$db->exec("CREATE TABLE IF NOT EXISTS `packages` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `title` VARCHAR(200) NOT NULL,
    `slug` VARCHAR(200) NOT NULL UNIQUE,
    `destination` VARCHAR(150) NOT NULL,
    `duration` VARCHAR(100) NOT NULL,
    `group_size` VARCHAR(100) DEFAULT '1 - 8 People',
    `price` VARCHAR(100) NOT NULL,
    `original_price` VARCHAR(100) DEFAULT NULL,
    `badge` VARCHAR(50) DEFAULT 'Trending',
    `reviews_count` INT DEFAULT 5,
    `rating` DECIMAL(2,1) DEFAULT 4.9,
    `short_description` VARCHAR(300) NOT NULL,
    `description` TEXT NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `featured` TINYINT(1) DEFAULT 1,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

// 2. Create Destinations Table
$db->exec("CREATE TABLE IF NOT EXISTS `destinations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(150) NOT NULL,
    `slug` VARCHAR(150) NOT NULL UNIQUE,
    `tour_count` VARCHAR(50) NOT NULL DEFAULT '05 Tours',
    `tagline` VARCHAR(255) NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `sort_order` INT DEFAULT 0,
    `status` ENUM('active', 'inactive') DEFAULT 'active',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

// 3. Seed Packages
$packages = [
    [
        'title' => 'Jungle Walking Tour with Authentic Cultural Lunch',
        'slug' => 'jungle-walking-tour-bangkok',
        'destination' => 'Bangkok, Thailand',
        'duration' => '2 Days / 1 Night',
        'group_size' => '1 - 8 People',
        'price' => '₹52,000',
        'original_price' => '₹65,000',
        'badge' => 'Trending',
        'reviews_count' => 5,
        'rating' => 4.9,
        'short_description' => 'Immerse in lush tropical rainforest trails, authentic local village gastronomy, and heritage temple stops.',
        'description' => 'Experience the hidden wilderness of Thailand accompanied by veteran local naturalist guides. This exclusive tour features private longtail river transport, canopy suspension bridges, wildlife sightings, and an authentic gourmet tribal luncheon prepared with fresh organic farm ingredients.',
        'image' => 'assets/images/portfolio-dest-1.jpg'
    ],
    [
        'title' => 'Desert Adventure Safari with Royal Sunset Dinner',
        'slug' => 'desert-adventure-safari-dubai',
        'destination' => 'Dubai, UAE',
        'duration' => '3 Days / 2 Nights',
        'group_size' => '2 - 12 People',
        'price' => '₹34,000',
        'original_price' => '₹45,000',
        'badge' => 'Popular',
        'reviews_count' => 8,
        'rating' => 5.0,
        'short_description' => 'Luxury dune bashing, Arabian falconry, private Bedouin tent dinner, and star-gazing experience.',
        'description' => 'Traverse golden crimson dunes in custom 4x4 luxury vehicles followed by quad biking, camel trekking, and a 5-star open-sky Arabian barbecue dinner featuring fire dancers, live oud music, and celestial stargazing.',
        'image' => 'assets/images/portfolio-corp-2.jpg'
    ],
    [
        'title' => 'Scenic Nature Journey with Delicious Picnic Basket',
        'slug' => 'scenic-nature-journey-switzerland',
        'destination' => 'Lake Como & Alps, Italy',
        'duration' => '5 Days / 4 Nights',
        'group_size' => '2 - 10 People',
        'price' => '₹1,22,000',
        'original_price' => '₹1,45,000',
        'badge' => 'Luxury Pick',
        'reviews_count' => 12,
        'rating' => 5.0,
        'short_description' => 'Lakeside vintage Riva boat cruise, alpine funicular train, and sommelier vineyard wine tasting.',
        'description' => 'A dream European escape along Lake Como and the Swiss-Italian Alps. Enjoy private villa tours, bespoke champagne cruises, artisanal cheese tastings, and scenic mountain lookout banquets with private concierge accompaniment.',
        'image' => 'assets/images/dest-como.jpg'
    ],
    [
        'title' => 'Bangkok Urban Green Spaces & Floating Market Tour',
        'slug' => 'bangkok-urban-green-spaces',
        'destination' => 'Bangkok, Thailand',
        'duration' => '1 Day / Full Day',
        'group_size' => '1 - 6 People',
        'price' => '₹12,000',
        'original_price' => '₹16,000',
        'badge' => '-25% Off',
        'reviews_count' => 6,
        'rating' => 4.8,
        'short_description' => 'Eco-friendly electric canal boats, organic rooftop gardens, and historic Chinatown street food.',
        'description' => 'Discover the sustainable and green soul of Bangkok. Glide through tranquil canal networks, explore sacred pagoda gardens, and taste Michelin-guide recognized street delicacies curated by culinary historians.',
        'image' => 'assets/images/service-destination.jpg'
    ],
    [
        'title' => 'Royal Rajasthan Heritage & Desert Palace Expedition',
        'slug' => 'royal-rajasthan-heritage-palace',
        'destination' => 'Udaipur & Jaipur, India',
        'duration' => '6 Days / 5 Nights',
        'group_size' => '2 - 15 People',
        'price' => '₹40,000',
        'original_price' => '₹1,00,000',
        'badge' => 'Super Deal',
        'reviews_count' => 15,
        'rating' => 5.0,
        'short_description' => 'Stay in royal 5-star palace heritage hotels, vintage car rides, and regal evening musical courtyards.',
        'description' => 'Live like royalty across Udaipur\'s lake palaces and Jaipur\'s amber fortresses. Package includes private chauffeured luxury transport, royal banquet dinners, private museum access, and folk performances under the stars.',
        'image' => 'assets/images/dest-udaipur.jpg'
    ],
    [
        'title' => 'Full-Day Coastal Hiking & Marine Yacht Adventure',
        'slug' => 'full-day-coastal-yacht-adventure',
        'destination' => 'Goa & Arabian Sea, India',
        'duration' => '4 Days / 3 Nights',
        'group_size' => '2 - 8 People',
        'price' => '₹56,000',
        'original_price' => '₹70,000',
        'badge' => 'Trending',
        'reviews_count' => 7,
        'rating' => 4.9,
        'short_description' => 'Private catamaran sail, hidden waterfall trek, coastal seafood grill, and sunset dolphin cruise.',
        'description' => 'Explore the unspoiled coastal beauty of Southern Goa and the Arabian Sea. Charter a private twin-hull catamaran, snorkel in vibrant coral reefs, and savor fresh catch barbecue on a secluded beach.',
        'image' => 'assets/images/dest-goa.jpg'
    ]
];

$stmtPkg = $db->prepare("INSERT INTO packages (title, slug, destination, duration, group_size, price, original_price, badge, reviews_count, rating, short_description, description, image, featured, status) VALUES (:title, :slug, :destination, :duration, :group_size, :price, :original_price, :badge, :reviews_count, :rating, :short_description, :description, :image, 1, 'active') ON DUPLICATE KEY UPDATE title=VALUES(title), price=VALUES(price), image=VALUES(image)");

foreach ($packages as $pkg) {
    $stmtPkg->execute($pkg);
}

// 4. Seed Destinations
$destinations = [
    [
        'name' => 'Thailand',
        'slug' => 'thailand',
        'tour_count' => '07 Tours',
        'tagline' => 'Tropical islands, floating markets, and emerald temples',
        'image' => 'assets/images/service-destination.jpg',
        'sort_order' => 1
    ],
    [
        'name' => 'India',
        'slug' => 'india',
        'tour_count' => '12 Tours',
        'tagline' => 'Royal palaces, sacred ghats, and backwater lagoons',
        'image' => 'assets/images/dest-udaipur.jpg',
        'sort_order' => 2
    ],
    [
        'name' => 'Switzerland & Italy',
        'slug' => 'switzerland-italy',
        'tour_count' => '08 Tours',
        'tagline' => 'Alpine peaks, scenic rail journeys, and Lake Como villas',
        'image' => 'assets/images/dest-como.jpg',
        'sort_order' => 3
    ],
    [
        'name' => 'Dubai & UAE',
        'slug' => 'dubai-uae',
        'tour_count' => '05 Tours',
        'tagline' => 'Futuristic skylines, desert dunes, and mega luxury resorts',
        'image' => 'assets/images/dest-dubai.jpg',
        'sort_order' => 4
    ],
    [
        'name' => 'Goa & Coastal Escapes',
        'slug' => 'goa-coastal',
        'tour_count' => '06 Tours',
        'tagline' => 'Sun-drenched beaches, luxury catamarans, and nightlife',
        'image' => 'assets/images/dest-goa.jpg',
        'sort_order' => 5
    ],
    [
        'name' => 'Canada & Rocky Mountains',
        'slug' => 'canada',
        'tour_count' => '04 Tours',
        'tagline' => 'Glacier lakes, national parks, and vibrant cities',
        'image' => 'assets/images/about-img.jpg',
        'sort_order' => 6
    ]
];

$stmtDest = $db->prepare("INSERT INTO destinations (name, slug, tour_count, tagline, image, sort_order, status) VALUES (:name, :slug, :tour_count, :tagline, :image, :sort_order, 'active') ON DUPLICATE KEY UPDATE name=VALUES(name), tour_count=VALUES(tour_count), image=VALUES(image)");

foreach ($destinations as $dst) {
    $stmtDest->execute($dst);
}

// 5. Update Site Settings with Sister Companies
$db->exec("INSERT INTO site_settings (setting_key, setting_value) VALUES 
('group_companies', 'Parth Planners, Pathik Planners, Ziva Planner, Ziva Tourism LLC Dubai, Incubival'),
('company_since', '2016'),
('stat_travelers', '5000+'),
('stat_destinations', '50+'),
('stat_years', '10+')
ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value);");

echo "Packages & Destinations migration completed successfully.\n";
