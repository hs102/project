<?php
// Database configuration
$host = 'localhost';
$dbName = 'pollify';
$username = 'root';
$password = '';

try {
    $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}
?>