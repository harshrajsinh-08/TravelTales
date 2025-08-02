<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$userEmail = $_SESSION['user'];

// Fetch current user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$userEmail]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $badgesInput = $_POST['badges'] ?? '';

    // Convert comma-separated badges to PostgreSQL array format
    $badgesArray = array_map('trim', explode(',', $badgesInput));
    $badgesPgArray = '{' . implode(',', array_map(fn($b) => '"' . $b . '"', $badgesArray)) . '}';

    // Handle profile picture upload
    $profilePic = $user['profile_pic'] ?? 'default.jpg';
    if (!empty($_FILES['profile_pic']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

        $fileName = uniqid() . "_" . basename($_FILES['profile_pic']['name']);
        $targetFile = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
            $profilePic = $targetFile;
        } else {
            die("File upload failed. Check permissions of the uploads/ folder.");
        }
    }

    // Update user data
    $stmt = $pdo->prepare("UPDATE users 
                           SET name = ?, bio = ?, badges = ?, profile_pic = ? 
                           WHERE email = ?");
    $stmt->execute([$name, $bio, $badgesPgArray, $profilePic, $userEmail]);

    header("Location: profile.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile - TravelTales</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  <style>
    body { font-family: "Poppins", sans-serif; }
  </style>
</head>
<body class="bg-gray-50">

<!-- Navbar -->
<nav class="fixed w-full bg-white/90 backdrop-blur-md z-50 shadow-sm">
  <div class="container mx-auto px-4 py-4 flex justify-between items-center">
    <div class="text-2xl font-bold text-orange-500">TravelTales</div>
    <div class="hidden md:flex space-x-6">
      <a href="explore.html" class="nav-link">Explore</a>
      <a href="blogs.php" class="nav-link">Blog</a>
      <a href="index.php#plan-trip" class="nav-link">My Trips</a>
      <a href="profile.php" class="nav-link text-orange-500 font-semibold">Profile</a>
    </div>
    <div class="flex items-center space-x-4">
      <span class="text-sm text-gray-600"><?= htmlspecialchars($userEmail) ?></span>
      <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
        Logout
      </a>
    </div>
  </div>
</nav>

<!-- Edit Profile Form -->
<section class="container mx-auto px-4 py-32">
  <h2 class="text-3xl font-bold mb-8">Edit Profile</h2>
  <form action="" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-md p-6 max-w-xl mx-auto space-y-6">

    <!-- Profile Picture -->
    <div>
      <label class="block font-semibold mb-2">Profile Picture</label>
      <img src="<?= htmlspecialchars($user['profile_pic'] ?? 'https://via.placeholder.com/150') ?>" 
           alt="Profile Picture" class="h-24 w-24 rounded-full mb-3 object-cover border-4 border-orange-500"/>
      <input type="file" name="profile_pic" class="block w-full text-sm text-gray-600"/>
    </div>

    <!-- Name -->
    <div>
      <label class="block font-semibold mb-2">Name</label>
      <input type="text" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" class="w-full px-4 py-2 border rounded-lg"/>
    </div>

    <!-- Bio -->
    <div>
      <label class="block font-semibold mb-2">Bio</label>
      <textarea name="bio" rows="3" class="w-full px-4 py-2 border rounded-lg"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
    </div>

    <!-- Badges -->
    <div>
      <label class="block font-semibold mb-2">Badges (comma-separated)</label>
      <input type="text" name="badges" value="<?= htmlspecialchars(implode(', ', (array)($user['badges'] ?? []))) ?>" class="w-full px-4 py-2 border rounded-lg"/>
    </div>

    <!-- Buttons -->
    <div class="flex justify-between items-center">
      <div>
        <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition">
          Save Changes
        </button>
        <a href="profile.php" class="ml-4 text-gray-600 hover:underline">Back to Profile</a>
      </div>
      <a href="index.php" class="text-orange-500 hover:underline">Back to Home</a>
    </div>
  </form>
</section>

</body>
</html>