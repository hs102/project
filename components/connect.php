<?php
// connection detais of the current device
$host = "localhost";
$username = "u515027391_pollify";
$password = "Pollify@123";
$dbname = "u515027391_pollify";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
