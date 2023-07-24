<?php
// Database configuration
$host = "localhost"; // e.g., localhost
$username = "root"; // e.g., root
$password = "";
$database = "renthub";
$user_id = $_SESSION['user_id'];

try {
    // Create a PDO database connection
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
