<?php
session_start();
require 'db.php';

// Redirect if user not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$userEmail = $_SESSION['user'];

// Fetch latest 3 blogs
$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC LIMIT 3");
$latestBlogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch logged-in user profile
$stmtUser = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmtUser->execute([$userEmail]);
$user = $stmtUser->fetch(PDO::FETCH_ASSOC);

$profilePic = $user['profile_pic'] ?? 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=1024&auto=format&fit=crop';
$userName = $user['name'] ?? 'Traveler';
$userBio = $user['bio'] ?? 'Passionate about discovering India.';
$userBadges = $user['badges'] ?? [];

if (is_string($userBadges)) {
    // Remove curly braces and split by comma
    $userBadges = array_map('trim', explode(',', trim($userBadges, '{}')));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>TravelTales - Discover India</title>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"/>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: "Poppins", sans-serif; scroll-behavior: smooth; }
    .parallax-header { height: 70vh; background-image: url("https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd"); background-size: cover; background-position: center; }
    #map { height: 400px; width: 100%; border-radius: 1rem; }
    .nav-link:hover { color: #f97316; transition: color 0.3s ease; }
    .story-card:hover, .blog-card:hover { transform: translateY(-5px); transition: transform 0.3s ease; }
    .badge { background-color: #f97316; color: white; font-size: 12px; font-weight: bold; padding: 0.2rem 0.6rem; border-radius: 12px; display: inline-block; }
  </style>
</head>
<body class="bg-gray-50">
  <!-- Navbar -->
<nav class="fixed w-full bg-white/90 backdrop-blur-md z-50 shadow-sm">
  <div class="container mx-auto px-4 py-4">
    <div class="flex justify-between items-center">

      <!-- Logo -->
      <a href="index.php" class="text-2xl font-bold text-orange-500 hover:text-orange-600 transition">
        TravelTales
      </a>

      <!-- Desktop Menu -->
      <div class="hidden md:flex space-x-6 font-medium">
        <a href="explore.php" class="nav-link hover:text-orange-500 transition">Explore</a>
        <a href="blogs.php" class="nav-link hover:text-orange-500 transition">Blog</a>
        <a href="trip-planner.php" class="nav-link hover:text-orange-500 transition">My Trips</a>
        <a href="profile.php" class="nav-link hover:text-orange-500 transition">Profile</a>
        <a href="about.php" class="nav-link hover:text-orange-500 transition">About</a>
        <a href="contact.php" class="nav-link hover:text-orange-500 transition">Contact</a>
      </div>

      <!-- Right Buttons -->
      <div class="hidden md:flex items-center space-x-4">
        <?php if (!empty($userEmail)): ?>
          <span class="text-sm text-gray-600"><?= htmlspecialchars($userEmail) ?></span>
          <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
            Logout
          </a>
        <?php else: ?>
          <a href="login.html" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition">
            Login
          </a>
        <?php endif; ?>
      </div>

      <!-- Mobile Menu Button -->
      <button id="mobile-menu-toggle" class="md:hidden">
        <i class="bi bi-list text-2xl"></i>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden flex-col gap-4 px-4 py-6 mt-2 bg-white shadow-md rounded-lg">
      <a href="explore.php" class="nav-link text-gray-700">Explore</a>
      <a href="blogs.php" class="nav-link text-gray-700">Blog</a>
      <a href="trip-planner.php" class="nav-link text-gray-700">My Trips</a>
      <a href="profile.php" class="nav-link text-gray-700">Profile</a>
      <a href="about.php" class="nav-link text-gray-700">About</a>
      <a href="contact.php" class="nav-link text-gray-700">Contact</a>

      <?php if (!empty($userEmail)): ?>
        <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition w-full text-center">
          Logout
        </a>
      <?php else: ?>
        <a href="login.html" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition w-full text-center">
          Login
        </a>
      <?php endif; ?>
    </div>
  </div>
</nav>

  <!-- Hero Section -->
  <header class="parallax-header relative flex items-center justify-center">
    <div class="absolute inset-0 bg-black/40"></div>
    <div class="relative text-center text-white px-4">
      <h1 class="text-4xl md:text-6xl font-bold mb-6">Discover Incredible India</h1>
      <div class="max-w-3xl mx-auto">
        <div class="flex flex-col md:flex-row gap-2 relative">
          <div class="flex-1 relative">
            <input type="text" id="searchInput" placeholder="Where do you want to go in India?" class="w-full px-6 py-3 rounded-full text-gray-800"/>
            <div id="searchResults" class="absolute left-0 right-0 mt-1 bg-white rounded-lg shadow-lg overflow-hidden hidden z-10"></div>
          </div>
          <button onclick="handleSearch()" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full transition">
            Search
          </button>
        </div>
      </div>
    </div>
  </header>

  <!-- Featured Travel Stories Section -->
  <section id="featured-stories" class="container mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold mb-8">Featured Travel Stories</h2>
    <div id="stories-container" class="grid grid-cols-1 md:grid-cols-3 gap-8"></div>
  </section>

  <script>
  fetch('stories.json')
    .then(res => res.json())
    .then(stories => {
      const container = document.getElementById('stories-container');
      stories.forEach(story => {
        const card = document.createElement('div');
        card.className = "story-card bg-white rounded-xl shadow-md overflow-hidden transition";
        card.innerHTML = `
          <img src="${story.image}" class="h-48 w-full object-cover"/>
          <div class="p-6">
            <h3 class="font-bold text-xl mb-2">${story.title}</h3>
            <p class="text-gray-600">${story.summary}</p>
            <a href="story.php?id=${story.id}" class="text-orange-500 font-semibold hover:underline mt-3 inline-block">Read More →</a>
          </div>
        `;
        container.appendChild(card);
      });
    });
  </script>

  <!-- Blog Section -->
  <section id="blog-section" class="bg-gray-100 py-16">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold mb-8">Travel Blogs</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php if ($latestBlogs): ?>
          <?php foreach ($latestBlogs as $blog): ?>
            <div class="blog-card bg-white rounded-xl shadow-md overflow-hidden transition hover:shadow-lg">
              <?php if ($blog['image']): ?>
                <img src="<?= htmlspecialchars($blog['image']) ?>" 
                     alt="<?= htmlspecialchars($blog['title']) ?>" 
                     class="h-48 w-full object-cover"/>
              <?php endif; ?>
              <div class="p-6">
                <h3 class="font-bold text-xl mb-2"><?= htmlspecialchars($blog['title']) ?></h3>
                <p class="text-gray-600 text-sm mb-4">
                  By <?= htmlspecialchars($blog['author']) ?> • <?= date('F j, Y', strtotime($blog['created_at'])) ?>
                </p>
                <p class="text-gray-600 mb-4 line-clamp-3">
                  <?= htmlspecialchars(substr($blog['content'], 0, 100)) ?>...
                </p>
                <a href="view-blog.php?id=<?= $blog['id'] ?>" 
                   class="text-orange-500 font-semibold hover:underline mt-3 inline-block">
                   Read More →
                </a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <p class="text-gray-600 text-center col-span-3">No blogs yet. <a href="add-blog.php" class="text-orange-500 underline">Add one?</a></p>
        <?php endif; ?>
      </div>
      <div class="text-center mt-10">
        <a href="blogs.php" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition">
          View All Blogs →
        </a>
      </div>
    </div>
  </section>

  <!-- Dynamic Profile Section -->
  <section id="profile-section" class="container mx-auto px-4 py-16">
    <h2 class="text-3xl font-bold mb-8">My Profile</h2>
    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col md:flex-row gap-6">
      <div class="flex-shrink-0">
        <img src="<?= htmlspecialchars($profilePic) ?>" 
             alt="Profile Picture" 
             class="h-32 w-32 rounded-full object-cover border-4 border-orange-500"/>
      </div>
      <div class="flex-1">
        <h3 class="text-2xl font-bold"><?= htmlspecialchars($userName) ?></h3>
        <p class="text-gray-600"><?= htmlspecialchars($userBio) ?></p>
        <div class="mt-4">
          <?php if (!empty($userBadges)): ?>
            <?php foreach ($userBadges as $badge): ?>
              <span class="badge"><?= htmlspecialchars($badge) ?></span>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
        <div class="mt-4">
          <a href="profile.php" class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition">
            View Full Profile →
          </a>
        </div>
      </div>
    </div>
  </section>

  <!-- Plan Your Trip Section -->
  <section id="plan-trip" class="bg-gray-100 pt-12 pb-12">
    <div class="container mx-auto px-4">
      <h2 class="text-3xl font-bold mb-6">Plan Your Next Trip</h2>
      <div class="flex flex-col md:flex-row gap-4 mb-6">
        <input type="text" id="destinationInput" placeholder="Enter a city in India"
               class="flex-1 px-6 py-3 rounded-full border border-gray-300 text-gray-800"/>
        <button onclick="fetchTripData()" class="bg-orange-500 hover:bg-orange-600 text-white px-8 py-3 rounded-full transition">
          Show Attractions
        </button>
      </div>
      <div id="map" class="h-80 rounded-lg shadow hidden mb-8"></div>
      <div id="location-card" class="hidden opacity-0 bg-white rounded-xl shadow-md overflow-hidden transition-all duration-500 mb-6"></div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white py-12">
    <div class="container mx-auto px-4">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <h3 class="text-xl font-bold mb-4">TravelTales</h3>
          <p class="text-gray-400">Share your journey, inspire others.</p>
        </div>
        <div>
          <h4 class="font-bold mb-4">Quick Links</h4>
          <ul class="space-y-2">
            <li><a href="about.html" class="text-gray-400 hover:text-white">About Us</a></li>
            <li><a href="contact.html" class="text-gray-400 hover:text-white">Contact</a></li>
            <li><a href="privacy.html" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
          </ul>
        </div>
        <div>
          <h4 class="font-bold mb-4">Follow Us</h4>
          <div class="flex space-x-4">
            <a href="#" class="text-2xl hover:text-orange-500"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-2xl hover:text-orange-500"><i class="bi bi-twitter"></i></a>
            <a href="#" class="text-2xl hover:text-orange-500"><i class="bi bi-instagram"></i></a>
          </div>
        </div>
        <div>
          <h4 class="font-bold mb-4">Newsletter</h4>
          <form class="flex flex-col space-y-2">
            <input type="email" placeholder="Your email" class="px-4 py-2 rounded-lg text-gray-800"/>
            <button class="bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-lg transition">Subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="navbar.js"></script>
  <script src="trip-planner.js"></script>
</body>
</html>