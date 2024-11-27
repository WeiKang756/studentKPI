<?php
session_start(); // Start or resume the session

// Check if the user is logged in (session variables are set)
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    // Unset and destroy the session variables
    unset($_SESSION['user_id']);
    unset($_SESSION['username']);
    session_destroy();

    // Redirect the user to a login page or any other desired page
    header("Location: index.php");
    exit;
} else {
    // If the user is not logged in, redirect them to the login page
    header("Location: index.php");
    exit;
}
?>
