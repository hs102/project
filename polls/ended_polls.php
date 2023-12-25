<?php
require 'connection.php';

// Fetch ended polls from the database
$query = "SELECT * FROM polls WHERE status = 'ended'";
// Execute the query and fetch the results
$stmt = $pdo->query($query);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<li><a class='form-link' href='view_results.php?id={$row['id']}'>{$row['title']}</a></li>";
}
?>