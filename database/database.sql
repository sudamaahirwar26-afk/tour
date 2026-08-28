-- =======================================================
-- Serenity Planners & Parth Trip - Complete Database Dump
-- Compatible with MySQL 8.0+ / MariaDB 10.4+
-- Generated At: 2026-08-26 21:57:42
-- =======================================================

CREATE DATABASE IF NOT EXISTS `serenity_events` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `serenity_events`;

SET FOREIGN_KEY_CHECKS = 0;

-- -------------------------------------------------------
-- Table structure for `admins`
-- -------------------------------------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('superadmin','admin','manager') DEFAULT 'admin',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `admins`
INSERT INTO `admins` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`, `updated_at`) VALUES
('1', 'Serenity Lead Planner', 'admin@serenityplanners.com', '$2y$10$BpKgXIYBCHiZUL/hmyy1c.37/aWX1/E.qxLHgX0CLxfbFZhfa5fsG', 'superadmin', '2026-08-26 22:01:45', '2026-08-26 22:09:05');

-- -------------------------------------------------------
-- Table structure for `packages`
-- -------------------------------------------------------
DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `destination` varchar(150) NOT NULL,
  `duration` varchar(100) NOT NULL,
  `group_size` varchar(100) DEFAULT '1 - 8 People',
  `price` varchar(100) NOT NULL,
  `original_price` varchar(100) DEFAULT NULL,
  `badge` varchar(50) DEFAULT 'Trending',
  `reviews_count` int(11) DEFAULT 5,
  `rating` decimal(2,1) DEFAULT 4.9,
  `short_description` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `featured` tinyint(1) DEFAULT 1,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `packages`
INSERT INTO `packages` (`id`, `title`, `slug`, `destination`, `duration`, `group_size`, `price`, `original_price`, `badge`, `reviews_count`, `rating`, `short_description`, `description`, `image`, `featured`, `status`, `created_at`) VALUES
('1', 'Jungle Walking Tour with Authentic Cultural Lunch', 'jungle-walking-tour-bangkok', 'Bangkok, Thailand', '2 Days / 1 Night', '1 - 8 People', '₹52,000', '₹65,000', 'Trending', '5', '4.9', 'Immerse in lush tropical rainforest trails, authentic local village gastronomy, and heritage temple stops.', 'Experience the hidden wilderness of Thailand accompanied by veteran local naturalist guides. This exclusive tour features private longtail river transport, canopy suspension bridges, wildlife sightings, and an authentic gourmet tribal luncheon prepared with fresh organic farm ingredients.', 'assets/images/portfolio-dest-1.jpg', '1', 'active', '2026-08-26 22:41:11'),
('2', 'Desert Adventure Safari with Royal Sunset Dinner', 'desert-adventure-safari-dubai', 'Dubai, UAE', '3 Days / 2 Nights', '2 - 12 People', '₹34,000', '₹45,000', 'Popular', '8', '5.0', 'Luxury dune bashing, Arabian falconry, private Bedouin tent dinner, and star-gazing experience.', 'Traverse golden crimson dunes in custom 4x4 luxury vehicles followed by quad biking, camel trekking, and a 5-star open-sky Arabian barbecue dinner featuring fire dancers, live oud music, and celestial stargazing.', 'assets/images/portfolio-corp-2.jpg', '1', 'active', '2026-08-26 22:41:11'),
('3', 'Scenic Nature Journey with Delicious Picnic Basket', 'scenic-nature-journey-switzerland', 'Lake Como & Alps, Italy', '5 Days / 4 Nights', '2 - 10 People', '₹1,22,000', '₹1,45,000', 'Luxury Pick', '12', '5.0', 'Lakeside vintage Riva boat cruise, alpine funicular train, and sommelier vineyard wine tasting.', 'A dream European escape along Lake Como and the Swiss-Italian Alps. Enjoy private villa tours, bespoke champagne cruises, artisanal cheese tastings, and scenic mountain lookout banquets with private concierge accompaniment.', 'assets/images/dest-como.jpg', '1', 'active', '2026-08-26 22:41:11'),
('4', 'Bangkok Urban Green Spaces & Floating Market Tour', 'bangkok-urban-green-spaces', 'Bangkok, Thailand', '1 Day / Full Day', '1 - 6 People', '₹12,000', '₹16,000', '-25% Off', '6', '4.8', 'Eco-friendly electric canal boats, organic rooftop gardens, and historic Chinatown street food.', 'Discover the sustainable and green soul of Bangkok. Glide through tranquil canal networks, explore sacred pagoda gardens, and taste Michelin-guide recognized street delicacies curated by culinary historians.', 'assets/images/service-destination.jpg', '1', 'active', '2026-08-26 22:41:11'),
('5', 'Royal Rajasthan Heritage & Desert Palace Expedition', 'royal-rajasthan-heritage-palace', 'Udaipur & Jaipur, India', '6 Days / 5 Nights', '2 - 15 People', '₹40,000', '₹1,00,000', 'Super Deal', '15', '5.0', 'Stay in royal 5-star palace heritage hotels, vintage car rides, and regal evening musical courtyards.', 'Live like royalty across Udaipur\'s lake palaces and Jaipur\'s amber fortresses. Package includes private chauffeured luxury transport, royal banquet dinners, private museum access, and folk performances under the stars.', 'assets/images/dest-udaipur.jpg', '1', 'active', '2026-08-26 22:41:11'),
('6', 'Full-Day Coastal Hiking & Marine Yacht Adventure', 'full-day-coastal-yacht-adventure', 'Goa & Arabian Sea, India', '4 Days / 3 Nights', '2 - 8 People', '₹56,000', '₹70,000', 'Trending', '7', '4.9', 'Private catamaran sail, hidden waterfall trek, coastal seafood grill, and sunset dolphin cruise.', 'Explore the unspoiled coastal beauty of Southern Goa and the Arabian Sea. Charter a private twin-hull catamaran, snorkel in vibrant coral reefs, and savor fresh catch barbecue on a secluded beach.', 'assets/images/dest-goa.jpg', '1', 'active', '2026-08-26 22:41:11');

-- -------------------------------------------------------
-- Table structure for `destinations`
-- -------------------------------------------------------
DROP TABLE IF EXISTS `destinations`;
CREATE TABLE `destinations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `tour_count` varchar(50) NOT NULL DEFAULT '05 Tours',
  `tagline` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `destinations`
