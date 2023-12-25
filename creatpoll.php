<?php
if (!session_id()) {
    session_start();
}

// Check if the user is logged 
if (!isset($_SESSION['uid'])) {
    header('Location: ./login.php');
    exit;
} else {
    // Check if the user has either 'ADMIN' or 'USER' role
    if ($_SESSION['role'] != 'ADMIN' && $_SESSION['role'] != 'USER') {
        header('Location: ./index.php');
        exit;
    }
}

// Include the navigation.php file
include './components/navigation.php';

$host = "localhost:3306";
$username = "root";
$password = "";
$dbname = "pollify";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the poll details from the form submission
    $title = $_POST['title'];
    $options = $_POST['options'];

    // Validate the inputs
    if (empty($title) || empty($options)) {
        echo "Please fill in all the required fields.";
        exit();
    }

    // Get the user ID from the session
    $userId = $_SESSION['uid'];

    // Save the poll details to the database (assuming you have a working database connection)
    // Insert the poll details into the 'polls' table, including the 'created_by' column
    $insertQuery = "INSERT INTO pollify.polls (title, status, end_date, created_by) VALUES (:title, :status, :endDate, :userId)";
    $stmt = $pdo->prepare($insertQuery);
    $status = ($_POST['end_type'] === 'stop') ? 'ended' : 'open';
    $stmt->execute(['title' => $title, 'status' => $status, 'endDate' => $_POST['end_date'], 'userId' => $userId]);
    $pollId = $pdo->lastInsertId();

    // Insert the options into the 'options' table
    foreach ($options as $option) {
        $insertOptionQuery = "INSERT INTO pollify.options (poll_id, text) VALUES (:pollId, :text)";
        $stmtOptions = $pdo->prepare($insertOptionQuery);
        $stmtOptions->execute(['pollId' => $pollId, 'text' => trim($option)]);
    }

    // Redirect the user to the view.php page to see the poll
    header("Location:polls/view_poll.php?id=$pollId");
    exit();
}

try {
    // Your database code here
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit();
}
?>

<!-- HTML form for creating the poll -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../pollify/css/createpoll.css">
    <title>Create Poll</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
</head>
<body>
    <div class="form-container">
        <form method="POST" action="" id="createPollForm">
            <label for="title">Title/Question:</label>
            <input type="text" name="title" id="title" required><br><br>
            
            <div id="optionsContainer">
                <!-- Initial option input fields -->
                <div class="optionContainer">
                    <label for="options[]">Option 1:</label>
                    <input type="text" name="options[]" class="optionInput" required>
                    <button type="button" class="removeOptionBtn" style="display:none;">Remove</button>
                </div>

                <div class="optionContainer">
                    <label for="options[]">Option 2:</label>
                    <input type="text" name="options[]" class="optionInput" required>
                    <button type="button" class="removeOptionBtn" style="display:none;">Remove</button>
                </div>
            </div>
            
            <button type="button" id="addOptionBtn">Add Option</button><br><br>
            
            <label for="end_type">Choose end type:</label><br>
            <input type="radio" name="end_type" value="stop" required> Stop Poll<br>
            <input type="radio" name="end_type" value="scheduled" required> Scheduled End Date<br><br>
            
            <label for="end_date">End Date (if scheduled):</label>
            <input type="datetime-local" name="end_date" id="end_date"><br><br>
            
            <input type="submit" value="Create Poll">
        </form>

        <!-- Button to redirect to view.php -->
        <a href="index.php">Back to Homepage</a>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const addOptionBtn = document.getElementById('addOptionBtn');
                const optionsContainer = document.getElementById('optionsContainer');

                addOptionBtn.addEventListener('click', function () {
                    const optionContainer = document.createElement('div');
                    optionContainer.className = 'optionContainer';

                    const optionNumber = optionsContainer.children.length + 1;

                    const label = document.createElement('label');
                    label.textContent = `Option ${optionNumber}:`;
                    label.htmlFor = `options[]`;

                    const optionInput = document.createElement('input');
                    optionInput.type = 'text';
                    optionInput.name = 'options[]';
                    optionInput.className = 'optionInput';
                    optionInput.required = true;

                    const removeOptionBtn = document.createElement('button');
                    removeOptionBtn.type = 'button';
                    removeOptionBtn.className = 'removeOptionBtn';
                    removeOptionBtn.textContent = 'Remove';
                    removeOptionBtn.style.display = 'inline';

                    removeOptionBtn.addEventListener('click', function () {
                        optionsContainer.removeChild(optionContainer);
                    });

                    optionContainer.appendChild(label);
                    optionContainer.appendChild(optionInput);
                    optionContainer.appendChild(removeOptionBtn);
                    optionsContainer.appendChild(optionContainer);
                });
            });
        </script>
    </div>
</body>
</html>
