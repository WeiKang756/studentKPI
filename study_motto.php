<?php
// Start a session and set error reporting for development
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Include database connection configuration
include("config.php"); // Include your database connection configuration


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize user inputs
    $study_motto = filter_var($_POST['study_motto'], FILTER_SANITIZE_STRING);
    $student_id = $_SESSION['user_id'];

    // Prepare and execute the SQL update statement
    $sql = 'UPDATE users
            SET study_motto = ?
            WHERE student_id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $study_motto, $student_id);

    if ($stmt->execute()) {
        // Update was successful
        echo '<script>';
        echo 'alert("successful!");';
        echo 'window.location.href = "about_me.php";';
        echo '</script>';
        exit();
        // You can redirect the user to a success page or perform other actions
    } else {
        // Handle the update error here
        echo "Update failed: " . $stmt->error;
    }

    mysqli_close($conn);
}
?>
