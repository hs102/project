<?php
if (!session_id()) {
    session_start();
}

include_once('connect.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    //hashing password before compare with DB password (using SHA1 hash method)
    $hashed_pass = sha1($pass);
    //Prepare Mysql Query to check the user exists
    $sql = "SELECT * FROM users 
            WHERE email = '{$email}' 
            AND password = '{$hashed_pass}' 
            LIMIT 1";

    $res = $conn->query($sql);
    if (($data = $res->fetch())) {
        $_SESSION['uid'] = $data[0];
        $_SESSION['email'] = $data[1];
        $_SESSION['role'] = $data[2];
        $_SESSION["fName"] = $data[4];
       
    }
}
?>