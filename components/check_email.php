<?php
// check_email.php

include('connect.php');

if (isset($_GET['email'])) {
    $email = $_GET['email'];

    $query = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Email already exists
        echo json_encode(array('status' => 'error', 'message' => 'Email already exists'));
    } else {
        // Email is available
        echo json_encode(array('status' => 'success', 'message' => 'Email is available'));
    }
}