<?php
// Start a session for storing user data
session_start();

include("config.php"); // Include your database connection configuration

$target_dir = "uploads/";

// Check if 'uploads/' directory exists, if not create it
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check if the 'uploads/' directory is writable
if (!is_writable($target_dir)) {
    die('Error: the upload directory is not writable.');
}

$student_id = $_SESSION['user_id']; // Retrieve student ID from session

// Retrieve the current image path from the database
$currentImagePath = '';
$sql = "SELECT profile_image_path FROM users WHERE student_id = '$student_id'";
$result = mysqli_query($conn, $sql);
if ($result && $row = mysqli_fetch_assoc($result)) {
    $currentImagePath = $row['profile_image_path'];
}

if (isset($_FILES['profilePicture'])) {
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($_FILES['profilePicture']['name'], PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES['profilePicture']['tmp_name']);
    if ($check !== false) {
        echo "File is an image - " . $check['mime'] . ".";
        $uploadOk = 1;
    } else {
        echo '<script>';
        echo 'alert("File is not an image.");';
        echo 'window.location.href = "about_me.php";';
        echo '</script>';
        exit();
    }

    // Check for file size
    if ($_FILES['profilePicture']['size'] > 5000000) { // 5MB size limit
        echo '<script>';
        echo 'alert("Sorry, your file is too large.");';
        echo 'window.location.href = "about_me.php";';
        echo '</script>';
        exit();
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo '<script>';
        echo 'alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");';
        echo 'window.location.href = "about_me.php";';
        echo '</script>';
        exit();
    }

    if ($uploadOk == 1) {
        // Generate unique file name
        $fileBaseName = pathinfo($_FILES['profilePicture']['name'], PATHINFO_FILENAME);
        $uniqueSuffix = uniqid() . '_' . time();
        $fileName = $fileBaseName . '_' . $uniqueSuffix . '.' . $imageFileType;
        $target_file = $target_dir . $fileName;

        if (move_uploaded_file($_FILES['profilePicture']['tmp_name'], $target_file)) {
            echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";

            // Define the path of the default image
            $defaultImagePath = $target_dir . 'image.png';

            // Check if the current image path is not the default image path
            if ($currentImagePath && file_exists($currentImagePath) && $currentImagePath != $target_file && $currentImagePath != $defaultImagePath) {
                unlink($currentImagePath);
            }

            // Update the user's profile image path in the database
            $sql = "UPDATE users SET profile_image_path = '$target_file'
                    WHERE student_id = '$student_id'";

            if (mysqli_query($conn, $sql)) {
                echo '<script>';
                echo 'alert("Profile updated successfully!");';
                echo 'window.location.href = "about_me.php";';
                echo '</script>';
                exit();
            } else {
                echo "Error updating user information: " . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

mysqli_close($conn);
?>
