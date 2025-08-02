<?php
$host = "localhost";
$port = "5432"; 
$dbname = "traveltales";
$user = "postgres";
$pass = ""; 

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname;options='--client_encoding=UTF8'",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>