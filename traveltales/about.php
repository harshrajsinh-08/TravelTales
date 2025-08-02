<?php
session_start();
require 'db.php';

$userEmail = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About - TravelTales</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: "Poppins", sans-serif; }
    .nav-link:hover { color: #f97316; transition: color 0.3s ease; }
  </style>
</head>
<body class="bg-gray-50">

<!-- Navbar -->
<nav class="fixed w-full bg-white/90 backdrop-blur-md z-50 shadow-sm">
  <div class="container mx-auto px-4 py-4 flex justify-between items-center">
    <div class="text-2xl font-bold text-orange-500">TravelTales</div>
    <div class="hidden md:flex space-x-6">
      <a href="index.php" class="nav-link">Home</a>
      <a href="blogs.php" class="nav-link">Blog</a>
      <a href="index.php#plan-trip" class="nav-link">My Trips</a>
      <a href="profile.php" class="nav-link">Profile</a>
      <a href="about.php" class="nav-link text-orange-500 font-semibold">About</a>
      <a href="contact.php" class="nav-link">Contact</a>
    </div>
    <?php if ($userEmail): ?>
    <div class="flex items-center space-x-4">
      <span class="text-sm text-gray-600"><?= htmlspecialchars($userEmail) ?></span>
      <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
        Logout
      </a>
    </div>
    <?php else: ?>
      <a href="login.html" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg text-sm transition">
        Login
      </a>
    <?php endif; ?>
  </div>
</nav>

<!-- About Section -->
<section class="container mx-auto px-4 py-32">
  <h1 class="text-4xl font-bold mb-6 text-center">About TravelTales</h1>
  <p class="text-lg text-gray-600 mb-12 max-w-3xl mx-auto text-center">
    TravelTales is a community-driven platform where travelers share their unique experiences, 
    discover hidden gems across India, and inspire others to explore new destinations. 
    Our mission is to bring authentic travel stories to life and connect passionate explorers.
  </p>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-12 max-w-5xl mx-auto">
    <div class="bg-white shadow-lg rounded-xl p-6 text-center">
      <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=400" 
           alt="Founder 1" class="h-32 w-32 rounded-full mx-auto mb-4 object-cover border-4 border-orange-500"/>
      <h3 class="text-xl font-bold mb-2">Harshrajsinh Zala</h3>
      <p class="text-gray-600">Founder & Lead Developer</p>
      <p class="mt-3 text-gray-500 text-sm">
        Harshrajsinh is passionate about building travel communities 
        and creating seamless platforms for explorers to share their journeys.
      </p>
    </div>

    <div class="bg-white shadow-lg rounded-xl p-6 text-center">
      <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400" 
           alt="Founder 2" class="h-32 w-32 rounded-full mx-auto mb-4 object-cover border-4 border-orange-500"/>
      <h3 class="text-xl font-bold mb-2">Co-Founder</h3>
      <p class="text-gray-600">Community & Content Head</p>
      <p class="mt-3 text-gray-500 text-sm">
        The co-founder focuses on engaging travelers, curating authentic content, 
        and growing the TravelTales community across India.
      </p>
    </div>
  </div>

  <div class="text-center mt-16">
    <a href="index.php" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition">
      ← Back to Home
    </a>
  </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800 text-white py-12 mt-20">
  <div class="container mx-auto px-4 text-center">
    <p class="text-gray-400">© <?= date('Y') ?> TravelTales. All rights reserved.</p>
  </div>
</footer>

</body>
</html>