<?php
// Start a session and set error reporting for development
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection configuration
include("config.php"); // Include your database connection configuration

$challenges_id = $_GET['challenges_id'];
$sql = 'DELETE FROM Challenges WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $challenges_id); // Change "s" to "i" for integer

if ($stmt->execute()) {
    // Update was successful
    echo '<script>';
    echo 'alert("Challenges Delete successful!");';
    echo 'window.location.href = "challenges.php";';
    echo '</script>';
    exit();
    // You can redirect the user to a success page or perform other actions
} else {
    // Handle the update error here
    echo "Update failed: " . $stmt->error;
}

mysqli_close($conn);
?>
