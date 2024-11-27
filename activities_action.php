<?php
// Start a session and set error reporting for development
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection configuration
include("config.php"); // Include your database connection configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $activity_name = mysqli_real_escape_string($conn, $_POST['activity_name']);
 $activity_type = mysqli_real_escape_string($conn, $_POST['activity_type']);
 $activity_level = mysqli_real_escape_string($conn, $_POST['activity_level']);
 $sem = mysqli_real_escape_string($conn, $_POST['sem']);
 $year = mysqli_real_escape_string($conn, $_POST['year']);
 $remark = mysqli_real_escape_string($conn, trim($_POST['remark']));
 $student_id = $_SESSION['user_id'];

 $sql = "INSERT INTO Activities (student_id, Sem, year, Activity_name, Activity_type, Activity_Level,remark)
         VALUES('$student_id','$sem','$year','$activity_name','$activity_type','$activity_level','$remark')";

        if (mysqli_query($conn, $sql)) {
            header("Location: list_of_activities.php"); // Redirect to a welcome page
            exit();
        } else {
            echo "Error updating user information: " . mysqli_error($conn);
        }

      }

mysqli_close($conn);
?>
