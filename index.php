<?php
include_once('./components/connect.php');

$sql = "SELECT * FROM polls ORDER BY id DESC";
$res = $conn->query($sql);
$polldata = $res->fetchAll();
?>

<html>

<head>
    <title>Pollify</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <?php include('./components/navigation.php') ?>

    <div class="wrapper">
        <div class="mainbody">
            <div class="text-center heading marginA">

                <h4> Welcome to </h4>
                <img src="img/pollifyhome.png">
                <p> Create a poll in minutes</p>
                <?php
                if (!session_id()) {
                    session_start();
                }
                if (isset($_SESSION['uid']) && ($_SESSION['role'] == 'ADMIN' || $_SESSION['role'] == 'USER')) {
                    ?>
                    <button class="ask-btn" onclick="window.location.href = ('./creatpoll.php')">Create Poll</button>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <p class="text-center" style="font-size: 25px;">
        <a href="polls/pindex.php" style="text-decoration: none; color: inherit;">Discover Polls</a>
    </p>
    <div class="dpolls">
        <?php
        if ($polldata) {
            foreach ($polldata as $row) {
                // Fetch all options for the current poll
                $pollId = $row["id"];
                $queryOptions = "SELECT * FROM options WHERE poll_id = :pollId";
                $stmtOptions = $conn->prepare($queryOptions);
                $stmtOptions->execute(['pollId' => $pollId]);
                $options = $stmtOptions->fetchAll(PDO::FETCH_ASSOC);

                ?>
                <div class="polls">
                    <a href="polls/view_poll.php?id=<?php echo $row["id"]; ?>">
                        <h4 class="q-title"><?php echo $row["title"]; ?></h4>

                        <?php
                        // Display all options for the current poll
                        if (!empty($options)) {
                            echo "<ul>";
                                foreach ($options as $option) {
                                    // Fetch the vote count for each option
                                    $optionId = $option['id'];
                                    $queryVoteCount = "SELECT COUNT(*) as count FROM votes WHERE poll_id = :pollId AND option_id = :optionId";
                                    $stmtVoteCount = $conn->prepare($queryVoteCount);
                                    $stmtVoteCount->execute(['pollId' => $pollId, 'optionId' => $optionId]);
                                    $voteCount = $stmtVoteCount->fetch(PDO::FETCH_ASSOC)['count'];

                                    echo "<p style='color: white; text-align: center; margin: 0;'>{$option['text']} - {$voteCount} votes</p>";
                                }
                            echo "</ul>";
                        } else {
                            echo "<p>No options found for this poll.</p>";
                        }
                        ?>

                        <p class="post-date" style="color: white;"><?php echo $row["created_at"]; ?></p>
                        <hr style="border:none ;height: 0.8px; background:#017DC3">
                    </a>
                </div>
            <?php }
        } else {
            ?>
            <div class="">
                <p class="my-5">No polls found.</p>
            </div>
        <?php
        } ?>
    </div>

    <?php include('components/footer.php') ?>

</body>

</html>

<style>
    body {
        font-family: 'ITC Bauhaus', sans-serif;
        margin: 0;
        padding: 0;
    }

    /* Navigation bar styles */
    nav {
        width: 100%;
        padding: 0;
        background: linear-gradient(135deg, #004aad, #cb6ce6);
        color: white;
    }

    .container-fluid {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem; /* Adjust padding as needed */
    }

    .top-bar-title {
        text-decoration: none;
        color: white;
    }

    .top-bar-title img {
        height: 60px;
    }

    .navigate {
        display: flex;
    }

    .navigate a {
        color: white;
        text-decoration: none;
        margin-right: 1rem; /* Adjust margin as needed */
    }

    /* Wrapper styles */
    .wrapper {
        margin: auto; /* Adjust margin as needed */
    }

    .mainbody {
        text-align: center;
        margin-top: 0; /* Remove top margin */
    }

    /* Heading styles */
    .heading {
        margin-bottom: 1rem; /* Adjust margin as needed */
    }

    .ask-btn {
        background-color: #004aad;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        cursor: pointer;
    }

    .ask-btn:hover {
        background-color: #002e66;
    }

    /* Discover Polls styles */
    .dpolls {
        margin: 0 auto;
        margin-top: 1rem;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        gap: 1rem;
        align-items: stretch;
        padding: 20px 10px;
    }

    /* Polls styles */
    .polls {
        box-sizing: border-box;
        width: calc(25% - 20px);
        margin-bottom: 1rem;
        padding: 1rem;
        border: 3px solid #dee2e6;
        border-radius: 25px;
        text-align: center;
        text-decoration: none;
        color: white; /* Updated text color to white */
        font-weight: bold; /* Make the text bold */
        background: linear-gradient(135deg, #004aad, #cb6ce6); /* Updated background color */
        transition: box-shadow 0.8s;
    }

    h4 {
        color: white; /* Updated text color to white */
        font-weight: bold; /* Make the text bold */

    }

    p {



    }

    .polls:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .q-title {
        margin-bottom: 0.5rem; /* Adjust margin as needed */
    }

    .post-date {
        color: #6c757d;
        font-size: 0.8rem;
    }

    .post-date::before {
        content: '\2022'; /* Bullet character */
        margin-right: 0.5rem;
        color: #6c757d;
    }

</style>
