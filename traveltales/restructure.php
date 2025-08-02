<?php
$folders = [
    'auth', 
    'includes', 
    'assets/css', 
    'assets/js', 
    'assets/images', 
    'assets/uploads', 
    'data', 
    'trip-planner'
];

// Create folders
foreach ($folders as $folder) {
    if (!is_dir($folder)) mkdir($folder, 0777, true);
}

// Move files to new structure
rename('db.php', 'includes/db.php');
rename('auth.php', 'includes/auth.php');
rename('navbar.js', 'assets/js/navbar.js');
rename('trip-planner.js', 'trip-planner/trip-planner.js');
rename('css', 'assets/css');
rename('js', 'assets/js');
rename('images', 'assets/images');
rename('uploads', 'assets/uploads');
rename('blogs.json', 'data/blogs.json');
rename('stories.json', 'data/stories.json');
rename('featured-stories.html', 'data/featured-stories.html');

// Auth files
rename('login.php', 'auth/login.php');
rename('signup.php', 'auth/signup.php');
rename('logout.php', 'auth/logout.php');

// Remove old .html login/signup if not needed or move for reference
rename('login.html', 'auth/login.html');
rename('signup.html', 'auth/signup.html');

echo "✅ Restructure complete!";
?>