<?php
    //delete session storage user detais if user logging out
    session_start();
    session_unset();
    session_destroy();
    
    // return to home page
    header('Location: ../index.php');
?>