INSERT INTO `destinations` (`id`, `name`, `slug`, `tour_count`, `tagline`, `image`, `sort_order`, `status`, `created_at`) VALUES
('1', 'Thailand', 'thailand', '07 Tours', 'Tropical islands, floating markets, and emerald temples', 'assets/images/service-destination.jpg', '1', 'active', '2026-08-26 22:41:11'),
('2', 'India', 'india', '12 Tours', 'Royal palaces, sacred ghats, and backwater lagoons', 'assets/images/dest-udaipur.jpg', '2', 'active', '2026-08-26 22:41:11'),
('3', 'Switzerland & Italy', 'switzerland-italy', '08 Tours', 'Alpine peaks, scenic rail journeys, and Lake Como villas', 'assets/images/dest-como.jpg', '3', 'active', '2026-08-26 22:41:11'),
('4', 'Dubai & UAE', 'dubai-uae', '05 Tours', 'Futuristic skylines, desert dunes, and mega luxury resorts', 'assets/images/dest-dubai.jpg', '4', 'active', '2026-08-26 22:41:11'),
('5', 'Goa & Coastal Escapes', 'goa-coastal', '06 Tours', 'Sun-drenched beaches, luxury catamarans, and nightlife', 'assets/images/dest-goa.jpg', '5', 'active', '2026-08-26 22:41:11'),
('6', 'Canada & Rocky Mountains', 'canada', '04 Tours', 'Glacier lakes, national parks, and vibrant cities', 'assets/images/about-img.jpg', '6', 'active', '2026-08-26 22:41:11');

