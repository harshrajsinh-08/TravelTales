<?php
session_start();

$host = "localhost";
$dbname = "traveltales";
$user = "postgres";
$pass = "";

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$pass");
if (!$conn) die("Database connection failed");

// Validate POST
if (empty($_POST['email']) || empty($_POST['password'])) {
    header("Location: login.php?error=empty");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$result = pg_query_params($conn, "SELECT * FROM users WHERE email = $1", [$email]);
$userData = pg_fetch_assoc($result);

if ($userData && password_verify($password, $userData['password'])) {
    $_SESSION['user'] = $userData['email'];
    header("Location: index.php");
    exit();
} else {
    header("Location: login.php?error=invalid");
    exit();
}
?>