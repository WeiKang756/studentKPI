<?php
session_start(); // Start a session for storing user data

include("config.php"); // Include your database connection configuration

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['student_id'];
    $password = $_POST['password'];

    // Fetch the user's data from the database
    $sql = "SELECT * FROM users WHERE student_id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        $hashedPassword = $user['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Password is correct; log in the user
            $_SESSION['user_id'] = $user['student_id']; // Store user ID in the session
            $_SESSION['username'] = $user['student_name']; // Store username in the session
            header("Location: about_me.php"); // Redirect to a welcome page
            exit;
        } else {
            echo '<script>alert("Incorrect Password"); window.location.href = "index.php";</script>';
        }
    } else {
        echo '<script>alert("User not found"); window.location.href = "index.php";</script>';
    }
}

mysqli_close($conn);
?>
