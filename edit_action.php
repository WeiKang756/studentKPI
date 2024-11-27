<?php // Start a session for storing user data

include("config.php"); // Include your database connection configuration
session_start();

 $name = mysqli_real_escape_string($conn, $_POST['name']);
 $matricNo = mysqli_real_escape_string($conn, $_POST['student_id']);
 $program = mysqli_real_escape_string($conn, $_POST['program']);
 $email = mysqli_real_escape_string($conn, $_POST['email']);
 $intake_batch = mysqli_real_escape_string($conn, $_POST['intake_batch']);
 $mentor_name = mysqli_real_escape_string($conn, $_POST['mentor_name']);
 $state_of_origin = mysqli_real_escape_string($conn, $_POST['state_of_origin']);
 $student_id = $_SESSION['user_id'];


 $sql = "UPDATE users
         SET student_name = '$name',
             program = '$program',
             email = '$email',
             intake_batch = '$intake_batch',
             mentor_name = '$mentor_name',
             state_of_origin = '$state_of_origin'
         WHERE student_id = '$student_id'";

        if (mysqli_query($conn, $sql)) {
          echo '<script>';
          echo 'alert("successful!");';
          echo 'window.location.href = "about_me.php";';
          echo '</script>';
          exit();
        } else {
            echo "Error updating user information: " . mysqli_error($conn);
        }

mysqli_close($conn);
?>
