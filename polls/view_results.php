<!DOCTYPE html>
<html>
<head>
    <title>Poll Results</title>
    
</head>
<body>

<?php include('../components/navigation.php'); ?>


<?php

require 'connection.php';

// Get the poll ID from the URL parameter
$pollId = $_GET['id'];

// Fetch the poll details from the database based on the ID
$query = "SELECT * FROM polls WHERE id = :pollId";
$stmt = $pdo->prepare($query);
$stmt->execute(['pollId' => $pollId]);
$poll = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch all options for the current poll
$queryOptions = "SELECT * FROM options WHERE poll_id = :pollId";
$stmtOptions = $pdo->prepare($queryOptions);
$stmtOptions->execute(['pollId' => $pollId]);
$options = $stmtOptions->fetchAll(PDO::FETCH_ASSOC);

// Fetch the vote counts for each option from the database using a separate query
$queryVoteCounts = "SELECT option_id, COUNT(*) as count FROM votes WHERE poll_id = :pollId GROUP BY option_id";
$stmtVoteCounts = $pdo->prepare($queryVoteCounts);
$stmtVoteCounts->execute(['pollId' => $pollId]);
$voteCounts = $stmtVoteCounts->fetchAll(PDO::FETCH_ASSOC);

if ($poll) {
    echo "<div class='form-container'>";
    echo "<h1 class='form-title'>{$poll['title']} - Results</h1>";

    // Display the results
    echo "<ul>";
    foreach ($options as $option) {
        $optionId = $option['id'];
        $voteCount = 0;

        // Check if there are votes for the current option
        foreach ($voteCounts as $vote) {
            if ($vote['option_id'] == $optionId) {
                $voteCount = $vote['count'];
                break;
            }
        }

        echo "<li>{$option['text']} - {$voteCount} votes</li>";
    }
    echo "</ul>";

    echo "</div>";
    echo "<a class='form-link' href='/pollify/index.php'>Take me Back</a>";
}
?>
</body>
</html>
