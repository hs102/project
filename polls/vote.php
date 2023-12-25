<?php
require 'connection.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['uid'])) {
    header('../pollify/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the poll ID from the form submission
    $pollId = $_POST['poll_id'];

    // Check if the 'option' key is set in $_POST
    if (isset($_POST['option'])) {
        $selectedOption = $_POST['option'];

        // Get the user ID from the session
        $userId = $_SESSION['uid'];

        // Check if the user has already voted for this poll
        $query = "SELECT * FROM votes WHERE poll_id = :pollId AND user_id = :userId";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['pollId' => $pollId, 'userId' => $userId]);
        $existingVote = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$existingVote) {
            // Insert the user's vote into the database
            $insertQuery = "INSERT INTO votes (poll_id, user_id, option_id) VALUES (:pollId, :userId, :selectedOption)";
            $stmt = $pdo->prepare($insertQuery);
            $stmt->execute(['pollId' => $pollId, 'userId' => $userId, 'selectedOption' => $selectedOption]);

            // Redirect the user to the results page for the poll
            header("Location: view_results.php?id=$pollId");
            exit();
        } else {
            // Fetch the text associated with the selected option
            $optionQuery = "SELECT text FROM options WHERE id = :selectedOption";
            $stmt = $pdo->prepare($optionQuery);
            $stmt->execute(['selectedOption' => $selectedOption]);
            $option = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($option && isset($option['text'])) {
                echo "You have already voted for option: {$option['text']}";
            } else {
                echo "You have already voted for this poll.";
            }

            echo "<a href='/pollify/index.php'>Take me there</a>";
        }
    } else {
        echo "Please select an option before submitting.";
    }
}
?>


