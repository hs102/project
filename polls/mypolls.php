<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    header('Location: login.php');
    exit;
}

require 'connection.php';

// Get the user ID from the session
$userId = $_SESSION['uid'];

// Fetch polls created by the logged-in user
$query = "SELECT * FROM pollify.polls WHERE created_by = :userId";
$stmt = $pdo->prepare($query);
$stmt->execute(['userId' => $userId]);
$polls = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Include the navigation.php file using the correct relative path
include __DIR__ . '/../components/navigation.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Polls</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
        body {
            background: linear-gradient(135deg, #004aad, #cb6ce6);
            color: white;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        li {
            width: 23%;
            margin: 10px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            box-sizing: border-box;
            text-align: center;
        }

        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>My Polls</h1>

    <?php
    if ($polls) {
        echo "<ul>";
        foreach ($polls as $poll) {
            echo "<li>";
            echo "<h3>{$poll['title']}</h3>";
            
            echo "<a href='view_poll.php?id={$poll['id']}'>View Poll</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No polls created by you.</p>";
    }
    ?>

    <a href="/pollify/index.php">Go back</a>
</body>
</html>
