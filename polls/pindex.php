<?php
require 'connection.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Poll System</title>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
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

        h1, h2 {
            text-align: center;
            color: #333;
        }

        ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 0;
        }

        li {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Optional: Add some hover effect */
        li:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        /* Optional: Style poll titles */
        li h3 {
            color: #333;
        }

        /* Optional: Style poll status */
        li p {
            color: #777;
            margin-top: 10px;
        }

        /* Optional: Add a button-like styling for the poll links */
        li a {
            display: block;
            background-color: #3498db;
            color: #fff;
            text-align: center;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        /* Optional: Add hover effect for the poll links */
        li a:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <?php include('../components/navigation.php') ?>

    <h1>Poll System</h1>
    <h2>Open Polls</h2>
    <ul>
        <!-- Display a list of open polls -->
        <?php include 'open_polls.php'; ?>
    </ul>

    <h2>Ended Polls</h2>
    <ul>
        <!-- Display a list of ended polls -->
        <?php include 'ended_polls.php'; ?>
    </ul>
</body>

</html>
