<?php
session_start();
require 'db.php';

// Fetch all blogs from the database
$stmt = $pdo->query("SELECT * FROM blogs ORDER BY created_at DESC");
$blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);

$userEmail = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Travel Blogs - TravelTales</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: "Poppins", sans-serif; scroll-behavior: smooth; }
    .nav-link:hover { color: #f97316; transition: color 0.3s ease; }
  </style>
</head>
<body class="bg-gray-50">

<!-- Navbar -->
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
        <a href="blogs.php" class="nav-link text-orange-500 font-semibold">Blog</a>
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

<!-- JS to Toggle Mobile Menu -->
<script>
  const toggleBtn = document.getElementById('mobile-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');

  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });
</script>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Blogs Section -->
<main class="pt-32 container mx-auto px-4 lg:px-20">
  <h1 class="text-4xl font-bold text-gray-900 mb-6 text-center">🌍 Travel Blogs</h1>

  <!-- Add Blog Button for Logged-in Users -->
  <?php if ($userEmail): ?>
    <div class="text-center mb-10">
      <a href="add-blog.php" 
         class="inline-block bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition">
        ➕ Add New Blog
      </a>
      <a href="index.php" class="inline-block bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold shadow-md transition">
        ← Back to Home
      </a>
    </div>
  <?php endif; ?>

  <!-- Blog Grid -->
  <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

    <?php if ($blogs): ?>
      <?php foreach ($blogs as $blog): ?>
        <div class="bg-white rounded-xl shadow-md overflow-hidden transition hover:shadow-lg">
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
              <?= htmlspecialchars(substr($blog['content'], 0, 120)) ?>...
            </p>
            <a href="view-blog.php?id=<?= $blog['id'] ?>" 
               class="text-orange-500 font-semibold hover:underline mt-3 inline-block">
              Read More →
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-gray-600 text-center col-span-3">No blogs available yet.</p>
    <?php endif; ?>

  </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-12 mt-16">
  <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-4 gap-8">
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
</footer>

</body>
</html>