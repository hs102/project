<?php
session_start(); // Start the session

require 'connection.php';

// Include the navigation bar
include '../components/navigation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Poll Title</title>

    <!-- Link the styles.css file -->
    <link rel="stylesheet" type="text/css" href="/pollify/css/viewpoll.css">
    
    <!-- Additional head elements if needed -->
</head>
<body>

<?php

// Check if the 'id' parameter is present in the URL
if (isset($_GET['id'])) {
    // Get the poll ID from the URL parameter
    $pollId = $_GET['id'];

    // Fetch the poll details from the database based on the ID using prepared statements
    $query = "SELECT * FROM pollify.polls WHERE id = :pollId";
    
    // Make sure $pdo is not null
    if ($pdo) {
        $stmt = $pdo->prepare($query);
        $stmt->execute(['pollId' => $pollId]);
        $poll = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($poll) {
            echo "<h1>{$poll['title']}</h1>";

            // Fetch the poll options from the database
            $optionsQuery = "SELECT * FROM pollify.options WHERE poll_id = :pollId";
            $optionsStmt = $pdo->prepare($optionsQuery);
            $optionsStmt->execute(['pollId' => $pollId]);
            $options = $optionsStmt->fetchAll(PDO::FETCH_ASSOC);

            // Check if the logged-in user is the creator of the poll
            $userId = isset($_SESSION['uid']) ? $_SESSION['uid'] : null; // Check if the session variable is set
            $isCreator = $userId == $poll['created_by'];

            // Display the poll options and allow the user to vote
            echo "<form action='vote.php' method='post'>";
            foreach ($options as $option) {
                echo "<input type='radio' name='option' value='{$option['id']}'> {$option['text']}<br>";
            }
            echo "<input type='hidden' name='poll_id' value='$pollId'>";

            // Disable the radio buttons and the "Vote" button if the poll is closed
            $isPollClosed = $poll['status'] == 'ended';
            $disabledAttribute = $isPollClosed ? 'disabled' : '';

            echo "<input type='submit' value='Vote' $disabledAttribute>";

            // Display the "Stop Poll" button if the logged-in user is the creator and the poll is open
            if ($isCreator && !$isPollClosed) {
                echo "<button type='submit' name='stop_poll'>Stop Poll</button>";
            }

            echo "<input type='hidden' name='poll_id' value='$pollId'>";
       
            echo "<input type='submit' value='View results' a href='polls/view_results.php'>";
            echo "</form>";

            echo "<a href='/pollify/index.php'>Go back</a>";
        } else {
            echo "<p>Poll not found.</p>";
        }
    } else {
        echo "<p>Database connection error.</p>";
    }
} else {
    echo "<p>Invalid poll ID.</p>";
}

// Process the form submission for stopping the poll
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['stop_poll'])) {
    // Update the poll status to indicate that it's closed
    $updateQuery = "UPDATE pollify.polls SET status = 'ended' WHERE id = :pollId";
    $stmtUpdate = $pdo->prepare($updateQuery);
    $stmtUpdate->execute(['pollId' => $pollId]);

    // Redirect the user to the view.php page to see the updated poll
    header("view_results.php?id=$pollId");
    exit();
}
?>
</body>
</html>
