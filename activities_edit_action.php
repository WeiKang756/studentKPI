<?php
// Start a session and set error reporting for development
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection configuration
include("config.php"); // Include your database connection configuration

$Activities_id = $_SESSION['activities_id'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize user inputs
    $Activity_name = filter_var($_POST['activity_name'], FILTER_SANITIZE_STRING);
    $Activity_type = filter_var($_POST['activity_type'], FILTER_SANITIZE_STRING);
    $Activity_Level = filter_var($_POST['activity_level'], FILTER_SANITIZE_STRING);
    $Sem = intval($_POST['sem']);
    $year = intval($_POST['year']);
    $Remark = filter_var($_POST['remark'], FILTER_SANITIZE_STRING);

    // Prepare and execute the SQL update statement
    $sql = 'UPDATE Activities
            SET Activity_name = ?,
                Activity_type = ?,
                Activity_Level = ?,
                Sem = ?,
                year = ?,
                Remark = ?
            WHERE Activities_id = ?';

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiisi", $Activity_name, $Activity_type, $Activity_Level, $Sem, $year, $Remark, $Activities_id);

    if ($stmt->execute()) {
        // Update was successful
        header("Location: list_of_activities.php"); // Redirect to a welcome page
        exit();
        // You can redirect the user to a success page or perform other actions
    } else {
        // Handle the update error here
        echo "Update failed: " . $stmt->error;
    }

    mysqli_close($conn);
}
?>
