<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

$conn = pg_connect("host=localhost dbname=traveltales user=postgres password=yourpassword");

if (!$conn) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$city = strtolower(trim($_GET['city'] ?? ''));
if ($city === '') {
    echo json_encode(["error" => "City is required"]);
    exit;
}

// Fetch attractions + city info (assuming we have a city_info table)
$result = pg_query_params(
    $conn,
    "SELECT 
        a.name, a.price_range, a.city_image,
        c.how_to_reach, c.nearest_station, c.nearest_airport
     FROM attractions a
     LEFT JOIN city_info c ON LOWER(a.city) = LOWER(c.city)
     WHERE LOWER(a.city) = $1",
    [$city]
);

if (!$result) {
    echo json_encode(["error" => "Query failed"]);
    exit;
}

$rows = pg_fetch_all($result);
if (!$rows) {
    echo json_encode(["city_image" => null, "attractions" => []]);
    exit;
}

// Prepare structured JSON
$cityImage = $rows[0]['city_image'] ?? null;
$howToReach = $rows[0]['how_to_reach'] ?? null;
$nearestStation = $rows[0]['nearest_station'] ?? null;
$nearestAirport = $rows[0]['nearest_airport'] ?? null;

$attractions = array_map(function($row) {
    return [
        "name" => $row['name'],
        "price_range" => $row['price_range']
    ];
}, $rows);

echo json_encode([
    "city_image" => $cityImage,
    "attractions" => $attractions,
    "how_to_reach" => $howToReach,
    "nearest_station" => $nearestStation,
    "nearest_airport" => $nearestAirport
]);
?>