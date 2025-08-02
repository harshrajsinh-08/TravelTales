<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

$userEmail = $_SESSION['user'];

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$userEmail]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch user trips
$stmt = $pdo->prepare("SELECT * FROM trips WHERE user_email = ? ORDER BY start_date ASC");
$stmt->execute([$userEmail]);
$trips = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Profile - TravelTales</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Poppins", sans-serif;
            scroll-behavior: smooth;
        }

        .badge {
            background-color: #f97316;
            color: white;
            font-size: 12px;
            font-weight: bold;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            display: inline-block;
        }
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
                <a href="about.php" class="nav-link">About</a>
                <a href="contact.php" class="nav-link">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600"><?= htmlspecialchars($userEmail) ?></span>
                <a href="logout.php"
                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <section id="profile-section" class="container mx-auto px-4 py-32">
        <h2 class="text-3xl font-bold mb-8">My Profile</h2>
        <div class="bg-white rounded-xl shadow-md p-6 flex flex-col md:flex-row gap-6">

            <!-- Profile Picture -->
            <div class="flex-shrink-0">
                <img src="<?= htmlspecialchars($user['profile_pic'] ?? 'https://via.placeholder.com/150') ?>"
                    alt="Profile Picture" class="h-32 w-32 rounded-full object-cover border-4 border-orange-500" />
            </div>

            <!-- Profile Details -->
            <div>
                <h3 class="text-2xl font-bold">
                    <?= htmlspecialchars($user['name'] ?? $userEmail) ?>
                </h3>
                <p class="text-gray-600">
                    <?= htmlspecialchars($user['bio'] ?? "Traveler exploring India!") ?>
                </p>

                <!-- Badges -->
                <div class="mt-4">
                    <?php
                    $badges = explode(',', $user['badges'] ?? 'Explorer,Photographer,Foodie');
                    foreach ($badges as $badge): ?>
                        <span class="badge"><?= htmlspecialchars(trim($badge)) ?></span>
                    <?php endforeach; ?>
                </div>

                <!-- Upcoming Trips -->
                <div class="mt-6">
                    <h4 class="text-xl font-bold mb-2">Upcoming Trips</h4>
                    <ul class="list-disc ml-6 text-gray-600">
                        <?php if ($trips && count($trips) > 0): ?>
                            <?php foreach ($trips as $trip): ?>
                                <li>
                                    <?= htmlspecialchars($trip['destination']) ?>
                                    (<?= date('F j, Y', strtotime($trip['start_date'])) ?>)
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No trips added yet.</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Edit Profile Button -->
                <div class="mt-6 flex gap-4">
                    <a href="index.php"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg transition">
                        ← Back to Home
                    </a>
                    <a href="edit-profile.php"
                        class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-lg transition">
                        ✏ Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </section>

</body>

</html>