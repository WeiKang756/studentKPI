<?php
// Start a session and set error reporting for development
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection configuration
include("config.php"); // Include your database connection configuration

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $challengeDescription = $_POST['challenge_description'];
    $futurePlan = $_POST['future_plan'];
    $sem = $_POST['sem'];
    $year = $_POST['year'];
    $remark = $_POST['remark'];
    $student_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO Challenges (challenge_description, future_plan, sem, year, remarks, student_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiss", $challengeDescription, $futurePlan, $sem, $year, $remark, $student_id);

    if ($stmt->execute()) {
      echo '<script>';
      echo 'alert("Insert Challenges Successful");';
      echo 'window.location.href = "challenges.php";';
      echo '</script>';
      exit();

    } else {
        // Error handling
        echo "Error: " . $stmt->error;
}

$stmt->close();
}

mysqli_close($conn);
?>
