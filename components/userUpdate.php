<?php
session_start();
include('connect.php');

// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    header('Location: ./login.php');
    exit;
}

$uid = $_SESSION['uid'];
$errors = '';


$sql = "SELECT * FROM users 
            WHERE uid = '$uid' 
            LIMIT 1";

$res = $conn->query($sql);
if (($data = $res->fetch())) {
    $curr_email = $data[1];
    $curr_fname = $data[4];
    
    
    $_SESSION['email'] = $data[1];
    $_SESSION["fName"] = $data[4];
    
} else {
    header('Location: ./login.php');
}
?>