-- -------------------------------------------------------
-- Table structure for `services`
-- -------------------------------------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `slug` varchar(150) NOT NULL,
  `short_description` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `icon` varchar(100) DEFAULT 'fa-sparkles',
  `featured` tinyint(1) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `sort_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `services`
INSERT INTO `services` (`id`, `title`, `slug`, `short_description`, `description`, `image`, `icon`, `featured`, `status`, `sort_order`, `created_at`, `updated_at`) VALUES
('1', 'Wedding Planning', 'wedding-planning', 'Comprehensive royal and bespoke wedding design, hospitality, guest management, and day-of execution.', 'From lavish floral mandaps and bridal suites to Michelin-star gourmet banquets and world-class entertainment, our wedding planners oversee every intricate chapter of your special celebration. We handle venue scouting, vendor curation, stage design, couture styling coordination, sound & lighting, and bespoke hospitality to ensure you revel in every magical moment.', 'assets/images/service-wedding.jpg', 'rings-wedding', '1', 'active', '1', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('2', 'Corporate Events', 'corporate-events', 'High-impact business summits, award galas, brand launches, and executive retreats executed with precision.', 'Elevate your brand authority with meticulously produced corporate experiences. Serenity Planners delivers end-to-end technical production, keynote staging, VIP hospitality, interactive keynote pavilions, and seamless delegate management tailored to reinforce your corporate identity.', 'assets/images/service-corporate.jpg', 'briefcase', '1', 'active', '2', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('3', 'Destination Events', 'destination-events', 'Turnkey international destination planning across exotic palaces, private islands, and luxury resorts.', 'Whether saying \"I do\" overlooking the Amalfi coast, hosting a private gala in Lake Como, or orchestrating a royal desert retreat in Rajasthan, our destination logistics specialists manage chartered travel, luxury concierge bookings, bilingual coordination, and multi-day festivities flawlessly.', 'assets/images/service-destination.jpg', 'globe', '1', 'active', '3', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('4', 'Private & Milestone Events', 'private-events', 'Exclusive anniversary celebrations, milestone birthdays, and private soirees with bespoke artistry.', 'Celebrate life\'s landmark chapters in supreme privacy and style. We tailor customized luxury themes, private chef dining experiences, sensory ambience, and custom musical performances that reflect your unique narrative.', 'assets/images/service-private.jpg', 'sparkles', '1', 'active', '4', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('5', 'Social & Cultural Galas', 'social-events', 'Thematic charity balls, cultural festivals, cocktail receptions, and festive gatherings of distinction.', 'We bring vibrancy and creative distinction to every social gathering. From heritage cultural galas to glamorous red-carpet fundraisers, our artistic directors curate atmospheric decor, immersive entertainment, and flawless guest experiences.', 'assets/images/service-social.jpg', 'glass-cheers', '1', 'active', '5', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('6', 'Decor & Production Design', 'decor-production-design', 'Avant-garde spatial architecture, bespoke floral installations, immersive lighting, and 3D stagecraft.', 'Our in-house design studio turns bare venues into breathtaking dreamscapes with custom carpentry, structural florals, ambient chandeliers, 3D projection mapping, and intelligent architectural illumination.', 'assets/images/service-decor.jpg', 'paint-brush', '1', 'active', '6', '2026-08-26 22:01:45', '2026-08-26 22:01:45');

-- -------------------------------------------------------
-- Table structure for `portfolio`
-- -------------------------------------------------------
DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE `portfolio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `category` enum('wedding','corporate','destination','private','social') NOT NULL DEFAULT 'wedding',
  `client_name` varchar(150) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `portfolio`
