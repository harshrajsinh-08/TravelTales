<?php
$host = "localhost";
$dbname = "traveltales";
$user = "postgres";
$pass = ""; // put your PostgreSQL password if required

$conn = pg_connect("host=$host dbname=$dbname user=$user password=$pass");

if (!$conn) {
    die("Database connection failed");
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Check if user already exists
$result = pg_query_params($conn, "SELECT * FROM users WHERE email = $1", [$email]);
if (pg_num_rows($result) > 0) {
    header("Location: signup.html?error=exists");
    exit();
}

// Insert new user
pg_query_params($conn, "INSERT INTO users (name, email, password) VALUES ($1, $2, $3)", [$name, $email, $password]);

header("Location: login.html?signup=success");
exit();
?>