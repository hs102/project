<?php
require 'connection.php';

// Fetch open polls from the database
// Assuming you have a table named 'polls' with columns 'id', 'title', 'status', 'end_date', etc.
$query = "SELECT * FROM polls WHERE status = 'open'";
$stmt = $pdo->query($query);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<li><a href='view_poll.php?id={$row['id']}'>{$row['title']}</a></li>";
}
?>