INSERT INTO `portfolio` (`id`, `title`, `category`, `client_name`, `event_date`, `location`, `description`, `image`, `featured`, `status`, `created_at`, `updated_at`) VALUES
('1', 'The Royal Grandeur Palace Wedding', 'wedding', 'Siddharth & Ananya', '2025-12-14', 'Udaipur City Palace', 'A grand 3-day royal heritage celebration with 500+ guests, featuring majestic floral pavilions, floating candle banquet setups, and traditional fireworks.', 'assets/images/portfolio-wedding-1.jpg', '1', 'active', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('2', 'Tech Global Innovation Summit & Gala', 'corporate', 'Apex Global Technologies', '2026-02-18', 'San Francisco Convention Center', 'Full-scale stage production, futuristic LED interactive tunnels, keynote audiovisuals, and a black-tie executive award gala for 1,200 attendees.', 'assets/images/portfolio-corp-1.jpg', '1', 'active', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('3', 'Amalfi Coast Cliffside Destination Nuptials', 'destination', 'Julian & Claire', '2025-09-22', 'Positano, Italy', 'Breathtaking coastal sunset vows followed by an intimate 7-course Mediterranean dinner with acoustic symphony strings under cascading wisteria.', 'assets/images/portfolio-dest-1.jpg', '1', 'active', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('4', 'Opulent 50th Golden Jubilee Soirée', 'private', 'The Sterling Family', '2026-01-10', 'Beverly Hills Private Estate', 'An immersive Gatsby-inspired golden soiree with custom crystal chandeliers, vintage jazz orchestra, and bespoke mixology bars.', 'assets/images/portfolio-private-1.jpg', '1', 'active', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('5', 'Metropolitan Charity Masquerade Ball', 'social', 'Heritage Foundation', '2025-11-05', 'Metropolitan Grand Ballroom', 'A prestigious fundraising gala hosting 650 philanthropists with theatrical aerial performers, live orchestral suites, and gold-leaf decor.', 'assets/images/portfolio-social-1.jpg', '1', 'active', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('6', 'Riviera Sun-Drenched Beachfront Wedding', 'wedding', 'Marcus & Elena', '2025-08-15', 'French Riviera, Nice', 'Chic coastal elegance featuring bohemian-luxury draped cabanas, oyster & champagne bar, and midnight fireworks over the Mediterranean.', 'assets/images/portfolio-wedding-2.jpg', '1', 'active', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('7', 'NextGen EV Luxury Auto Launch', 'corporate', 'Vanguard Motors', '2026-03-04', 'Dubai World Trade Centre', 'Spectacular robotic vehicle unveil with 360-degree laser mapping, holographic visuals, and international press banquet.', 'assets/images/portfolio-corp-2.jpg', '1', 'active', '2026-08-26 22:01:45', '2026-08-26 22:01:45'),
('8', 'Lake Como Villa Renaissance Vows', 'destination', 'Alexander & Vivienne', '2025-10-08', 'Villa Balbiano, Lake Como', 'A timeless Italian lakeside gathering featuring vintage wooden Riva boat arrival, Renaissance floral arches, and candlelit courtyard feast.', 'assets/images/portfolio-dest-2.jpg', '1', 'active', '2026-08-26 22:01:45', '2026-08-26 22:01:45');

-- -------------------------------------------------------
-- Table structure for `testimonials`
-- -------------------------------------------------------
DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(150) NOT NULL,
  `client_role` varchar(150) DEFAULT NULL,
  `event_type` varchar(100) NOT NULL,
  `rating` tinyint(4) NOT NULL DEFAULT 5,
  `message` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('published','draft') DEFAULT 'published',
  `sort_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `testimonials`
INSERT INTO `testimonials` (`id`, `client_name`, `client_role`, `event_type`, `rating`, `message`, `image`, `status`, `sort_order`, `created_at`) VALUES
('1', 'Eleanor & Marcus Vance', 'Bride & Groom', 'Destination Wedding in Lake Como', '5', 'Serenity Planners gave us the wedding of our dreams. From handling 180 international guests to the mind-blowing floral architecture, everything was executed with unbelievable perfection. We did not stress for a single second!', 'assets/images/testimonial-1.jpg', 'published', '1', '2026-08-26 22:01:45'),
('2', 'David Sterling', 'VP Corporate Communications, Apex Group', 'Annual Executive Global Summit', '5', 'Flawless execution from concept to the final keynote. Serenity Planners transformed a complex multi-track conference and awards gala into our most acclaimed company event to date. Highly recommended for enterprise scale.', 'assets/images/testimonial-2.jpg', 'published', '2', '2026-08-26 22:01:45'),
('3', 'Natasha & Kabir Mehta', 'Hosts', '3-Day Royal Palace Celebration', '5', 'Their attention to detail and hospitality management is unmatched. The stage decor, celebrity artists, and guest coordination were world-class. Serenity Planners truly turns dreams into reality.', 'assets/images/testimonial-3.jpg', 'published', '3', '2026-08-26 22:01:45'),
('4', 'Sophia Lorenzi', 'Founder, Horizon Foundation', 'Charity Autumn Gala', '5', 'Working with the Serenity Planners team was an absolute delight. They brought our vision for our annual charity gala to life with sophistication, elegance, and remarkable financial prudence.', 'assets/images/testimonial-4.jpg', 'published', '4', '2026-08-26 22:01:45');

-- -------------------------------------------------------
-- Table structure for `enquiries`
-- -------------------------------------------------------
DROP TABLE IF EXISTS `enquiries`;
CREATE TABLE `enquiries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `event_date` date DEFAULT NULL,
  `guest_count` int(11) DEFAULT NULL,
  `budget_range` varchar(100) DEFAULT NULL,
  `event_location` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `status` enum('new','contacted','in_progress','converted','closed') DEFAULT 'new',
  `admin_notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- Table structure for `contact_messages`
-- -------------------------------------------------------
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `status` enum('unread','read','replied') DEFAULT 'unread',
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idx_status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -------------------------------------------------------
-- Table structure for `site_settings`
-- -------------------------------------------------------
DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `site_settings`
INSERT INTO `site_settings` (`id`, `setting_key`, `setting_value`, `updated_at`) VALUES
('1', 'company_name', 'Serenity Planners', '2026-08-26 22:01:45'),
('2', 'tagline', 'Bespoke Luxury Events & Celebrations', '2026-08-26 22:01:45'),
('3', 'email', 'concierge@serenityplanners.com', '2026-08-26 22:01:45'),
('4', 'phone', '+1 (800) 589-3281', '2026-08-26 22:01:45'),
('5', 'alt_phone', '+1 (555) 924-8172', '2026-08-26 22:01:45'),
('6', 'address', '742 Luxury Boulevard, Suite 500, Beverly Hills, CA 90210', '2026-08-26 22:01:45'),
('7', 'business_hours', 'Mon - Sat: 9:00 AM - 7:00 PM | Sun: By Appointment', '2026-08-26 22:01:45'),
('8', 'hero_headline', 'Plan. Create. Celebrate.', '2026-08-26 22:01:45'),
('9', 'hero_subtitle', 'Creating unforgettable luxury experiences that deserve to be remembered forever.', '2026-08-26 22:01:45'),
('10', 'about_heading', 'Turning Ideas Into Unforgettable Experiences', '2026-08-26 22:01:45'),
('11', 'about_text', 'At Serenity Planners, we curate extraordinary, tailor-made luxury events across the globe. From lavish destination weddings to high-profile corporate galas, our team transforms your visionary concepts into immaculate, sensory-rich realities with meticulous attention to detail.', '2026-08-26 22:01:45'),
('12', 'stat_events', '150+', '2026-08-26 22:01:45'),
('13', 'stat_corporate', '50+', '2026-08-26 22:01:45'),
('14', 'stat_clients', '100+', '2026-08-26 22:01:45'),
('15', 'stat_years', '10+', '2026-08-26 22:41:11'),
('16', 'facebook_url', 'https://facebook.com/serenityplanners', '2026-08-26 22:01:45'),
('17', 'instagram_url', 'https://instagram.com/serenityplanners', '2026-08-26 22:01:45'),
('18', 'linkedin_url', 'https://linkedin.com/company/serenityplanners', '2026-08-26 22:01:45'),
('19', 'pinterest_url', 'https://pinterest.com/serenityplanners', '2026-08-26 22:01:45'),
('20', 'footer_text', 'Serenity Planners is an internationally acclaimed luxury event management agency crafting bespoke weddings, corporate summits, and milestone celebrations worldwide.', '2026-08-26 22:01:45'),
('21', 'group_companies', 'Parth Planners, Pathik Planners, Ziva Planner, Ziva Tourism LLC Dubai, Incubival', '2026-08-26 22:41:11'),
('22', 'company_since', '2016', '2026-08-26 22:41:11'),
('23', 'stat_travelers', '5000+', '2026-08-26 22:41:11'),
('24', 'stat_destinations', '50+', '2026-08-26 22:41:11');

SET FOREIGN_KEY_CHECKS = 1;
